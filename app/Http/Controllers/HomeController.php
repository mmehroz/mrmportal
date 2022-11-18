<?php

namespace App\Http\Controllers;

use App\Imports\AttendanceImport;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class HomeController extends Controller
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
     * @return Renderable
     */
    public function index()
    {
        return view('dashboard');
    }



}
