@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
        

        <!-- page content -->
        <div class="right_col" role="main">

<div class="container-fluid text-center">
    <label>Admission No</label>&nbsp;
    <input type="number" name="sid" id="sid" onkeyup="getStudent(this.value)"/>&nbsp;&nbsp;
    <label>Student Name</label>&nbsp;
    <input type="text" name="sname" id="sname" onkeyup="getStudent(this.value)"/>&nbsp;&nbsp;
    <label>Register Mobile</label>&nbsp;
    <input type="number" name="fmobile" id="fmobile" onkeyup="getStudent(this.value)"/>&nbsp;&nbsp;
</div>
<div class="container-fluid text-center table-responsive">
    <table id="stdtbl" class="table table-bordered table-striped">
        <tbody>
            <!----- data will come dynamically !------->
        </tbody>
    </table>
</div>
<!----- add fees form starts !----->

<div class="x_panel">
    <div class="x_title">
        <h2 class="text-center">Add Student Fees</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
    <form>
        <input type="hidden" name="_token" id="token" value="{{csrf_token()}}"/>
        <input type="hidden" name="sessionName" id="sessionName" value="{{session('sName')}}"/>
        <input type="hidden" name="semail" id="semail"/>
    <div class="row">
        <div class="col-md-4 col-sm-12 form-group">
            <label>Admission No</label>
            <input type="text" name="sId" id="sId" class="form-control" onkeyup="this.value=this.value.toUpperCase()" required/>
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label>Student Name</label>
            <input type="text" name="sName" id="sName" class="form-control" onkeyup="this.value=this.value.toUpperCase()" required/>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label>Class Name</label>
            <select name="className" id="className" class="form-control" required>
                <option value="">Select</option>
            </select>
        </div>
        <div class="col-md-1 col-sm-12 form-group">
            <label>Get Class Fees</label>
            <input type="checkbox" name="getClassFee" id="getClassFee" class="form checkbox" onclick="getClassFees()"/>
        </div>
    </div>
    <h4 class="text-center">Add Fees Details</h4>
    <div class="row">
        
        <div class="col-md-2 col-sm-12 form-group">
            <label>Fees Year</label>
            <select name="years" id="years" class="form-control">
                 <option value="@php echo date('Y'); @endphp">@php echo date('Y'); @endphp</option>
                <option value="@php echo date('Y')-1; @endphp">@php echo date('Y')-1; @endphp</option>
               @php for($i=1; $i<2; $i++){@endphp
               <option value="@php echo date('Y')+$i; @endphp">@php echo date('Y')+$i; @endphp</option>
               @php
               }
               @endphp
            </select>
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label>Fees Months</label>
            <select name="months" id="months" class="form-control" onchange="getClassFees()">
               <option value="">Select</option>
               @php for($i=2; $i<14; $i++){@endphp
               <option value="@php echo date('M', mktime(0,0,0,$i,0,0)) @endphp">@php echo date('M', mktime(0,0,0,$i,0,0)) @endphp</option>
               @php
               }
               @endphp
            </select>
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label class="manual-fees">Payment For</label>
            <!---<input type="text" name="payFor" id="payFor" class="form-control" onkeyup="this.value=this.value.toUpperCase()"/>!--->
            <select name="payFor" id="payFor" class="form-control manual-fees">
                <option value="">Select Payment For</option>
                @php 

use App\Http\Controllers\AccountController; 
$data = AccountController::getActiveFee();

