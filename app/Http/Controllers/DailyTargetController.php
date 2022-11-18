<?php

namespace App\Http\Controllers;

use App\Profile;
use App\SalesLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\DailyTarget;
use App\User;
use App\Notifications\newNotification;
use DB;

class DailyTargetController extends Controller
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
        $this->section->title = 'Sales Daily Target';
        $this->section->heading = 'Bid';
        $this->section->slug = 'daily_target';
        $this->section->folder = 'daily_target';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        checkPermission('read-daily-target');
        $section = $this->section;
        $section->method = 'GET';
        $section->title = 'Upwork Unit Bidding';
        $section->route = $section->slug.'.index';

        $date_from = ($request->date_from ? $request->date_from : date('Y-m-01'));
        $date_to = ($request->date_to ? $request->date_to : date('Y-m-d'));

        // For Bidder only
        if((auth()->user()->user_type == 5) || (auth()->user()->user_type == 4)){
            $name = $request->request->add(['name'=>auth()->user()->id]);
        }
        else {
            $name = ($request->name ? $request->name : null);
        }

        $profile_link = $request->profile_link ? $request->profile_link : null;

//        dd($request->toArray());

        // Get Bidders List
        $biddersUsers = getUserByType([5,4,6]);

        if(!is_null($request->name)){
            // dd($request);
            $dailytarget = getUserDetail($request->name)->daily_pitch;
            $getconnectspurchase= DB::table('connectpurchase')
            ->select('connectpurchase_amount')
            ->whereBetween('connectpurchase_date', [$request->date_from, $request->date_to])
            ->where('created_by','=',$request->name)
            ->where('status_id','=',1)
            ->sum('connectpurchase_amount');
        }
        else {
            if (!empty($request->date_from)) {
            $getconnectspurchase= DB::table('connectpurchase')
            ->select('connectpurchase_amount')
            ->whereBetween('connectpurchase_date', [$request->date_from, $request->date_to])
            ->where('status_id','=',1)
            ->sum('connectpurchase_amount');    
            }else{
            $getconnectspurchase= DB::table('connectpurchase')
            ->select('connectpurchase_amount')
            ->where('connectpurchase_date','like',date('Y-m')."%")
            ->where('status_id','=',1)
            ->sum('connectpurchase_amount');
            }
            // dd($getconnectspurchase);
            $dailytarget = 'All Users';
        }

        if(in_array(auth()->user()->user_type,[0,1,3])){ //Check Admin, Owner
           $query = DailyTarget::with('user');
        }
        else {
            $query = DailyTarget::with(['user', 'profile']); //->where('is_request', 0);
        }

        if (!empty($request->name)){
            $query->where('user_id', $request->name);
        }

        if (!empty($request->profile_link)){
            $query->where('profile_link', $request->profile_link);
        }

        if (!empty($date_from) && !empty($date_to)){
            $query->whereBetween('bid_date', [$date_from, $date_to]);
        }

        $targets = $query->orderBy('id', 'DESC')->get();

        $sales_targets = $query->where('sale_person_id',auth()->user()->id)->orderBy('id', 'DESC')->get();

        // For Date Period work only
        $date_toForTable = Carbon::createFromFormat('Y-m-d', $date_to);
        $date_toForTable->addDay();
        $date_toForTable = $date_toForTable->format('Y-m-d');

        $timePeriod = new \DatePeriod(
            new \DateTime($date_from),
            new \DateInterval('P1D'),
            new \DateTime($date_toForTable)
        );

        $profile = Profile::where('status', 1)->pluck('name', 'id')->toArray();

        $totalSumAmount = 0;
        $totalSalePersonId = 0;
        foreach ($targets as $key => $value) {
            if($value->amount != null){
//                dump(str_replace('$', '', $value->amount));
                $totalSumAmount += str_replace('$', '', $value->amount);
            }

            if($value->sale_person_id != null){
                $totalSalePersonId ++;
            }
        }
        return view($section->folder.'.index', compact('targets','getconnectspurchase', 'section','date_from','date_to','name','biddersUsers', 'dailytarget', 'timePeriod', 'profile', 'profile_link', 'sales_targets', 'totalSumAmount', 'totalSalePersonId'));
    }

    public function indexSales(Request $request)
    {

        checkPermission('read-daily-target');
        $section = $this->section;
        $section->title = 'Upwork Unit Sales';
        $section->method = 'GET';
        $section->route = $section->slug.'.indexSales';

        $date_from = ($request->date_from ? $request->date_from : date('Y-m-01'));
        $date_to = ($request->date_to ? $request->date_to : date('Y-m-d'));

        // For Bidder only
        if((auth()->user()->user_type == 5) || (auth()->user()->user_type == 4)){
            $name = $request->request->add(['name'=>auth()->user()->id]);
        }
        else {
            $name = ($request->name ? $request->name : null);
        }

        $profile_link = $request->profile_link ? $request->profile_link : null;

        // Get Bidders List
        $biddersUsers = getUserByType([4,5,6]);

        if(!is_null($request->name)){
            $dailytarget = getUserDetail($request->name)->daily_pitch;
        }
        else {
            $dailytarget = 'All Users';
        }

        if(in_array(auth()->user()->user_type,[0,1,3])){ //Check Admin, Owner
            $query = DailyTarget::with('user');
        }
        else {
            $query = DailyTarget::with(['user', 'profile']); //->where('is_request', 0);
        }

        if (!empty($request->name)){
            $query->where('sale_person_id', $request->name);
        }

        if (!empty($request->profile_link)){
            $query->where('profile_link', $request->profile_link);
        }

        if (!empty($date_from) && !empty($date_to)){
            $query->whereBetween('is_chat_date', [$date_from, $date_to]);
        }

        $targets = $query->orderBy('id', 'DESC')->get();
         $sales_targets = $query->where('sale_person_id',auth()->user()->id)->orderBy('id', 'DESC')->get();
//        dd('Faizan', $section->route, $targets->toArray());
        // For Date Period work only
        $date_toForTable = Carbon::createFromFormat('Y-m-d', $date_to);
        $date_toForTable->addDay();
        $date_toForTable = $date_toForTable->format('Y-m-d');

        $timePeriod = new \DatePeriod(
            new \DateTime($date_from),
            new \DateInterval('P1D'),
            new \DateTime($date_toForTable)
        );

        $profile = Profile::where('status', 1)->pluck('name', 'id')->toArray();

        $totalSumAmount = 0;
        $totalSalePersonId = 0;
        foreach ($targets as $key => $value) {
            if($value->amount != null){
//                dump(str_replace('$', '', $value->amount));
                $totalSumAmount += str_replace('$', '', $value->amount);
            }

            if($value->sale_person_id != null){
                $totalSalePersonId ++;
            }
        }
        $getreleaseamount = DB::table('daily_target')
        ->select('releaseamount')
        ->sum('releaseamount');  
        // dd($getreleaseamount);
        return view($section->folder.'.indexSales', compact('targets', 'section','date_from','date_to','name','biddersUsers', 'dailytarget', 'timePeriod', 'profile', 'profile_link', 'sales_targets', 'totalSumAmount', 'totalSalePersonId', 'getreleaseamount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       checkPermission('create-daily-target');
        $target = [];
        $section = $this->section;
        $section->heading = 'Sales Daily Target';
        $section->title = 'Add Daily Target';
        $section->method = 'POST';
        $section->route = $section->slug.'.store';
        return view($section->folder.'.form',compact('section','target'));

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
        //define custom validation messages for validator
        // $validationMessages = [
        //     'name.unique' => 'Brand name already exist. Please enter a unique brand name',
        // ];
        // validate user input
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|unique:brands,name',
        //     'status' => 'required|boolean',
        // ], $validationMessages);

        //validation fails
        // if ($validator->fails()) {
        //     return redirect()->back()->withInput($request->input())->withErrors($validator);
        // } else {
        $request->request->add([
            'user_id'=>auth()->user()->id,
            'is_chat'=>0,
            'is_sale'=>0,
//            'bid_date'=> Carbon::now()->format('Y-m-d')
            ]
        );

        DailyTarget::create($request->all());
        $request->session()->flash('alert-success', 'Record has been added successfully.');
        return redirect()->route($section->slug.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $date = null)
    {
        $target = DailyTarget::where('id', $id)->first();
        return response()->json(['data'=>unserialize($target->requested_data)]);
    }

    public function singleDayReport($id, $date = null)
    {
        checkPermission('read-daily-target');
        $section = $this->section;
        $section->title = 'Upwork Unit Bidding';
        if(!in_array($id, [0,1,3])){ // If not admin, owner
          $targets = DailyTarget::where(['user_id' => $id])->where('bid_date', $date)->get();
        }
        else{
          $targets = DailyTarget::all();
        }
        $dailytarget = getUserDetail($id)->daily_pitch;
        return view($section->folder.'.single', compact('targets', 'section', 'dailytarget'));
    }

    public function singleSalesDayReport($id, $date = null)
    {
        checkPermission('read-daily-target');
        $section = $this->section;
        $section->title = 'Upwork Unit Sales';
        if(!in_array($id, [0,1,3])){ // If not admin, owner
            $targets = DailyTarget::where(['sale_person_id' => $id])->where('is_chat_date', $date)->get();
        }
        else{
            $targets = DailyTarget::all();
        }

//        dd($targets->toArray());
        $dailytarget = getUserDetail($id)->daily_pitch;
        return view($section->folder.'.single', compact('targets', 'section', 'dailytarget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edittarget($id)
    {
        checkPermission('update-daily-target');
        $section = $this->section;
        $section->heading = 'Upwork Unit Bidding';
        $section->title = 'Edit Bid';
        $section->method = 'PUT';
        $section->route = [$section->slug.'.update', $id];
        $target = DailyTarget::where('id', $id)->first();
        $sale_person_id = User::where('status', 1)->whereIn('user_type',[4,5,6])->pluck('name', 'id')->toArray();
        $profile = Profile::where('status', 1)->pluck('name', 'id')->toArray();
       return view($section->folder.'.editform', compact('target', 'section', 'profile','sale_person_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyTarget $daily_target)
    {
        // dd($request);
        // dd($daily_target);
        // $this->checkPermission('edit-modules');
        $section = $this->section;
        //define custom validation messages for validator
         $validationMessages = [
             'customer_name.required_if' => 'Customer name is required',
         ];
//        dd($request->toArray());
         // validate user input
         $validator = Validator::make($request->all(), [
             'bid_link' => 'required',
             'profile_link' => 'required',
             'is_chat' => 'required',
             'is_sale' => 'required',
             'customer_name' => 'required_if:is_chat,==,1',
             'sale_person_id' => 'required_if:is_chat,==,1',
             'bid_date' => 'required',
//             'status' => 'required'
         ], $validationMessages);

        //  validation fails
         if ($validator->fails()) {
             return redirect()->back()->withInput($request->input())->withErrors($validator);
         }
         DB::table('daily_target')
        ->where('id', $daily_target->id)
        ->update([
        'feedback'   => $request->feedback,
        'releaseamount'   => $request->releaseamount,
        ]);
//         dd($request->toArray(), auth()->user()->user_type);
        if (($request->status == null) && !in_array(auth()->user()->user_type, [0,1,3])) {
            // dd($request);
            $request->request->add([
                'is_request'=> 1,
                'is_approved'=> 0,
                'requested_data'=> serialize($daily_target->toArray())]
            );
            $daily_target->update($request->all());

             // Send Notification of Daily Target Update
            $sender = User::find(auth()->user()->id);
            $recipients = User::whereIn('user_type', [1,3])->get(); // To Admin & Owner
            $detailNotify = [
                'description' => $sender->name.' has updated daily target for date ' . $request->bid_date,
                'link' => route("daily_target.edit", [\Illuminate\Support\Facades\Crypt::encrypt($daily_target->id)]),
                'member_id' => [1,3], // To Admin & Owner
                'user_id' => auth()->user()->id
             ];
            foreach($recipients as $recipient){
                if($recipient->id != auth()->user()->id){
                    User::find($recipient->id)->notify( new newNotification($detailNotify));
                }
            }

            // Send notification to Sale Person
            if($request->is_chat == 1 && $request->sale_person_id != null){
                //if($request->sale_person_id != $daily_target->sale_person_id){
                    $daily_target->is_chat_date = date('Y-m-d');
                    $daily_target->save();

                    $detailNotify = [
                        'description' => $sender->name.' has assign you new leads for date ' . $request->bid_date,
                        'link' => route("daily_target.edit", [\Illuminate\Support\Facades\Crypt::encrypt($daily_target->id)]),
                        'member_id' => $request->sale_person_id, // To Sale Person id
                        'user_id' => auth()->user()->id
                    ];
                    User::find($request->sale_person_id)->notify( new newNotification($detailNotify));
             //   }
//                SalesLead::create([
//                    'daily_target_id' => $daily_target->id,
//                    'sale_person_id' => $request->sale_person_id,
//                    'assignee_id' => auth()->user()->id,
//
//                ]);
            }
            $request->session()->flash('alert-success', 'Your request has been submitted!');
        }
        elseif($request->status == 1) {
            $request->request->add([
                'is_request'=> 0,
                'is_approved'=> 1]
            );
            $daily_target->update($request->all());

            // Send Notification of Daily Target Update
            $sender = User::find(auth()->user()->id);
            $recipients = User::whereIn('user_type', [1,3,$daily_target->user_id])->get(); // To Admin & Owner

            $detailNotify = [
                'description' => $sender->name.' has approved, '. getUserDetail($daily_target->user_id)->name .' daily target for date ' . $request->bid_date,
                'link' => route("daily_target.edit", [\Illuminate\Support\Facades\Crypt::encrypt($daily_target->id)]),
                'member_id' => [1,3,$daily_target->user_id], // To Admin & Owner
                'user_id' => auth()->user()->id
             ];
            foreach($recipients as $recipient){
                if($recipient->id != auth()->user()->id){
                    User::find($recipient->id)->notify( new newNotification($detailNotify));
                }
            }
            User::find($daily_target->user_id)->notify( new newNotification($detailNotify));


            // Send notification to Sale Person
            if($request->is_chat == 1 && $request->sale_person_id != null){
              //  if($request->sale_person_id != $daily_target->sale_person_id){
                    $daily_target->is_chat_date = date('Y-m-d');
                    $daily_target->save();

                    $detailNotify = [
                        'description' => $sender->name.' has assign you new leads for date ' . $request->bid_date,
                        'link' => route("daily_target.edit", [\Illuminate\Support\Facades\Crypt::encrypt($daily_target->id)]),
                        'member_id' => $request->sale_person_id, // To Sale Person id
                        'user_id' => auth()->user()->id
                    ];
                    User::find($request->sale_person_id)->notify( new newNotification($detailNotify));
             //   }
            }

            $request->session()->flash('alert-success', 'Record has been updated!');
        }
        elseif($request->status == 2) {
            // dd($daily_target);
            // $oldData = unserialize($daily_target->requested_data);
            // $request->request->add($oldData);
            $request->request->add([
                'is_request'=> 0,
                'is_approved'=> 2
            ]);
            $daily_target->update($request->all());

            // Send Notification of Daily Target Update
            $sender = User::find(auth()->user()->id);
            $recipients = User::whereIn('user_type', [1,3,$daily_target->user_id])->get(); // To Admin & Owner

            $detailNotify = [
                'description' => $sender->name.' has rejected, '. getUserDetail($daily_target->user_id)->name .' daily target for date ' . $request->bid_date,
                'link' => route("daily_target.edit", [\Illuminate\Support\Facades\Crypt::encrypt($daily_target->id)]),
                'member_id' => [1,3,$daily_target->user_id], // To Admin & Owner
                'user_id' => auth()->user()->id
            ];
            foreach($recipients as $recipient){
                if($recipient->id != auth()->user()->id){
                    User::find($recipient->id)->notify( new newNotification($detailNotify));
                }
            }


            // Send notification to Sale Person
            if($request->is_chat == 1 && $request->sale_person_id != null){
                if($request->sale_person_id != $daily_target->sale_person_id){
                    $daily_target->is_chat_date = date('Y-m-d');
                    $daily_target->save();

                    $detailNotify = [
                        'description' => $sender->name.' has assign you new leads for date ' . $request->bid_date,
                        'link' => route("daily_target.edit", [\Illuminate\Support\Facades\Crypt::encrypt($daily_target->id)]),
                        'member_id' => $request->sale_person_id, // To Sale Person id
                        'user_id' => auth()->user()->id
                    ];
                    User::find($request->sale_person_id)->notify( new newNotification($detailNotify));
                }
            }

            User::find($daily_target->user_id)->notify( new newNotification($detailNotify));
            $request->session()->flash('alert-success', 'Record has been updated!');
        }
       elseif($request->status == 0) {
           $request->request->add([
                'is_request'=> 0,
                'is_approved'=> 0
            ]);
            $daily_target->update($request->all());
        }else{
            $daily_target->update($request->all());
        }

        return redirect()->route($section->slug.'.index');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bidpurchase(Request $request)
    {
        $section = $this->section;
        $adds = array(
        'connectpurchase_amount'   => $request->bid_purchaseamount,
        'connectpurchase_qty'      => $request->bid_purchasequantity,
        'connectpurchase_profile'  => $request->profile_link,
        'connectpurchase_buyer'    => $request->buyer_name,
        'created_by'               => auth()->user()->id,
        'connectpurchase_date'     => $request->bid_purchasedate,
        'status_id'                => 1,
        );
        DB::table('connectpurchase')->insert($adds);
        return redirect()->route($section->slug.'.index');
    }
    public function feedback(Request $request)
    {
        $section = $this->section;
        DB::table('daily_target')
        ->where('id', $request->hdnid)
        ->update([
        'rating'        => $request->rating,
        'feedback'      => $request->feedback,
        'feedbackby'    => auth()->user()->id,
        ]);
        return redirect()->route($section->slug.'.indexSales');
    }
    public function destroy($id)
    {
        // dd('Faizan');
    }
}
