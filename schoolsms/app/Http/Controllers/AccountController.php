<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeesDetails;
use App\Models\FeesPayment;
use App\Models\FeesManage;
use App\Models\FeesType;

use Illuminate\Support\Facades\DB;
use Mail;
use App\Http\Controllers\CustomCode;

class AccountController extends Controller
{
    //
    public function index(Request $request){
        
        return view('admin/add_fees'); 
    }
    
    public function getData(Request $request){
        
       $fetchData = $request->query('FetchData');
       $Data = $request->query('Data');
       $GetData = $request->query('GetData');
       
       if(isset($fetchData)){
       if($Data !=''){
       $result = DB::table('sms_student_data')
                    ->where('ADMISSION_NO', '=', $Data)
                    ->orWhere('STUDENT_NAME', 'like', $Data.'%')
                    ->orWhere('S_MOBILE', 'like', $Data.'%')
                    ->limit(5)
                    ->get();
       }else{
       $result = "";
       }
       
       }///isset close
       
       if(isset($GetData)){
           if($Data !=''){
       $result = DB::table('sms_student_data')
                    ->where('ADMISSION_NO', '=', $Data)
                    ->get();
       }else{
       $result = "";
       }
       }
        return response()->json($result);           
    }
    
    public function manageFees(Request $request)
    {
        //return $request->post();
        //return $request->sid;
        date_default_timezone_set('Asia/Kolkata');
        $currDate = date('Y-m-d');
        $currTime = date('h:i:s a');
        
        $feesArr = $request->feesArr;
        $totfees = 0;
        
        for($i=0; $i < count($feesArr); $i++){
            $totfees = $totfees + $feesArr[$i][3];
        }
        
        /*echo $totfees;
        
        exit();*/
        
        $pmtArr = $request->pmtArr;
        $totPmt = 0;
        
        for($i=0; $i < count($pmtArr); $i++){
            $totPmt = $totPmt + $pmtArr[$i][3];
        }
        
        /*echo $totPmt;
        
        exit();*/
        
        $balAmt = $totfees - $totPmt;
        $status = "PENDING";//SELECT FEES_RECEIPT_ID FROM  ORDER BY FEES_RECEIPT_ID DESC LIMIT 1"
       $receipt = DB::table('sms_fees_master')->select('FEES_RECEIPT_ID')->orderByDesc('FEES_RECEIPT_ID', 'DESC')->get();
       //return $receipt;
      $receipt_id = 0;
       if(isset($receipt[0]->FEES_RECEIPT_ID) && $receipt[0]->FEES_RECEIPT_ID != ''){
           $receipt_id = $receipt[0]->FEES_RECEIPT_ID+1;
       }else{
           $receipt_id = 1;
       }
       $receipt_no = 'IPS/'.date("y").'/'.date("M").'/'.$receipt_id;
       
            $feesObj = new FeesManage();
            $fDetailsObj = new FeesDetails();
            $fPmtObj = new FeesPayment();
       
        $uid = new CustomCode();
        $fid = $uid->CreateId();
        
        $feesObj->FEES_MASTER_ID = $fid;
        $feesObj->FEES_RECEIPT_ID = $receipt_id;
        $feesObj->FEES_RECEIPT_NO = $receipt_no;
        $feesObj->STUDENT_ID = $request->sid;
        $feesObj->STUDENT_NAME = $request->sName;
        $feesObj->CLASS_ID = $request->className;
        $feesObj->TOTAL_FEES = $totfees;
        $feesObj->RECEIVED_AMT = $totPmt;
        $feesObj->BALANCE_AMT = $balAmt;
        $feesObj->RECEIVED_BY = $request->session;
        $feesObj->RECEIVED_DATE = $currDate;
        $feesObj->RECEIVED_TIME = $currTime;
        $feesObj->FEES_STATUS = $status;
        $feesObj->save();
        
        $feesArr = $request->feesArr;
      
        
      
        for($i=0; $i < count($feesArr); $i++){
            $fduid = new CustomCode();
            $fdid = $fduid->CreateId();
            DB::table('sms_fees_details')->insert([
                    'FEES_ID'=>$fdid,
                    'FEES_MASTER_ID'=>$feesObj->FEES_MASTER_ID,
                    'FEES_MONTHS'=>$feesArr[$i][1],
                    'FEES_YEAR'=>$feesArr[$i][0],
                    'FEES_DETAILS'=>$feesArr[$i][4],
                    'FEES_AMT'=>$feesArr[$i][3],
                    'STUDENT_ID'=>$request->sid,
                    'FEES_DATE'=>$currDate
                    ]);
        }
        
        $pmtArr = $request->pmtArr;
        
        for($i=0; $i < count($pmtArr); $i++){
            $pmtuid = new CustomCode();
            $pmtid = $pmtuid->CreateId();
            DB::table('sms_fees_pmt_details')->insert([
                    'PAYMENT_ID'=>$pmtid,
                    'FEES_MASTER_ID'=>$feesObj->FEES_MASTER_ID,
                    'PAYMENT_MODE'=>$pmtArr[$i][0],
                    'REFERENCE_NO'=>$pmtArr[$i][1],
                    'PAYMENT_AMT'=>$pmtArr[$i][3],
                    'PAYMENT_DATE'=>$pmtArr[$i][2],
                    'STUDENT_ID'=>$request->sid,
                    'RECEIVED_DATE'=>$currDate,
                    ]);
        }
        
	    $msg = array('Msg'=>'Fees Added Successfully');
        return response()->json($msg);
    }
    
