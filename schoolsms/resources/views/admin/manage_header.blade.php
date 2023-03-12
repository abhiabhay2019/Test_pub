@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
<!-- page content -->
        <div class="right_col" role="main">
            
    @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
    <div class="row form-group">
        <div class="col-md-6 col-sm-6 form-group">
            <div class="table-responsive">
                <table class="table table-bordered table-striped jambo_table bulk_action" id="links_table">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Head Name</th>
                        <th>SubHead Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach($lists as $key)
                    <tr>
                        <td>@php echo $i; @endphp</td>
                        <td>{{$key->HEAD_NAME}}</td>
                        <td>{{$key->SUB_HEAD_NAME}}</td>
                        <td>{{$key->SUB_HEAD_STATUS}}</td>
                        <td><button onclick="edit_link('{{$key->LINK_ID}}')"><i class="fa fa-pencil"></i></button></td>
                    </tr>
                    @php $i++; @endphp
                    @endforeach
                </tbody>
                
                    {{$lists->links()}}
                
            </table>
            {{$lists->links()}}
            </div>
            
        </div>
        <div class="col-md-6 col-sm-12 form-group">
            <div class="x_panel">
            <form action="{{url('admin/add-header')}}" method="post">
                @csrf
                <input type="hidden" name="sub_header_id" id="sub_header_id" value=""/>
                <div class="row form-group">
                    <label>Select Head Name</label>
                    <select name="head_id" id="head_id" class="form-control">
                        <option value="">Select Head</option>
                        @foreach($data as $val)
                        <option value="{{$val->HEAD_ID}}">{{$val->HEAD_NAME}}</option>
                        @endforeach
                    </select>
                </div>
            
                <div class="row form-group">
                    <label>Enter SubHead Name</label>
                    <input type="text" name="subhead_name" id="subhead_name" class="form-control" required/>
                </div>
                <div class="row form-group">
                    <label>Enter SubHead Sequance</label>
                    <input type="number" name="subhead_pos" id="subhead_pos" class="form-control" required/>
                </div>
                <div class="row form-group">
                    <label>Enter SubHead Link</label>
                    <input type="text" name="subhead_link" id="subhead_link" class="form-control" required/>
                </div>
                <div class="row form-group">
                    <label>Head Class</label>
                    <input type="text" name="head_class" id="head_class" class="form-control" value="open" readonly required/>
                </div>
                
                <div class="row form-group">
                    <label>Sub Head Class</label>
                    <input type="text" name="sub_head_class" id="sub_head_class" class="form-control" value="active" readonly required/>
                </div>
                
                <div class="row form-group">
                    <label>Sub Head Status</label>
                    <select name="sub_head_status" id="sub_head_status" class="form-control">
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="DEACTIVE">DEACTIVE</option>
                    </select>
                </div>
                
                <div class="row form-group">
                    <input type="reset" name="reset" id="reset" class="btn btn-danger btn-sm"/>
                    
                    <input type="Submit" name="add_header" id="add_header" class="btn btn-success btn-sm"/>
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
        setTimeout(function() { 
      $(".alert-info").fadeOut(); 
}, 2000);
//get_all_link();
    });
    
    /*function get_all_link(){
        $.ajax({
            url:'get-links',
            data:'get_links=true',
            dataType:'Json',
            success:function(res){
               // alert(res);
               if(res.length == 0){
                   $("#links_table tbody").html("No Record Found!");
               }else{
                   var tbl_data = '';
                   for(var i = 0; i < res.length; i++){
                       
                       var j = i+1;
                       tbl_data +='<tr style="padding: 0px;">';
                       tbl_data +='<td style="padding: 0px;">'+j+'</td>';
                       tbl_data +='<td style="padding: 0px;">'+res[i].HEAD_NAME+'</td>';
                       tbl_data +='<td style="padding: 0px;">'+res[i].SUB_HEAD_NAME+'</td>';
                       tbl_data +='<td style="padding: 0px;">'+res[i].SUB_HEAD_STATUS+'</td>';
                       tbl_data +='<td style="padding: 0px;"><button class="btn btn-primary btn-sm" onclick="edit_link(\''+res[i].LINK_ID+'\')" style="padding: 2px;"><i class="glyphicon glyphicon-pencil"></i></button></td>';
                       tbl_data +='</tr>';
                   }
                   $("#links_table tbody").html(tbl_data);
               }
            }
        })
    }*/
    
    function edit_link(link_id){
        $.ajax({
            url:'edit-subhead',
            data:'link_id='+link_id,
            dataType:'Json',
            success:function(res){
                //alert(res)
                var data = res[0];
                //alert(data.HEAD_ID);
                $("#sub_header_id").val(data.LINK_ID);
                //$("#head_id").append('<option value="'+data.HEAD_ID+'">'+data.HEAD_NAME+'</option>');
                $("#head_id").val(data.HEAD_ID);
                $("#subhead_name").val(data.SUB_HEAD_NAME);
                $("#subhead_pos").val(data.SUB_HEAD_SEQ);
                $("#subhead_link").val(data.SUB_HEAD_LINK);
            }
        })
    }
</script>