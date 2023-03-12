<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CustomCode;

use App\Models\StaffManage;
use App\Models\UserManage;

class StaffController extends Controller
{
    //
    public function index(Request $request, $staffID = ''){
        
        /*$uid = new CustomCode();
        $id = $uid->CreateId();
        echo $id;*/
        $roles = DB::select("SELECT * FROM sms_role_master WHERE ROLE_STATUS = 'ACTIVE' ORDER BY ROLE_NAME");
        if(isset($request->staffID) && $request->staffID !=''){
            $staffID = $request->staffID;
        }else{
            $staffID = '';
        }
        if($staffID == ''){
            return view('admin/add_staff', compact('roles'));
        }
        if($staffID != ''){
            $data = DB::select("SELECT * FROM sms_staff_data sd LEFT JOIN sms_userlogin su ON sd.STAFF_ID = su.STAFF_ID LEFT JOIN sms_role_master rm ON su.USER_ROLE = rm.ROLE_ID WHERE sd.STAFF_ID = '$staffID' AND sd.STAFF_STATUS = 'ACTIVE'");
            $roles = DB::select("SELECT * FROM sms_role_master WHERE ROLE_STATUS = 'ACTIVE' ORDER BY ROLE_NAME");
            return view('admin/add_staff', compact('data','roles'));
        }
         
    }
    
    public function manageStaff(Request $request){
        
        date_default_timezone_set('Asia/Kolkata');
        $curr_date = date("Y-m-d");
        $staff_id = '';
        if(isset($request->staffid) && $request->staffid !=''){
            $staff_id = $request->staffid;
        }else{
            $staff_id = '';
        }
        /*========== add new staff =====*/
        if($staff_id == ''){
        $uid = new CustomCode();
        $id = $uid->CreateId();
        
        $staff = new StaffManage();
        
        $staff->STAFF_ID = $id;
        $staff->STAFF_NAME = $request->empName;
        $staff->STAFF_FATHER_NAME = $request->empF_Name;
        $staff->STAFF_MOBILE = $request->empMobile;
        $staff->STAFF_GENDER = $request->empGender;
        $staff->STAFF_DOB = $request->empDOB;
        $staff->STAFF_QUALIFICATION = $request->empEducation;
        $staff->STAFF_ADDRESS = $request->empAddress;
        $staff->STAFF_AREA = $request->empArea;
        $staff->STAFF_STATE = $request->empState;
        $staff->STAFF_STATUS = $request->empStatus;
        $staff->DATE_ENTERED = $curr_date;
        
        if($staff->save()){
            $uid = new CustomCode();
            $userid = $uid->CreateId();
            $user = new UserManage();
            $uname = explode(" ", $request->empName);
            $user->USER_ID = $userid;
            $user->STAFF_ID = $staff->STAFF_ID;
            $user->USER_NAME = $uname[0];
            $user->USER_PASSWORD = $request->empPassword;
            $user->USER_EMAIL = $request->empEmail;
            $user->USER_MOBILE = $request->empMobile;
            $user->USER_ROLE = $request->empRole;
            $user->USER_STATUS = $request->empStatus;
            $user->CREATED_AT = $curr_date;
            if($user->save()){
                return redirect('admin/view-staff');
            }
        }
        
        }
        
        /*======= update Information ====*/
        if($staff_id !=''){
            
        $staff = StaffManage::find($staff_id);

        $staff->STAFF_NAME = $request->empName;
        $staff->STAFF_FATHER_NAME = $request->empF_Name;
        $staff->STAFF_MOBILE = $request->empMobile;
        $staff->STAFF_GENDER = $request->empGender;
        $staff->STAFF_DOB = $request->empDOB;
        $staff->STAFF_QUALIFICATION = $request->empEducation;
        $staff->STAFF_ADDRESS = $request->empAddress;
        $staff->STAFF_AREA = $request->empArea;
        $staff->STAFF_STATE = $request->empState;
        $staff->STAFF_STATUS = $request->empStatus;
        $staff->DATE_ENTERED = $curr_date;
        
        if($staff->save()){
            $uid = new CustomCode();
        $recordid = $uid->Get_Record('sms_userlogin','STAFF_ID',$staff_id);
        
            $user = UserManage::find($recordid[0]->USER_ID);
            $user->STAFF_ID = $staff_id;
            $user->USER_NAME = $request->empName;
            if($request->empPassword == ''){
            $user->USER_PASSWORD = $request->old_password;
            }else{
                $user->USER_PASSWORD = $request->empPassword;
            }
            $user->USER_EMAIL = $request->empEmail;
            $user->USER_MOBILE = $request->empMobile;
            $user->USER_ROLE = $request->empRole;
            $user->USER_STATUS = $request->empStatus;
            $user->CREATED_AT = $curr_date;
            if($user->save()){
                return redirect('admin/view-staff');
            }
        }
    }
       // return $request;
    }
    
    public function staffList(Request $request){
       // $data = DB::select("SELECT * FROM sms_staff_data");
       // $data = StaffManage::paginate(10);
        $data = DB::table('sms_staff_data')->where('STAFF_STATUS','=','ACTIVE')->paginate(10);
        //return $data;
        return view('admin/view_staff', compact('data'));
    }
    
    public function removeStaff(Request $req){
        $msg = array();
        if(isset($req->remove_staff) && isset($req->sid)){
            $staff = StaffManage::find($req->sid);
            $staff->STAFF_STATUS = 'DEACTIVE';
            if($staff->save()){
                $uid = new CustomCode();
            $recordid = $uid->Get_Record('sms_userlogin','STAFF_ID',$req->sid);
        
            $user = UserManage::find($recordid[0]->USER_ID);
            $user->USER_STATUS = 'DEACTIVE';
            if($user->save()){
                $msg = array('msg'=>'Staff Removed Successfully!');
                }
            }
            
        }
        
        if(isset($req->join_staff) && isset($req->sid)){
            $staff = StaffManage::find($req->sid);
            $staff->STAFF_STATUS = 'ACTIVE';
            if($staff->save()){
                $uid = new CustomCode();
            $recordid = $uid->Get_Record('sms_userlogin','STAFF_ID',$req->sid);
        
            $user = UserManage::find($recordid[0]->USER_ID);
            $user->USER_STATUS = 'ACTIVE';
            if($user->save()){
                $msg = array('msg'=>'Staff Re-Join Successfully!');
                }
            }
            
        }
        
        return response()->json($msg);
    }
}
