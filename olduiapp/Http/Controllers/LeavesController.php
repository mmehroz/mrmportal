<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notifications\newNotification;
use App\Rules\checkAvail;
use Carbon\Carbon;
use App\Leave;
use App\User;

class LeavesController extends Controller
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
        $this->section->title = 'All Leaves';
        $this->section->heading = 'Leave';
        $this->section->slug = 'leaves';
        $this->section->folder = 'leaves';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // checkPermission('read-team');
        $section = $this->section;
        if (!in_array(auth()->user()->user_type,[0,1,3,7])) {
           $leaves = Leave::with('user')->where('user_id',auth()->user()->id)->get();
           return view($section->folder.'.index', compact('leaves', 'section'));
        }
        $leaves = Leave::with('user')->get();
        return view($section->folder.'.index', compact('leaves', 'section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // checkPermission('create-team');
        $leaves = [];
        $section = $this->section;
        $section->heading = 'Add New Leave';
        $section->title = 'New Leave';
        $section->method = 'POST';
        $section->route = $section->slug.'.store';

        return view($section->folder.'.form',compact('section', 'leaves'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = $this->section;

        // $validationMessages = [
        //     'name.unique' => 'Team name already exist. Please enter a unique team name',
        // ];
        $no_of_days = 0;
        if ($request->leave_type == 0) {
            $no_of_days = 0.5;
        }
        elseif ($request->leave_type == 1) {
            $no_of_days = 1;
        }
        else{
            $no_of_days = Carbon::parse($request->date_from)
                          ->diffInDays(Carbon::parse($request->date_to)) + 1;
        }

        $validator = Validator::make($request->all(), [
            'reason' => 'required|string',
        ]);
        $availed_leaves = Leave::where(['user_id' => auth()->user()->id, 'status' => 2])
                          ->pluck('no_of_days')
                          ->sum();
        $applied_leaves = Leave::where(['user_id' => auth()->user()->id, 'status' => 0])
                          ->pluck('no_of_days')
                          ->sum();
        $total_leaves = $availed_leaves + $applied_leaves;
        $available_leaves = auth()->user()->no_of_leaves - $total_leaves;
        if (($no_of_days <= $available_leaves)) {
        if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {
            if ($request->leave_type == 0) {
                 $request->request->add([
                    'date_from'=> $request->date_from,
                    'date_to'=> $request->date_from,
                    'no_of_days'=> 0.5
                ]);
            }
            elseif ($request->leave_type == 1) {
                 $request->request->add([
                    'date_from'=> $request->date_from,
                    'date_to'=> $request->date_from,
                    'no_of_days'=> 1
                ]);
            }
            else{
                  $request->request->add([
                    'date_from'=> $request->date_from,
                    'date_to'=> $request->date_to,
                    'no_of_days'=> Carbon::parse($request->date_from)->diffInDays(Carbon::parse($request->date_to)) + 1
                ]);
            }
            $request->request->add([
                'user_id'=>auth()->user()->id,
                'status'=> 0
            ]);

            Leave::create($request->all());
            // Send Notification of New Leave
            $sender = User::find(auth()->user()->id);
            $recipients = User::whereIn('user_type', [1,3,6,7])->get();
            $detailNotify = [
                'description' => $sender->name.' has applied for '.($no_of_days != 0.5 ? 'leaves' : 'half day'),
                'link' => route("leaves.index"),
                'member_id' => array(1,3,6,7),
                'user_id' => auth()->user()->id
             ];
             foreach($recipients as $recipient){
                 User::find($recipient->id)->notify( new newNotification($detailNotify));
             }
            $request->session()->flash('flash_message', 'Record has been added successfully.');
            return redirect()->route($section->slug.'.index');
        }
        }
        else{
            $request->session()->flash('alert-danger', 'Kindly check your allowed leaves!');
            return redirect()->back()->withInput($request->input());
        }
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
        $section = $this->section;
        $section->heading = 'Edit Leave';
        $section->title = 'Edit Leave';
        $section->method = 'PUT';
        $section->route = [$section->slug.'.update', $id];
        $leaves = Leave::find($id);
        return view($section->folder.'.form', compact('leaves', 'section'));
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
        $section = $this->section;

        // $validationMessages = [
        //     'name.unique' => 'Team name already exist. Please enter a unique team name',
        // ];
        $validator = Validator::make($request->all(), [
            'reason' => 'required|string',
        ]);

        if ($validator->fails()) {
                return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {
            if ($request->leave_type == 0) {
                 $request->request->add([
                    'date_from'=> $request->date_from,
                    'date_to'=> $request->date_from,
                    'no_of_days'=> 0.5
                ]);
            }
            elseif ($request->leave_type == 1) {
                 $request->request->add([
                    'date_from'=> $request->date_from,
                    'date_to'=> $request->date_from,
                    'no_of_days'=> 1
                ]);
            }
            else{
                  $request->request->add([
                    'date_from'=> $request->date_from,
                    'date_to'=> $request->date_to,
                    'no_of_days'=> Carbon::parse($request->date_from)->diffInDays(Carbon::parse($request->date_to)) + 1
                ]);
            }
            $request->request->add([
                'status'=> $request->status
            ]);
            $leave = Leave::find($id);
            $leave->update($request->all());
            // Send Notification of Leave Update
            $leave_status = $request->status;
            $sender = User::find(auth()->user()->id);
            $recipient = User::find($leave->user_id);
            if($leave_status != 0){
            $text = $leave_status == 1 ? 'rejected' : 'approved';
            $detailNotify = [
                'description' => $sender->name.' has '.$text.' your leave request',
                'link' => route("leaves.index"),
                'member_id' => $recipient->id,
                'user_id' => auth()->user()->id
             ];
            User::find($recipient->id)->notify( new newNotification($detailNotify));
            }
            $request->session()->flash('flash_message', 'Record has been added successfully.');
            return redirect()->route($section->slug.'.index');
        }
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

    public function summary(Request $request)
    {
         checkPermission('summary-leave');
        $section = $this->section;
        $this->section->title = 'Employee Leaves Summary';

        $users = User::whereIn('user_type', [4,5,6,7,8,9])->orderBy('user_type', 'ASC')->get();
//        dd($users->toArray());
        return view($section->folder.'.summary', compact('users', 'section'));
    }
}
