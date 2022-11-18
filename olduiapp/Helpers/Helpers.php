<?php

use App\Leave;
use App\Setting;
use Illuminate\Support\Facades\Gate;
use Twilio\Rest\Client;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Facades\FCM;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Permission;
use App\Category;
use App\Brand;
use App\Role;
use App\Attachment;
use App\RolePermission;
use App\User;
use App\ProjectUser;
use App\TeamMembers;
use App\Team;
use App\Profile;
use App\Notification;
use App\Message;

function required(){
    return ' <span class="required">*</span>';
}

function metricsName($value){
    return ucwords(ucfirst(str_replace('_', ' ', $value)));
}

if (! function_exists('formatDate')){
    function formatDate($value){
        return Carbon::parse($value)->format('d M y');
    }
}

if (! function_exists('formatTime')){
    function formatTime($value){
        return Carbon::parse($value)->format('h:i a');
    }
}

if (! function_exists('getCategoryName')){
    function getCategoryName($value){
        $categories = json_decode($value);
        return Category::whereIn('id', $categories)->pluck('name');
    }
}

if (! function_exists('getUserDetail')){
    function getUserDetail($value){
        return User::with('role')->where('id', $value)->first();
    }
}

if (! function_exists('getUserByType')){
    function getUserByType($value){
        return User::where('status','1')->whereIn('user_type',$value)->pluck('name', 'id')->toArray();
    }
}

if (! function_exists('getAllCustomers')){
    function getAllCustomers(){
        return User::where('user_type',2)->pluck('email', 'id')->toArray();
    }
}

if (! function_exists('getAllProfiles')){
    function getAllProfiles(){
        return Profile::pluck('name', 'id')->toArray();
    }
}

if (! function_exists('getAllMembers')){
    function getAllMembers(){
        return User::where('user_type', '!=',2)->pluck('name', 'id')->toArray();
    }
}

if (! function_exists('getTeamMembers')){
    function getTeamMembers($team_id){
        return TeamMembers::where('team_id',$team_id)->where('is_lead', 0)->pluck('member_id')->toArray();
    }
}

if (! function_exists('getTeamLead')){
    function getTeamLead($team_id){
        $team_member = TeamMembers::with('team_lead')->where('team_id',$team_id)->where('is_lead', 1)->first();
        if (!is_null($team_member)) {
             return $team_member->toArray();
        }
        return null;
    }
}

if (! function_exists('getProjectMembers')){
    function getProjectMembers($project_id){
        return ProjectUser::where('project_id',$project_id)->pluck('member_id')->toArray();
    }
}

if (! function_exists('getTeamName')){
    function getTeamName($team_id){
        return Team::where('id',$team_id)->first();
    }
}

if (! function_exists('getAmountFormat')){
    function getAmountFormat($value){
        if($value){
            return number_format("$value") .' <span class="currenct currency-usd">USD</span>';
        }
    }
}


if (! function_exists('getBrandName')){
    function getBrandName($value){
        return Brand::where('id', $value)->pluck('name')->first();
    }
}

if (! function_exists('getRoleName')){
    function getRoleName($value){
        return Role::where('id', $value)->pluck('name')->first();
    }
}

if (! function_exists('getUserPermissions')){
    function getUserPermissions(){
        if(auth()->user()->user_type != 0) {
        return RolePermission::where('role_id', auth()->user()->user_type)->pluck('permission_id')->toArray();
        }
        else{
         return Permission::pluck('name')->toArray();
        }
    }
}

function checkPermission($value){
    if(auth()->user()->user_type != 0) {
        if (!in_array($value, getUserPermissions()))
        {
            return abort('403');
        }
    }
}

if (! function_exists('hasUnreadMessages')){
    function hasUnreadMessages(){
       $count = Message::getUnreadCount();
       if ($count > 0) {
        return true;
       }
        return false;
    }
}


function getHrsMins($time)
{
    $hours = floor($time / 60);
    $minutes = ((($time * 60) + $time) % 60);
    if($minutes > 0){
        return $hours . 'h ' . $minutes . 'm';
    }
    else {
        return $hours . 'h ';
    }

}

