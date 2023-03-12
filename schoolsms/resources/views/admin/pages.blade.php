@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
<!-- page content -->
        <div class="right_col" role="main">
    <div class="row">
        <a href="addpage" class="btn classic-btn btn-sm glyphicon glyphicon-plus" style="float: right; padding: 10px;">&nbsp;Add Page Details&nbsp;</a>
        <div class="table-responsive">
            <table class="table table-bordered table-striped jambo_table bulk_action">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Title</th>
                    <th>Contact Name</th>
                    <th>Contact Mobile</th>
                    <th>Contact Email</th>
                    <th>Attendace Time</th>
                    <th>Login Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $sl = 1; @endphp
                @foreach($data as $info)
                <tr>
                    <td>{{$sl}}</td>
                    <td>{{$info->SCHOOL_NAME}}</td>
                    <td>{{$info->CONTACT_NAME}}</td>
                    <td>{{$info->CONTACT_MOBILE}}</td>
                    <td>{{$info->CONTACT_EMAIL}}</td>
                    <td>{{$info->ATTENDANCE_START_TIME}} - {{$info->ATTENDANCE_END_TIME}}</td>
                    <td>{{$info->LOGIN_START_TIME}} - {{$info->LOGIN_END_TIME}}</td>
                    <td><a href="addpage?pageid={{ $info->INFO_ID }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a></td>
                </tr>
                @php $sl++; @endphp
                @endforeach
            </tbody>
        </table>
        </div>
        
    </div>



    
</div>
        </div>
        <!-- /page content -->
@include('admin/footer1')
@include('admin/bottom_link')