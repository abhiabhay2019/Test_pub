<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentManage;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    //
    public function index(Request $request){
        
        return view('admin/add_student'); 
    }
    
    public function addStudent(Request $request){
        //return $request->post();
        $id ='';
        date_default_timezone_set('Asia/Kolkata');
        $currDate = date("Y-m-d");
        $currTime = date("h:i:s a");
        $currYear = date("Y");
        if($request->sid == 'ADD'){
        $uid = new CustomCode();
        $id = $uid->CreateId();
        $stdDB = new StudentManage();
        $stdDB->ADMISSION_DATE = $currDate;
        
        }else{
           $stdDB = StudentManage::find($request->sid);
           $id = $request->sid;
        }
        $stdDB->S_ID = $id;
        $stdDB->STUDENT_NAME = $request->studentName;
        $stdDB->S_FATHER_NAME = $request->fatherName;
        $stdDB->S_MOTHER_NAME = $request->motherName;
        $stdDB->S_DOB = $request->studentDOB;
        $stdDB->S_GENDER = $request->gender;
        $stdDB->S_ADDRESS = $request->address;
        $stdDB->S_DISTRICT = $request->district;
        $stdDB->S_PINCODE = $request->pincode;
        $stdDB->S_MOBILE = $request->fatherMobile;
        $stdDB->S_EMAIL = $request->email;
        $stdDB->S_AADHAR_NUMBER = $request->studentAadhar;
        $stdDB->S_NATIONALITY = $request->nationality;
        $stdDB->S_RELIGION = $request->religion;
        $stdDB->S_FATHER_OCCUPATION = $request->fatherOccupation;
        $stdDB->ADMISSION_CLASS = $request->className;
        $stdDB->SUBMIT_DCUMENT_LIST = $request->document;
        $stdDB->S_STATUS = 'ACTIVE';
        $stdDB->STATUS_REMARK = '';
        $stdDB->ADMISSION_SESSION = $request->admission_session;
        $stdDB->ADMISSION_TIME = $currTime;
        $stdDB->CREATED_BY = $request->session;
        $stdDB->save();
        
        $last_sid=$stdDB->S_ID;
        
        $sdata = StudentManage::all()->last();
        $uid1 = new CustomCode();
        $sessionid = $uid1->CreateId();
        
        $session = array("SESSION_ID"=>$sessionid,
                         "SESSION_YEAR"=>$sdata->ADMISSION_SESSION,
                         "STUDENT_ID"=>$sdata->S_ID,
                         "CLASS_ID"=>$sdata->ADMISSION_CLASS,
                         "REGISTRATION_NO"=>$sdata->ADMISSION_NO,
                         "REGISTRATION_YEAR"=>$sdata->ADMISSION_NO."/".$currYear,
                         "ADMISSION_NO"=>$sdata->ADMISSION_NO,
                         "ENTERED_DATE"=>$currDate,
                         "CREATED_BY"=>session('sName'),
                         );
        DB::table('sms_student_session')->insert($session);                 
        if($request->sid == 'ADD'){
        $request->session()->flash('msg','Thank You, Student Added Successfully!');
        }else{
           $request->session()->flash('msg','Thank You, Student Updated Successfully!'); 
        }
        
        //return redirect('admin/add-student');
        return redirect()->back();
    }
    
    public function getAllStudent(Request $request){
        
        $className = $request->ClassName;
        $wildSearch = $request->wildSearch;
      if($className =='' && $wildSearch =='')
      {
        $data = StudentManage::join('sms_class_master','sms_class_master.CLASS_ID','=','sms_student_data.ADMISSION_CLASS')->where('S_STATUS','=','ACTIVE')->orderBy('sms_student_data.ADMISSION_NO','DESC')->paginate(10);
      }
      if($className !='' && $wildSearch =='')
      {
        $data = StudentManage::join('sms_class_master','sms_class_master.CLASS_ID','=','sms_student_data.ADMISSION_CLASS')->where('sms_class_master.CLASS_ID','=',$className)->paginate(10);
      }
      if($className =='' && $wildSearch !='')
      {
        $data = StudentManage::join('sms_class_master','sms_class_master.CLASS_ID','=','sms_student_data.ADMISSION_CLASS')->where('sms_student_data.S_FATHER_NAME','=',$wildSearch)->orWhere('sms_student_data.STUDENT_NAME','=',$wildSearch)->orWhere('sms_student_data.S_MOBILE','=',$wildSearch)->paginate(10);
      }
      if($className !='' && $wildSearch !='')
      {
        $data = StudentManage::join('sms_class_master','sms_class_master.CLASS_ID','=','sms_student_data.ADMISSION_CLASS')->where('sms_student_data.S_FATHER_NAME','=',$wildSearch)->orWhere('sms_student_data.STUDENT_NAME','=',$wildSearch)->orWhere('sms_student_data.STUDENT_NAME','=',$wildSearch)->orWhere('sms_class_master.CLASS_ID','=',$className)->paginate(10);
      }
        return view('admin/student_list',compact('data'));
    }
    
    public function editStudent(Request $request, $id){
        //return $id;
        
        $result = StudentManage::join('sms_class_master','sms_class_master.CLASS_ID','=','sms_student_data.ADMISSION_CLASS')->where('sms_student_data.S_ID','=',$id)->get();
        
        $cresult = DB::table('sms_class_master')->where('CLASS_STATUS','=','ACTIVE')->get();
        
        return view('admin/edit_student')->with('data',$result)->with('cdata',$cresult);
    }
    
    public function deleteStudent(Request $request, $id, $action){
        
        //return $id;
        
        $stdData = StudentManage::find($id);
        if($action =='DEACTIVE'){
        $stdData->S_STATUS = 'DEACTIVE';
        }
        if($action =='ACTIVE'){
        $stdData->S_STATUS = 'ACTIVE';
        }
        $stdData->save();
        
        if($action =='DEACTIVE'){
        $request->session()->flash('msg','Student Deactivated Success');
        }
        if($action =='ACTIVE'){
        $request->session()->flash('msg','Student Activated Success');
        }
        
        return redirect()->back();
    }
    
    public function deactiveLisst(Request $req){
        return view('admin/deactive_list');
    }
    
    public function getDeactiveLisst(Request $req){
        $page_limit = '10';
        $page_no = '';
        $start_from = '';
        $end_to = '';
        if($req->query('pageNo') == 1){
            $start_from = 0;
            $end_to = $page_limit;
        }else{
            $page_no = $req->query('pageNo');
            $start_from = ($page_no * $page_limit)-$page_limit;
            $end_to = ($page_no * $page_limit);
        }
        
        if($req->query('dataType') == 'Student'){
        $data = DB::select("SELECT STUDENT_NAME as name, S_FATHER_NAME as fname, S_MOBILE as mobile, S_EMAIL as email, S_STATUS as status, S_ID as id FROM sms_student_data WHERE S_STATUS = 'DEACTIVE' ORDER BY ADMISSION_NO DESC LIMIT $page_limit OFFSET $start_from");
        $total_record = DB::select("SELECT COUNT(ADMISSION_NO) AS TOTAL_RECORD FROM sms_student_data WHERE S_STATUS = 'DEACTIVE'");
        }
        
        return response()->json(array('main_data'=>$data,'total_record'=>$total_record));
    }
}
