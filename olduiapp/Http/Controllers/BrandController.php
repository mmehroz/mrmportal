<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\Gate;

class BrandController extends Controller
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
        $this->section->title = 'Brands';
        $this->section->heading = 'Brands';
        $this->section->slug = 'brands';
        $this->section->folder = 'brands';
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
        checkPermission('read-brand');
        $section = $this->section;
		$brands = Brand::get();
		return view($section->folder.'.index', compact('brands', 'section'));
	}

    public function create()
    {
        checkPermission('create-brand');
        $brand = [];
        $section = $this->section;
        $section->heading = 'Brands';
        $section->title = 'Add Brand';
        $section->method = 'POST';
        $section->route = $section->slug.'.store';
        return view($section->folder.'.form',compact('section', 'brand'));
    }

    public function store(Request $request)
    {
        $section = $this->section;

        //define custom validation messages for validator
        $validationMessages = [
            'name.unique' => 'Brand name already exist. Please enter a unique brand name',
        ];
        // validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:brands,name',
            'status' => 'required|boolean',
        ], $validationMessages);

        //validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {
            $request->request->add(['user_id'=>auth()->user()->id]);

            if($request->has('image')){
                // Picture Upload process
                $image = $request->file('image');

                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $url = 'images/'.$imageName;
                $request->request->add(['picture'=>$url]);
            }

            $request->request->add(['sorting_order'=>Brand::get()->count()+1]);

            Brand::create($request->all());
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
    public function edit(Brand $brand)
    {
         checkPermission('update-brand');
         $section = $this->section;
         $section->heading = 'Brands';
         $section->title = 'Edit Brand';
         $section->method = 'PUT';
         $section->route = [$section->slug.'.update', $brand];
         return view($section->folder.'.form', compact('brand', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
         $section = $this->section;

        //define custom validation messages for validator
        $validationMessages = [
            'name.unique' => 'Brand name already exist. Please enter a unique brand name',
        ];
        // validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:brands,name,'. $brand->id . ',id',
            'status' => 'required|boolean',
            'sorting_order' => 'required',
            'image' => 'mimes:jpeg,png,jpg|max:1014'
        ], $validationMessages);

        //validation fails
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        } else {

            if($request->has('image')){
                // Picture Upload process
                $image = $request->file('image');

                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $url = 'images/'.$imageName;
                $request->request->add(['picture'=>$url]);
            }

            $brand->update($request->all());
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
