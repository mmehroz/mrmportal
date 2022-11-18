<?php

namespace App\Http\Controllers;

use App\Order;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $orderData = Order::Active(1)->where('order_status', 1)->whereBetween('order_time', [date('Y-m-01 00:00:00'), date('Y-m-d 23:59:59')])->get();
//
//        $orders = Order::orderBy('id', "DESC")->with(['orderLineItem', 'orderLineItem.orderLineItemOption'])->whereDate('created_at', Carbon::today()->format('Y-m-d'))->get();
//        dd($orders->toArray(), date('Y-m-01 00:00:00'), date('Y-m-d 00:00:00'));
//        return view('dashboard', compact('orders', 'section'));
        if(auth()->user()->user_type == 3){
            return redirect()->route('daily_target.index');
        }
        else {
            return view('dashboard');
        }
    }
}
