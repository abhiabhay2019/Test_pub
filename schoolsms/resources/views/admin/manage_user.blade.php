@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
<!-- page content -->
        <div class="right_col" role="main">
            <div class="col-md-6 col-sm-6 form-group">
                <div class="table-responsive">
                    <table id="role_access_tbl" class="table table-bordered table-striped jambo_table bulk_action">
                        <thead>
                            <tr>
                               <td>Sl</td>
                               <td>Role Name</td>
                               <td>Head Name</td>
                               <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                    <!--- data will show dynamically !---->
                        </tbody>
                    </table>
                </div>                
            </div>
            
            <div class="col-md-6 col-sm-12 form-group">
                <div class="x_panel">
                    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}"/>
                    <div class="row form-group">
                    <label>Select Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{$role->ROLE_ID}}">{{$role->ROLE_NAME}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="row form-group">
                    <label>Select Head</label>
                    <select name="head" id="head" class="form-control">
                        <option value="">Select Head</option>
                        @foreach($head as $heads)
                            <option value="{{$heads->HEAD_ID}}">{{$heads->HEAD_NAME}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="row form-group">
                    <input type="button" name="addCart" id="addCart" class="btn classic-btn btn-sm" value="Add Access"/>
                    </div>
                    <div class="row form-group">
                    <div class="table-responsive">
                    <table id="form_tbl" class="table table-bordered table-striped jambo_table bulk_action">
                        <thead>
                            <tr>
                               <td>Sl</td>
                               <td>Head Name</td>
                               <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                    </div>
                    <div class="row form-group">
                    <select name="access_status" id="access_status" class="form-control">
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="DEACTIVE">DEACTIVE</option>
                    </select>
                    </div>
                    <div class="row form-group">
                    <button name="submit_access" id="submit_access" class="btn classic-btn btn-sm">Submit Role Access</button>
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
        get_control();
    });
    
    function get_control(){
        
            $.ajax({
                url:'getcontrol',
                data:'getControl=true',
                dataType:'Json',
                success:function(res){
                   if(res.length == 0){
                       $("#role_access_tbl tbody").html("");
                   }else{
                       var data = '';
                       for(var i = 0; i < res.length; i++){
                           var j = i+1;
                           data +='<tr>';
                           data +='<td>'+j+'</td>';
                           data +='<td>'+res[i].ROLE_NAME+'</td>';
                           data +='<td>'+res[i].HEAD_NAME+'</td>';
                           data +='<td><a href="#"><i class="fa fa-trash"></i></a></td>';
                           data +='</tr>';
                       }
                       $("#role_access_tbl tbody").html(data);
                   }
                }
            });
        
    }
    
    $("#addCart").on('click', function(){
        add_cart();
    })

    var access_arr = [];
    
    function add_cart(){
        //alert('dsafdsfd');
        
        var head_id = $("#head option:selected").val();
        var head_name = $("#head option:selected").text();
        var data = [head_id, head_name];
        access_arr.push(data);
        display_table();
        
        //$("#role").val("");
        $("#head").val("");
    }
    
    function display_table(){
        if(access_arr.length == 0){
            
        }else{
            var tbl ='';
            for(var i = 0; i < access_arr.length; i++){
                var j =i+1;
                tbl +='<tr>';
                tbl +='<td style="padding: 0px;">'+j+'</td>';
                tbl +='<td style="padding: 0px;">'+access_arr[i][1]+'</td>';
                tbl +='<td style="padding: 0px;"><button onclick="del('+i+')"><i class="fa fa-trash"></i></button></td>';
                tbl +='</tr>';
            }
            $("#form_tbl tbody").html(tbl);
        }
    }
    
    function del(a){
        access_arr.splice(a,1);
        display_table();
    }
    
    $("#submit_access").on('click',function(){
        var role_id = $("#role option:selected").val();
        var role_name = $("#role option:selected").text();
        var head_id = $("#head option:selected").val();
        var access_status = $("#access_status option:selected").val();
        var token = $("#token").val();
        
        $.ajax({
            url:'update_access',
            data:'_token='+token+'&UpdateData=true&role_id=+'+role_id+'&role_name='+role_name+'&access_status='+access_status+'&access_data='+access_arr,
            type:'post',
            dataType:'Json',
            success:function(res){
                alert(res.msg)
                window.location.href = '';
            }/// success close
        })//// ajax close
    })
</script>        