    public function getAllFees(Request $request){
  
  if(isset($request->feestype) && $request->feestype !=null && $request->feestype !=''){
            $data = DB::table('sms_fees_master')
                            ->join('sms_class_master','sms_fees_master.CLASS_ID','=','sms_class_master.CLASS_ID')
                            ->where('sms_fees_master.FEES_STATUS','=',$request->feestype)
                            ->orderby('sms_fees_master.FEES_RECEIPT_ID','desc')
                            ->paginate(10);
  }else if(isset($request->sroll) && $request->sroll !=null && $request->sroll !=''){
            $data = DB::table('sms_fees_master')
                            ->join('sms_class_master','sms_fees_master.CLASS_ID','=','sms_class_master.CLASS_ID')
                            ->where('sms_fees_master.STUDENT_ID','=',$request->sroll)
                            ->orderby('sms_fees_master.FEES_RECEIPT_ID','desc')
                            ->paginate(10);
  }else if(isset($request->feestype) && isset($request->sroll) && $request->feestype !=null && $request->feestype !='' && $request->sroll !=null && $request->sroll !=''){
            $data = DB::table('sms_fees_master')
                            ->join('sms_class_master','sms_fees_master.CLASS_ID','=','sms_class_master.CLASS_ID')
                            ->where('sms_fees_master.STUDENT_ID','=',$request->sroll)
                            ->where('sms_fees_master.FEES_STATUS','=',$request->feestype)
                            ->orderby('sms_fees_master.FEES_RECEIPT_ID','desc')
                            ->paginate(10);
  }else{
      $data = DB::table('sms_fees_master')
                            ->join('sms_class_master','sms_fees_master.CLASS_ID','=','sms_class_master.CLASS_ID')
                            ->orderby('sms_fees_master.FEES_RECEIPT_ID','desc')
                            ->paginate(10);
  }
                            
            
        
        return view('admin/view_fees_reports', compact('data'));
    }
    
    public function getAllFeesAjax(Request $request){
        if($request->query('AllFees') !=''){
            $data = DB::table('sms_fees_master')
                            ->join('sms_fees_details','sms_fees_master.FEES_MASTER_ID','=','sms_fees_details.FEES_MASTER_ID')
                            ->join('sms_fees_pmt_details','sms_fees_master.FEES_MASTER_ID','=','sms_fees_pmt_details.FEES_MASTER_ID')
                            ->join('sms_class_master','sms_fees_master.CLASS_ID','=','sms_class_master.CLASS_ID')
                            ->orderby('sms_fees_master.FEES_MASTER_ID','desc')->paginate(10);
        }
        
        return $result = json_encode($data);
    }
    
    //// addFeesMaster method to create fees master getAllFeesAjax
    
