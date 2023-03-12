<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassManage;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    //
    /*public function index(Request $request){
        
        return view('admin/pages'); 
    }*/
    
    public function manageClass(Request $request){
        /*return $request->post();
        exit();*/
        date_default_timezone_set('Asia/Kolkata');
        
        if($request->cid == 0){
            $cmanage = new ClassManage();
        }else{
           $cmanage = ClassManage::find($request->cid); 
        }
        
        $cmanage->CLASS_NAME = $request->cName;
        $cmanage->CLASS_STATUS = $request->cStatus;
        $cmanage->CREATED_DATE = date("Y-m-d");
        $cmanage->save();
        
        if($request->cid == 0){
            $msg = array('msg'=>'Class Added Successfully');
        }else{
            $msg = array('msg'=>'Class Updated Successfully');
        }
        
        return response()->json($msg);
    }
    
    function getClass(Request $request){
        //return $request->query('GetClassList');GetActive
        
        $GetClassList = $request->query('GetClassList');
        $ClassId = $request->query('ClassId');
        $GetActive = $request->query('GetActive');
        
        if(isset($GetClassList)){
            $result = DB::table('sms_class_master')
                    ->get();
        }
        if(isset($ClassId))
        {
            $result = DB::table('sms_class_master')
                    ->where('CLASS_ID','=',$request->query('ClassId'))
                    ->get();
        }
        
        if(isset($GetActive))
        {
            $result = DB::table('sms_class_master')
                    ->where('CLASS_STATUS','=','ACTIVE')
                    ->get();
        }
        
        return response()->json($result);
    }
}
