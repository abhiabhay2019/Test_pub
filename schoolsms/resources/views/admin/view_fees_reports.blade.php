@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')

@php
$ftype = "";
$sroll = "";
$smobile = "";
$qryDate1 = "";
$qryDate2 = "";

if(isset($_POST['feestype'])){
$ftype = $_POST['feestype'];
}
@endphp


<!-- page content -->
        <div class="right_col" role="main">
    <div class="row form-group">
        <form action="{{url('admin/fees-reports')}}" method="post" onsubmit="return check_form();">
            @csrf
            <div class="col-sm-2">
            <label>Select Fees Type</label>
        <select name="feestype" id="feestype" class="form-control">
            @php
            if($ftype==''){
            @endphp
            <option value="">All</option>
            @php }else{ @endphp
            <option value="@php echo $ftype; @endphp">@php echo $ftype; @endphp</option>
            @php } @endphp
            <option value="Paid">Paid</option>
            <option value="Partial Paid">Partial Paid</option>
            <option value="Due">Due</option>
        </select>    
            </div>
        <div class="col-sm-2">
        <label>Student Roll</label>
        <input type="number" name="sroll" id="sroll" class="form-control"/>
        </div>
        <div class="col-sm-2">
        <label>Student Mobile</label>
        <input type="number" name="mobile" id="mobile" class="form-control"/>
        </div>
        <div class="col-sm-2">
            &nbsp;
        <input type="date" name="queryDate1" id="queryDate1" class="form-control"/>
        </div>
        <div class="col-sm-2">
            &nbsp;
        <input type="date" name="queryDate2" id="queryDate2" class="form-control"/>
        </div>
        <div class="col-sm-2">
            <br/>
        <input type="submit" name="search_fees" id="search_fees" class="btn classic-btn btn-sm" value="Show Fees"/>
        <a href="{{url('admin/fees-reports')}}" class="btn btn-danger btn-sm">Clear Search</a>
        
        </div>
        
        </form>
    </div>
    
    <!------- table row start !-------->
    <div class="row">
        <div class="col-md-12 col-sm-12 table-responsive form-group">
        <table id="feesTable" class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th>Sl</th>
                    <th>Fees_Date</th>
                    <th>Admission No</th>
                    <th>Receipt No</th>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Total Fees</th>
                    <th>Received Amt</th>
                    <th>Balance Amt</th>
                    <th>Fees Structure</th>
                    <th colspan="5">Action</th>
                </tr>
            </thead>
            <tbody class="page-data">
                 @if(!empty($data) && $data->count())
                 
   @foreach($data as $key=>$std)
                          <tr>
                      <td>{{ ++$key }}</td>
                       
                      <td>@php echo date("d-m-Y", strtotime($std->RECEIVED_DATE)); @endphp</td>
                      <td>{{ $std->STUDENT_ID }}</td>
                      <td>{{ $std->FEES_RECEIPT_NO }}</td>
                      <td>{{ $std->STUDENT_NAME }}</td>
                      <td>{{ $std->CLASS_NAME }}</td>
                      <td>{{ $std->TOTAL_FEES }}</td>
                      <td>{{ $std->RECEIVED_AMT }}</td>
                      <td>{{ $std->BALANCE_AMT }}</td>
                      
                      <td><a href='javascript:void(0)' class='btn classic-btn btn-sm' onclick="window.open('{{url('admin/fees-structure')}}?fees_id={{$std->FEES_MASTER_ID}}','targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=750,height=450,top=100,left=100')">Fees Structure</a></td>
                      <td><a href="{{url('admin/edit-fees')}}?fees_id={{$std->FEES_MASTER_ID}}" class='btn classic-btn1 btn-sm'>Edit Fees</a></td>
                      <td><a href='{{url("/admin")}}/create-pdf-file?sid={{$std->STUDENT_ID}}&feesid={{$std->FEES_MASTER_ID}}' class='btn classic-btn btn-sm' target='_blank'>Print Fees</a></td>
                      <td><a href='javascript:void(0)' class='btn classic-btn1 btn-sm' onclick="send_fees('{{$std->STUDENT_ID}}','{{$std->FEES_MASTER_ID}}')">Email Fees</a></td>
                      
                      <td><a href='javascript:void(0)' class='btn classic-btn btn-sm'>Send SMS</a></td>
                      @if($std->FEES_STATUS =='' || $std->FEES_STATUS =='PENDING')
                      <td><a href='javascript:void(0)' class='btn classic-btn1 btn-sm' onclick="update_status('{{$std->STUDENT_ID}}','{{$std->FEES_MASTER_ID}}')">Update Status</a></td>
                      @else
                      <td><a href='javascript:void(0)' class='btn classic-btn btn-sm'>{{$std->FEES_STATUS}}</a></td>
                      @endif
                      </tr>
    @endforeach
 @else
 <tr>
 <td colspan="4">No data found.</td>
 </tr>
 @endif
            </tbody>
        </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <a href="javascript:void(0)" class="btn btn-warning btn-sm">Export To Excel</a>
        </div>
        <div class="col-sm-offset-8 col-sm-2">
            {!! $data->links() !!}
        </div>
    </div>
