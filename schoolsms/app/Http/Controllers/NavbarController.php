<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CustomCode;
use Session;

class NavbarController extends Controller
{
    //
    public function index(Request $request){
        $uid = new CustomCode();
        $id = $uid->CreateId();
       // echo $id;
        return view('admin/d'); 
    }
    
    public function manage_header(Request $req){
         $uid = new CustomCode();
        $id = $uid->CreateId();
        //echo $id;
        $data = DB::select("SELECT * FROM sms_head_setup WHERE HEAD_STATUS = 'ACTIVE' ORDER BY HEAD_POSITION ASC");
        $lists = DB::table('sms_navbar_setup')->where('SUB_HEAD_STATUS', '=', 'ACTIVE')->paginate(10);
        //return $lists;
        return view('admin/manage_header', compact('data', 'lists'));
    }
    
    public function add_header(Request $req){
        $uid = new CustomCode();
        $id = $uid->CreateId();
        $sub_header_id = '';
        if(isset($req->sub_header_id) && $req->sub_header_id !=''){
        $sub_header_id = $req->sub_header_id;
        }
        $head_id = $req->head_id;
        $subhead_name = ucwords($req->subhead_name);
        $subhead_pos = $req->subhead_pos;
        $subhead_link = $req->subhead_link;
        $head_class = $req->head_class;
        $sub_head_class = $req->sub_head_class;
        $sub_head_status = $req->sub_head_status;
        $head = DB::select("SELECT HEAD_NAME FROM sms_head_setup WHERE HEAD_ID = '$head_id'");
   $head_name =  $head[0]->HEAD_NAME;
        if($sub_header_id ==''){
        $data=array("LINK_ID"=>$id,
                    "HEAD_ID"=>$head_id,
                    "HEAD_NAME"=>$head_name,
                    "SUB_HEAD_NAME"=>$subhead_name,
                    "SUB_HEAD_SEQ"=>$subhead_pos,
                    "SUB_HEAD_LINK"=>$subhead_link,
                    "HEAD_CLASS"=>$head_class,
                    "SUB_HEAD_CLASS"=>$sub_head_class,
                    "SUB_HEAD_STATUS"=>$sub_head_status
                    );
       $result = DB::table('sms_navbar_setup')->insert($data);
       Session::flash('message', 'Link Created Successfully!');
        }else{
            
            $result = DB::statement("UPDATE sms_navbar_setup SET HEAD_ID = '$head_id', HEAD_NAME = '$head_name', SUB_HEAD_NAME = '$subhead_name', SUB_HEAD_SEQ = '$subhead_pos', SUB_HEAD_LINK = '$subhead_link', HEAD_CLASS = '$head_class', SUB_HEAD_CLASS = '$sub_head_class', SUB_HEAD_STATUS = '$sub_head_status' WHERE LINK_ID = '$sub_header_id'");
            Session::flash('message', 'Link Updated Successfully!');
        }
        
         
        return redirect('admin/manage-header');
    }
    
   public function get_header(Request $req){
        //$data = DB::select("SELECT * FROM sms_navbar_setup WHERE SUB_HEAD_STATUS = 'ACTIVE' ORDER BY HEAD_NAME ASC");
       
        return response()->json($data);
    }
    
    public function get_header_list(Request $req){
        $role_id = $req->role_id;
        if($role_id == 'ADMIN'){
        $data = DB::select("SELECT * FROM sms_head_setup WHERE HEAD_STATUS = 'ACTIVE' ORDER BY HEAD_POSITION ASC");
        }else{
          $data = DB::select("SELECT * FROM sms_head_setup hs INNER JOIN sms_user_access_control uac ON hs.HEAD_ID = uac.HEAD_ID WHERE hs.HEAD_STATUS = 'ACTIVE' AND uac.ROLE_ID = '$role_id' ORDER BY hs.HEAD_POSITION ASC");  
        }
        
        return response()->json($data);
    }
    
    public function get_subhead_list(Request $req){
        $head_id = '';
        $data = array();
        if($req->query('head_id') !=''){
            $head_id = $req->query('head_id');
        $data = DB::select("SELECT * FROM sms_navbar_setup WHERE SUB_HEAD_STATUS = 'ACTIVE' AND HEAD_ID = '$head_id' ORDER BY SUB_HEAD_NAME ASC");
        }
        if($req->query('link_id') !=''){
            $linkid = $req->query('link_id');
        $data = DB::select("SELECT * FROM sms_navbar_setup ns INNER JOIN sms_head_setup hs ON ns.HEAD_ID = hs.HEAD_ID WHERE ns.SUB_HEAD_STATUS = 'ACTIVE' AND ns.LINK_ID = '$linkid'");   
        }
        
        return response()->json($data);
    }
    
    public function get_current_url(Request $req){
        $url_name = '';
        $data = array();
        if($req->query('url_name') !==''){
            $url_name = $req->query('url_name');
            
        $data = DB::select("SELECT * FROM sms_navbar_setup WHERE SUB_HEAD_STATUS = 'ACTIVE' AND SUB_HEAD_LINK = '$url_name' ORDER BY SUB_HEAD_NAME ASC");
        }
        
        return response()->json($data);
    }
}