    public function addFeesMaster(Request $request){
        date_default_timezone_set('Asia/Kolkata');
        //print_r($request->post());
        $class='';
        if($request->post('className') !=''){
            $class = $request->post('className');
        }
        
        $chk = DB::table('sms_fees_type')->where('CLASS_ID','=',$class)->count();
        if($chk > 0){
            DB::select("DELETE FROM sms_fees_type WHERE CLASS_ID = '$class'");
        }
        
            for($i=0; $i<count($request->row_id); $i++){
            $j = $i+1;
            $uid = new CustomCode();
            $fid = $uid->CreateId();
            $feesType = new FeesType();
            $feesType->FEES_STATUS = 'ACTIVE';
        $currDate = date("Y-m-d");
        $feesType->FEES_TYPE_ID = $fid;
        $feesType->CLASS_ID = $request->post('className');
        $feesType->FEES_NAME = $request->post('fees_name_'.$j);
        $feesType->FEES_AMOUNT = $request->post('fees_amt_'.$j);
        $feesType->CREATED_AT = $currDate;
        $feesType->save();
            }
       
       //return $request->post();
        $request->session()->flash('msg','Fees Created Successfully');
        return redirect('admin/view-fees-type');
        
    }
    
    public function getAllFeesType(){
       // $feesType = new FeesType();
        
        $result = DB::select("SELECT ft.FEES_TYPE_ID, ft.CLASS_ID, cm.CLASS_NAME, SUM(ft.FEES_AMOUNT) AS CHARGES, ft.FEES_STATUS, ft.CLASS_ID FROM sms_fees_type ft LEFT JOIN sms_class_master cm ON ft.CLASS_ID = cm.CLASS_ID GROUP BY ft.CLASS_ID ORDER BY ft.CLASS_ID DESC");
        
        return view('admin/view_fees_type')->with('data',$result);
    }
    
    public function getFeesType(Request $req){
        
        return view('admin/fees_master');
        
    }
    
    public function getFeesTypeByID(Request $req){
        $class_id = $req->query('class_id');
        $result = DB::select("SELECT ft.FEES_TYPE_ID, ft.CLASS_ID, cm.CLASS_NAME, ft.FEES_NAME, ft.FEES_AMOUNT, ft.FEES_STATUS, ft.CLASS_ID FROM sms_fees_type ft LEFT JOIN sms_class_master cm ON ft.CLASS_ID = cm.CLASS_ID WHERE ft.CLASS_ID = '$class_id'");
        return $result;
    }
    
    public function getActiveFee(){
       
        $data = FeesType::where('FEES_STATUS','=','ACTIVE')->get();
        
        return $data;
    }
    
    public function show_fees_structure(Request $request){
        
        if(isset($request->fees_id) && $request->fees_id != null){
            $data = DB::table('sms_fees_details')
            ->join('sms_fees_type','sms_fees_details.FEES_DETAILS','=','sms_fees_type.FEES_TYPE_ID')
            ->where('sms_fees_details.FEES_MASTER_ID','=',$request->fees_id)
            ->get();
            
            $data1 = DB::table('sms_fees_pmt_details')
            ->where('FEES_MASTER_ID','=',$request->fees_id)
            ->get();
            
        }
        return view('admin/show_structure', compact('data','data1'));
    }
    
    public function editFees(Request $request){
        if(isset($request->fees_id) && $request->fees_id != null){
            //return $request->fees_id;
            $fid = $request->fees_id;
            
            //return $data;
            return view('admin/edit_fees');
        }
    }
    
    public function getFeesData(Request $request){
        if(isset($request->getdata)){
        if(isset($request->feesid) && $request->feesid != null){
            $data = DB::select("SELECT * FROM sms_fees_master fm LEFT JOIN sms_class_master cm ON fm.CLASS_ID = cm.CLASS_ID WHERE fm.FEES_MASTER_ID = '$request->feesid'");
            return response()->json($data);
        }
        }
        
        if(isset($request->getfeedata)){
        if(isset($request->feesid) && $request->feesid != null){
            $data = DB::select("SELECT * FROM sms_fees_details fd LEFT JOIN sms_fees_type ft ON fd.FEES_DETAILS = ft.FEES_TYPE_ID WHERE fd.FEES_MASTER_ID = '$request->feesid'");
            return response()->json($data);
        }
        }
        
        if(isset($request->getpmtdata)){
        if(isset($request->feesid) && $request->feesid != null){
            $data = DB::select("SELECT * FROM sms_fees_pmt_details WHERE FEES_MASTER_ID = '$request->feesid'");
            return response()->json($data);
        }
        }
    }
    
