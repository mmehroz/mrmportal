<?php

namespace App\Http\Controllers;

use App\TeamMilestone;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Notifications\newNotification;
use App\TeamMembers;
use App\Team;
use App\User;

class TeamController extends Controller
{
    private $model, $section, $components;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->section = new \stdClass();
        $this->section->title = 'Teams';
        $this->section->heading = 'Teams';
        $this->section->slug = 'teams';
        $this->section->folder = 'teams';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        checkPermission('read-team');
        $section = $this->section;
        $team_members = Team::with('teamMembers.user')->get();
        // dd( $team_members);
        return view($section->folder.'.index', compact('team_members', 'section'));
    }

    public function create()
    {
        checkPermission('create-team');
        $team = [];
        $section = $this->section;
        $section->heading = 'Teams';
        $section->title = 'Add Team';
        $section->method = 'POST';
        $section->route = $section->slug.'.store';
        return view($section->folder.'.createform',compact('section', 'team'));
    }

    public function store(Request $request)
    {
        $section = $this->section;

        $validationMessages = [
            'name.unique' => 'Team name already exist. Please enter a unique team name',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:teams,name',
        ], $validationMessages);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {

            $request->request->add(['user_id'=>auth()->user()->id]);
            // dd($request->toArray());

            $team = Team::create([
                    'name' => $request->name,
                    'team_target' => $request->team_target,
                    'user_id' => auth()->user()->id
            ]);

            // For Team Lead
            $teamLead = TeamMembers::create([
                    'member_id' => $request->team_lead,
                    'team_id' => $team->id,
                    'is_lead' => 1,
                    'user_id' => auth()->user()->id
                ]);
            $sender = User::find(auth()->user()->id); 
            // $recipient = User::find($lastComment->user_id); 
            // Send Notification of New Team to Team Lead
                $detailNotify = [
                    'description' => $sender->name.' has assigned you as team lead of '.$team->name,
                    'link' => 'javascript:void(0)',
                    'member_id' => $teamLead->member_id,
                    'user_id' => auth()->user()->id
                 ];
                 User::find($teamLead->member_id)->notify( new newNotification($detailNotify));
            // For Team Members
            foreach ($request->member_id as $member_id){
                $project_user = TeamMembers::create([
                    'member_id' => $member_id,
                    'team_id' => $team->id,
                    'is_lead' => 0,
                    'user_id' => auth()->user()->id
                ]);
                // Send Notification of New Team to members
                $detailNotify = [
                    'description' => $sender->name.' has created a new team '.$team->name,
                    'link' => 'javascript:void(0)',
                    'member_id' => $member_id,
                    'user_id' => auth()->user()->id
                 ];
                 User::find($member_id)->notify( new newNotification($detailNotify));
            }

            $request->session()->flash('flash_message', 'Record has been added successfully.');
            return redirect()->route($section->slug.'.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        checkPermission('update-team');
         $section = $this->section;
         $section->heading = 'Teams';
         $section->title = 'Edit Team';
         $section->method = 'PUT';
         $section->route = [$section->slug.'.update', $team];
        return view($section->folder.'.form', compact('team', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        // dd($request->team_lead(), $team->id);
        $section = $this->section;

        //define custom validation messages for validator
        $validationMessages = [
            'name.unique' => 'Team name already exist. Please enter a unique team name',
        ];
        // validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:teams,name,'. $team->id . ',id',
        ], $validationMessages);

        //validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {
            $team->name = $request->name;
            $team->team_target = $request->team_target;
            $team->save();
            // $team->update($request->all());
            TeamMembers::where('team_id', $team->id)->delete();
            $sender = User::find(auth()->user()->id); 
            // $recipient = User::find($lastComment->user_id); 
            // For Team Lead
            $teamLead = TeamMembers::create([
                    'member_id' => $request->team_lead,
                    'team_id' => $team->id,
                    'is_lead' => 1,
                    'user_id' => auth()->user()->id
                ]);

            // dd($request->team_lead, $teamLead->member_id);
            // if ($request->team_lead != $teamLead->member_id) {        
            //     // Send Notification of New Team to Team Lead
            //     $detailNotify = [
            //         'description' => $sender->name.' has assigned you as team lead of '.$team->name,
            //         'link' => 'javascript:void(0)',
            //         'member_id' => $teamLead->member_id,
            //         'user_id' => auth()->user()->id
            //      ];
            //      User::find($teamLead->member_id)->notify( new newNotification($detailNotify));
            // }

            // For Team Members
            foreach ($request->member_id as $member_id){
                $project_user = TeamMembers::create([
                    'member_id' => $member_id,
                    'team_id' => $team->id,
                    'is_lead' => 0,
                    'user_id' => auth()->user()->id
                ]);
            }



            $request->session()->flash('alert-success', 'Record has been updated successfully.');
            return redirect()->route($section->slug . '.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Category $category)
//    {
//         $section = $this->section;
//         $category->delete();
//         request()->session()->flash('alert-success', 'Record has been deleted successfully.');
//         return redirect()->route($section->slug.'.index');
//    }


    public function generateReport(Request $request)
    {

        $section = $this->section;
        $query = TeamMembers::where('id', '>', 0);
        if (!empty($request->team_id)){
            $query->where('team_id', $request->team_id);
        }
        $teams = $query->get();

        $teamMilestoneQuery = TeamMilestone::whereBetween('created_at', [$request->start_date, $request->end_date]);

        // dd( $request->start_date, $request->end_date);
        if (!empty($request->team_id)){
            $teamMilestoneQuery->where('team_id', $request->team_id);
        }
        $teamMilestones = $teamMilestoneQuery->get();
       // dd($teamMilestones->toArray());
        $targets = [];

        foreach ($teams->groupBy('team_id') as $team_id => $teamMembers){
            $targets[$team_id]['team_id'] = $team_id;
            $targets[$team_id]['team_target'] = $this->getTeamSaleRecord($request, $team_id);
//            dump($team_id);
//            dump($this->getTeamSaleRecord($request, $team_id));
            foreach ($teamMembers as $key => $teamMember){
                $targets[$team_id]['members'][$key] = $teamMember->toArray();
                $targets[$team_id]['members'][$key]['sale_amount'] = $this->getPersonSaleRecord($request, $teamMember);
//                dump($teamMember->toArray());
            }
        }
//        dd('End', $target);
//
//        dd($request->toArray(), $targets);

        return view($section->folder.'.team_report', compact('targets', 'teamMilestones', 'section'));
    }


    public function getPersonSaleRecord(Request $request, $memberDetail)
    {
        $memberData = TeamMilestone::whereBetween('created_at', [$request->start_date, $request->end_date])->where('sale_id', $memberDetail->member_id)->get();
        return $memberData->sum('sale_amount');
    }

    public function getTeamSaleRecord(Request $request, $TeamID)
    {
        $teamData = TeamMilestone::whereBetween('created_at', [$request->start_date, $request->end_date])->where('team_id', $TeamID)->get();
        return $teamData->sum('team_amount');
    }
}
