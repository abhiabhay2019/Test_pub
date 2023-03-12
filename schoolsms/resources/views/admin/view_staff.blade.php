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
   
            @if(Session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{Session()->get('msg')}}</h3>
</div>
    
    @endif
    
    
    
        <div class="row">
            <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-striped jambo_table bulk_action">
                <thead>
                    <tr>
                        <td>Sl</td>
                        <td>Staff Name</td>
                        <td>Staff Mobile</td>
                        <td>Staff Area</td>
                        <td>Staff Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <!------- data will show dynamically !----->
                    @if(!empty($data) && $data->count())
                    @php $i = 1; @endphp
                @foreach($data as $key => $value)
                    <tr>
                        <td>@php echo $i; @endphp</td>
                        <td>{{ $value->STAFF_NAME}}</td>
                        <td>{{ $value->STAFF_MOBILE}}</td>
                        <td>{{ $value->STAFF_AREA}}</td>
                        <td>{{ $value->STAFF_STATUS}}</td>
                        <td>
                            <a href="{{url('/admin')}}/add-staff?staffID={{$value->STAFF_ID}}" title="Edit Staff"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="javascript:void(0)" class="text-danger"  onclick="deactive('{{$value->STAFF_ID}}')" title="De-Active Staff"><i class="glyphicon glyphicon-trash"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="javascript:void(0)" class="text-success" title="Add Salary"><i class="fa fa-money"></i></a>
                            </td>
                    </tr>
                    @php $i++; @endphp
                @endforeach
            @else
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif
                </tbody>
            </table> 
            {!! $data->links() !!}
            </div>
        </div>
</div>
</div>

        @include('admin/footer1')
        
        @include('admin/bottom_link')
        
<script>
    function deactive(sid){
        $.ajax({
            url:'remove_staff',
            data:'remove_staff=true&sid='+sid,
            dataType:'Json',
            success:function(res){
                alert(res.msg);
                window.location.href='';
            }
        })
    }
    
    function active(sid){
        $.ajax({
            url:'remove_staff',
            data:'join_staff=true&sid='+sid,
            dataType:'Json',
            success:function(res){
                alert(res.msg);
                window.location.href='';
            }
        })
    }
</script>        