@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
<!-- page content -->
        <div class="right_col" role="main">
            
    <div class="x_panel">
        
            @if(session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{session('msg')}}</h3>
</div>
    
    @endif
    
        <div class="row form-group">
            <div class="col-sm-2">
            <label>Student / Staff</label>
            <select name="data_option" id="data_option" class="form-control">
                <option value="Student">Student</option>
                <option value="Staff">Staff</option>
            </select>
            </div>
        </div>
    
    <div class="row table-responsive">
        <input type="hidden" name="page_no" id="page_no" value=""/>
        
        <table id="itemTable" class="table table-striped jambo_table bulk_action">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>Father</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <!--- data will show dynamically  !---->
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <input type="button" name="prev_btn" id="prev_btn" class="btn btn-primary" value="Previous" style="padding: 2px;"/>
        </div>
        <div class="col-sm-1">
            <input type="button" name="prev_btn" id="prev_btn" class="btn btn-primary" value="Next" style="padding: 2px;"/>
        </div>
        <div class="col-sm-8">
            
        </div>
        <div class="col-sm-2">
            <label id="total"></label>
        </div>
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
    getList();
});

function getList(){
    var dataType = $("#data_option option:selected").val();
    var page_no = $("#page_no").val();
    var pageNo = '';
    if(page_no ==''){
        pageNo = 1;
    }else{
        pageNo = page_no;
    }
    
    $.ajax({
        url:'getDeactiveList',
        data:'dataType='+dataType+'&pageNo='+pageNo,
        dataType:'Json',
        success:function(res){
            if(res.length == 0){
                
            }else{
                var main = '';
                for(var i = 0; i < res.main_data.length; i++){
                    var j = i+1;
                    main +="<tr>";
                    main +="<td>"+j+"</td>";
                    main +="<td>"+res.main_data[i].name+"</td>";
                    main +="<td>"+res.main_data[i].fname+"</td>";
                    main +="<td>"+res.main_data[i].mobile+"</td>";
                    main +="<td>"+res.main_data[i].email+"</td>";
                    main +="<td>"+res.main_data[i].status+"</td>";
                    main +="<td><a href='active-student/"+res.main_data[i].id+"/ACTIVE' name='status' id='status' class='btn classic-btn btn-sm' style='padding: 0px;'>Make Active</a></td>";
                    main +="</tr>";
                }
                $("#itemTable tbody").html(main);
                
                $("#total").html("Total Record "+res.total_record[0].TOTAL_RECORD);
            }
        }
    })
}

</script>