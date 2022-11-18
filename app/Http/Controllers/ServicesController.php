<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\Gate;

class ServicesController extends Controller
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
        $this->section->title = 'Services';
        $this->section->heading = 'Services';
        $this->section->slug = 'services';
        $this->section->folder = 'services';
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
        checkPermission('read-services');
        $section = $this->section;
		$services = Service::get();
		return view($section->folder.'.index', compact('services', 'section'));
	}

    public function create()
    {
        checkPermission('create-services');
        $service = [];
        $section = $this->section;
        $section->heading = 'Services';
        $section->title = 'Add Service';
        $section->method = 'POST';
        $section->route = $section->slug.'.store';
        return view($section->folder.'.createform',compact('section', 'service'));
    }

    public function store(Request $request)
    {
        $section = $this->section;

        //define custom validation messages for validator
        $validationMessages = [
            'name.unique' => 'Service name already exist. Please enter a unique service name',
        ];
        // validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:services,name',
            'status' => 'required|boolean',
        ], $validationMessages);

        //validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {
            $request->request->add(['user_id'=>auth()->user()->id]);
            $request->request->add(['sorting_order'=>Service::get()->count()+1]);

            Service::create($request->all());
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
    public function edit(Service $service)
    {
        checkPermission('update-services');
         $section = $this->section;
         $section->heading = 'Services';
         $section->title = 'Edit Service';
         $section->method = 'PUT';
         $section->route = [$section->slug.'.update', $service];
        return view($section->folder.'.form', compact('service', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
         $section = $this->section;

        //define custom validation messages for validator
        $validationMessages = [
            'name.unique' => 'Service name already exist. Please enter a unique service name',
        ];
        // validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:services,name,'. $service->id . ',id',
            'status' => 'required|boolean',
            'sorting_order' => 'required'
        ], $validationMessages);

        //validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {
            $service->update($request->all());
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
}
