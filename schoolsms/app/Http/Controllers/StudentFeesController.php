<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\ManageEvent;
use Illuminate\Support\Facades\DB;
use Session;

class StudentFeesController extends Controller
{
    //
    public function index(Request $request){
        /*$noticeid = $request->query('eventid');
        
        if($noticeid !='')
        {
          $data =ManageEvent::orderBy('ID','DESC')->paginate(10);
          $edit = ManageEvent::where('ID','=',$noticeid)->get();
        }else{
           $data =ManageEvent::orderBy('ID','DESC')->paginate(10); 
           $edit = array();
        }*/
        //, compact('data','edit')
        return view('admin/student_wise_fees'); 
    }
    
    public function get_student_wise(Request $req){
        $fees_year = $req->fees_year;
        $sid = $req->adm_number;
        
        $sdata = DB::table('sms_student_data')->where('ADMISSION_NO','=',$sid)->get();
        
        $fdata = array();
        $fees_arr = array();
        $month_arr = array();
        for($i = 1; $i < 13; $i++){
                $j=$i-1;
                $month = date('M', mktime(0, 0, 0, $i, 10));
            array_push($month_arr,$month);   
                }
                
        for($i=0; $i < count($month_arr); $i++){
            
            $data = DB::select("SELECT fd.FEES_MONTHS, fd.FEES_DATE, SUM(fd.FEES_AMT) AS TOTAL, fm.FEES_STATUS, fm.FEES_MASTER_ID, fm.STUDENT_ID FROM sms_fees_details fd LEFT JOIN sms_fees_master fm ON fd.FEES_MASTER_ID = fm.FEES_MASTER_ID WHERE fd.STUDENT_ID = '$sid' AND fd.FEES_YEAR = '$fees_year' AND fd.FEES_MONTHS = '$month_arr[$i]'");
            array_push($fdata,['fees'=>$data, 'year'=>$fees_year, 'month'=>$month_arr[$i]]);
        }
        
        for($i=0; $i < count($fdata); $i++){
            for($j=0; $j < count($fdata[$i]['fees']); $j++){
                if(isset($fdata[$i]['fees'][$j]->FEES_DATE) && $fdata[$i]['fees'][$j]->FEES_DATE !=''){
                  $fdate = date("d-m-Y", strtotime($fdata[$i]['fees'][$j]->FEES_DATE));
                }else{
                   $fdate = ""; 
                }
        array_push($fees_arr,['year'=>$fdata[$i]['year'],
                            'month'=>$fdata[$i]['month'],
                            'student_id'=>$sid,
                            'status'=>$fdata[$i]['fees'][$j]->FEES_STATUS,
                            'amount'=>$fdata[$i]['fees'][$j]->TOTAL,
                            'fmid'=>$fdata[$i]['fees'][$j]->FEES_MASTER_ID,
                            'sid'=>$fdata[$i]['fees'][$j]->STUDENT_ID,
                            'fdate'=>$fdate,
                                ]);
            }
        }
        /*echo "<pre>";
        print_r($fdata);
        exit;
        echo "<pre>";
        print_r($fees_arr);
        */
        
        return view('admin/student_wise_fees', compact('sdata','fees_arr'));
    }
}
