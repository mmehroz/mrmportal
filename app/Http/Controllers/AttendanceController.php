<?php

namespace App\Http\Controllers;

use App\attendance;
use App\Imports\AttendanceImport;
use App\Notifications\newNotification;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->section = new \stdClass();
        $this->section->title = 'Attendance';
        $this->section->heading = 'Attendance';
        $this->section->slug = 'attendance';
        $this->section->folder = 'attendance';
    }

    public function index(Request $request)
    {
        checkPermission('read-attendance');

        $section = $this->section;
        $section->method = 'GET';
        $section->route = 'show.attendance';

//        dd($request->toArray());
//        $attendance = Attendance::with('user')->get();

        // For Developers only
        if(auth()->user()->user_type == 4 || auth()->user()->user_type == 5 || auth()->user()->user_type == 8 || auth()->user()->user_type == 9 || auth()->user()->user_type == 2){
            $name = $request->request->add(['name'=>auth()->user()->id]);
        }
        else {
            $name = ($request->name ? $request->name : null);
        }

        // Get Users List
        $users = User::whereNotIn('user_type', [2])->where('id', '!=', 1)->pluck('name', 'id');

        $date_from = ($request->date_from ? $request->date_from : date('Y-m-01'));
        $date_to = ($request->date_to ? $request->date_to : date('Y-m-d'));

        $query = Attendance::with('user');
        if (!empty($request->name )){
            $query->where('user_id', $request->name );
        }

        if (!empty($date_from) && !empty($date_to)){
            $query->whereBetween('date', [$date_from, $date_to]);
        }

        $attendance = $query->orderBy('date', 'ASC')->get();

        // For Date Period work only
        $date_toForTable = Carbon::createFromFormat('Y-m-d', $date_to);
        $date_toForTable->addDay();
        $date_toForTable = $date_toForTable->format('Y-m-d');

        $timePeriod = new \DatePeriod(
            new \DateTime($date_from),
            new \DateInterval('P1D'),
            new \DateTime($date_toForTable)
        );

        $timePeriodDate = [];
        foreach ($timePeriod as $key => $value){
            $timePeriodDate[$value->format('Y-m-d')] = null;
        }

        $attendance = array_merge_recursive($attendance->groupBy('date')->toArray(), $timePeriodDate);

//        dd($request->toArray(),  $attendance->groupBy('date')->toArray(), $timePeriod);
//        dd($request->toArray(),  $attendance, $timePeriod);

        return view($section->folder.'.index', compact( 'attendance','section', 'users','date_from','date_to', 'name', 'timePeriod'));
    }

    public function create()
    {
        $section = $this->section;
        $section->heading = 'Attendance';
        $section->title = 'Add Attendance';
        $section->method = 'POST';
        $section->route = [$section->slug.'.store'];
        $attendance = new Attendance();
        return view($section->folder.'.create', compact('attendance', 'section'));
    }

    public function store(Request $request)
    {

        $key =   date('Y-m-d', strtotime($request->date));
        $attendance = Attendance::where('date',$key)->where('attendance_user_id', auth()->user()->attendance_id)->get();
        if(count($attendance)==0) {


            $section = $this->section;
            $section->method = 'GET';
            $section->route = 'show.attendance';

            $request->merge([
                "date" => date('Y-m-d', strtotime($request->date)),
                "user_id" => auth()->user()->id,
                "attendance_user_id" => auth()->user()->attendance_id,
            ]);


            $request->merge([
                "pending" => serialize($request->all())
            ]);

            $attendance = Attendance::create($request->all());

            // notify to hr

            $sender = User::find(auth()->user()->id);
            $recipients = User::whereIn('user_type', [1, 3, 7])->get(); // To Admin & Owner
            $detailNotify = [
                'description' => $sender->name . ' has edit the attendance sheet for date ' . $request->date,
                'link' => route("edit.attendance", [\Illuminate\Support\Facades\Crypt::encrypt($attendance->id), "is_change" => "yes"]),
                'member_id' => [1, 3, 7], // To Admin & Owner
                'user_id' => auth()->user()->id
            ];
            foreach ($recipients as $recipient) {
                User::find($recipient->id)->notify(new newNotification($detailNotify));
            }
            // notify to hr

            $date_from = ($request->date_from ? $request->date_from : date('Y-m-01'));
            $date_to = ($request->date_to ? $request->date_to : date('Y-m-d'));
            // Get Users List
            $users = User::whereNotIn('user_type', [2])->where('id', '!=', 1)->pluck('name', 'id');
            // For Developers only
            if (auth()->user()->user_type == 4 || auth()->user()->user_type == 5 || auth()->user()->user_type == 8 || auth()->user()->user_type == 9 || auth()->user()->user_type == 2) {
                $name = $request->request->add(['name' => auth()->user()->id]);
            } else {
                $name = ($request->name ? $request->name : null);
            }
            $query = Attendance::with('user');
            if (!empty($request->name)) {
                $query->where('user_id', $request->name);
            }

            if (!empty($date_from) && !empty($date_to)) {
                $query->whereBetween('date', [$date_from, $date_to]);
            }

            $attendance = $query->get();
            return view($section->folder . '.index', compact('attendance', 'section', 'users', 'date_from', 'date_to', 'name'));
        } else {
            $request->session()->flash('alert-danger', 'Record already exist for the date '.$key);
            return redirect()->back();
        }
    }

    public function edit($id,Request $request)
    {
        $id = Crypt::decrypt($id);
        $section = $this->section;
        $section->heading = 'Attendance';
        $section->title = 'Edit Attendance';
        $section->method = 'PUT';
        $section->route = [$section->slug.'.update', $id];
        $attendance = Attendance::find($id)->toArray();

        $old_data = Attendance::find($id)->toArray();

        if($request->get("is_change")=="yes"){
            $attendance = unserialize($attendance['pending']);
            return view($section->folder.'.form', compact('attendance', 'section','old_data'));
        }

        $old_data = false;
        return view($section->folder.'.form', compact('attendance', 'section'));



    }

    public function update(Request $request, Attendance $attendance)
    {
        $section = $this->section;


        if( (auth()->user()->user_type == "7" || auth()->user()->user_type == "0") && $request->status == "1" ){

            $request->merge([
                'status' => 0,
                'update_by' => auth()->user()->id,
            ]);

            $attendance->update($request->all());
        }

       // user sends it
       if ($request->status == 1) {

           $request->merge(['is_late'=>$attendance->is_late]);

           $attendance->pending = serialize($request->all());
           $attendance->status = 0;
           $attendance->update();

           // Send Notification of Daily Target Update
           $sender = User::find(auth()->user()->id);
           $recipients = User::whereIn('user_type', [1, 3, 7])->get(); // To Admin & Owner
           $detailNotify = [
               'description' => $sender->name . ' has edit the attendance sheet for date ' . $request->date,
               'link' => route("edit.attendance", [\Illuminate\Support\Facades\Crypt::encrypt($attendance->id), "is_change" => "yes"]),
               'member_id' => [1, 3,7], // To Admin & Owner
               'user_id' => auth()->user()->id
           ];
           foreach ($recipients as $recipient) {
               User::find($recipient->id)->notify(new newNotification($detailNotify));
           }
           // Send Notification of Daily Target Update

       }

       if ($request->status == 0) {

           $request->merge([
               'pending' => null,
               'status' => 1,
               'update_by' => auth()->user()->id,
           ]);

           $attendance->update($request->all());

           $user = getUserDetail(auth()->user()->id);
           if($user){
               $updated_by_name = ucfirst($user->name);
           }

           $user_sheet = getUserDetail($attendance->user_id);
           if($user_sheet){
               $user_sheet_name = ucfirst($user_sheet->name);
           }



           // Send Notification of Daily Target Update
           // $recipients = User::find($attendance->user_id)->get(); // To Admin & Owner
           $recipients = User::whereIn('user_type', [1, 3, 7])->get(); // To Admin & Owner & HR
           $detailNotify = [
               'description' => ucfirst($user_sheet_name) . ' attendance sheet ('.$attendance->date.') has been updated by '.ucfirst($updated_by_name),
               'link' => route("edit.attendance", [\Illuminate\Support\Facades\Crypt::encrypt($attendance->id), "is_change" => "yes"]),
               'member_id' => [1, 3], // To Admin & Owner
               'user_id' => auth()->user()->id
           ];
           foreach ($recipients as $recipient) {
               User::find($recipient->id)->notify(new newNotification($detailNotify));
           }
           User::find($attendance->user_id)->notify(new newNotification($detailNotify));
           // Send Notification of Daily Target Update

       }



        $request->session()->flash('alert-success', 'Record has been updated successfully.');
        return redirect()->route('show.attendance');

    }

    public function importFileView()
    {
        return view('attendance.add');
    }

    public function importFunction(Request $request)
    {
        Excel::import(new AttendanceImport, $request->file('select_file'));
        $request->session()->flash('flash_message', 'Record has been added successfully.');
        return redirect()->route('show.attendance');
    }

}
