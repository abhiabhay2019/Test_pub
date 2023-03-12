@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')

<!-- page content -->
        <div class="right_col" role="main">
    
    @if(session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{session('msg')}}</h3>
</div>
    
    @endif
    <div class="x_panel">
        <h3 class="text-center">Manage Student</h3>
        <!--<div class="row">-->
            <form>
                @csrf
            <div class="col-md-4 col-sm-12 form-group">
                <lable>Search By Class</lable>
                <select name="ClassName" id="ClassName" class="form-control">
                    <option value="">Select Class</option>
                </select>
            </div>
             <div class="col-md-4 col-sm-12 form-group">
                <lable>Enter Text To Search</lable>
                <input type="text" name="wildSearch" id="wildSearch" placeholder="Enter Text To Search" class="form-control" value=""/>
            </div>
             <div class="col-md-4 col-sm-12 form-group">
                 <br/>
                 <input type="submit" name="searchBtn" id="searchBtn" value="Search" class="btn classic-btn btn-sm"/>
                 </form>
                 <input type="button" name="resetBtn" id="resetBtn" value="Clear Search" class="btn btn-danger btn-sm" onclick="clearSearch()"/>
                 
                <a href="add-student" class="btn classic-btn btn-sm glyphicon glyphicon-plus" style="float: right; margin-bottom: 10px;">&nbsp;Add Student</a>
            </div>
        <!--</div>-->
        
        
        <table class="table table-hover table-bordered table-responsive table-striped">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Adm_No</th>
                    <th>Student Name</th>
                    <th>Father's Name</th>
                    <th>Mother Name</th>
                    <th>DateOfBirth</th>
                    <th>Father Mobile</th>
                    <th>Admisson Class</th>
                    <th>Admisson Status</th>
                    <th>Admisson Date</th>
                    <th>Admisson Time</th>
                    <th>Admisson TakenBy</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $sl = 1;
                 @endphp
                @foreach($data as $list)
                <tr>
                    <td>{{$sl}}</td>
                    <td>{{$list->ADMISSION_NO}}</td>
                    <td>{{$list->STUDENT_NAME}}</td>
                    <td>{{$list->S_FATHER_NAME}}</td>
                    <td>{{$list->S_MOTHER_NAME}}</td>
                    <td>{!! date('d-m-Y', strtotime($list->S_DOB)) !!}</td>
                    <td>{{$list->S_MOBILE}}</td>
                    <td>{{$list->CLASS_NAME}}</td>
                    <td>{{$list->S_STATUS}}</td>
                    <td>{!! date('d-m-Y', strtotime($list->ADMISSION_DATE)) !!}</td>
                    <td>{{$list->ADMISSION_TIME}}</td>
                    <td>{{$list->CREATED_BY}}</td>
                    <td><a href="edit-student/{{$list->S_ID}}" class="btn classic-btn btn-sm glyphicon glyphicon-edit"></a></td>
                    @if($list->S_STATUS == 'ACTIVE')
                    <td><a href="delete-student/{{$list->S_ID}}/DEACTIVE" class="btn classic-btn btn-sm glyphicon glyphicon-remove"></a></td>
                    @else
                    <td><a href="active-student/{{$list->S_ID}}/ACTIVE" class="btn classic-btn btn-sm glyphicon glyphicon-pencil"></a></td>
                    @endif
                </tr>
                @php
                $sl++
                @endphp
                @endforeach
               
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
</div>


    
</div>
</div>
        <!-- /page content -->
        @include('admin/footer1')
        
        @include('admin/bottom_link')
<script>
$(document).ready(function(){
    GetClassList();
    
    
});

function GetClassList(){
     $.ajax({
        url:'class_list',
        data:'GetActive=GetActive',
        dataType:'Json',
        success:function(result){
            //alert(result)
            for(var i = 0; i < result.length; i++)
            {
           $("#ClassName").append("<option value='"+result[i].CLASS_ID+"'>"+result[i].CLASS_NAME+"</option>");
            }
            
            var url_string = location;
   // alert(url_string)
    var url = new URL(url_string);
    var className = url.searchParams.get("ClassName");
    var wildSearch = url.searchParams.get("wildSearch");
    
    var pos = parseInt(className)-1;
    
    $("#ClassName").append("<option selected value='"+className+"'>"+result[pos].CLASS_NAME+"</option>");
    $("#wildSearch").val(wildSearch);
    
        }
    })
}

function clearSearch(){
    window.open("http://schoolms.softdevloper.com/admin/manage-student","_self");
}
</script>
