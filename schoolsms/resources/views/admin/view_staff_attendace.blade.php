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
@php
use App\Http\Controllers\StaffAttendanceController;
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}" />

    <div class="row text-center form-group">
        <div class="col-sm-2">
            <label>Select Year</label>
        <select name="year_name" id='year_name' class="form-control">
           <!--<option value="">Select year</option>-->
           @php
           echo '<option value="'.date("Y").'">'.date("Y").'</option>';
           for($i=1; $i <= 3; $i++){
           $nextyear = date("Y")-$i;
           echo '<option value="'.$nextyear.'">'.$nextyear.'</option>';
           }
           @endphp
        </select>
        </div>
        <div class="col-sm-2">
            <label>Select Month</label>
        <select name="month_name" id='month_name' class="form-control">
            @php
            echo "<option value=".date('m').">".date('M')."</option>";
            @endphp
           
           <option value="01">Jan</option>
           <option value="02">Feb</option>
           <option value="03">Mar</option>
           <option value="04">Apr</option>
           <option value="05">May</option>
           <option value="06">Jun</option>
           <option value="07">Jul</option>
           <option value="08">Aug</option>
           <option value="09">Sep</option>
           <option value="10">Oct</option>
           <option value="11">Nov</option>
           <option value="12">Dec</option>
        </select>
        </div>
        <div class="col-sm-2">
            <label>Select Staff</label>
        <select name="staff_name" id='staff_name' class="form-control">
           <option value="">Select Staff</option>
           
        </select>
        </div>
       <div class="col-sm-2">
            
            <button name="search_attendance" id="search_attendance" value="Search Attendance" class="btn classic-btn btn-sm" style="margin-top: 25px;" onclick="get_attendance()">Search Attendance</button>
        </div>
    </div>
    <!--- attendace table code goes bellow !----->
    
    <div class="row form-group">
        <div class="col-md-12 col-sm-12 form-group table-responsive">
        <table class="table table-bordered table-striped jambo_table bulk_action" id="attedance_tbl">
            <thead>
                <tr>
                    <th>Staff Name</th>
                    <th>Presen Count</th>
                    <th>Absent Count</th>
                </tr>
            </thead>
            <tbody>
                <!--- data will add dynamically !-->
            </tbody>
        </table>
        </div>
    </div>
    
</div>
</div>

        @include('admin/footer1')
        
        @include('admin/bottom_link')
<script>
$(document).ready(function(){
    get_staff();
    get_attendance();
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
                   $("#staff_name").append("<option value="+res[i].STAFF_ID+">"+res[i].STAFF_NAME+"</option>");
               }
           }
        }
    })
}

function get_attendance(){
    var year_name = $("#year_name option:selected").val();
    var month_name = $("#month_name option:selected").val();
    var staff_name = $("#staff_name option:selected").val();
    var url = '';
    
    if(year_name !='' && month_name !='' && staff_name ==''){
    url = "attendance_report?year_name="+year_name+"&month_name="+month_name;
    }
    if(year_name !='' && month_name !='' && staff_name !=''){
    url = "attendance_report?year_name="+year_name+"&month_name="+month_name+"&staff_name="+staff_name;
    }
    
    $.ajax({
        url:url,
        data:'',
        dataType:'Json',
        success:function(res){
            if(res.length == 0){
                $("#attedance_tbl tbody").html("No Record found");
            }else{
                var present = 0;
                var absent = 0;
                var tbl_data = "";
                for(var i = 0; i < res.length; i++){
                    tbl_data +='<tr>';
                    tbl_data +='<td>'+res[i].STAFF_NAME+'</td>';
                    tbl_data +='<td><a href="javascript:void(0)" onclick="check_attendance('+res[i].STAFF_ID+',\'PRESENT\')">'+res[i].PRESENT+'</a></td>';
                    tbl_data +='<td><a href="javascript:void(0)" onclick="check_attendance('+res[i].STAFF_ID+',\'ABSENT\')">'+res[i].ABSENT+'</a></td>';
                    tbl_data +='<tr>';
                }
                 $("#attedance_tbl tbody").html(tbl_data);
            }
        }
    })
}
</script>