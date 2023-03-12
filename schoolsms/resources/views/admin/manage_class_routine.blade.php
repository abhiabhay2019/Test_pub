@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
<!-- page content -->
        <div class="right_col" role="main">
   <div class="row form-group">
            @if(Session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{Session()->get('msg')}}</h3>
</div>
    
    @endif
    
   <div class="col-sm-offset-4 col-sm-4">
       <!--<select name="selectClass1" id="selectClass1" class="form-control selectClass">
           <option value="">Select Class</option>
       </select>-->
   </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped jambo_table bulk_action">
            <thead>
            <tr>
                <th>Days/Hrs</th>
                @php $hr = count($hrs); $sess = array(); @endphp
                @foreach($hrs as $key=>$hours)
                <th>({{$hours->START_TIME}})-({{$hours->END_TIME}}) Period {{$hours->TIME_ID}}</th>
                @php array_push($sess,$hours->TIME_ID); @endphp
                @endforeach
                </tr>
                </thead>
            @foreach($day as $key=>$days)
            <tr>
                <td>{{$days->DAY_NAME}}</td>
                @php
                for($i=0; $i < $hr; $i++)
                {
                @endphp
                <td><button class="btn classic-btn btn-sm" onclick="AddSubject('{{$days->DAY_NAME}}', '@php echo $sess[$i]; @endphp')">Add Subject</button></td>
                @php } @endphp
            </tr>
            @endforeach
        </table>
    </div>
</div>

<!---- add subject modal !-------->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Add Subject For <span id="dname"></span> &nbsp;(<span id="tname"></span>) &nbsp; <select name="selectClass" id="selectClass" class="form-control selectClass">
           <option value="">Select Class</option>
       </select></h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="{{url('admin/add_routine')}}" method="post" onsubmit="return checkForm();">
            @csrf
            <input type="hidden" name="period_id" id="period_id" value=""/>
            <input type="hidden" name="day_name" id="day_name" value=""/>
            <input type="hidden" name="class_id" id="class_id" value=""/>
            <div class="row">
                <div class="col-sm-8">
                <label>Enter Subject Name</label>
            <input type="text" name="subject_name" id="subject_name" class="form-control">    
                </div>
                <div class="col-sm-4">
                    <label>
                    &nbsp;
                    </label>
                    <input type="submit" name="add_sub" id="add_sub" value="Add Subject" class="form-control btn classic-btn btn-sm"> 
                </div>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
           $(".selectClass").append("<option value='"+result[i].CLASS_ID+"'>"+result[i].CLASS_NAME+"</option>");
            }
        }
    })
}

function AddSubject(dayname, hrs_id){
    var class_id = $("#selectClass option:selected").val();
    $("#dname").html(dayname);
    $("#tname").html(hrs_id);
    
    $("#period_id").val(hrs_id);
    $("#day_name").val(dayname);
    $("#class_id").val(class_id);
    $("#subject_name").val("");
    
    $("#myModal").modal("show");
}

function checkForm(){
   var period_id = $("#period_id").val();
   var day_name = $("#day_name").val();
   var class_id = $("#class_id").val();
   var subject_name = $("#subject_name").val();
   
   var class_id = $("#selectClass option:selected").val();
   $("#class_id").val(class_id);
   
       if(subject_name =='')
       {
       alert('Please Fill Subject Name');
       return false;
       }
       if(class_id =='')
       {
       alert('Please Fill Class Name');
       return false;
       }
       if(day_name =='')
       {
       alert('Please Fill Day Name');
       return false;
       }
       if(period_id =='')
       {
       alert('Please Fill Period');
       return false;
       }
  
   if(period_id !='' || day_name !='' || class_id !='' || subject_name !='')
   {
       return true;
   }
}
</script>