</div>

<!---------- modal to update fees status -----!----->
<!-- Modal -->
<div id="up_status" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Fees Status</h4>
      </div>
      <div class="modal-body">
          <form action="{{url('/admin')}}/update_fees_status">
              <input type="hidden" name="master_id" id="master_id" value=""/>
              <input type="hidden" name="student_id" id="student_id" value=""/>
              <input type="hidden" name="class_id" id="class_id" value=""/>
       <div class="row form-group" style="padding: 10px;">
           <label>Fees Year</label>
            <select name="year" id="year" class="form-control">
               <option value="">Select</option>
                @php for($i=2; $i >= 1; $i--){@endphp
               <option value="@php echo date('Y')-$i @endphp">@php echo date('Y')-$i @endphp</option>
               @php
               }
               @endphp
               <option value="@php echo date('Y') @endphp">@php echo date('Y') @endphp</option>
               @php for($j=1; $j < 3; $j++){@endphp
               <option value="@php echo date('Y')+$j @endphp">@php echo date('Y')+$j @endphp</option>
               @php
               }
               @endphp
            </select>
            
            <label>Fees Months</label>
            <select name="months" id="months" class="form-control">
               <option value="">Select</option>
               @php for($i=2; $i<14; $i++){@endphp
               <option value="@php echo date('M', mktime(0,0,0,$i,0,0)) @endphp">@php echo date('M', mktime(0,0,0,$i,0,0)) @endphp</option>
               @php
               }
               @endphp
            </select>
            
       </div>
       <input type="submit" name="update_fees" id="update_fees" value="Update Fees" class="btn classic-btn btn-sm"/>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        </div>
        <!-- /page content -->
        
        @include('admin/footer1')
        
        @include('admin/bottom_link')
<script>
function check_form(){
    var feestype = $("#feestype option:selected").val();
    var sroll = $("#sroll").val();
    var mobile = $("#mobile").val();
    var queryDate1 = $("#queryDate1").val();
    var queryDate2 = $("#queryDate2").val();
    
    if(feestype =='' && sroll == '' && mobile == '' && queryDate1 == '' && queryDate2 == '')
    {
    return false;
    }else{
        return true;
    }
}

function send_fees(sid, feesid){
    $.ajax({
        url:'send_mail',
        data:'sendMail=sendMail&sid='+sid+'&feesid='+feesid,
        dataType:'Json',
        success:function(data){
            alert(data.msg)
        }
    })
}

function update_status(sid, feesid){
    $.ajax({
        url:'update_fees_status',
        data:'updateStatus=updateStatus&sid='+sid+'&feesid='+feesid,
        dataType:'Json',
        success:function(data){
            //alert(data)
            if(data.length !=0){
                var datas = data[0];
                $("#master_id").val(datas.FEES_MASTER_ID)
                $("#student_id").val(datas.STUDENT_ID)
                $("#class_id").val(datas.CLASS_ID)
                $('#up_status').modal('show');
            }
        }
    })
}
</script>