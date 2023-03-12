<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CustomCode;

use App\Models\StaffManage;
use App\Models\UserManage;
use App\Models\ManageAttendance;
use Session;

class StaffAttendanceController extends Controller
{
    //
    public function index(Request $request, $staffID = ''){
    
    return view('admin/staff_attendance');
        
    }
    
    public function manageStaff(Request $request){
        
    }
    
    public function get_all_staff(Request $req){
        $tbl_name = $req->query('staff_data');
        //echo $tbl_name;
        $data = DB::table($tbl_name)->where('STAFF_STATUS','=','ACTIVE')->orderBy('STAFF_NAME','ASC')->get();
        
        return response()->json($data);
       
    }
    
    public function mark_attendance(Request $req){
        $uid = new CustomCode();
        $id = $uid->CreateId();
        date_default_timezone_set('Asia/Kolkata');
        $curr_date = date("Y-m-d");
        $curr_time = date("h:i:s a");
        $attendance = 0;
        if(isset($req->attendance) && $req->attendance !=''){
            $attendance = $req->attendance;
        }
        
        $staff_id = '';
        if(isset($req->select_staff) && $req->select_staff !=''){
           $staff_id =  $req->select_staff;
        }
        
        $chk = DB::select("SELECT * FROM sms_staff_attendance WHERE STAFF_ID = '$staff_id' AND ATTENDANCE_DATE = '$curr_date'");
       
        if(count($chk) > 0){
            $message='Attendance Already Added!'; 
        }else{
            $atten = new ManageAttendance();
            $atten->ATTENDANCE_ID = $id;
            $atten->STAFF_ID = $staff_id;
            $atten->ATTENDANCE_DATE = $curr_date;
            $atten->ATTENDANCE_STATUS = $attendance;
            $atten->ANY_REMARK = $req->leave_remark;
            $atten->ATTENDANCE_TIME = $curr_time;
            $atten->save();
            $message='Attendance Added Successsfully!'; 
        }
        $res = array('msg'=>$message);
        return response()->json($res);
    }
    
    public function get_attendance(Request $req){
        date_default_timezone_set('Asia/Kolkata');
        $start_date = $req->year_name."-".$req->month_name."-01";
        $d=cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
        $end_date = $req->year_name."-".$req->month_name."-".$d;
        
        return view('admin/view_staff_attendace');
    }
    
    public function view_attendance(Request $req){
         date_default_timezone_set('Asia/Kolkata');
        $start_date = $req->year_name."-".$req->month_name."-01";
        $d=cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
        $end_date = $req->year_name."-".$req->month_name."-".$d;
        
        if(isset($req->year_name) && isset($req->month_name) && !isset($req->staff_name)){
         $data = DB::select("SELECT sa.ATTENDANCE_STATUS, sd.STAFF_ID, sd.STAFF_NAME FROM sms_staff_attendance sa INNER JOIN sms_staff_data sd ON sa.STAFF_ID = sd.STAFF_ID WHERE sa.ATTENDANCE_DATE BETWEEN '$start_date' AND '$end_date' GROUP BY sd.STAFF_NAME ORDER BY sd.STAFF_NAME ASC");
        }
        if(isset($req->year_name) && isset($req->month_name) && isset($req->staff_name)){
         $data = DB::select("SELECT sa.ATTENDANCE_STATUS, sd.STAFF_ID, sd.STAFF_NAME FROM sms_staff_attendance sa INNER JOIN sms_staff_data sd ON sa.STAFF_ID = sd.STAFF_ID WHERE sa.ATTENDANCE_DATE BETWEEN '$start_date' AND '$end_date' AND sa.STAFF_ID = '$req->staff_name' GROUP BY sd.STAFF_NAME ORDER BY sd.STAFF_NAME ASC");
        }
       
        $return_arr = array();
        foreach($data as $key){
           $present = $this->get_present($key->STAFF_ID);
           $absent = $this->get_absent($key->STAFF_ID);
           
           array_push($return_arr, array('STAFF_ID'=>$key->STAFF_ID,
                               'STAFF_NAME'=>$key->STAFF_NAME,
                               'PRESENT'=>$present,
                               'ABSENT'=>$absent,
                               ));
        }
        
        return response()->json($return_arr);
    }
    
    function get_present($staff_id){
        $data = DB::select("SELECT COUNT(ATTENDANCE_STATUS) AS PRESENT FROM sms_staff_attendance WHERE STAFF_ID = '$staff_id' AND ATTENDANCE_STATUS = '1'");
        return $data[0]->PRESENT;
    }
    
    function get_absent($staff_id){
        $data = DB::select("SELECT COUNT(ATTENDANCE_STATUS) AS ABSENT FROM sms_staff_attendance WHERE STAFF_ID = '$staff_id' AND ATTENDANCE_STATUS = '0'");
        return $data[0]->ABSENT;
    }
}
