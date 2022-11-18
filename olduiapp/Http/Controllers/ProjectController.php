<?php

namespace App\Http\Controllers;

use App\ProjectMilestone;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\ProjectUser;
use App\Attachment;
use App\Profile;
use App\Project;
use App\User;
use App\Notifications\newNotification;

class ProjectController extends Controller
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
        $this->section->heading = 'Projects';
        $this->section->title = 'Projects';
        $this->section->slug = 'projects';
        $this->section->folder = 'projects';
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        checkPermission('read-project');
        $section = $this->section;
        $projects = Project::with('profile','customer', 'projectUser.user', 'team')->get();
        if (auth()->user()->user_type == 2) {
            $projects = $projects->whereIn('customer_id',auth()->user()->id);
            return view($section->folder.'.index-customer', compact('projects','section'));
        }
        return view($section->folder.'.index', compact('projects','section'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $section = $this->section;

        $projectDetails = Project::with(
            'projectUser',
            'projectUser.user',
            'comments',
            'comments.user',
            'comments.comment_members',
            'comments.comment_members.user'
        )->where('id', $id)->first();

        $projectMilestone = ProjectMilestone::where('project_id', $id)->get();

//         dd($projectDetails->toArray());

        return view($section->slug.'.projectview', compact('section','projectDetails', 'projectMilestone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
          
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

    public function newComment(Request $request)
    {

        dd($request->all());
        //
    }

    public function projectview()
    {
        $section = $this->section;

        $projectDetails = Project::with(
            'projectUser',
            'projectUser.user',
            'comments',
            'comments.user',
            'comments.comment_members',
            'comments.comment_members.user'
        )->first();


        // dd($projectDetails->sale);

        return view('projectview', compact('section','projectDetails'));
    }
}
