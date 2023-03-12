<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\ManageNotice;
use Illuminate\Support\Facades\DB;
use Session;

class NoticeController extends Controller
{
    //
    public function index(Request $request){
        $noticeid = $request->query('noticeid');
        
        if($noticeid !='')
        {
          $data =ManageNotice::where('STATUS','=','Active')->orderBy('ID','DESC')->paginate(10);
          $edit = ManageNotice::where('ID','=',$noticeid)->get();
        }else{
           $data =ManageNotice::where('STATUS','=','Active')->orderBy('ID','DESC')->paginate(10); 
           $edit = array();
        }
        
        return view('admin/manage_notice', compact('data','edit')); 
    }
    
    public function addNotice(Request $request){
        
       $noticeid ="";
        
        if(isset($request->noticeid) && $request->noticeid !=""){
            $noticeid = $request->noticeid;
        }
        
        if($noticeid !=""){
            
            $notice = new ManageNotice();
            $notices = $notice->find($noticeid);
            
            $notices->TITLE = $request->noticeTitle;
        $notices->DATE = $request->noticeDate;
        $notices->MESSAGE = $request->noticeMessage;
        $notices->STATUS = $request->noticeStatus;
        $notices->save();
        }else{
            $notice = new ManageNotice();
            if(isset($request->noticeImg)){
             $validatedData = $request->validate([
         'noticeImg' => 'required|mimes:jpeg,png,jpg,gif'
 
        ]);
        
            
            $name = $request->file('noticeImg')->getClientOriginalName();
 
        $path = $request->file('noticeImg')->store('public/files');
            }else{
                $name = '';
                $path = '';
            }
        
        $notice->TITLE = $request->noticeTitle;
        $notice->DATE = $request->noticeDate;
        $notice->MESSAGE = $request->noticeMessage;
        $notice->FILE_NAME = $name;
        $notice->FILE_PATH = $path;
        $notice->STATUS = $request->noticeStatus;
        $notice->save();
        }
        
        
        
        Session::flash('msg','Notice Added successfully');
        
        return redirect('admin/manage-notices');
    }
}
