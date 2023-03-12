<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageRole;
use Illuminate\Support\Facades\DB;
use Session;

class RoleController extends Controller
{
    //
    public function index(Request $request){
        
        return view('admin/manage-role'); 
    }
    
    public function manage_role(Request $req){
        $rid = $req->rid;
        $uid = new CustomCode();
        $id = $uid->CreateId();
        $rname = $req->rName;
        $rstatus = $req->rStatus;
        if($rid == ''){
            $arr=array("ROLE_ID"=>$id,
                        "ROLE_NAME"=>$rname,
                        "ROLE_STATUS"=>$rstatus);
            $data = DB::table('sms_role_master')->insert($arr);
            $msg = array('msg'=>'Role Created Successfully');
        }
        if($rid != ''){
            
            $data = DB::statement("UPDATE sms_role_master SET ROLE_NAME = '$rname', ROLE_STATUS = '$rstatus' WHERE ROLE_ID = '$rid'");
            $msg = array('msg'=>'Role Updated Successfully');
        }
        return response()->json($msg); 
    }
    
    public function getAllRole(Request $request){
        if(isset($request->roleid) && $request->roleid !=''){
            $rid = $request->roleid;
            $result = DB::select("SELECT * FROM sms_role_master WHERE ROLE_ID = '$rid'");
        }else{
        $result = DB::select("SELECT * FROM sms_role_master");
        }
        return response()->json($result);
    }
    
    public function update_access_list(Request $req ){
        
        $access_data = explode(",",$req->access_data);
       
       for($i = 0; $i < count($access_data); $i++){
           if($i%2 == 0){
                $uid = new CustomCode();
                $id = $uid->CreateId();
               $data = array("ACCESS_ID"=>$id,
                             "ROLE_ID"=>$req->role_id,
                             "HEAD_ID"=>$access_data[$i],
                             "STATUS"=>$req->access_status);
                DB::table('sms_user_access_control')->insert($data);
           }
       }
       $msg = array('msg'=>'Access Control Updated Successfully');
       return response()->json($msg);
    }
    
    public function getAllControl(Request $req){
        $data = DB::select("SELECT uac.ACCESS_ID, uac.ROLE_ID, uac.HEAD_ID, rm.ROLE_NAME, hs.HEAD_NAME FROM sms_user_access_control uac INNER JOIN sms_role_master rm ON uac.ROLE_ID = rm.ROLE_ID INNER JOIN sms_head_setup hs ON uac.HEAD_ID = hs.HEAD_ID WHERE uac.STATUS = 'ACTIVE' ORDER BY rm.ROLE_NAME");
        
        return response()->json($data);
    }
}