    public function updateFees(Request $request){
        //return $request;
        
        date_default_timezone_set('Asia/Kolkata');
        $currDate = date('Y-m-d');
        $currTime = date('h:i:s a');
        
        $feesArr = $request->feesArr;
        $totfees = 0;
        
        for($i=0; $i < count($feesArr); $i++){
            $totfees = $totfees + $feesArr[$i][3];
        }
        
        /*echo $totfees;
        
        exit();*/
        
        $pmtArr = $request->pmtArr;
        $totPmt = 0;
        
        for($i=0; $i < count($pmtArr); $i++){
            $totPmt = $totPmt + $pmtArr[$i][3];
        }
        
        $balAmt = $totfees - $totPmt;
        $status = "PENDING";
        
        if(isset($request->feeMasterId) && $request->feeMasterId != null){
       $data = DB::statement("UPDATE sms_fees_master SET STUDENT_ID = '$request->sid',  STUDENT_NAME = '$request->sName', CLASS_ID = '$request->className', TOTAL_FEES = '$totfees', RECEIVED_AMT = '$totPmt', BALANCE_AMT = '$balAmt', RECEIVED_BY = '$request->session', RECEIVED_DATE = '$currDate', RECEIVED_TIME = '$currTime', FEES_STATUS = '$status'  WHERE FEES_MASTER_ID = '$request->feeMasterId'");
            
        }
        
        $feesArr = $request->feesArr;
        
        $chk = DB::statement("DELETE FROM sms_fees_details WHERE FEES_MASTER_ID ='$request->feeMasterId'");
       
        for($i=0; $i < count($feesArr); $i++){
            $uid = new CustomCode();
            $id = $uid->CreateId();
            
                DB::table('sms_fees_details')->insert([
                    'FEES_ID'=>$id,
                    'FEES_MASTER_ID'=>$request->feeMasterId,
                    'FEES_MONTHS'=>$feesArr[$i][1],
                    'FEES_YEAR'=>$feesArr[$i][0],
                    'FEES_DETAILS'=>$feesArr[$i][4],
                    'FEES_AMT'=>$feesArr[$i][3],
                    'STUDENT_ID'=>$request->sid,
                    'FEES_DATE'=>$currDate
                    ]);
               
            
        }
        
        $pmtArr = $request->pmtArr;
        if(count($pmtArr) > 0){
            DB::statement("DELETE FROM sms_fees_pmt_details WHERE FEES_MASTER_ID = '$request->feeMasterId'");
        }
        for($i=0; $i < count($pmtArr); $i++){
            $uid = new CustomCode();
            $id = $uid->CreateId();
            DB::table('sms_fees_pmt_details')->insert([
                    'PAYMENT_ID'=>$id,
                    'FEES_MASTER_ID'=>$request->feeMasterId,
                    'PAYMENT_MODE'=>$pmtArr[$i][0],
                    'REFERENCE_NO'=>$pmtArr[$i][1],
                    'PAYMENT_AMT'=>$pmtArr[$i][3],
                    'PAYMENT_DATE'=>$pmtArr[$i][2],
                    'STUDENT_ID'=>$request->sid,
                    'RECEIVED_DATE'=>$currDate,
                    ]);
            
        }
        
	    $msg = array('Msg'=>'Fees Updated Successfully');
        return response()->json($msg);
        
        /*if(isset($request->feesid) && $request->feesid != null){
            $data = DB::select("SELECT * FROM sms_fees_pmt_details WHERE FEES_MASTER_ID = '$request->feesid'");
            return response()->json($data);
        }
        
        if(isset($request->feesid) && $request->feesid != null){
            $data = DB::select("SELECT * FROM sms_fees_details fd LEFT JOIN sms_fees_type ft ON fd.FEES_DETAILS = ft.FEES_TYPE_ID WHERE fd.FEES_MASTER_ID = '$request->feesid'");
            return response()->json($data);
        }*/
        
        
    }
    
    public function getPendingFees(Request $req){
        return view('admin/view_pending_fees');
    }
    
