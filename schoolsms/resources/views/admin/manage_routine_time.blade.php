@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
<!-- page content -->
        <div class="right_col" role="main">
    <h2 class="text-center">Routine Times</h2>
    <div class="row">
        <div class="col-md-6 col-sm-12 form-group">
            
            <div class="table-responsive">
                
            
        <table class="table table-bordered table-striped jambo_table bulk_action">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($data) != 0)
                @foreach($data as $key=>$notice)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $notice->START_TIME }}</td>
                    <td>{{ $notice->END_TIME }}</td>
                    <td>{{ $notice->STATUS }}</td>
                    <td><a href="time-master?timeid={{ $notice->TIME_ID }}" class="btn classic-btn btn-sm">Edit</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {!! $data->links() !!}
        </div>
    </div>
    <!------------------------ form bellow !------------------->
        <div class="col-md-6 col-sm-12 form-group">
            @if(Session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{Session()->get('msg')}}</h3>
</div>
    
    @endif
    
    @php $startTime =""; $endTime =""; $status =""; $message=""; $files=""; $id="";
    
    foreach($edit as $editdata)
    {
    $startTime =$editdata->START_TIME; $endTime =$editdata->END_TIME; $status =$editdata->STATUS; $id=$editdata->TIME_ID;
    }
    @endphp
    <div class="x_panel">
            <form action="{{url('/admin/addtime')}}" method="post" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" name="timeid" id="timeid" value="{{$id}}"/>
            <div class="row form-group">
                <div class="col-sm-12 form-group">
                   <label>Start Time</label>
                   <input type="time" name="startTime" id="startTime" class="form-control" value="{{$startTime}}" autocomplete="off"/>
                </div>
               </div>
               <div class="row form-group">
                <div class="col-sm-6 form-group">
                   <label>End Time</label>
                   <input type="time" name="endTime" id="endTime" class="form-control" autocomplete="off" value="{{$endTime}}"/>
                </div>
                <div class="col-sm-6 form-group">
                   <label>Status</label>
                   <select name="timeStatus" id="timeStatus" class="form-control"/>
                   <option value="">Select Status</option>
                   <option value="Active">Active</option>
                   <option value="Deactive">Deactive</option>
                   @if($status !='')
                   <option value="{{$status}}" selected>{{$status}}</option>
                   @endif
                   </select>
                   
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

</script>