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
            <div class="x_panel">
    <div class="x_title">
    <h2 class="text-center">Update Student Data</h2>
    <div class="clearfix"></div>
    </div>
    <div class="x_content">
    @if(session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{session('msg')}}</h3>
</div>
    
    @endif
    <!--<div class="row">
        <div class="col-sm-4">
            
        </div>
        <div class="col-sm-4">
            
        </div>
        <div class="col-sm-4">
            
        </div>
    </div>-->
    @foreach($data as $list)
    <form action="{{url('/admin')}}/admission_process" method="post">
        @csrf
        <input type="hidden" name="sid" id="sid" value="{{$list->S_ID}}"/>
        <input type="hidden" name="session" value="{{session('sName')}}"/>
    <div class="row form-group">
        <div class="col-sm-4">
            <label>Enter Student Name</label>
            <input type="text" name="studentName" id="studentName" class="form-control" required onkeyup="this.value=this.value.toUpperCase();" value="{{$list->STUDENT_NAME}}"/>
        </div>
        <div class="col-sm-4">
            <label>Student Father Name</label>
            <input type="text" name="fatherName" id="fatherName" class="form-control" required onkeyup="this.value=this.value.toUpperCase();" value="{{$list->S_FATHER_NAME}}"/>
        </div>
        <div class="col-sm-4">
            <label>Student Mother Name</label>
            <input type="text" name="motherName" id="motherName" class="form-control" required onkeyup="this.value=this.value.toUpperCase();" value="{{$list->S_MOTHER_NAME}}"/>
        </div>
    </div>
    
    <div class="row form-group">
        <div class="col-sm-3">
            <label>Enter Date Of Birth</label>
            <input type="date" name="studentDOB" id="studentDOB" class="form-control" required value="{{$list->S_DOB}}"/>
        </div>
        <div class="col-sm-3">
            <label>Student Aadhar Number</label>
            <input type="number" name="studentAadhar" id="studentAadhar" class="form-control" value="{{$list->S_AADHAR_NUMBER}}"/>
        </div>
        <div class="col-sm-3">
            <label>Father Mobile Number</label>
            <input type="number" name="fatherMobile" id="fatherMobile" class="form-control" required value="{{$list->S_MOBILE}}"/>
        </div>
        <div class="col-sm-3">
            <label>Email</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{$list->S_EMAIL}}"/>
        </div>
    </div>
    
    <div class="row form-group">
        <div class="col-sm-4">
            <label>Nationality</label>
            <input type="text" name="nationality" id="nationality" class="form-control" required onkeyup="this.value=this.value.toUpperCase();" value="{{$list->S_NATIONALITY}}"/>
        </div>
        <div class="col-sm-4">
            <label>Religion</label>
            <input type="text" name="religion" id="religion" class="form-control" required onkeyup="this.value=this.value.toUpperCase();" value="{{$list->S_RELIGION}}"/>
        </div>
        <div class="col-sm-4">
            <label>Father Occupation</label>
            <input type="text" name="fatherOccupation" id="fatherOccupation" class="form-control" required onkeyup="this.value=this.value.toUpperCase();" value="{{$list->S_FATHER_OCCUPATION}}"/>
        </div>
    </div>
    
    <div class="row form-group">
        <div class="col-sm-4">
            <label>Select Class Name In Which Admission Is Taken</label>
            <select name="className" id="className" class="form-control">
                <option value="{{$list->CLASS_ID}}">{{$list->CLASS_NAME}}</option>
                <option value="">Select</option>
                @foreach($cdata as $clist)
                <option value="{{$clist->CLASS_ID}}">{{$clist->CLASS_NAME}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <label>Name of Submitted Document <small>If document more than one  use ',' comma for saperating</small></label>
            <input type="text" name="document" id="document" class="form-control" required onkeyup="this.value=this.value.toUpperCase();" value="{{$list->SUBMIT_DCUMENT_LIST}}"/>
        </div>
        <div class="col-sm-4">
           <label>Select Gender</label><br/>
           @if($list->S_GENDER =='MALE')
           <label>Male &nbsp;&nbsp;<input type="radio" name="gender" id="male" value="MALE" checked/></label>&nbsp;
           <label>Female &nbsp;&nbsp;<input type="radio" name="gender" id="female" value="FEMALE"/></label>&nbsp;
           @else
           <label>Male &nbsp;&nbsp;<input type="radio" name="gender" id="male" value="MALE"/></label>&nbsp;
           <label>Female &nbsp;&nbsp;<input type="radio" name="gender" id="female" value="FEMALE" checked/></label>&nbsp;
           @endif
        </div>
    </div>
    
    <div class="row form-group">
        <div class="col-sm-4">
            <label>Address</label>
            <textarea class="form-control" name="address" id="address" required onkeyup="this.value=this.value.toUpperCase();">{{$list->S_ADDRESS}}</textarea>
        </div>
        <div class="col-sm-4">
            <label>District </label>
            <input type="text" name="district" id="district" class="form-control" required onkeyup="this.value=this.value.toUpperCase();" value="{{$list->S_DISTRICT}}"/>
        </div>
        <div class="col-sm-2">
           <label>Pin Code</label><br/>
           <input type="number" name="pincode" id="pincode" class="form-control" required value="{{$list->S_PINCODE}}"/>
        </div>
        <div class="col-sm-2">
            
           <label>Admission Session</label><br/>
           <select name="admission_session" id="admission_session" class="form-control">
               @php
               if(date('m')>'03'){
               $Y = date('Y')."-".(date('y')+1);
               }else{
               $Y = (date('Y')-1)."-".date('y');
               }
               echo $Y;
               @endphp
               <option value="{{$list->ADMISSION_SESSION}}">{{$list->ADMISSION_SESSION}}</option>
               @php
               for($i=1; $i<=3;$i++){
               if(date('m')>'03'){
               $Year = (date('Y')-$i)."-".((date('y')-$i)+1);
               }else{
               $Year = ((date('Y')-$i)-1)."-".(date('y')-$i);
               }
               @endphp
               <option value="@php echo $Year; @endphp">@php echo $Year; @endphp</option>
               @php
               }
               @endphp
           </select>
           </div>
    </div>
    
     <div class="row form-group">
        <div class="col-sm-3">
            
        </div>
        <div class="col-sm-3">
            <button type="submit" class="btn classic-btn btn-sm form-control"><i class="glyphicon glyphicon-pencil"></i> &nbsp; Update Student</button>
         
        </div>
        <div class="col-sm-3">
            <a href="{{url('/admin')}}/manage-student" class="btn btn-sm btn-danger form-control">Cancel</a>
        </div>
        <div class="col-sm-3">
           
        </div>
    </div>
    </form>
    @endforeach
</div>
</div>
</div>
        </div>
        <!-- /page content -->
        
        @include('admin/footer1')
        
        @include('admin/bottom_link')