@endphp
                @foreach($data as $fee)
                <option value="{{$fee->FEES_TYPE_ID}}">{{$fee->FEES_NAME}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label class="manual-fees">Amount</label>
            <input type="number" name="payAmt" id="payAmt" class="form-control manual-fees"/>
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            
            <input type="button" name="addPmt" id="addPmt" class="btn classic-btn btn-sm form-control" value="Add Fees" onclick="AddFees()" style="margin-top: 25px;"/>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group  table-responsive">
            <table id="feesTbl" class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th>Sl</th>
                    <th>Fess Year</th>
                    <th>Fees Month</th>
                    <th>Fees For</th>
                    <th>Amt</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!---- data will load using javascript !---->
            </tbody>
        </table>
        </div>
        
    </div>
    <h4 class="text-center">Add Payment Details</h4>
    <div class="row">
        
        <div class="col-md-4 col-sm-12 form-group">
            <label>Payment Method</label><br/>
            <label>Cheque &nbsp;<input type="radio" name="pMethod" id="Cheque" value="Cheque"/></label>&nbsp;&nbsp;
            <label>Cash &nbsp;<input type="radio" name="pMethod" id="Cash" value="Cash"/></label>&nbsp;&nbsp;
            <label>Upi &nbsp;<input type="radio" name="pMethod" id="Upi" value="Upi"/></label>&nbsp;&nbsp;
            <label>Neft/Imps &nbsp;<input type="radio" name="pMethod" id="Neft_Imps" value="Neft/Imps"/></label>
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label>Payment Date</label>
            <input type="date" name="pmtDate" id="pmtDate" class="form-control" />
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label>Cheque/Reference NO</label>
            <input type="test" name="pmtNo" id="pmtNo" class="form-control"/>
        </div>
        
        <div class="col-md-2 col-sm-12 form-group">
            <label>Payment Amount</label>
            <input type="number" name="pmtAmt" id="pmtAmt" class="form-control" />
        </div>
        
        <div class="col-md-2 col-sm-12 form-group">
            
            <input type="button" name="addPmt" id="addPmt" class="btn classic-btn btn-sm form-control" value="Add Payment" onclick="AddPayment()" style="margin-top: 25px;"/>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group table-responsive">
        <table id="paymentTbl" class="table table-striped jambo_table bulk_action">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Payment Mode</th>
                    <th>Reference No</th>
                    <th>Payment Date</th>
                    <th>Amt</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!---- data will show dynamically !------>
            </tbody>
        </table>
        </div>
    </div>
    
    <div class="row form-group">
        <div class="col-sm-4">
            
        </div>
        <div class="col-sm-4">
            
            <input type="reset" name="reset" id="reset" class="btn btn-danger btn-sm" value="Reset Fess"/>
            &nbsp;&nbsp;
            <input type="button" name="addFees" id="addFees" class="btn classic-btn btn-sm" value="Add Fess" onclick="addStudentFess()"/>
            
        </div>
        <div class="col-sm-4">
            
        </div>
    </div>
    
    </form>
</div>
</div>
</div>
        </div>
        <!-- /page content -->
        
        @include('admin/footer1')
        
        @include('admin/bottom_link')
<script>
$(document).ready(function(){
    GetClassList();
});

function GetClassList(){
     $.ajax({
        url:'class_list',
        data:'GetActive=GetActive',
        dataType:'Json',
        success:function(result){
            //alert(result)
            for(var i = 0; i < result.length; i++)
            {
           $("#className").append("<option value='"+result[i].CLASS_ID+"'>"+result[i].CLASS_NAME+"</option>");
            }
        }
    })
}

    function getStudent(sdata){
        //alert(sdata);
        $.ajax({
            url:'getData',
            data:'FetchData=FetchData&Data='+sdata,
            dataType:'Json',
            success:function(data){
                //alert(data);
                if(data.length == 0){
                    $("#stdtbl tbody").html('No Record Found');
                }else{
                    var s_data = "";
                    for(var i = 0; i < data.length; i++){
                     var j = i+1;
                     s_data +="<tr style='padding: 0px;'>";
                     s_data +="<td style='padding: 0px;'>"+ j +"</td>";
                     s_data +="<td style='padding: 0px;'>"+ data[i].ADMISSION_NO +"</td>";
                     s_data +="<td style='padding: 0px;'>"+ data[i].STUDENT_NAME +"</td>";
                     s_data +="<td style='padding: 0px;'>"+ data[i].S_FATHER_NAME +"</td>";
                     s_data +="<td style='padding: 0px;'>"+ data[i].S_MOTHER_NAME +"</td>";
                     s_data +="<td style='padding: 0px;'>"+ data[i].S_MOBILE +"</td>";
                     s_data +="<td style='padding: 0px;'>"+ data[i].S_STATUS +"</td>";
                     s_data +="<td style='padding: 0px;'><button name='add_fees' id='add_fees' onclick=add_data('"+ data[i].ADMISSION_NO +"') class='btn classic-btn btn-sm' style='padding: 1px;'><i class='fa fa-plus'></i></button></td>";
                     s_data +="</tr>";
                    }
                    
                    $("#stdtbl tbody").html(s_data);
                    
                }
            }
        }); /// ajax close
    }
    
/*========= function to add student record into add fees form ==========*/

function add_data(sid){
    //alert(sid);
    $.ajax({
            url:'getData',
            data:'GetData=GetData&Data='+sid,
            dataType:'Json',
            success:function(result){
               // alert(result);
               var sData = result[0];
              // alert(sData.ADMISSION_CLASS)
               $("#sId").val(sData.ADMISSION_NO);
               $("#sName").val(sData.STUDENT_NAME);
               $("#sClass").val(sData.ADMISSION_CLASS);
               $("#semail").val(sData.S_EMAIL);
               
               $("#stdtbl tbody").html("");
            }
    })
}

/*============== function to add data into array and display into payment table===========*/
var feesArr = [];
function AddFees(){
    var months = $("#months option:selected").val();
    var years = $("#years option:selected").val();
    var feesName = $("#payFor option:selected").text();
    var feesvalue = $("#payFor option:selected").val();
    var feesAmt = $("#payAmt").val();
    
    var feesDetails = [years,months,feesName,feesAmt,feesvalue];
    
    //alert(feesDetails);
    
    feesArr.push(feesDetails);
    
    displayFees();
    
    $("#months").val("");
    $("#payFor").val("");
    $("#payAmt").val("");
}

function displayFees(){
   // alert(feesArr.length);
    var feesData = "";
    var totalAmt = 0;
    for(var i = 0; i < feesArr.length; i++){
        var j = i+1;
        totalAmt += parseInt(feesArr[i][3]);
        feesData +="<tr style='padding: 0px;'>";
        feesData +="<td style='padding: 0px;'>"+ j +"</td>";
        feesData +="<td style='padding: 0px;'>"+ feesArr[i][0] +"</td>";
        feesData +="<td style='padding: 0px;'>"+ feesArr[i][1] +"</td>";
        feesData +="<td style='padding: 0px;'>"+ feesArr[i][2] +"</td>";
        feesData +="<td style='padding: 0px;'>"+ feesArr[i][3] +"</td>";
        feesData +="<td style='padding: 0px;'><button class='btn btn-danger btn-sm' onclick='delfees("+ i +")' style='padding: 1px;'><i class='fa fa-trash'></i></button></td>";
        feesData +="</tr>";
        
    }
    
    feesData +="<tr>";
    feesData +="<td colspan='4'></td>";
    feesData +="<td>"+ totalAmt +"</td>";
    feesData +="<td></td>";
    feesData +="</tr>";
    
    $("#feesTbl tbody").html(feesData)
}

function delfees(a){	
		feesArr.splice(a,1);   // deleting 1 product
		displayFees();  // displaying product	
	}
	
/*============ add pyment details into table ======*/

var pmtArr = [];

function AddPayment(){
   
    var method = "";
    var PmtDate = $("#pmtDate").val();
    var PmtNo = $("#pmtNo").val();
    var PmtAmout = $("#pmtAmt").val();
    
    if($("#Cheque").is(":checked")){
        method = "Cheque";
    }
    if($("#Cash").is(":checked")){
        method = "Cash";
    }
    if($("#Upi").is(":checked")){
        method = "Upi";
    }
    if($("#Neft_Imps").is(":checked")){
        method = "Neft/Imps";
    }
    
     
    
    var pmtData = [method,PmtNo,PmtDate,PmtAmout];
    //alert(pmtData);
    pmtArr.push(pmtData);
    
    displayPmt();
    
    $("#pmtDate").val("");
    $("#pmtNo").val("");
    $("#pmtAmt").val("");
    document.getElementById('Cheque').checked=false;
    document.getElementById('Cash').checked=false;
    document.getElementById('Upi').checked=false;
    document.getElementById('Neft_Imps').checked=false;
}


function displayPmt(){
    //alert(pmtArr.length);
    var feesData = "";
    for(var i = 0; i < pmtArr.length; i++){
        var j = i+1;
        feesData +="<tr style='padding: 0px;'>";
        feesData +="<td style='padding: 0px;'>"+ j +"</td>";
        feesData +="<td style='padding: 0px;'>"+ pmtArr[i][0] +"</td>";
        feesData +="<td style='padding: 0px;'>"+ pmtArr[i][1] +"</td>";
        var pmt_date = pmtArr[i][2].split("-").reverse().join("-");
        feesData +="<td style='padding: 0px;'>"+ pmt_date +"</td>";
        feesData +="<td style='padding: 0px;'>"+ pmtArr[i][3] +"</td>";
        feesData +="<td style='padding: 0px;'><button class='btn btn-danger btn-sm' onclick='delpmt("+ i +")' style='padding: 1px;'><i class='fa fa-trash'></i></button></td>";
        feesData +="</tr>";
    }
    
    $("#paymentTbl tbody").html(feesData)
}

function delpmt(a){	
		pmtArr.splice(a,1);   // deleting 1 product
		displayPmt();  // displaying product	
	}


/*=================== function to add fees ========*/

function addStudentFess(){
    var token = $("#token").val();
    var sId = $("#sId").val();
    var sName = $("#sName").val();
    var className = $("#className option:selected").val();
    var session = $("#sessionName").val();
    var email = $("#semail").val();
    
    $.post('manage-fees',{
        _token:token,
        sid:sId,
        sName:sName,
        className:className,
        session:session,
        feesArr:feesArr,
        pmtArr:pmtArr,
        email:email,
        addFess:'AddFess'
    },function(result){
        alert(result.Msg);
        
        window.open("{{url('/admin')}}/fees-reports","_self");
    })
}

function getClassFees(){
    var classID = $("#className option:selected").val();
    var months = $("#months option:selected").val();
    var years = $("#years option:selected").val();
    if($("#getClassFee").is(":checked")){
        $(".manual-fees").hide();
        if(classID == ''){
            alert("Please Select Class First");
        }
        if(months == ''){
            alert("Please Select Months Name");
        }
        if(classID != '' && months != ''){
            
$.ajax({
        url:'ClassFees',
        data:'ClassFees=ClassFees&ClassID='+classID,
        dataType:'Json',
        success:function(result){
            //alert(result)
            for(var i = 0; i < result.length; i++){
    var feesDetails = [years,months,result[i].FEES_NAME,result[i].FEES_AMOUNT,result[i].FEES_NAME];
    
    feesArr.push(feesDetails);
            }
            
            displayFees();
        }
    })
    
        }
    }else{
       $(".manual-fees").show();
    }
}

</script>