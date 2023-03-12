@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
        

        <!-- page content -->
        <div class="right_col" role="main">
    <div class="x_panel">
        <h3 class="text-center">ADD & UPDATE EMPLOYEE</h3>
        <div class="col-sm-12">
            @if(session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{session('msg')}}</h3>
</div>
    
@endif
    @if(isset($data) && !empty($data))
    @foreach($data as $value)
    
    
    <form action="{{url('/admin/addstaff')}}" method="post">
                @csrf
                <input type="hidden" name="staffid" id="staffid" value="{{$value->STAFF_ID}}"/>
                <!--<input type="hidden" name="feesid" id="feesid" value=""/>-->
            <div class="row form-group">
                <div class="col-sm-4 form-group">
                   <label>Employee Name</label>
                   <input type="text" name="empName" id="empName" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="{{$value->STAFF_NAME}}" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Employee Father Name</label>
                   <input type="text" name="empF_Name" id="empF_Name" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="{{$value->STAFF_FATHER_NAME}}" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Employee Mobile</label>
                   <input type="text" name="empMobile" id="empMobile" class="form-control" value="{{$value->STAFF_MOBILE}}" autocomplete="off"/>
                </div>
                </div>
                <div class="row form-group">
                <div class="col-sm-4 form-group">
                   <label>Employee Gender</label>
                   <select name="empGender" id="empGender" class="form-control">
                       <option value="{{$value->STAFF_GENDER}}">{{$value->STAFF_GENDER}}</option>
                       <option value="Male">Male</option>
                       <option value="Female">Female</option>
                   </select>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Date Of Birth</label>
                   <input type="date" name="empDOB" id="empDOB" class="form-control" value="{{$value->STAFF_DOB}}" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Employee Education</label>
                   <input type="text" name="empEducation" id="empEducation" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="{{$value->STAFF_QUALIFICATION}}" autocomplete="off"/>
                </div>
                </div>
                <div class="row form-group">
                <div class="col-sm-4 form-group">
                   <label>Employee Address</label>
                   <input type="text" name="empAddress" id="empAddress" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="{{$value->STAFF_ADDRESS}}" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Employee Area</label>
                   <input type="text" name="empArea" id="empArea" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="{{$value->STAFF_AREA}}" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Employee State</label>
                   <input type="text" name="empState" id="empState" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="{{$value->STAFF_STATE}}" autocomplete="off"/>
                </div>
                </div>
                <div class="row form-group">
                <div class="col-sm-2 form-group">
                   <label>Employee Status</label>
                   <select name="empStatus" id="empStatus" class="form-control">
                        <option value="{{$value->STAFF_STATUS}}">{{$value->STAFF_STATUS}}</option>
                       <option value="ACTIVE">ACTIVE</option>
                       <option value="DEACTIVE">DEACTIVE</option>
                   </select>
                </div>
                <div class="col-sm-2">
                <label>Employee Role</label>
                   <select name="empRole" id="empRole" class="form-control">
        <option value="{{$value->USER_ROLE}}">{{$value->ROLE_NAME}}</option>
    <option value="">Select Employee Role</option>
    @foreach($roles as $role)
    <option value="{{$role->ROLE_ID}}">{{$role->ROLE_NAME}}</option>
    @endforeach
                   </select>    
                </div>
                <div class="col-sm-4">
                   <label>Employee Email</label>
                   <input type="email" name="empEmail" id="empEmail" class="form-control" autocomplete="off" value="{{$value->USER_EMAIL}}"/>
                   
                </div>
                <div class="col-sm-4">
                   <label>Employee Login Password</label>
                   <input type="password" name="empPassword" id="empPassword" class="form-control" autocomplete="off"/>
                   <input type="hidden" name="old_password" id="old_password" value="{{$value->USER_PASSWORD}}"
                </div>
                </div>
                <input type="submit" name="addStaff" id="addStaff" Value="Add & Update Staff" class="btn classic-btn btn-sm form-control"/>
            </div>
            
            </form>
    @endforeach
    @else
    
   
    
    <form action="{{url('/admin/addstaff')}}" method="post">
                @csrf
                
                <!--<input type="hidden" name="feesid" id="feesid" value=""/>-->
            <div class="row form-group">
                <div class="col-sm-4 form-group">
                   <label>Employee Name</label>
                   <input type="text" name="empName" id="empName" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Employee Father Name</label>
                   <input type="text" name="empF_Name" id="empF_Name" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Employee Mobile</label>
                   <input type="text" name="empMobile" id="empMobile" class="form-control" value="" autocomplete="off"/>
                </div>
                </div>
                <div class="row form-group">
                <div class="col-sm-4 form-group">
                   <label>Employee Gender</label>
                   <select name="empGender" id="empGender" class="form-control">
                       <option value="Male">Male</option>
                       <option value="Female">Female</option>
                   </select>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Date Of Birth</label>
                   <input type="date" name="empDOB" id="empDOB" class="form-control" value="" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Employee Education</label>
                   <input type="text" name="empEducation" id="empEducation" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="" autocomplete="off"/>
                </div>
                </div>
                <div class="row form-group">
                <div class="col-sm-4 form-group">
                   <label>Employee Address</label>
                   <input type="text" name="empAddress" id="empAddress" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Employee Area</label>
                   <input type="text" name="empArea" id="empArea" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label>Employee State</label>
                   <input type="text" name="empState" id="empState" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="" autocomplete="off"/>
                </div>
                </div>
                <div class="row form-group">
                <div class="col-sm-2 form-group">
                   <label>Employee Status</label>
                   <select name="empStatus" id="empStatus" class="form-control">

                       <option value="ACTIVE">ACTIVE</option>
                       <option value="DEACTIVE">DEACTIVE</option>
                   </select>
                </div>
                <div class="col-sm-2">
                <label>Employee Role</label>
                   <select name="empRole" id="empRole" class="form-control">
    <option value="">Select Employee Role</option>
     @foreach($roles as $role)
    <option value="{{$role->ROLE_ID}}">{{$role->ROLE_NAME}}</option>
    @endforeach
                   </select>    
                </div>
                <div class="col-sm-4">
                   <label>Employee Email</label>
                   <input type="email" name="empEmail" id="empEmail" class="form-control" autocomplete="off" value=""/>
                   
                </div>
                <div class="col-sm-4">
                   <label>Employee Login Password</label>
                   <input type="password" name="empPassword" id="empPassword" class="form-control" autocomplete="off"/>
                </div>
                </div>
                <input type="submit" name="addStaff" id="addStaff" Value="Add & Update Staff" class="btn classic-btn btn-sm form-control"/>
            </div>
            
            </form>
    
    @endif
            
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
    
});

</script>