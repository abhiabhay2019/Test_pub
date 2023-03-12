<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use Mail;

class PDFController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        date_default_timezone_set("Asia/Kolkata");
        $sid = $request->query('sid');
        $feesid = $request->query('feesid');
        
        $data = DB::select("SELECT fm.FEES_MASTER_ID, fm.FEES_RECEIPT_NO, fpd.PAYMENT_ID, fpd.RECEIVED_DATE, sd.S_ID, sd.ADMISSION_NO, sd.STUDENT_NAME, sd.S_FATHER_NAME, cm.CLASS_NAME, fm.TOTAL_FEES, fm.RECEIVED_AMT, fm.BALANCE_AMT FROM sms_student_data sd LEFT JOIN sms_fees_master fm ON sd.ADMISSION_NO = fm.STUDENT_ID LEFT JOIN sms_fees_pmt_details fpd ON  fm.FEES_MASTER_ID = fpd.FEES_MASTER_ID LEFT JOIN sms_class_master cm ON fm.CLASS_ID = cm.CLASS_ID WHERE sd.ADMISSION_NO = '$sid' AND fm.FEES_MASTER_ID = '$feesid' GROUP BY  sd.S_ID");
        
        $fees = DB::table('sms_fees_details')->join('sms_fees_type','sms_fees_details.FEES_DETAILS','=','sms_fees_type.FEES_TYPE_ID')->where('sms_fees_details.STUDENT_ID','=',$sid)->where('sms_fees_details.FEES_MASTER_ID','=',$feesid)->get(); 
        
        $pmt = DB::table('sms_fees_pmt_details')->where('FEES_MASTER_ID','=',$feesid)->get();
           //return $data;
           
        $pdf = PDF::loadView('admin/generate_pdf', compact('data','fees','pmt'));

       return $pdf->stream("SID(".$sid.")DT(".date("d-m-Y h:i:s a").").pdf");

       
       // return $pdf->download('tutsmake.pdf');
    }
    
    public function send_mail(Request $req){
        
        date_default_timezone_set("Asia/Kolkata");
        $sid = $req->query('sid');
        $feesid = $req->query('feesid');
        $data = DB::select("SELECT * FROM sms_student_data WHERE ADMISSION_NO = '$sid'");
        
        $page_data = ['sid'=>$sid, 'feesid'=>$feesid];
      
        Mail::send('myfee_report',$page_data,function($message) use ($data){
            $message->to($data[0]->S_EMAIL);
            $message->subject($data[0]->STUDENT_NAME. "   Your Fees Receipt");
            
        });
        
            $result = ['msg'=>'Mail Sent Successfully!'];
            return response()->json($result);
    }
    
    public function send_pending_mail(Request $req){
        date_default_timezone_set("Asia/Kolkata");
        $sid = $req->query('sid');
        $month = $req->query('month');
        
        $data = DB::select("SELECT * FROM sms_student_data WHERE S_ID = '$sid'");
       
        $page_data = ['sname'=>$data[0]->STUDENT_NAME, 'month'=>$month];
        
        $subject = "Payment Reminder For Month Of ". $page_data['month'];
      
        Mail::send('email_pending_fees',$page_data,function($message) use ($data){
            
            $message->to($data[0]->S_EMAIL);
            //$message->subject($subject);
            $message->subject("School Fees Payment Reminder!....");
            
        });
        
        $result = ['msg'=>'Reminder Sent Successfully!'];
            return response()->json($result);
    }
    
    public function send_notice_mail(Request $req){
        date_default_timezone_set("Asia/Kolkata");
        $nid = $req->query('notice_id');
        
        
        $data = DB::select("SELECT * FROM sms_notices WHERE ID = '$nid'");
       
        $page_data = ['body'=>$data[0]->MESSAGE];
        
        $sdata = DB::select("SELECT S_EMAIL, STUDENT_NAME FROM sms_student_data WHERE S_STATUS = 'ACTIVE'");
        
        $details = ['subject'=>'Notice', 'NoticeData'=>$data, 'StudentData'=>$sdata];
        
        $job = (new \App\Jobs\SendQueueEmail($details))->delay(now()->addSeconds(2));
        //print_r($job);
        //return $job;
            dispatch($job);
        $result = ['msg'=>'Reminder Sent Successfully!'];
            return response()->json($result);
    }
}
