<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\ManageRoutine;
use Illuminate\Support\Facades\DB;
use Session;

class RoutineController extends Controller
{
    //
   public function time_index(Request $request){
       $timeid="";
       $timeid = $request->query('timeid');
        
        if($timeid !='')
        {
          $data =DB::table('sms_class_time')->orderBy('TIME_ID','DESC')->paginate(10);
          $edit = DB::table('sms_class_time')->where('TIME_ID','=',$timeid)->get();
        }else{
           $data =DB::table('sms_class_time')->orderBy('TIME_ID','DESC')->paginate(10); 
           $edit = array();
        }
        
        return view('admin/manage_routine_time', compact('data','edit')); 
   }
   
   public function manage_time(Request $request){
       $timeid="";
       if(isset($request->timeid) && $request->timeid !=""){
           DB::table('sms_class_time')->where(['TIME_ID'=>$request->timeid])->update(['START_TIME'=>$request->startTime, 'END_TIME'=>$request->endTime, 'STATUS'=>$request->timeStatus]);
       }else{
           DB::table('sms_class_time')->insert(['START_TIME'=>$request->startTime,'END_TIME'=>$request->endTime,'STATUS'=>$request->timeStatus]);
       }
       
       Session::flash('msg','Routine Added & Updated successfully');
        
        return redirect('admin/time-master');
   }
   
   /*=============== manage day =====================*/
   public function day_index(Request $request){
       $dayid="";
       $dayid = $request->query('dayid');
        
        if($dayid !='')
        {
          $data =DB::table('sms_class_day')->orderBy('DAY_ID','DESC')->paginate(10);
          $edit = DB::table('sms_class_day')->where('DAY_ID','=',$dayid)->get();
        }else{
           $data =DB::table('sms_class_day')->orderBy('DAY_ID','DESC')->paginate(10); 
           $edit = array();
        }
        
        return view('admin/manage_routine_day', compact('data','edit'));
   }
   
   public function manage_day(Request $request){
       $dayid="";
       if(isset($request->dayid) && $request->dayid !=""){
           DB::table('sms_class_day')->where(['DAY_ID'=>$request->dayid])->update(['DAY_NAME'=>$request->dayName]);
       }else{
           DB::table('sms_class_day')->insert(['DAY_NAME'=>$request->dayName]);
       }
       
       Session::flash('msg','Routine Added & Updated successfully');
        
        return redirect('admin/day-master');
   }
   
   /*=============== manage routine ==================*/
   
   public function routine_index(Request $request){
       
       $hrs = DB::table('sms_class_time')->where('STATUS','=','ACTIVE')->orderBy('TIME_ID','ASC')->get();
       
       $day = DB::table('sms_class_day')->orderBy('DAY_ID','ASC')->get();
       
       return view('admin/manage_class_routine', compact('hrs', 'day'));
   }
   
   /*====================== add routine for class ====================*/
   public function add_routine(Request $request){
       
       $period_id = "";
       $day_name = "";
       $class_id = "";
       $subject_name = "";
       $routine_id ="";
       $status = "Active";
       $add_sub = "";
       if(isset($request->period_id) && $request->period_id !=null)
       {
          $period_id = $request->period_id;
       }
       if(isset($request->day_name) && $request->day_name !=null)
       {
          $day_name = $request->day_name;
       }
       if(isset($request->class_id) && $request->class_id !=null)
       {
          $class_id = $request->class_id;
       }
       if(isset($request->subject_name) && $request->subject_name !=null)
       {
          $subject_name = $request->subject_name;
       }
       if($period_id !='' && $day_name !='' && $class_id !='' && $subject_name !='')
       {
           if($routine_id == ""){
               $routine = new ManageRoutine();
               $routine->CLASS_ID = $class_id;
               $routine->TIME_ID = $period_id;
               $routine->DAY_NAME = $day_name;
               $routine->SUBJECT_NAME = ucwords($subject_name);
               $routine->STATUS = "Active";
               $routine->save();
               $msg = "Routine Added Successfully";
           }else{
               $routine = new ManageRoutine();
               $routine->find($routine_id);
               $routine->CLASS_ID = $class_id;
               $routine->TIME_ID = $period_id;
               $routine->DAY_NAME = $day_name;
               $routine->SUBJECT_NAME = ucwords($subject_name);
               $routine->STATUS = $status;
               $routine->save();
               $msg = "Routine Updated Successfully";
           }
           
           Session::flash('msg',$msg);
       }
       
       return redirect('admin/routine-master');
   }
   
   public function class_wise_routine(Request $request){
       
       $class_id = "";
       
       if(isset($request->selectClass1) && $request->selectClass1 !=null)
       {
           $class_id = $request->selectClass1;
       }
       
       if($class_id == ""){
           
           $hrs = DB::table('sms_class_time')->where('STATUS','=','ACTIVE')->orderBy('TIME_ID','ASC')->get();
       
       $day = DB::table('sms_class_day')->orderBy('DAY_ID','ASC')->get();
       
       $routine = DB::table('sms_class_day')->join('sms_class_routine','sms_class_day.DAY_NAME','=','sms_class_routine.DAY_NAME')->where('sms_class_routine.CLASS_ID','=',$class_id)->orderBy('DAY_ID','ASC')->get();
       
       
       }else{
          $hrs = DB::table('sms_class_time')->where('STATUS','=','ACTIVE')->orderBy('TIME_ID','ASC')->get();
       
       $day = DB::table('sms_class_day')->orderBy('DAY_ID','ASC')->get();
       
       $routine = DB::table('sms_class_day')->join('sms_class_routine','sms_class_day.DAY_NAME','=','sms_class_routine.DAY_NAME')->join('sms_class_time','sms_class_time.TIME_ID','=','sms_class_routine.TIME_ID')->where('sms_class_routine.CLASS_ID','=',$class_id)->orderBy('sms_class_time.TIME_ID','ASC')->get();
       
        
       }
       
       return view('admin/view_class_routine', compact('hrs', 'day', 'routine'));
   }
}
