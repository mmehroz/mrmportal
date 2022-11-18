<?php

namespace App\Http\Controllers;

use App\Logs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Gate;

class LogController extends Controller
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
        $this->section->title = 'Logs';
        $this->section->heading = 'Logs';
        $this->section->slug = 'logs';
        $this->section->folder = 'logs';
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
        checkPermission('view-logs');
        $section = $this->section;
		$logs = Logs::get();
//		dd($logs->toArray());
		return view($section->folder.'.index', compact('logs', 'section'));
	}
}
