<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectMilestone;
use App\Team;
use App\User;
use App\TeamMembers;
use App\TeamMilestone;
use Illuminate\Http\Request;
use App\Notifications\newNotification;

class ProjectMilestoneController extends Controller
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
        $this->section->heading = 'Team Milestone';
        $this->section->title = 'Edit Milestone';
        $this->section->slug = 'project_milestone';
        $this->section->folder = 'projects';
    }     

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['user_id'=>auth()->user()->id]);

        $project = Project::where('id', $request->project_id)->first();

        $milestone = ProjectMilestone::create($request->all());

        // Send Notification of New Milestone to Owner & Admin
        $sender = User::find(auth()->user()->id); 
        $recipients = User::whereIn('user_type', [1,3])->get(); // Admin, Owner
        $detailNotify = [
            'description' => $sender->name.' has created a new Milestone on '.$project->title,
            'link' => route("projects.show", $project->id),
            'member_id' => array(1,3), // Admin, Owner
            'user_id' => auth()->user()->id
         ];
         foreach($recipients as $recipient){
              User::find($recipient->id)->notify( new newNotification($detailNotify));
         }
        if(empty($project->sale_id) && $project->bidder_id){ // Bidder Amount
            TeamMilestone::create([
                'project_id' => $project->id,
                'milestone_id' => $milestone->id,
                'milestone' => $request->amount,
                'sale_id' => $project->bidder_id,
                'sale_amount' => $request->amount,
                'team_id' => $project->team_id,
                'team_amount' => $request->amount,
                'user_id' => $request->user_id,
            ]);
//            dump('Bidder 100%');
        }

        if($project->sale_id && $project->bidder_id){ // Check Same Team or Different Team
            $team = TeamMembers::where('team_id', $project->team_id)->get();
            if(in_array($project->sale_id, $team->pluck('member_id')->toArray())){
                $salePerson = 1;
            }
            else {
                $salePerson = 0;
            }

            if(in_array($project->bidder_id, $team->pluck('member_id')->toArray())){
                $bidderPerson = 1;
            }
            else {
                $bidderPerson = 0;
            }

            if ($salePerson == 1 && $bidderPerson == 1){ // Sale Person Amount
                TeamMilestone::create([
                    'project_id' => $request->project_id,
                    'milestone_id' => $milestone->id,
                    'milestone' => $request->amount,
                    'sale_id' => $project->sale_id,
                    'sale_amount' => $request->amount,
                    'team_id' => $project->team_id,
                    'team_amount' => $request->amount,
                    'user_id' => $request->user_id,
                ]);
//                dump('Same Team', 'Sale Person 100%');
            }
            else { // Sale Person And Team Amount Divide
                TeamMilestone::create([
                    'project_id' => $request->project_id,
                    'milestone_id' => $milestone->id,
                    'milestone' => $request->amount,
                    'sale_id' => $project->sale_id,
                    'sale_amount' => $request->amount * 40 / 100,
                    'team_id' => $project->team_id,
                    'team_amount' => $request->amount * 60 / 100,
                    'user_id' => $request->user_id,
                ]);
//                dump('Different Team Sale Person 40% & Team 60%');
            }
//            dd($team->pluck('member_id')->toArray(), $bidderPerson, $salePerson);
        }

        $request->session()->flash('alert-success', 'Record has been added successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // checkPermission('update-daily-target');
        $section = $this->section;
        $section->heading = 'Team Milestone';
        $section->title = 'Edit Milestone';
        $section->method = 'PUT';
        $section->route = [$section->slug.'.update', $id];
        $bidder_sale = getUserByType([5,4]); // plucked names and IDs
        $teams = Team::pluck('name', 'id');

        $teamMilestone = TeamMilestone::where('id', $id)->first();
        return view($section->folder.'.form-milestone', compact('bidder_sale','teams','teamMilestone', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $project = Project::where('id', $request->project_id)->first();


//         if(empty($project->sale_id) && $project->bidder_id){ // Bidder Amount
//             TeamMilestone::create([
//                 'project_id' => $project->id,
//                 'milestone_id' => $milestone->id,
//                 'milestone' => $request->amount,
//                 'sale_id' => $project->bidder_id,
//                 'sale_amount' => $request->amount,
//                 'team_id' => $project->team_id,
//                 'team_amount' => $request->amount,
//                 'user_id' => $request->user_id,
//             ]);
// //            dump('Bidder 100%');
//         }

        // if($project->sale_id && $project->bidder_id){ // Check Same Team or Different Team
        //     $team = TeamMembers::where('team_id', $project->team_id)->get();
        //     if(in_array($project->sale_id, $team->pluck('member_id')->toArray())){
        //         $salePerson = 1;
        //     }
        //     else {
        //         $salePerson = 0;
        //     }

        //     if(in_array($project->bidder_id, $team->pluck('member_id')->toArray())){
        //         $bidderPerson = 1;
        //     }
        //     else {
        //         $bidderPerson = 0;
        //     }

        //     if ($salePerson == 1 && $bidderPerson == 1){ // Sale Person Amount
                $teamMilestone = TeamMilestone::find($id);
                $teamMilestone->project_id = $request->project_id;
                $teamMilestone->milestone = $request->milestone;
                $teamMilestone->sale_id = $request->sale_id;
                $teamMilestone->sale_amount = $request->sale_amount;
                $teamMilestone->team_id = $request->team_id;
                $teamMilestone->team_amount =  $request->team_amount;
                $teamMilestone->save();

//                dump('Same Team', 'Sale Person 100%');
            // }
            // else { // Sale Person And Team Amount Divide
               // TeamMilestone::create([
               //      'project_id' => $request->project_id,
               //      'milestone_id' => $milestone->id,
               //      'milestone' => $request->amount,
               //      'sale_id' => $project->sale_id,
               //      'sale_amount' => $request->amount * 40 / 100,
               //      'team_id' => $project->team_id,
               //      'team_amount' => $request->amount * 60 / 100,
               //      'user_id' => $request->user_id,
               //  ]);
//                dump('Different Team Sale Person 40% & Team 60%');
            // }
        // }
        $request->session()->flash('alert-success', 'Record has been added successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
