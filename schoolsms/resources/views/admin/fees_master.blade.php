@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
<!-- page content -->
        <div class="right_col" role="main">
            
    <div class="x_panel">
        <div class="col-md-4 col-sm-12 form-group">
            </div>
        <div class="col-md-4 col-sm-12 form-group">
            @if(session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{session('msg')}}</h3>
</div>
    
    @endif
    
            <form action="{{url('/admin/addmaster')}}" method="post">
                @csrf
               <input type="hidden" name="feesid" id="feesid" value=""/>
            <div class="row">
                <div class="col-sm-12 form-group">
                   <label>Select Class</label>
                   <select name="className" id="className" class="form-control" required>
                <option value="">Select</option>
            </select>
                </div>
                <div class="col-sm-12 form-group">
                   <label>Fees Name</label>
                   <input type="text" name="feesName" id="feesName" class="form-control" onkeyup="this.value=this.value.toUpperCase()"/>
                </div>
                <div class="col-sm-6 form-group">
                   <label>Fees Amount</label>
                   <input type="number" name="feesAmt" id="feesAmt" class="form-control"/>
                </div>
                <div class="col-sm-6 form-group">
                    <br>
                   <input type="button" name="add" id="add" class="btn classic-btn btn-sm" style="margin-top: 10px;" onclick="addInTable()" value="Add"/>
                </div>
                <div class="col-sm-12 form-group table-responsive">
                   <table id="itemTable" class="table table-striped jambo_table bulk_action">
                       <thead>
                           <tr>
                               <th>Sl</th>
                               <th>Name</th>
                               <th>Amount</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           <!---- data show dynamically !---->
                       </tbody>
                   </table>
                </div>
                <div class="col-sm-12 form-group">
                   <input type="submit" name="addFeesMaster" id="addFeesMaster" Value="Add & Update Fees Master" class="btn classic-btn btn-sm"/>
                </div>
            </div>
            
            </form>
        </div>
    </div>
</div>

</div>
</div>
        <!-- /page content -->
@include('admin/footer1')
@include('admin/bottom_link')
<script>
$(document).ready(function(){
    
    $(".alert").hide();
    
    GetClassList();
    getRecord();
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

var fees_data = [];

function addInTable(){
    var feesName = $("#feesName").val();
    var feesAmt = $("#feesAmt").val();
    
    var data = [feesName, feesAmt];
    fees_data.push(data);
    display();
    $("#feesName").val("");
    $("#feesAmt").val("");
}

function display(){
var feesData = "";
    for(var i = 0; i < fees_data.length; i++){
        var j = i+1;
        feesData +="<tr style='padding: 0px;'>";
        feesData +="<td style='padding: 0px;'><input type='hidden' name='row_id[]' value='"+j+"'/>"+ j +"</td>";
        feesData +="<td style='padding: 0px;'><input type='hidden' name='fees_name_"+j+"' value='"+fees_data[i][0]+"'/>"+ fees_data[i][0] +"</td>";
        feesData +="<td style='padding: 0px;'><input type='hidden' name='fees_amt_"+j+"' value='"+fees_data[i][1]+"'/>"+ fees_data[i][1] +"</td>";
       
        feesData +="<td style='padding: 0px;'><input type='button' class='btn btn-danger btn-sm' onclick='delfees("+ i +")' style='padding: 1px;' value='X'></td>";
        feesData +="</tr>";
    }
    
    $("#itemTable tbody").html(feesData)
}

function delfees(a){	
		fees_data.splice(a,1);   // deleting 1 product
		display();  // displaying product	
	}
	
function getRecord(){
    var url_string = location; //window.location.href
    var url = new URL(url_string);
    var Id = url.searchParams.get("feesid");
    //alert(Id);
    $.ajax({
        url:'getfeesType',
        data:'class_id='+Id,
        dataType:'Json',
        success:function(res){
            //alert(res);
            if(res.length == 0){
                
            }else{
                var all_id = '';
                var ftype = '';
                for(var i = 0; i < res.length; i++){
                    
                    if(i == 0){
                       // all_id = res[i].FEES_TYPE_ID;
                        $("#className").val(res[i].CLASS_ID);
                    }else{
                       // all_id = all_id+'|'+res[i].FEES_TYPE_ID;
                    }
                    ftype = [res[i].FEES_NAME,res[i].FEES_AMOUNT]
                    fees_data.push(ftype);
                }
                
                display();
               // $("#feesid").val(all_id);
            }
        }
    })
}	

</script>