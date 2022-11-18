<?php

namespace App\Imports;

use App\Attendance;
use App\User;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AttendanceImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {


        $count = 0;
        foreach ($collection as $collect) {

            $dte = date('Y-m-d', strtotime($collect[3]));
            $month[$dte][$count] = date('h:i:s A', strtotime($collect[3]));
            $count++;
        }

       /* echo '<pre>';
        print_r($month);
        die;*/
       // Attendance::truncate();


        foreach ($month as $key => $val) {

            $start = reset($val);
            $end = end($val);

            /*echo "Date :" . $key;
            echo '<br>';
            echo "=====";
            echo '<br>';
            echo $start;
            echo '<br>';
            echo $end;
            echo '<br>';
            echo "=====";
            echo '<br>';

            $a = new DateTime($start);
            $b = new DateTime($end);
            $interval = $a->diff($b);*/

            // echo "Diffrence = ".$interval->format("%S");


            //  echo "Difference = " . number_format(( strtotime($start) - strtotime($end) ) / 60, 2);

            //if (isset($start) && isset($end)) {
                // echo $this->getTimeDiff($end, $start);
           // }

            /*echo '<br>';
            echo "---------------------------------------------------------------";
            echo '<br><br>';*/



            // check for previous entry
            $attendance = Attendance::where('date',$key)->where('attendance_user_id', $collection[2][2])->get();
            if(count($attendance)==0) {


                $user = User::where('attendance_id', $collection[2][2])->first();


                // insert into attendance TABLE


                $attendance = new Attendance();

                if ($user) {
                    $attendance->user_id = $user->id;

                    $routine_check_in = date('H:i:s', strtotime($user->check_in));
                    $routine_checkout = date('H:i:s', strtotime($user->check_out));

                    $attendance->routine_check_in = $user->check_in;
                    $attendance->routine_checkout = $user->check_out;


                }

                // late

                $diff = getWorkingHours($user->check_in, $start);

                if ($diff >= 0.51638888888889) {  // 04:30:59
                    $attendance->is_late = 1;
                } else {
                    $attendance->is_late = 0;
                }

                // late


                // if total hours are 9 or above then remove late
                $total_hours = getWorkingHoursSheet($start,$end);

                $th = date("H",strtotime($total_hours));


                if($th >= "09"){
                    $attendance->is_late = 0;
                }

                // if total hours are 9 or above then remove late

                $attendance->attendance_user_id = $collection[2][2];
                $attendance->date = $key;

                $attendance->today_check_in = $start;
                $attendance->today_check_out = $end;

                $attendance->status = 1;

                if (isset($start) && isset($end)) {
                    $attendance->difference_time = $this->getTimeDiff($start, $end);
                }

                $attendance->save();

            }


        }


    }

    function getTimeDiff($dtime, $atime)
    {
        $nextDay = $dtime > $atime ? 1 : 0;
        $dep = explode(':', $dtime);
        $arr = explode(':', $atime);
        $diff = abs(mktime($dep[0], $dep[1], 0, date('n'), date('j'), date('y')) - mktime($arr[0], $arr[1], 0, date('n'), date('j') + $nextDay, date('y')));
        $hours = floor($diff / (60 * 60));
        $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        $secs = floor(($diff - (($hours * 60 * 60) + ($mins * 60))));
        if (strlen($hours) < 2) {
            $hours = "0" . $hours;
        }
        if (strlen($mins) < 2) {
            $mins = "0" . $mins;
        }
        if (strlen($secs) < 2) {
            $secs = "0" . $secs;
        }
        return $hours . ':' . $mins . ':' . $secs;
    }
}
