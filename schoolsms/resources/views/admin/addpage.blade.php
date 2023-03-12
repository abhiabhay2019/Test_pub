@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
        

        <!-- page content -->
        <div class="right_col" role="main">
    <div class="x_panel">
        <h3 class="text-center">Add & Update School Information</h3>
        <div class="col-sm-12">
            @if(session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{session('msg')}}</h3>
</div>
    
@endif
   
    <form action="{{url('/admin/addpage_info')}}" method="post">
                @csrf
                
                <!--<input type="hidden" name="feesid" id="feesid" value=""/>-->
            <div class="row form-group">
                <div class="col-sm-4 form-group">
                   <label for="schoolName">School Name</label>
                   <input type="text" name="schoolName" id="schoolName" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label for="contactName">Contact Name</label>
                   <input type="text" name="contactName" id="contactName" class="form-control" onkeyup="this.value=this.value.toUpperCase()" value="" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label for="contactMobile">Contact Mobile</label>
                   <input type="text" name="contactMobile" id="contactMobile" class="form-control" value="" autocomplete="off"/>
                </div>
                </div>
                <div class="row form-group">
                <div class="col-sm-4 form-group">
                   <label for="schoolAddress">School Address</label>
                   <textarea name="schoolAddress" id="schoolAddress" col="5" class="form-control"></textarea>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label for="schoolArea">School Area</label>
                   <input type="text" name="schoolArea" id="schoolArea" class="form-control" value="" autocomplete="off"/>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label for="schoolDistrict">School District</label>
                   <input type="text" name="schoolDistrict" id="schoolDistrict" class="form-control" value="" autocomplete="off"/>
                </div>
                </div>
                <div class="row form-group">
                <div class="col-sm-4 form-group">
                   <label for="schoolState">School State</label>
                   <input type="text" name="schoolState" id="schoolState" class="form-control" value="" autocomplete="off"/>
                </div>
                <div class="col-sm-2 form-group">
                   <label for="areaPincode">Area Pincode</label>
                   <input type="text" name="areaPincode" id="areaPincode" class="form-control" value="" autocomplete="off"/>
                </div>
                 <div class="col-sm-2 form-group">
                   <label for="areaPincode">Make Default</label>
                   <select name="defaultBranch" id="defaultBranch" class="form-control">
                       <option value="0">NO</option>
                       <option value="1">YES</option>
                   </select>
                </div>
                
                <div class="col-sm-4 form-group">
                   <label for="udiseNo">Udise No</label>
                   <input type="text" name="udiseNo" id="udiseNo" class="form-control" value="" autocomplete="off"/>
                </div>
                </div>
                <div class="row form-group">
                <div class="col-sm-4 form-group">
                   <label for="officialEmail">Official Email</label>
                   <input type="email" name="officialEmail" id="officialEmail" class="form-control" value="" autocomplete="off"/>
                </div>    
                <div class="col-sm-2 form-group">
                    <label for="attendanceTime1">Attendance Start Time</label>
                    <div class="col-sm-6">
                   <select name="attendanceTime1" id="attendanceTime1" class="form-control">

                       <option value="">HH</option>
                       @php
                       for($i=0; $i<24; $i++){
                        if($i < 10){
                            echo "<option value='0".$i."'>0".$i."</option>";
                        }else{
                        echo "<option value='".$i."'>".$i."</option>";
                        }
                       }
                       @endphp
                   </select>
                           
                       </div>
                    <div class="col-sm-6">
                        
                   <select name="attendanceTime11" id="attendanceTime11" class="form-control">

                       <option value="">MM</option>
                       @php
                       for($i=0; $i<60; $i++){
                        if($i < 10){
                            echo "<option value='0".$i."'>0".$i."</option>";
                        }else{
                        echo "<option value='".$i."'>".$i."</option>";
                        }
                       }
                       @endphp
                   </select>
                    </div>
                   
                </div>
                <div class="col-sm-2 form-group">
                   <label for="attendanceTime2">Attendance End Time</label>
                   <div class="col-sm-6">
                       <select name="attendanceTime2" id="attendanceTime2" class="form-control">

                       <option value="">HH</option>
                       @php
                       for($i=0; $i<24; $i++){
                        if($i < 10){
                            echo "<option value='0".$i."'>0".$i."</option>";
                        }else{
                        echo "<option value='".$i."'>".$i."</option>";
                        }
                       }
                       @endphp
                   </select>
                   </div>
                   <div class="col-sm-6">
                       <select name="attendanceTime22" id="attendanceTime22" class="form-control">

                       <option value="">MM</option>
                       @php
                       for($i=0; $i<60; $i++){
                        if($i < 10){
                            echo "<option value='0".$i."'>0".$i."</option>";
                        }else{
                        echo "<option value='".$i."'>".$i."</option>";
                        }
                       }
                       @endphp
                   </select>
                   </div>
                   
                </div>
                <div class="col-sm-2 form-group">
                   <label for="loginTime1">Login Start Time</label>
                   <div class="col-sm-6">
                       <select name="loginTime1" id="loginTime1" class="form-control">

                       <option value="">HH</option>
                       @php
                       for($i=0; $i<25; $i++){
                        if($i < 10){
                            echo "<option value='0".$i."'>0".$i."</option>";
                        }else{
                        echo "<option value='".$i."'>".$i."</option>";
                        }
                       }
                       @endphp
                   </select>
                   </div>
                   <div class="col-sm-6">
                       <select name="loginTime11" id="loginTime11" class="form-control">

                       <option value="">MM</option>
                       @php
                       for($i=0; $i<60; $i++){
                        if($i < 10){
                            echo "<option value='0".$i."'>0".$i."</option>";
                        }else{
                        echo "<option value='".$i."'>".$i."</option>";
                        }
                       }
                       @endphp
                   </select>
                   </div>
                   
                </div>
                <div class="col-sm-2 form-group">
                   <label for="loginTime2">Login End Time</label>
                   <div class="col-sm-6">
                <select name="loginTime2" id="loginTime2" class="form-control">

                       <option value="">HH</option>
                       @php
                       for($i=0; $i<24; $i++){
                        if($i < 10){
                            echo "<option value='0".$i."'>0".$i."</option>";
                        }else{
                        echo "<option value='".$i."'>".$i."</option>";
                        }
                       }
                       @endphp
                   </select>
                   </div>
                   <div class="col-sm-6">
                       <select name="loginTime22" id="loginTime22" class="form-control">

                       <option value="">MM</option>
                       @php
                       for($i=0; $i<60; $i++){
                        if($i < 10){
                            echo "<option value='0".$i."'>0".$i."</option>";
                        }else{
                        echo "<option value='".$i."'>".$i."</option>";
                        }
                       }
                       @endphp
                   </select>
                   </div>
                   
                </div>
                
                </div>
                <input type="submit" name="updateInfo" id="updateInfo" Value="Add & Update Info" class="btn classic-btn btn-sm form-control"/>
            </div>
            
            </form>
    
    
            
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