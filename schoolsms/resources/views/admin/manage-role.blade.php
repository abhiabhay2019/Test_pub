@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
<!-- page content -->
        <div class="right_col" role="main">
    <div class="row">
        <div class="col-md-6 col-sm-12 form-group">
            <div class="table-responsive">
                
            
            <table id="classListTbl" class="table table-bordered table-striped jambo_table bulk_action">
               <thead>
                   <tr>
                       <th>Sl</th>
                       <th>Role Name</th>
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
        <div class="col-sm-6">
            <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center msg_res"></h3>
</div>
<div class="x_panel">
   <form id="roleForm">
                @csrf
                <input type="hidden" name="rid" id="rid" value=""/>
            <div class="row">
                <div class="col-sm-12 form-group">
                   <label>Enter Role Name</label>
                   <input type="text" name="rName" id="rName" class="form-control" onkeyup="this.value=this.value.toUpperCase()"/>
                </div>
                <div class="col-sm-12 form-group">
                   <label>Role Status</label>
                   <select name="rStatus" id="rStatus" class="form-control">
                      <option value="">Select Status</option>
                      <option value="ACTIVE">ACTIVE</option>
                      <option value="DEACTIVE">DEACTIVE</option>
                   </select>
                </div>
                <div class="col-sm-12 form-group">
                   <input type="submit" name="addRole" id="addRole" Value="Add & Update Role" class="btn classic-btn btn-sm"/>
                </div>
            </div>
            </form>
            </div>
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
    
    getRoleList();
    
});

    $("#addRole").click(function(e){
        
        e.preventDefault();
        
        $.ajax({
            url:'manage_role',
            data: $("#roleForm").serialize(),
            type:'post',
            success:function(result){
                
                //alert(result.msg)
                 $(".alert").fadeIn();
                //$(".alert").show();
                $(".msg_res").html(result.msg);
                
                $("#rName").val("");
                $("#rStatus").val("");
                $("#rid").val("");
                
                $(".alert").fadeOut(2000);
                
                getRoleList();
            }
        })
    });
    
/*=============== function to get all class list =========*/

function getRoleList(){
    $.ajax({
        url:'role_list',
        data:'GetRole=GetRole',
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
                   cdata +="<td>"+ result[i].ROLE_NAME +"</td>";
                   cdata +="<td>"+ result[i].ROLE_STATUS +"</td>";
                   cdata +="<td><button name='editClass' id='editClass' onclick=EditRole('"+ result[i].ROLE_ID +"') class='btn classic-btn glyphicon glyphicon-pencil'></button></td>";
                   cdata +="<tr>";
                }
                $("#classListTbl tbody").html(cdata);
            }
        }
    })
}

///*================ function to edit ======================*/

function EditRole(rid){
    //alert(cid);
    $.ajax({
        url:'role_list',
        data:'roleid='+rid,
        dataType:'Json',
        success:function(result){
            //alert(result)
            var cdata = result[0]
            $("#rName").val(cdata.ROLE_NAME);
            $("#rStatus").val(cdata.ROLE_STATUS);
                $("#rid").val(cdata.ROLE_ID);
        }
        
    });
}
</script>