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
$ftype = "";
$sroll = "";
$smobile = "";
$qryDate1 = "";
$qryDate2 = "";

if(isset($_POST['feestype'])){
$ftype = $_POST['feestype'];
}
@endphp


    <div class="row form-group">
       <div class="col-sm-2">
        
        </div>
            <div class="col-sm-3">
            <label>Fees Months</label>
            <select name="months" id="months" class="form-control" onchange="getPendingFees()">
               <option value="@php echo date('M'); @endphp">@php echo date('M'); @endphp</option>
               <!--<option value="">Select</option>-->
               @php for($i=2; $i<14; $i++){@endphp
               <option value="@php echo date('M', mktime(0,0,0,$i,0,0)) @endphp">@php echo date('M', mktime(0,0,0,$i,0,0)) @endphp</option>
               @php
               }
               @endphp
            </select>
            </div>
        <div class="col-sm-3">
            <label>Class Name</label>
            <select name="className" id="className" class="form-control" required onchange="getPendingFees()">
                <option value="">Select</option>
            </select>
        </div>
        
        <div class="col-sm-2">
          
        </div>
        <div class="col-sm-2">
            
        </div>
        
    </div>
    
    <!------- table row start !-------->
    <div class="row">
        <div class="col-md-12 col-sm-12 table-responsive form-group">
        <table id="feesTable" class="table table-striped jambo_table bulk_action">
            <input type="hidden" name="pageNo" id="pageNo" value="1"/>
            <input type="hidden" name="initialValue" id="initialValue" value="0"/>
            <input type="hidden" name="recordLimit" id="recordLimit" value="10"/>
            
            <thead>
                <tr class="headings">
                    <th>Sl</th>
                    <th>Admission No</th>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>Class</th>
                    <th>Month Name</th>
                    <th>Fees Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody class="page-data">
                
                      <!--<td><a href='javascript:void(0)' class='btn btn-warning' onclick="send_pending_fees('sid','feesmaster_id')">Email Fees</a></td>
                      <td><a href='javascript:void(0)' class='btn btn-default'>Send SMS</a></td>
                      </tr>-->
 
            </tbody>
        </table>
        </div>
    <div class="col-12 bs-pagination">    
<nav aria-label="Page navigation example" class="">
  <ul class="pagination">
    <li class="page-item"><a class="page-link previous-btn" href="#" onclick="previousPage()">Previous</a></li>
    <li class="page-item"><a class="page-link show-page-no" href="#">PageNo</a></li>
    <li class="page-item"><a class="page-link next-btn" href="#" onclick="nextPage()">Next</a></li>
  </ul>
</nav>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <a href="javascript:void(0)" class="btn classic-btn btn-sm">Export To Excel</a>
        </div>
        <!--<div class="col-sm-offset-8 col-sm-2">
            
        </div>-->
    </div>
</div>
        </div>
        <!-- /page content -->
        
        @include('admin/footer1')
        
        @include('admin/bottom_link')
<script>

$(document).ready(function(){
    GetClassList();
    getPendingFees();
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

function getPendingFees(){
   
    var month_name = $("#months option:selected").val();
    var class_name = $("#className option:selected").val();
    var pageno = $("#pageNo").val();
    var recordLimit = $("#recordLimit").val();
    //alert(month_name);
    if(month_name != '' && class_name ==''){
        url="get_pending_fees?month_name="+month_name+"&PageNo="+pageno+"&RecordLimit="+recordLimit;
    }
    
    if(month_name != '' && class_name !=''){
        url="get_pending_fees?month_name="+month_name+"&class_name="+class_name+"&PageNo="+pageno+"&RecordLimit="+recordLimit;
    }
    
    $.ajax({
        url:url,
        data:'',
        dataType:'Json',
        success:function(res){
            //alert(res);
            if(res.length == 0){
                $("#feesTable tbody").html("No Record Found!......");
                $(".previous-btn").attr("disabled",true);
                    $(".next-btn").attr("disabled",true);
                    
                    $(".previous-btn").removeAttr("onclick");
                    $(".next-btn").removeAttr("onclick");
            }else{
                var dataTable = '';
                for(var i = 0; i < res.length; i++){
                    var j = i+1;
                    dataTable +="<tr style='padding: 0px;'>";
                    dataTable +="<td>"+j+"</td>";
                    dataTable +="<td>"+res[i].ADMISSION_NO+"</td>";
                    dataTable +="<td>"+res[i].STUDENT_NAME+"</td>";
                    dataTable +="<td>"+res[i].S_FATHER_NAME+"</td>";
                    dataTable +="<td>"+res[i].C_NAME+"</td>";
                    dataTable +="<td>"+month_name+"</td>";
                    dataTable +="<td>"+res[i].FEES_STATUS+"</td>";
                    dataTable +="<td><a href='javascript:void(0)' class='btn classic-btn btn-sm' onclick=send_pending_fees('"+res[i].STUDENT_ID+"','"+month_name+"')>Email Fees</a></td>";
                    dataTable +="<td><a href='javascript:void(0)' class='btn classic-btn1 btn-sm'>Send SMS</a></td>";
                    
                    dataTable +="</tr>";
                }
                $("#feesTable tbody").html(dataTable);
                $(".show-page-no").html(pageno);
                if(pageno == 1 || pageno <= 0){
                    
                    $(".previous-btn").attr("disabled",true);
                    $(".previous-btn").removeAttr("onclick");
                    
                    if(res.length < recordLimit){
                    $(".next-btn").attr("disabled",true);
                    $(".next-btn").removeAttr("onclick");
                    }else{
                    $(".next-btn").attr("disabled",false);
                    $(".next-btn").attr("onclick","nextPage()");
                    }
                }else{
                    $(".previous-btn").attr("disabled",false);
                    $(".previous-btn").attr("onclick","previousPage()");
                    
                    if(res.length < recordLimit){
                    $(".next-btn").attr("disabled",true);
                    $(".next-btn").removeAttr("onclick");
                    }else{
                    $(".next-btn").attr("disabled",false);
                    $(".next-btn").attr("onclick","nextPage()");
                    }
                }
            }
        }
    })
}

function send_pending_fees(sid, month){
    $.ajax({
        url:'send_pending_mail',
        data:'sendPendingMail=sendPendingMail&sid='+sid+'&month='+month,
        dataType:'Json',
        success:function(data){
            alert(data.msg)
        }
    })
}

function previousPage(){
    var pageno = $("#pageNo").val();
    var pno = '';
    if(pageno == 1 || pageno <= 0){
        $("#pageNo").val(1);
    }else{
        pno = parseInt(pageno)-1;
        $("#pageNo").val(pno);
    }
    getPendingFees();
}

function nextPage(){
    var pageno = $("#pageNo").val();
    var pno = '';
    if(pageno == 1 || pageno <= 0){
        pno = parseInt(pageno)+1;
        $("#pageNo").val(pno);
    }else{
        pno = parseInt(pageno)+1;
        $("#pageNo").val(pno);
    }
    
    getPendingFees()
}
</script>