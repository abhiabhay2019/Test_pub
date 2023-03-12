@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
<!-- page content -->
        <div class="right_col" role="main">

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="table-responsive" style="height: 500px; overflow: auto;">
                
            
            <table id="classListTbl" class="table table-striped jambo_table bulk_action">
               <thead>
                   <tr class="headings">
                       <th>Sl</th>
                       <th>Class Name</th>
                       <th>Status</th>
                       <th>Action</th>
                   </tr>
               </thead>
               <tbody>
                   <!--- data will load dynamically using js !---->
               </tbody>
            </table>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 form-group">
            <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center msg_res"></h3>
</div>
<div class="x_panel">
    <form id="classForm">
                @csrf
            <div class="row">
                <div class="col-sm-12 form-group">
                   <label>Enter Class Name</label>
                   <input type="text" name="cName" id="cName" class="form-control" onkeyup="this.value=this.value.toUpperCase()"/>
                </div>
                <div class="col-sm-12 form-group">
                   <label>Class Status</label>
                   <select name="cStatus" id="cStatus" class="form-control">
                      <option value="">Select Status</option>
                      <option value="ACTIVE">ACTIVE</option>
                      <option value="DEACTIVE">DEACTIVE</option>
                   </select>
                </div>
                <div class="col-sm-12 form-group">
                   <input type="submit" name="addClass" id="addClass" Value="Add & Update Class" class="btn classic-btn btn-sm"/>
                </div>
            </div>
            <input type="hidden" name="cid" id="cid" value="0"/>
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
    
    getClassList();
    
});

    $("#addClass").click(function(e){
        
        e.preventDefault();
        
        $.ajax({
            url:'class_manage',
            data: $("#classForm").serialize(),
            type:'post',
            success:function(result){
                
                //alert(result.msg)
                 $(".alert").fadeIn();
                //$(".alert").show();
                $(".msg_res").html(result.msg);
                
                $("#cName").val("");
                $("#cStatus").val("");
                $("#cid").val(0);
                
                $(".alert").fadeOut(2000);
                
                getClassList();
            }
        })
    });
    
/*=============== function to get all class list =========*/

function getClassList(){
    $.ajax({
        url:'class_list',
        data:'GetClassList=GetClassList',
        dataType:'Json',
        success:function(result){
            //alert(result)
            
            if(result.length ==0){
                alert('No Record Found');
            }else{
                var cdata = "";
                for(var i = 0; i < result.length; i++)
                {
                    var j = i+1;
                   cdata +="<tr>";
                   cdata +="<td>"+ j +"</td>";
                   cdata +="<td>"+ result[i].CLASS_NAME +"</td>";
                   cdata +="<td>"+ result[i].CLASS_STATUS +"</td>";
                   cdata +="<td><button name='editClass' id='editClass' onclick='EditClass("+ result[i].CLASS_ID +")' class='btn btn-info glyphicon glyphicon-pencil'></button></td>";
                   cdata +="<tr>";
                }
                $("#classListTbl tbody").html(cdata);
            }
        }
    })
}

///*================ function to edit ======================*/

function EditClass(cid){
    //alert(cid);
    $.ajax({
        url:'class_list',
        data:'ClassId='+cid,
        dataType:'Json',
        success:function(result){
            //alert(result)
            var cdata = result[0]
            $("#cName").val(cdata.CLASS_NAME);
            $("#cStatus").val(cdata.CLASS_STATUS);
                $("#cid").val(cdata.CLASS_ID);
        }
        
    });
}
</script>