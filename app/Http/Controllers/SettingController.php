<?php

namespace App\Http\Controllers;

use App\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
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
        $this->section->title = 'Settings';
        $this->section->heading = 'Settings';
        $this->section->slug = 'settings';
        $this->section->folder = 'settings';
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Setting $setting) {
        $section = $this->section;
        $section->heading = 'Settings';
        $section->title = 'Settings';
        $section->method = 'PUT';
        $section->route = [$section->slug.'.update', 1];

        $setting = Setting::first();
        if($setting->monday_open_time){
            $setting->monday_open_time = date("h:i A", strtotime($setting->monday_open_time));
        }
        if($setting->monday_close_time){
            $setting->monday_close_time = date("h:i A", strtotime($setting->monday_close_time));
        }
        if($setting->tuesday_open_time){
            $setting->tuesday_open_time = date("h:i A", strtotime($setting->tuesday_open_time));
        }
        if($setting->tuesday_close_time){
            $setting->tuesday_close_time = date("h:i A", strtotime($setting->tuesday_close_time));
        }
        if($setting->wednesday_open_time){
            $setting->wednesday_open_time = date("h:i A", strtotime($setting->wednesday_open_time));
        }
        if($setting->wednesday_close_time){
            $setting->wednesday_close_time = date("h:i A", strtotime($setting->wednesday_close_time));
        }
        if($setting->thursday_open_time){
            $setting->thursday_open_time = date("h:i A", strtotime($setting->thursday_open_time));
        }
        if($setting->thursday_close_time){
            $setting->thursday_close_time = date("h:i A", strtotime($setting->thursday_close_time));
        }
        if($setting->friday_open_time){
            $setting->friday_open_time = date("h:i A", strtotime($setting->friday_open_time));
        }
        if($setting->friday_close_time){
            $setting->friday_close_time = date("h:i A", strtotime($setting->friday_close_time));
        }
        if($setting->saturday_open_time){
            $setting->saturday_open_time = date("h:i A", strtotime($setting->saturday_open_time));
        }
        if($setting->saturday_close_time){
            $setting->saturday_close_time = date("h:i A", strtotime($setting->saturday_close_time));
        }
        if($setting->sunday_open_time){
            $setting->sunday_open_time = date("h:i A", strtotime($setting->sunday_open_time));
        }
        if($setting->sunday_close_time){
            $setting->sunday_close_time = date("h:i A", strtotime($setting->sunday_close_time));
        }
//        dd($setting->toArray());
		return view($section->folder.'.form', compact('setting', 'section'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $section = $this->section;


        $request->request->add(['monday_open_time' => date("H:i:s", strtotime($request->monday_open_time))]);
        $request->request->add(['monday_close_time' => date("H:i:s", strtotime($request->monday_close_time))]);
        $request->request->add(['tuesday_open_time' => date("H:i:s", strtotime($request->tuesday_open_time))]);
        $request->request->add(['tuesday_close_time' => date("H:i:s", strtotime($request->tuesday_close_time))]);
        $request->request->add(['wednesday_open_time' => date("H:i:s", strtotime($request->wednesday_open_time))]);
        $request->request->add(['wednesday_close_time' => date("H:i:s", strtotime($request->wednesday_close_time))]);
        $request->request->add(['thursday_open_time' => date("H:i:s", strtotime($request->thursday_open_time))]);
        $request->request->add(['thursday_close_time' => date("H:i:s", strtotime($request->thursday_close_time))]);
        $request->request->add(['friday_open_time' => date("H:i:s", strtotime($request->friday_open_time))]);
        $request->request->add(['friday_close_time' => date("H:i:s", strtotime($request->friday_close_time))]);
        $request->request->add(['saturday_open_time' => date("H:i:s", strtotime($request->saturday_open_time))]);
        $request->request->add(['saturday_close_time' => date("H:i:s", strtotime($request->saturday_close_time))]);
        $request->request->add(['sunday_open_time' => date("H:i:s", strtotime($request->sunday_open_time))]);
        $request->request->add(['sunday_close_time' => date("H:i:s", strtotime($request->sunday_close_time))]);
        if($request->has('logo_header_image')){
            $image = $request->file('logo_header_image');

            $imageName = 'logo_header_image.'.$request->logo_header_image->extension();
            $request->logo_header_image->move(public_path('images'), $imageName);
            $url = 'images\\'.$imageName;
            $request->request->add(['logo_header'=>$url]);
        }

        if($request->has('logo_footer_image')){
            $image = $request->file('logo_footer_image');

            $imageName = 'logo_footer_image.'.$request->logo_footer_image->extension();
            $request->logo_footer_image->move(public_path('images'), $imageName);
            $url = 'images\\'.$imageName;
            $request->request->add(['logo_footer'=>$url]);
        }

        if($request->has('fav_icon_image')){
            $image = $request->file('fav_icon_image');

            $imageName = 'fav_icon_image.'.$request->fav_icon_image->extension();
            $request->fav_icon_image->move(public_path('images'), $imageName);
            $url = 'images\\'.$imageName;
            $request->request->add(['fav_icon'=>$url]);
        }

        $request->request->remove('_token');
        $request->request->remove('_method');
        $request->request->remove('logo_header_image');
        $request->request->remove('logo_footer_image');
        $request->request->remove('fav_icon_image');

        Setting::where('id', 1)->update($request->only(['client_name', 'contact_number', 'header_content', 'footer_content', 'privacy_policy', 'terms_condition', 'address', 'display_product_images', 'website_link', 'facebook_link','twitter_link', 'instagram_link', 'linkedin_link', 'google_plus_link', 'header_color','footer_color', 'theme_primary_color', 'theme_variant_color', 'currency', 'is_delivery','delivery_flat_charges', 'logo_header', 'logo_footer', 'fav_icon', 'minimum_order', 'delivery_time', 'tax', 'monday_open_time', 'monday_close_time', 'tuesday_open_time', 'tuesday_close_time', 'wednesday_open_time', 'wednesday_close_time', 'thursday_open_time', 'thursday_close_time', 'friday_open_time', 'friday_close_time', 'saturday_open_time', 'saturday_close_time', 'sunday_open_time', 'sunday_close_time']));
        $request->session()->flash('alert-success', 'Record has been updated successfully.');
        return redirect()->route($section->slug . '.index');
    }
}
