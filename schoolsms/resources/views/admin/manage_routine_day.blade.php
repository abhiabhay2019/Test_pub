@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
<!-- page content -->
        <div class="right_col" role="main">
    
    <div class="row">
        <div class="col-sm-6">
            <label>Routine Times</label>
        <table class="table table-hover table-striped table-responsive table-bordered">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Day_Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($data) != 0)
                @foreach($data as $key=>$notice)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $notice->DAY_NAME }}</td>
                    <td><a href="day-master?dayid={{ $notice->DAY_ID }}" class="btn classic-btn btn-sm">Edit</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {!! $data->links() !!}
    </div>
    <!------------------------ form bellow !------------------->
        <div class="col-sm-6">
            @if(Session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{Session()->get('msg')}}</h3>
</div>
    
    @endif
    
    @php $dayname =""; $endTime =""; $status =""; $message=""; $files=""; $id="";
    
    foreach($edit as $editdata)
    {
    $dayname =$editdata->DAY_NAME; $id=$editdata->DAY_ID;
    }
    @endphp
            <form action="{{url('/admin/addday')}}" method="post" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" name="dayid" id="dayid" value="{{$id}}"/>
            <div class="row form-group">
                <div class="col-sm-12 form-group">
                   <label>Routine Day</label>
                   <select name="dayName" id="dayName" class="form-control"/>
                   <option value="">Select Days</option>
                   <option value="Monday">Monday</option>
                   <option value="Tuesday">Tuesday</option>
                   <option value="Wednesday">Wednesday</option>
                   <option value="Thursday">Thursday</option>
                   <option value="Friday">Friday</option>
                   <option value="Saturday">Saturday</option>
                   <option value="Sunday">Sunday</option>
                   @if($dayname !='')
                   <option value="{{$dayname}}" selected>{{$dayname}}</option>
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
        <!-- /page content -->
        
        @include('admin/footer1')
        
        @include('admin/bottom_link')
@include('admin/footer')
<script>
$(document).ready(function(){
    
   // $(".alert").hide();
    
});

</script>