function getHrsMinsArray($time)
{
    return [
        'time_hrs' => floor($time / 60),
        'time_mins' => ((($time * 60) + $time) % 60)
    ];
}

function getNotifyTime($time)
{
    $notifyTime = Carbon::parse($time)->diffForHumans();
    return $notifyTime;
}

function getNotifyCount()
{
    $count = 0;
    foreach (auth()->user()->notifications as $key => $notification) {
        if (is_null($notification->read_at)) {
            $count++;
        }
    }
    return $count;
}

function daysLeft($date)
{
    if ($date) {
        $remaining_days = Carbon::now()->diffInDays(Carbon::parse($date));
    } else {
        $remaining_days = 0;
    }


    if($remaining_days >= 10) {
        return '<span class="badge badge-dim badge-light text-gray"><em class="icon ni ni-clock"></em><span>'.$remaining_days.' Days Left</span></span>';
    }
    elseif ($remaining_days >=2 && $remaining_days <=9){
        return '<span class="badge badge-dim badge-warning"><em class="icon ni ni-clock"></em><span>'.$remaining_days.' Days Left</span></span>';
    }
    else {
        return '<span class="badge badge-dim badge-danger"><em class="icon ni ni-clock"></em><span>'.$remaining_days.' Day Left</span></span>';
    }
}