    public function getDueFees(Request $req){
        $month_name = '';
        $class_id = '';
        $pageNo = '';
        $initialVal = 0;
        $recordLimit = '';
        if(isset($req->month_name)){
            $month_name = $req->month_name;
        }
        if(isset($req->class_name)){
            $class_id = $req->class_name;
        }
        if(isset($req->PageNo) && isset($req->RecordLimit)){
        $pageNo = $req->PageNo;
        $recordLimit = $req->RecordLimit; 
        }
        if($pageNo == 1 || $pageNo <= 0){
            $offset = $initialVal;
            $limit = $recordLimit;
        }else{
           if($pageNo > 1){
               $offset = ($recordLimit*$pageNo)-$recordLimit;
               $limit = $recordLimit*$pageNo;
           } 
        }
        
        if($month_name !='' && $class_id ==''){
            
            $data = DB::select("SELECT sd.ADMISSION_NO, sd.STUDENT_NAME, sd.S_FATHER_NAME, cm.CLASS_NAME AS C_NAME, fs.FEES_MASTER_ID, fs.MONTH_NAME, fs.FEES_STATUS, CASE WHEN  MONTH_NAME = '$month_name' THEN 'DONE' ELSE 'PENDING' END AS FEES_STATUS FROM sms_student_data sd LEFT JOIN sms_student_fees_status fs ON sd.ADMISSION_NO = fs.STUDENT_ID LEFT JOIN sms_class_master cm ON sd.ADMISSION_CLASS = cm.CLASS_ID ORDER BY sd.ADMISSION_NO DESC LIMIT ".$offset.", ".$limit."");
        }
        if($month_name !='' && $class_id !=''){
           
            $data = DB::select("SELECT sd.ADMISSION_NO, sd.STUDENT_NAME, sd.S_FATHER_NAME, cm.CLASS_NAME AS C_NAME, fs.FEES_MASTER_ID, fs.MONTH_NAME, fs.FEES_STATUS, CASE WHEN  MONTH_NAME = '$month_name' THEN 'DONE' ELSE 'PENDING' END AS FEES_STATUS FROM sms_student_data sd LEFT JOIN sms_student_fees_status fs ON sd.ADMISSION_NO = fs.STUDENT_ID LEFT JOIN sms_class_master cm ON sd.ADMISSION_CLASS = cm.CLASS_ID WHERE sd.ADMISSION_CLASS = '$class_id' ORDER BY sd.ADMISSION_NO DESC");
        }
        return response()->json($data);
    }
    
    
 //////////////////////////////////////////
 
 
    public function getFeesStatus(Request $req){
        date_default_timezone_set("Asia/Kolkata");
        $curr_date = date("Y-m-d");
        $sid = $req->query('sid');
        $feesid = $req->query('feesid');
        $up_status = $req->query('update_fees');
        if(isset($feesid) && $feesid !=''){
        $data = DB::select("SELECT FEES_MASTER_ID, STUDENT_ID, CLASS_ID FROM sms_fees_master WHERE FEES_MASTER_ID = '$feesid'");
        return response()->json($data);
        }
        if(isset($up_status)){
            $uid = new CustomCode();
            $id = $uid->CreateId();
            $student_id = $req->query('student_id');
            $class_id = $req->query('class_id');
            $months = $req->query('months');
            $year = $req->query('year');
            $master_id = $req->query('master_id');
            $chk = DB::table('sms_student_fees_status')->where('FEES_MASTER_ID','=',$master_id)->count();
            
            if($chk > 0){
                
                $tbl_data = array('STUDENT_ID'=>$student_id, 'CLASS_ID'=>$class_id, 'MONTH_NAME'=>$months, 'YEAR'=>$year, 'FEES_STATUS'=>'DONE', 'DATE_ENTERED'=>$curr_date);
            $upd = DB::table('sms_student_fees_status')->where('FEES_MASTER_ID',$master_id)->update($tbl_data);
            $upd1 = DB::table('sms_fees_master')->where('FEES_MASTER_ID',$master_id)->update(array('FEES_STATUS'=>'DONE'));
            if($upd){
                return redirect('admin/fees-reports');
            }else{
                return redirect('admin/fees-reports');
            }
            }else{
                
            $tbl_data = array('ID'=>$id, 'STUDENT_ID'=>$student_id, 'CLASS_ID'=>$class_id, 'MONTH_NAME'=>$months, 'YEAR'=>$year, 'FEES_MASTER_ID'=>$master_id, 'FEES_STATUS'=>'DONE', 'DATE_ENTERED'=>$curr_date);
            
            $upd = DB::table('sms_student_fees_status')->insert($tbl_data);
            $upd1 = DB::table('sms_fees_master')->where('FEES_MASTER_ID',$master_id)->update(array('FEES_STATUS'=>'DONE'));
            if($upd){
                return redirect('admin/fees-reports');
            }
            else{
                return redirect('admin/fees-reports');
            }
            }
        }
    }
    
   public function getClassFess(Request $request){
       $class_id = $request->ClassID;
       
       $data = DB::select("SELECT * FROM sms_fees_type WHERE CLASS_ID = '$class_id' AND FEES_STATUS = 'ACTIVE'");
        return response()->json($data);
   }
}
