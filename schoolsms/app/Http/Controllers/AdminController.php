<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminLogin;
use Illuminate\Support\Facades\DB;
use App\Models\SchoolManage;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.index');
    }
    
    public function checklogin(Request $req){
        date_default_timezone_set('Asia/Kolkata');
        //return $req->input();
        $user=$req->post('uName');
        $pass=$req->post('uPass');
        
        $adminData = AdminLogin::where(['USER_NAME'=>$user,'USER_PASSWORD'=>$pass])->get();
        if(isset($adminData['0']->USER_ID)){
            $req->session()->put('ADMIN_LOGIN',true);
            $req->session()->put('IS_ADMIN',$adminData['0']->IS_ADMIN);
            $req->session()->put('sName',$adminData['0']->USER_NAME);
            
            $data = SchoolManage::where('STATUS','=','ACTIVE')->where('DEFAULT_BRANCH','=','1')->get();
            $schoolName = '';
            $login_start='';
            $login_end='';
            
            $allData = $adminData->merge($data);
            
            foreach($allData as $key=>$val){
            $req->session()->put($key,$val);
            }
            
            if($data[0]->SCHOOL_NAME !=''){
                $req->session()->put('title',$data[0]->SCHOOL_NAME);
            }else{
                $req->session()->put('title','Your School Name');
            }
            if($data[0]->LOGIN_START_TIME !='' && $data[0]->LOGIN_END_TIME !=''){
            $login_start = $data[0]->LOGIN_START_TIME;
            $login_end = $data[0]->LOGIN_END_TIME;
            }
            $current_time = date("H:i");
            if($adminData['0']->IS_ADMIN == 1 || $adminData['0']->IS_ADMIN == '1'){
            return redirect('admin/dashboard');
            }
            else{
                
                if($current_time>$login_start && $current_time < $login_end){
                    return redirect('admin/dashboard');
                }else{
                    session()->forget('ADMIN_LOGIN');
                    session()->forget('sName');
                    session()->flush();
                    session()->flash('msg','Login Time Has Been Over Please Contact Administrator');
                    
                    return redirect('admin');
                }
            }
        }else{
           $req->session()->flash('msg','User Name & Password Not Matched');
           return redirect('admin');
        }
       // return $adminData->all();
    }
    
    ////////////////////////////////////////////////////////
    
    public function dashboard(Request $req){
        date_default_timezone_set('Asia/Kolkata');
        $start_date = date("Y-m-")."01";
        $d=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
        $end_date = date("Y-m-").$d;
        $student = DB::select("SELECT COUNT(S_ID) AS TOTAL_STUDENT FROM sms_student_data WHERE S_STATUS = 'ACTIVE'");
        $staff = DB::select("SELECT COUNT(STAFF_ID) AS TOTAL_STAFF FROM sms_staff_data WHERE STAFF_STATUS = 'ACTIVE'");
        $fees = DB::select("SELECT SUM(RECEIVED_AMT) AS TOTAL_FEES, COUNT(FEES_MASTER_ID) AS TOTAL_FEES_COUNT FROM sms_fees_master WHERE FEES_STATUS = 'DONE' AND RECEIVED_DATE BETWEEN '$start_date' AND '$end_date'");
        $pstaff = DB::select("SELECT COUNT(STAFF_ID) AS TOTAL_PRESENT FROM sms_staff_data WHERE STAFF_STATUS = 'ACTIVE'");
        return view('admin.dashboard', compact('student', 'staff', 'fees', 'pstaff'));
    }
}
