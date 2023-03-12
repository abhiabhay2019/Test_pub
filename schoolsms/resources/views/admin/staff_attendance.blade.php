@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')

<!----- add fees form starts !----->

<!-- page content -->
<!-- page content -->
        <div class="right_col" role="main">
<meta name="csrf-token" content="{{ csrf_token() }}" />

    <div class="row">
        <div class="x_panel">
            
        
  @php
  date_default_timezone_set('Asia/Kolkata');
  $y = date('Y');
    $m = date('m');
    if($m < 10){
        $m1 = str_replace("0","",$m);
    }else{
        $m1 = $m;
    }
    $month = date('F', mktime(0, 0, 0, $m, 10));
   
    //months array just like Jan,Feb,Mar,Apr in short format
    $m_array = array('1'=>'Jan', '2'=>'Feb', '3'=>'Mar', '4'=>'Apr', '5'=>'May', '6'=>'Jun', '7'=>'Jul', '8'=>'Aug', '9'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');
    //display months
    $attendance_time1 = '';
    $attendance_time2 = '';
    $current_time = date("H:i");
    if(!empty(Session::get('ATTENDANCE_START_TIME')) && !empty(Session::get('ATTENDANCE_END_TIME'))){
    $attendance_time1 = Session::get('ATTENDANCE_START_TIME');
    $attendance_time2 = Session::get('ATTENDANCE_END_TIME');
    }
    
    $d_array = array('1'=>31, '2'=>28, '3'=>31, '4'=>30, '5'=>31, '6'=>30, '7'=>31, '8'=>31, '9'=>30, '10'=>31, '11'=>30, '12'=>31);
    $d_m = ($m==2 && $y%4==0)?29:$d_array[$m1];
    echo '<div class="x_title">
        <h2 class="text-center">'.$month.' &nbsp;&nbsp; '.$y.'</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="col-md-12 col-sm-12 form-group table-responsive">
<table class="table table-bordered table-striped jambo_table bulk_action">
    <thead>
    <tr>';
    //days array
    $days_array = array('1'=>'Mon', '2'=>'Tue', '3'=>'Wed', '4'=>'Thu', '5'=>'Fri', '6'=>'Sat', '7'=>'Sun');
    //display days
    foreach ($days_array as $key=>$val){
        echo '<th>'.$val.'</th>';      
    }
    echo "</tr>
    </thead>
    <tbody><tr>";
    $date = $y.'-'.$m.'-01';
    //find start day of the month
    $startday = array_search(date('D',strtotime($date)), $days_array);
    $curr_day = date("d");
    //daisplay month dates
    for($i=0; $i<($d_m+$startday); $i++){
        $day = ($i-$startday+1<=9)?'0'.($i-$startday+1):$i-$startday+1;
        if($day == $curr_day){
        
        if(Session::get('IS_ADMIN') == 1 || Session::get('IS_ADMIN') == '1'){
        echo ($i<$startday)?'<td></td>':'<td class="add-event" id="event'.$day.'" onclick="mark_attendance('.$day.')" style="background-color: lightgreen;">'.$day.'</td>';
        }else{
        if($current_time>$attendance_time1 && $current_time<$attendance_time2){
        echo ($i<$startday)?'<td></td>':'<td class="add-event" id="event'.$day.'" onclick="mark_attendance('.$day.')" style="background-color: lightgreen;">'.$day.'</td>';
            }else{
            echo ($i<$startday)?'<td></td>':'<td class="add-event" id="event'.$day.'">'.$day.'</td>';
            }
        }
        
        }else{
        echo ($i<$startday)?'<td></td>':'<td class="add-event">'.$day.'</td>';
        }
        echo ($i%7==0)?'</tr>':''; 
    }
    //calculate next & prev month
    $next_y=(($m+1)>12)?($y+1):$y;
    $next_m=(($m+1)>12)?1:($m+1);
    $prev_y=(($m-1)<=0)?($y-1):$y;
    $prev_m=(($m-1)<=0)?12:($m-1);
    
    //daisplay next prev
    
  @endphp
</tbody>
</table>
            </div>
        </div>
    </div>
</div>
    </div>
        </div>
        <!-- /page content -->
        
        
        <!----------- modal to add attendance !---------------->

<!-- Modal -->
<div id="addAttendance" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Add Attendance</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
          @csrf
        <div class="row form-group">
            <div class="col-sm-12">
                <label>Select Staff</label>
            <select name="select_staff" id="select_staff" class="form-control" required ="">
                <option value="">Select Staff</option>
            </select>
            <span id="staff_error"></span>
            </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-6">
                    <label>Present</label>
                    <input type="radio" name="attendance" id="present" value="1">
                </div>
                <div class="col-sm-6">
                    <label>Absent/On Leave</label>
                    <input type="radio" name="attendance" id="absent" value="0">
                </div>
                <span id="radio_error"></span>
            </div>
            <div class="row form-group">
                 <div class="col-sm-12">
                     <label>Leave Remark</label>
                     <input type="text" name="leave_remark" id="leave_remark" class="form-control"/>
                     <span id="leave_error"></span>
                 </div>
            </div>
            
            <div class="row form-group">
                 <div class="col-sm-12">
                     <button name="add_attendance" id="add_attendance" class="btn classic-btn btn-sm" onclick="validate()">Add Attendance</button>
                 </div>
            </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
      
    </div>

  </div>
</div>

        @include('admin/footer1')
        
        @include('admin/bottom_link')

<script>
$(document).ready(function(){
    $(".alert-info").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-info").slideUp(500);
});
})
function mark_attendance(attendance_day){
    get_staff();
    
    $("#addAttendance").modal("show");
}

function get_staff(){
    $.ajax({
        url:'get_staff',
        data:'get_staff=true&staff_data=sms_staff_data',
        dataType:'Json',
        success:function(res){
           // alert(res);
           if(res.length == 0){
               
           }else{
               for(var i = 0; i < res.length; i++){
                   $("#select_staff").append("<option value="+res[i].STAFF_ID+">"+res[i].STAFF_NAME+"</option>");
               }
           }
        }
    })
}

function validate(){
    var staff_id = $('#select_staff option:selected').val();
    var leave_remark = $("#leave_remark").val();
    var atten = '';
    var atten1 = 0;
    var error_msg = '';
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    if($("#present").is(":checked")){
        atten = 'Present';
        atten1 = 1;
    }
    if($("#absent").is(":checked")){
        atten = 'Absent';
        atten1 = 0;
    }
    
    if(staff_id == ''){
        error_msg = 'Please Select Staff!....';
        $("#staff_error").html(error_msg);
       
    }else{$("#staff_error").html('');}
    if(atten == ''){
        error_msg = 'Please Check Attendance Type!....';
        $("#radio_error").html(error_msg);
    }else{$("#radio_error").html('');}
    
    if(atten == 'Absent' && leave_remark ==''){
        error_msg = 'Please Enter Leave Reason!....';
        $("#leave_error").html(error_msg);
    }else{$("#leave_error").html('');}
    
    if(error_msg == ''){
        $.ajax({
            url:'mark_attendance',
            data:{_token:CSRF_TOKEN,'attendance':atten1,'select_staff':staff_id,'leave_remark':leave_remark},
            dataType:'Json',
            type:'post',
            success:function(res){
                alert(res.msg);
                window.open('staff-attendance','_self');
            }
        })
    }
}
</script>