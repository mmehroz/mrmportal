<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\DailyProgress;
use App\Project;
use App\User;

class DailyProgressController extends Controller
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
        $this->section->title = 'Daily Progress';
        $this->section->heading = 'Daily Progress';
        $this->section->slug = 'daily_progress';
        $this->section->folder = 'daily_progress';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        checkPermission('read-daily-progress');
        $section = $this->section;
        $section->method = 'GET';
        $section->route = $section->slug.'.index';

        $date_from = ($request->date_from ? $request->date_from : date('Y-m-01'));
        $date_to = ($request->date_to ? $request->date_to : date('Y-m-d'));

        // For Developers only
        if(auth()->user()->user_type == 8 || auth()->user()->user_type == 9){
            $name = $request->request->add(['name'=>auth()->user()->id]);
        }
        else {
            $name = ($request->name ? $request->name : null);
        }

//        dd($request->name);

        // Get Developers List
        $devUsers = getUserByType([8, 9]);

        // if(!is_null($request->name)){
        //     $dailyprogress = getUserDetail($request->name)->daily_pitch;
        // }
        // else {
            $dailyprogress = 'All Users';
        // }

        $query = DailyProgress::with('user');
        if (!empty($request->name )){
            $query->where('user_id', $request->name );
        }

        if (!empty($date_from) && !empty($date_to)){
            $query->whereBetween('date', [$date_from, $date_to]);
        }

        $progress = $query->get();


        // For Date Period work only
        $date_toForTable = Carbon::createFromFormat('Y-m-d', $date_to);
        $date_toForTable->addDay();
        $date_toForTable = $date_toForTable->format('Y-m-d');

        $timePeriod = new \DatePeriod(
            new \DateTime($date_from),
            new \DateInterval('P1D'),
            new \DateTime($date_toForTable)
        );

        $projects = Project::pluck('title', 'id')->toArray();

//        dd($progress->groupBy(['user_id', 'date'])->toArray(), $timePeriod);
        return view($section->folder.'.index', compact('progress', 'projects','section','date_from','date_to','name','devUsers', 'dailyprogress', 'timePeriod'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       checkPermission('create-daily-progress');
        $progress = [];
        $section = $this->section;
        $section->heading = 'Daily Progress';
        $section->title = 'Add Daily Progress';
        $section->method = 'POST';
        $section->route = $section->slug.'.store';
        $projects = Project::pluck('title', 'id')->toArray();
        return view($section->folder.'.form',compact('section','progress','projects'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd( $request->all());
        $section = $this->section;
        // define custom validation messages for validator
        // $validationMessages = [
        //    'project_id.required' => 'Please select a project',
        //    'date.required' => 'Please select a date',
        //    'time_hrs.required' => 'Please select a working hours',
        //    'time_mins.required' => 'Please select a working minutes',
        //    'description.required' => 'Work description is required',
        // ];
        // validate user input
         $attributeNames = array(
           'project_id' => 'project',
           'date' => 'date',
           'time_hrs' => 'hours',
           'time_mins' => 'minutes',
           'description' => 'description',
        );

        // validate user input
        $validator = Validator::make($request->all(), [
//            'project_id' => 'required',
            'date' => 'required',
            'time_hrs' => 'required',
            'time_mins' => 'required',
            'description' => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);

        // validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {

         if(!empty($request->trello_link)){
             $request->request->add([
                 'project_id'=>$request->trello_link
             ]);
         }

            $request->request->remove('trello_link');

//         dd($request->all(), 'Faizan');
        // dd(($request->time_hrs * 60) + $request->time_mins);
        $request->request->add([
            'user_id'=>auth()->user()->id,
            'time'=> ($request->time_hrs * 60) + $request->time_mins
        ]);
         $request->request->remove('time_mins');
         $request->request->remove('time_hrs');

        DailyProgress::create($request->all());
        $request->session()->flash('alert-success', 'Record has been added successfully.');
        return redirect()->route($section->slug.'.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $date = null)
    {
       dd('show()');
    }

    public function singleDayReport($id, $date = null)
    {
        checkPermission('read-daily-progress');
        $section = $this->section;
        $progress = DailyProgress::where('user_id', $id)->where('date', $date)->get();
        $projects = Project::pluck('title', 'id')->toArray();
        // $dailytarget = getUserDetail($id)->daily_pitch;
        return view($section->folder.'.single', compact('progress', 'section','projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        checkPermission('update-daily-progress');
        $id = Crypt::decrypt($id);
        $section = $this->section;
        $section->heading = 'Daily Progress';
        $section->title = 'Edit Daily Progress';
        $section->method = 'PUT';
        $section->route = [$section->slug.'.update', $id];

        $dailyProgress = DailyProgress::where('id', $id)->first()->toArray();
        $minsHrs = getHrsMinsArray($dailyProgress['time']);
        $progress = array_merge($dailyProgress, $minsHrs);

        $projects = Project::pluck('title', 'id')->toArray();
        return view($section->folder.'.form', compact('progress', 'projects', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyProgress $daily_progress)
    {
        // $this->checkPermission('edit-modules');
        $section = $this->section;
        //define custom validation messages for validator
        //  $validationMessages = [
        //    'project_id.required' => 'Please select a project',
        //    'date.required' => 'Please select a date',
        //    'time_hrs.required' => 'Please select a working hours',
        //    'time_mins.required' => 'Please select a working minutes',
        //    'description.required' => 'Work description is required',
        // ];

        $attributeNames = array(
           'project_id' => 'project',
           'date' => 'date',
           'time_hrs' => 'hours',
           'time_mins' => 'minutes',
           'description' => 'description',
        );

        // validate user input
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'date' => 'required',
            'time_hrs' => 'required',
            'time_mins' => 'required',
            'description' => 'required',
        ]);
        $validator->setAttributeNames($attributeNames);


        //validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {
        $request->request->add([
            'time'=> ($request->time_hrs * 60) + $request->time_mins
        ]);
        $request->request->remove('time_mins');
        $request->request->remove('time_hrs');
        $daily_progress->update($request->all());
        $request->session()->flash('alert-success', 'Record has been updated successfully.');
        return redirect()->back();
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
        dd('Faizan');
    }
}
