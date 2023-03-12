<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManageRole;
use Illuminate\Support\Facades\DB;
use Session;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $roles = DB::select("SELECT * FROM sms_role_master WHERE ROLE_STATUS = 'ACTIVE' ORDER BY ROLE_NAME ASC");
        $head = DB::select("SELECT * FROM sms_head_setup WHERE HEAD_STATUS = 'ACTIVE' ORDER BY HEAD_POSITION ASC");
        return view('admin/manage_user', compact('roles', 'head')); 
    }
    
}

?>