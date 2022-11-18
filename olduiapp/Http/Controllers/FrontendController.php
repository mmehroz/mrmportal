<?php

namespace App\Http\Controllers;

use App\Category;
use App\Deal;
use App\DeliveryZone;
use App\Discount;
use App\Product;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('auth.login');
    }


    public function checkout(Request $request)
    {
        $deliveryZone = DeliveryZone::Active()->get();
        $todayDate = date('Y-m-d');

        return view('checkout', compact('request', 'todayDate', 'deliveryZone'));
    }

     public function mode_switch(Request $request)
    {
        $settings = Setting::find(1);
        $settings->mode_dark = $request->mode_dark;
        $settings->save();
    }


}
