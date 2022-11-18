<?php

namespace App\Http\Controllers;

use App\ProfileJss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Profile;
use DB;

class ProfileController extends Controller
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
        $this->section->heading = 'Profiles';
        $this->section->title = 'Upwork Account';
        $this->section->slug = 'profiles';
        $this->section->folder = 'profiles';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       checkPermission('read-profile');
        $section = $this->section;
        $profiles = Profile::get();
        $is_admin = false;
        if (auth()->user()->user_type == 0) {
            $is_admin = true;
        }
        return view($section->folder.'.index', compact('profiles','section','is_admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       checkPermission('create-profile');
        $profile = [];
        $section = $this->section;
        $section->heading = 'Create Profile';
        $section->title = 'Create Sales Profile';
        $section->method = 'POST';
        $section->route = $section->slug.'.store';
        return view($section->folder.'.createform',compact('section','profile'));
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
        // define custom validation messages for validator
        $validationMessages = [
            'name.unique' => 'Profile name already exist. Please enter a unique profile name',
        ];
        // validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:profiles,name',
            'status' => 'required|boolean',
        ], $validationMessages);

        // validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {
        $request->request->add(['user_id'=>auth()->user()->id]);

        $profile = Profile::create($request->all());

        $request->request->add([
            'profile_id'=> $profile->id
        ]);
        ProfileJss::create($request->all());
        $request->session()->flash('flash_message', 'Record has been added successfully.');
        return redirect()->route($section->slug.'.index');
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
       checkPermission('update-profile');

        $section = $this->section;
        $section->heading = 'Edit Profile';
        $section->title = 'Edit Sales Profiles';
        $section->method = 'PUT';
        $section->route = [$section->slug.'.update', $id];

        $profile = Profile::where('id', $id)->first();
        return view($section->folder.'.form', compact('profile', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {

         $section = $this->section;

        //define custom validation messages for validator
        $validationMessages = [
            'name.unique' => 'Profile name already exist. Please enter a unique profile name',
        ];
        // validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:profiles,name,'.$profile->id,
            'status' => 'required|boolean',
        ], $validationMessages);

        // validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {
            $request->request->add([
                    'profile_id'=> $profile->id,
                    'user_id' => auth()->user()->id
            ]);

            $profile->update($request->all());
            ProfileJss::create($request->all());
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
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jssRecord(Request $request, $id)
    {
        checkPermission('read-profile');
        $section = $this->section;
        $profiles = ProfileJss::orderBy('id', 'desc')->where('profile_id', $id)->get();
        return view($section->folder.'.jss_index', compact('profiles','section'));
    }
    public function bdlog(Request $request, $id)
    {
        checkPermission('read-profile');
        $profiles= DB::table('connectpurchase')
        ->select('*')
        ->where('connectpurchase_profile','=',$id)
        ->where('status_id','=',1)
        ->get();
        $section = $this->section;
        return view($section->folder.'.bdlog_index', compact('profiles','section'));
    }
    public function editbidpurchase(Request $request)
    {
        DB::table('connectpurchase')
        ->where('connectpurchase_id', $request->connectpurchase_id)
        ->update([
        'connectpurchase_amount'   => $request->bid_purchaseamount,
        'connectpurchase_qty'      => $request->bid_purchasequantity,
        ]);
        return redirect('dashboard/bdlog/'.$request->connectpurchase_profile);
    }

    public function editjss($id)
    {
        $section = $this->section;
        $jss = ProfileJss::where('id', $id)->first();
        return view($section->folder.'.editjss', compact('jss','section'));
    }
    public function submiteditjss(Request $request, Profile $profile)
    {
        $section = $this->section;
        DB::table('profiles_jss')
        ->where('id', $request->hdnjssid)
        ->update([
        'jss_record'   => $request->jss_record,
        ]);
        $request->session()->flash('alert-success', 'Record has been updated successfully.');
        return redirect()->route($section->slug . '.index');
    }
    
}
