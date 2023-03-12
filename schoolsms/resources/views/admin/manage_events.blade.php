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
            
            <div class="row form-group">
                <div class="col-sm-4">
                    <select name="select_class" id="select_class" class="form-control">
                <option value="">Select Class</option>
            </select>
            </div>
                <div class="col-sm-4">
                    <input type="button" name="send_email" id="send_email" class="btn classic-btn btn-sm" value="Send Email" onclick="send_notice()"/>
                    <input type="hidden" name="event" id="event" value=""/> 
                </div>
                <div class="col-sm-4">
                    <input type="button" name="send_sms" id="send_sms" class="btn classic-btn btn-sm" value="Send SMS"/>
                </div>
        </div>
        
            <label>All Notices</label>
        <table class="table table-bordered table-striped jambo_table bulk_action">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Sl</th>
                    <th>Notice_Date</th>
                    <th>Notice Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($data) != 0)
                @foreach($data as $key=>$notice)
                <tr>
                    <td><input type="radio" name="event_id" class="event_id" id="event_id" value="{{$notice->ID}}" onclick="update_event(this.value)"></td>
                    <td>{{ ++$key }}</td>
                    <td>{{ $notice->DATE }}</td>
                    <td>{{ $notice->TITLE }}</td>
                    <td>{{ $notice->STATUS }}</td>
                    <td><a href="manage-events?eventid={{ $notice->ID }}" class="btn classic-btn btn-sm">Edit</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {!! $data->links() !!}
    </div>
    <!------------------------ form bellow !------------------->
        <div class="col-md-6 col-sm-12 form-group">
            @if(Session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{Session()->get('msg')}}</h3>
</div>
    
    @endif
    
    @php $title =""; $date =""; $status =""; $message=""; $files=""; $id="";
    
    foreach($edit as $editdata)
    {
    $title =$editdata->TITLE; $date =$editdata->DATE; $status =$editdata->STATUS; $message=$editdata->MESSAGE; $files=""; $id=$editdata->ID;
    }
    @endphp
    <div class="x_panel">
        <form action="{{url('/admin/addevent')}}" method="post" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" name="eventid" id="eventid" value="{{$id}}"/>
            <div class="row form-group">
                <div class="col-sm-12 form-group">
                   <label>Notice Title</label>
                   <input type="text" name="noticeTitle" id="noticeTitle" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="{{$title}}" autocomplete="off"/>
                </div>
               </div>
               <div class="row form-group">
                <div class="col-sm-6 form-group">
                   <label>Notice Date</label>
                   <input type="date" name="noticeDate" id="noticeDate" class="form-control" autocomplete="off" value="{{$date}}"/>
                </div>
                <div class="col-sm-6 form-group">
                   <label>Status</label>
                   <select name="noticeStatus" id="noticeStatus" class="form-control"/>
                   <option value="">Select Status</option>
                   <option value="Active">Active</option>
                   <option value="Deactive">Deactive</option>
                   @if($status !='')
                   <option value="{{$status}}" selected>{{$status}}</option>
                   @endif
                   </select>
                   
                </div>
                </div>
                <div class="row form-group">
                <div class="col-sm-12 form-group">
                   <label>Enter Your Notice Message Here!</label>
                   <textarea name="noticeMessage" id="noticeMessage" class="form-control" style="height: 300px;">{{$message}}</textarea>
                </div>
                </div>
                <div class="row form-group">
                <div class="col-sm-12 form-group">
                   <label>If Any Notice Image</label>
                   <input type="file" name="noticeImg" id="noticeImg" class="form-control"/>
                </div>
                </div>
                <div class="col-sm-12 form-group">
                   <input type="submit" name="addFeesMaster" id="addFeesMaster" Value="Add & Update Notice" class="btn classic-btn btn-sm"/>
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
    
   // $(".alert").hide();
    
});
CKEDITOR.replace( 'noticeMessage' );

function update_event(nid){
    
    $("#event").val(nid);
}

function send_notice(){
   var nid = $("#event").val();
   $.ajax({
        url:'sendNotice',
        data:'sendNotice=sendEvent&notice_id='+nid,
        dataType:'Json',
        success:function(data){
            alert(data.msg)
        }
    })
}
</script>