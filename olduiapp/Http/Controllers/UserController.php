<?php

namespace App\Http\Controllers;

use App\Leave;
use App\Mail\SendCredentials;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Category;
use App\Notifications\newNotification;

class UserController extends Controller
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
        $this->section->title = 'Users';
        $this->section->heading = 'Users';
        $this->section->slug = 'users';
        $this->section->folder = 'user';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        checkPermission('read-user');
        $section = $this->section;
        $users = User::with('role')->orWhere('user_type', '!=', 2)->get();
        return view($section->folder.'.index', compact('users', 'section'));
    }

    public function impersonate($user_id){
        $user = User::find($user_id);
        Auth::user()->impersonate($user);
        return redirect()->route('dashboard');
    }

    public function impersonate_leave(){
        Auth::user()->leaveImpersonation();
        return redirect()->route('dashboard');
    }

    public function userOnlineStatus()
    {
        $users = User::with('role')->orWhere('user_type', '!=', 2)->get();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id))
                echo $user->name . " is online. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            else
                echo $user->name . " is offline. Last seen: " . Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
        }
    }

    public function customersList() {
        // checkPermission('read-user');
        $section = $this->section;
        $section->title = 'Customers';
        $section->heading = 'Add New Customer';
        $customers = User::with('role')->where('user_type', 2)->get();
        return view($section->folder.'.customers', compact('customers', 'section'));
    }

    public function show(Category $category)
    {
        // $this->checkPermission('view-modules');
        // $section = $this->section;
        // $section->title = $module->module_name;
        // $section->heading = $module->module_name;
        // return view($section->folder.'.show', compact('module', 'section'));
    }

    public function create()
    {
        checkPermission('create-user');
        $user = [];
        $section = $this->section;
        $section->heading = 'Users';
        $section->title = 'Add User';
        $section->method = 'POST';
        $section->route = $section->slug.'.store';
        $roles = Role::pluck('name', 'id')->toArray();
//        dd($roles);
        return view($section->folder.'.form',compact('section', 'user', 'roles'));
    }

    public function store(Request $request)
    {


        //$request->merge(array('check_in' => date('H:i:s', strtotime($request->input('check_in')))));
        //$request->merge(array('check_out' => date('H:i:s', strtotime($request->input('check_out')))));


        // dd(strtolower('sdfsdfSDFSDf'));
        // dd($request->all());
        // dd($request->user_type);
        // $this->checkPermission('add-modules');
        $section = $this->section;

        //define custom validation messages for validator
        $validationMessages = [
            'name.unique' => 'User name already exist. Please enter a unique username',
            'email.unique' => 'Email already exist. Please enter a unique email',
        ];
        // validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:users,name',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'user_type' => 'required',
            'status' => 'required|boolean',
            'check_in' => 'required',
            'check_out' => 'required',
        ], $validationMessages);

        //validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {

            $plain_pass = $request->password;



            $request->request->add([
                'password'=>bcrypt($request->password),
                'birth_date'=> Carbon::now()->format('Y-m-d'),
                'joining_date'=> Carbon::now()->format('Y-m-d')
            ]);
            if ($request->user_type == 2) {
             $request->request->add([
                'is_customer'=> 1,
            ]);
            }

              if($request->has('image')){
                // Picture Upload process
                // $image = $request->file('image');
                $imageName = strtolower($request->name).'.'.$request->image->extension();
                $request->image->move(public_path('pictures'), $imageName);
                $request->request->add(['picture'=> $imageName]);
            }

              //dd($request->all());






            $user = User::create($request->all());

            $extra = [
                'plain_password' => $plain_pass,
                'url' => env('APP_URL')
            ];

            $merge = array_merge($user->toArray(),$extra);



            Mail::to($user->email)->send(new SendCredentials($merge));




            // User::find(1)->notify( new newNotification);
            // $description = auth()->user()->name.' created a new user '. $user->name;
            // $link = "";
            // $member_id = User::pluck('id')->where('user_type',0)->first();
            // $user_id = auth()->user()->id;
            // sendNotification($description, $link, $member_id, $user_id);
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
    public function edit($id)
    {
        checkPermission('update-user');

        $id = Crypt::decrypt($id);

        $section = $this->section;
        $section->heading = 'Users';
        $section->title = 'Edit User';
        $section->method = 'PUT';
        $section->route = [$section->slug.'.update', $id];
        $roles = Role::pluck('name', 'id')->toArray();

        $user = User::where('id', $id)->first();
        return view($section->folder.'.form', compact('user', 'section', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $this->checkPermission('edit-modules');
        $section = $this->section;

        //define custom validation messages for validator
        $validationMessages = [
            'name.unique' => 'User name already exist. Please enter a unique username',
            'email.unique' => 'Email already exist. Please enter a unique email',
        ];
        // validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:users,name,'. $user->id . ',id',
            'email' => 'required|string|email|unique:users,email,'. $user->id . ',id',
            'password' => 'confirmed',
            'user_type' => 'required',
            'status' => 'required|boolean'
        ], $validationMessages);

        //validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {

              if($request->has('image')){
                // Picture Upload process
                // $image = $request->file('image');
                $imageName = strtolower($request->name).'.'.$request->image->extension();
                $request->image->move(public_path('pictures'), $imageName);
                $request->request->add(['picture'=> $imageName]);
            }
                if ($request->password) {
                 $request->request->add([
                     'password'=>bcrypt($request->password),
                 ]);
                 $user->update($request->all());
                }else{
        // dd($request);
                 $user->update($request->except('password','password_confirmation'));
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
    public function destroy(User $user)
    {
        $section = $this->section;
        $user->delete();
        request()->session()->flash('alert-success', 'Record has been deleted successfully.');
        return redirect()->route($section->slug.'.index');
    }

    public function profile(Request $request)
    {
        $section = $this->section;
        $section->title = 'Profile';
        $user = User::where('id', auth()->user()->id )->first();
        $leaves = Leave::where(['user_id' => auth()->user()->id])->get();
        $availed_leaves = Leave::where(['user_id' => auth()->user()->id, 'status' => 2])
                          ->pluck('no_of_days')
                          ->sum();
        $applied_leaves = Leave::where(['user_id' => auth()->user()->id, 'status' => 0])
                          ->pluck('no_of_days')
                          ->sum();
        $available_leaves = $user->no_of_leaves - $availed_leaves;
        return view($section->folder.'.profile', compact('user', 'section', 'leaves','availed_leaves', 'available_leaves','applied_leaves'));
    }

    public function changePassword(Request $request)
    {
        $section = $this->section;
        $validatedData = $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        // if (!\Entrust::can('view-user')) {
        //     abort(403, 'Unauthorized action.');
        // }

        $user = User::find(auth()->user()->id);
        $user->password = bcrypt($request->password);
        $user->save();

        $request->session()->flash( 'status', 'Password updated successfully.' );
        return redirect()->route($section->slug . '.profile');
    }

    public function change_profile_image(Request $request){


        $validator = Validator::make($request->all(), [
            'picture' => 'required|mimes:jpg,png,jpeg,tiff,webp',
        ]);

        if ($validator->fails()) {
                 return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {
                $image = $request->file('picture');
                $imageName = strtolower(auth()->user()->name).'.'.$image->extension();
                $image->move(public_path('pictures'), $imageName);
                $request->request->add(['picture'=> $imageName]);
                User::where('id', auth()->user()->id)->update(['picture'=>$imageName]);
                return back();
        }
    }
}