if (! function_exists('getFiles')){
    function getFiles($attachment_id){
        $file_ids = explode(',', $attachment_id);
        $attachments = Attachment::whereIn('id',$file_ids)->get();
        $html = '<div class="attach-files"><ul class="attach-list">';
        foreach($attachments as $attachment){
            $exploded = explode('.', $attachment->name);
            $file_name = substr($attachment->name, 0, strrpos($attachment->name, "."));
            $file_ext = strtolower(end($exploded));
            if ($file_ext == 'png') {
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/PNG.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
            elseif($file_ext == 'jpg' || $file_ext == 'jpeg'){
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/JPEG.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
             elseif($file_ext == 'svg'){
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/SVG.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
            elseif($file_ext == 'psd'){
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/DOC.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
            elseif($file_ext == 'ai'){
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/AI.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
            elseif($file_ext == 'eps'){
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/EPS.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
             elseif($file_ext == 'pdf'){
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/PDF.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
             elseif($file_ext == 'zip'){
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/ZIP.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
             elseif($file_ext == 'rar'){
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/RAR.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
             elseif($file_ext == 'ppt' || $file_ext == 'pptx'){
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/PPTX.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
             elseif($file_ext == 'doc' || $file_ext == 'docx'){
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/DOC.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
             elseif($file_ext == 'txt'){
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/TXT.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
            }
            else {
            $html .= '<li class="attach-item" data-toggle="tooltip" data-placement="top" title="'.$file_name.'"><a class="download" target="_blank" href="'.asset('attachments/'.$attachment->name).'"><img src="'.asset('images/icons/FILE.png').'" width="35px"><span> &nbsp;'.$file_name.'</span></a></></li>';
             }

        }
        $html .= '</ul></div>';
        return $html;
    }
}

if (!function_exists('sendNotification')){
    function sendNotification($description, $link, $member_id, $user_id){
        Notification::create([
            'description' => $description,
            'link' => $link,
            'member_id' => $member_id,
            'user_id' => $user_id
        ]);
    }
}

function priceToFloat($s)
{
    // convert "," to "."
    $s = str_replace(',', '.', $s);

    // remove everything except numbers and dot "."
    $s = preg_replace("/[^0-9\.]/", "", $s);

    // remove all seperators from first part and keep the end
    $s = str_replace('.', '',substr($s, 0, -3)) . substr($s, -3);

    // return float
    return (float) $s;
}

function jsonClean($json){
    $str_response = mb_convert_encoding($json, 'utf-8', 'auto');

    for ($i = 0; $i <= 31; ++$i) {
        $str_response = str_replace(chr($i), "", $str_response);
    }
    $str_response = str_replace(chr(127), "", $str_response);

    if (0 === strpos(bin2hex($str_response), 'efbbbf')) {
        $str_response = substr($str_response, 3);
    }

    return $str_response;
}

function monthAlpha($value){
    switch ($value) {
        case 1:
            return 'January';
            break;
        case 2:
            return 'February';
            break;
        case 3:
            return 'March';
            break;
        case 4:
            return 'April';
            break;
        case 5:
            return 'May';
            break;
        case 6:
            return 'June';
            break;
        case 7:
            return 'July';
            break;
        case 8:
            return 'August';
            break;
        case 9:
            return 'September';
            break;
        case 10:
            return 'October';
            break;
        case 11:
            return 'November';
            break;
        case 12:
            return 'December';
            break;
    }
}

function hasPermission($permission_name) {
	return \Auth::user()->user_type == \App\User::SUPER_ADMIN ?: \Auth::user()->can($permission_name);
}

function userStatus($value){
    switch ($value) {
        case 0:
            return '<label class="badge badge-info">No Check</label>';
            break;
        case 1:
            return '<label class="badge badge-danger">Failed</label>';
            break;
        case 2:
            return '<label class="badge badge-success">Passed</label>';
            break;
        case 3:
            return '<label class="badge badge-warning">Temperature Failed</label>';
            break;
        case 4:
            return '<label class="badge badge-warning">Covid Positive</label>';
            break;
    }
}

function getNameInitials($name)
{
    $nameParts = explode(' ', trim($name));
    $firstName = array_shift($nameParts);
    $lastName = array_pop($nameParts);
    $initials = mb_substr($firstName,0,1) . mb_substr($lastName,0,1);
    return strtoupper($initials);
}

function getUserImage($id)
{
    $user = getUserDetail($id);
        if(isset($user->id)) {
            if (Cache::has('user-is-online-' . $user->id)) {
                echo '<div class="status dot dot-lg dot-success"></div>';
            } else {
                echo '<div class="status dot dot-lg dot-gray"></div>';
            }
        }

        if (isset($user->picture)) {
            return '<img src="'.asset('pictures/'.$user->picture).'">';
        }
        else {
            if(isset($user->name)){
                $nameParts = explode(' ', trim($user->name));
                $firstName = array_shift($nameParts);
                $lastName = array_pop($nameParts);
                $initials = mb_substr($firstName,0,1) . mb_substr($lastName,0,1);
                return strtoupper($initials);
            }
        }

}

function isSuperAdmin(){
    return intval(auth()->user()->application_id) === 0;
}

function sendEmail($dynamicData, $obj, $files = null){
    try {

        Mail::send('emails.payment_success', $obj, function($message) use ($dynamicData,$obj,  $files) {
                    $message->setFrom($obj["from"], $obj["sales"]);
                    $message->setSubject($obj["subject"]);
                    $message->addTo($obj["to"] , $obj["customer"]);
                    $message->attach( public_path('/temp_files/') .$files['fileName'] );
        });

    } catch (Exception $e) {
        echo 'Caught exception: '.  $e->getMessage(). "\n";
    }
}

function getWorkingHours($in,$out){

    $ts1 = strtotime(str_replace('/', '-', date('H:i:s', strtotime($in))));
    $ts2 = strtotime(str_replace('/', '-', $out));
    return abs($ts1 - $ts2) / 3600;

}


function getWorkingHoursSheet($in,$out){
    $startTime = Carbon::parse($in);
    $finishTime = Carbon::parse($out);

    $totalDuration = $finishTime->diffInSeconds($startTime);
    return gmdate('H:i:s', $totalDuration);
}

function getTimeTotal($in,$out){
    $startTime = Carbon::parse($in);
    $finishTime = Carbon::parse($out);

    $totalDuration = $finishTime->diffInMinutes($startTime);
    return $totalDuration;
}

function getProfileJss($id)
{
    return \App\ProfileJss::where('profile_id', $id)->pluck('jss_record')->last();
}

function getProfileName($id)
{
    return Profile::where('id', $id)->pluck('name')->first();
}
function getUserAvailedLeaves($id)
{
    return Leave::where(['user_id' => $id, 'status' => 2])->pluck('no_of_days')->sum();
}
function getUserAppliedLeaves($id)
{
    return Leave::where(['user_id' => $id, 'status' => 0])->pluck('no_of_days')->sum();
}
