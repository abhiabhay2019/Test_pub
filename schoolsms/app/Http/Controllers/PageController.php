<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CustomCode;

use App\Models\SchoolManage;

class PageController extends Controller
{
    //
    public function index(Request $request){
        
        //return view('admin/pages'); 
        $data = SchoolManage::where('STATUS','=','ACTIVE')->where('DEFAULT_BRANCH','=','1')->get();
        
        return view('admin/pages', compact('data'));
    }
    
    public function addPage(Request $request){
        $roles = DB::select("SELECT * FROM sms_role_master WHERE ROLE_STATUS = 'ACTIVE' ORDER BY ROLE_NAME");
        return view('admin/addpage', compact('roles'));
    }
    
    public function addPageInfo(Request $request){
        $pageInof = new SchoolManage();
        
        $uid = new CustomCode();
        $school_id = $uid->CreateId();
        
        $msg ='';
        
        $chk = DB::table('sms_school_info')->where('SCHOOL_NAME','=',$request->schoolName)->count();
        if($chk > 0){
            $msg = "Information Already Created";
        }else{
            $attendance_time1 = $request->attendanceTime1.':'.$request->attendanceTime11;
            $attendance_time2 = $request->attendanceTime2.':'.$request->attendanceTime22;
            
            $login_time1 = $request->loginTime1.':'.$request->loginTime11;
            $login_time2 = $request->loginTime2.':'.$request->loginTime22;
            
            $status = 'ACTIVE';
            
        $pageInof->INFO_ID = $school_id;
        $pageInof->SCHOOL_NAME = $request->schoolName;
        $pageInof->CONTACT_NAME = $request->contactName;
        $pageInof->CONTACT_MOBILE = $request->contactMobile;
        $pageInof->CONTACT_EMAIL = $request->officialEmail;
        $pageInof->SCHOOL_ADDRESS = $request->schoolAddress;
        $pageInof->SCHOOL_AREA = $request->schoolArea;
        $pageInof->SCHOOL_DISTRICT = $request->schoolDistrict;
        $pageInof->SCHOOL_STATE = $request->schoolState;
        $pageInof->SCHOOL_AREA_PIN = $request->areaPincode;
        $pageInof->SCHOOL_UDISE_NO = $request->udiseNo;
        $pageInof->ATTENDANCE_START_TIME = $attendance_time1;
        $pageInof->ATTENDANCE_END_TIME = $attendance_time2;
        $pageInof->LOGIN_START_TIME = $login_time1;
        $pageInof->LOGIN_END_TIME = $login_time2;
        $pageInof->STATUS = $status;
        $pageInof->DEFAULT_BRANCH = $request->defaultBranch;
        $pageInof->save();
        }
        
        $data = SchoolManage::where('STATUS','=','ACTIVE')->where('DEFAULT_BRANCH','=','1')->get();
        
        return view('admin/pages', compact('data'));
    }
}
