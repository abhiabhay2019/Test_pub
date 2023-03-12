<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\ManageEvent;
use Illuminate\Support\Facades\DB;
use Session;

class EventController extends Controller
{
    //
    public function index(Request $request){
        $noticeid = $request->query('eventid');
        
        if($noticeid !='')
        {
          $data =ManageEvent::orderBy('ID','DESC')->paginate(10);
          $edit = ManageEvent::where('ID','=',$noticeid)->get();
        }else{
           $data =ManageEvent::orderBy('ID','DESC')->paginate(10); 
           $edit = array();
        }
        
        return view('admin/manage_events', compact('data','edit')); 
    }
    
    public function addEvent(Request $request){
        $eventid ="";
        $eventid = $request->eventid;
        if($eventid !=""){
            $event = new ManageEvent();
            $event = $event->find($eventid);
        $event->TITLE = $request->noticeTitle;
        $event->DATE = $request->noticeDate;
        $event->MESSAGE = $request->noticeMessage;
        $event->STATUS = $request->noticeStatus;
        
        $event->save();
        }else{
        $validatedData = $request->validate([
         'noticeImg' => 'required|mimes:jpeg,png,jpg,gif'
 
        ]);
        
        $name = $request->file('noticeImg')->getClientOriginalName();
 
        $path = $request->file('noticeImg')->store('public/files');
        
        $event = new ManageEvent();
        
        $event->TITLE = $request->noticeTitle;
        $event->DATE = $request->noticeDate;
        $event->MESSAGE = $request->noticeMessage;
        $event->FILE_NAME = $name;
        $event->FILE_PATH = $path;
        $event->STATUS = $request->noticeStatus;
        
        $event->save();
        }
        
        Session::flash('msg','Event Added successfully');
        
        return redirect('admin/manage-events');
    }
}
