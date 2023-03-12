@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
        

        <!-- page content -->
        <div class="right_col" role="main">
            <form action="{{url('/admin/student_wise')}}" method="post">
            @csrf
    <div class="row text-center">
        
        <div class="col-md-2 col-sm-12 form-group">
            <label>Year <small> Four digit year (YYYY)</small></label>
            <input type="number" name="fees_year" id="fees_year" class="form-control" required/>
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label>Admission Number</label>
            <input type="number" name="adm_number" id="adm_number" class="form-control" required/>
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <br/>
            <input type="submit" name="get_data" id="get_data" class="btn classic-btn btn-sm" value="Search"/>
            <a href="{{url('/admin')}}/student-fees" name="reset" id="reset" class="btn btn-danger btn-sm">Reste</a>
        </div>
        
    </div>
    </form>
    <!---- div for student permanent Info !---->
    <h4 class="text-center">Student Information</h4>
    <div class="row text-center">
        
        <div class="col-md-12 col-sm-12  form-group table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr>
                <th class="text-center">Admission No</th>
                <th class="text-center">Student Name</th>
                <th class="text-center">Father Name</th>
                <th class="text-center">Mobile No</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                @php if(isset($sdata) && isset($sdata[0])){ @endphp
                <td>{{$sdata[0]->ADMISSION_NO}}</td>
               @php } @endphp
               
               
                @php if(isset($sdata) && isset($sdata[0])){ @endphp
                <td>{{$sdata[0]->STUDENT_NAME}}</td>
               @php } @endphp
               
               
               
                @php if(isset($sdata) && isset($sdata[0])){ @endphp
                <td>{{$sdata[0]->S_FATHER_NAME}}</td>
               @php } @endphp
               
               
                @php if(isset($sdata) && isset($sdata[0])){ @endphp
                <td>{{$sdata[0]->S_MOBILE}}</td>
               @php } @endphp
                
            </tr>
            </tbody>
        </table>
        </div>
    </div>
    <!---- div for Month Name and fees data !---->
    <h4 class="text-center">Fees Information</h4>
    <div class="row text-center">
        
        <div class="col-md-12 col-sm-12 form-group table-responsive">
           
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="text-center">
                    <th class="text-center">Fees Year</th>
                    <th class="text-center">Month Name</th>
                    <th class="text-center">Fees Status</th>
                    <th class="text-center">Fee Amount</th>
                    <th class="text-center">Payment Date</th>
                </tr>
            </thead>
            <tbody>
                @php if(isset($fees_arr)){ @endphp
              @php for($i=0; $i < count($fees_arr); $i++){ @endphp
              <input type="hidden" name="sid_{{$i}}" id="sid_sid_{{$i}}" value="{{$fees_arr[$i]['student_id']}}"/>
        <input type="hidden" name="year_{{$i}}" id="year_{{$i}}" value="{{$fees_arr[$i]['year']}}"/>
             @if($fees_arr[$i]['status'] == 'DONE')
             <tr style="background-color: lightgreen;">
                  <td>{{$fees_arr[$i]['year']}}</td>
                  <td>{{$fees_arr[$i]['month']}}</td>
                  @if($fees_arr[$i]['status'] == '')
                 <td>PENDING</td>
                 @else
                  <td>{{$fees_arr[$i]['status']}}</td>
                  
                  @endif
                  
                  <td>{{$fees_arr[$i]['amount']}}</td>
                  <td>{{$fees_arr[$i]['fdate']}}</td>
              </tr>
             @else
              <tr>
                  <td>{{$fees_arr[$i]['year']}}</td>
                  <td>{{$fees_arr[$i]['month']}}</td>
                  @if($fees_arr[$i]['status'] == '')
                 <td>PENDING</td>
                 @else
                  <td>{{$fees_arr[$i]['status']}}</td>
                  
                  @endif
                  
                  <td>{{$fees_arr[$i]['amount']}}</td>
                  <td>{{$fees_arr[$i]['fdate']}}</td>
              </tr>
             @endif
              @php  } } @endphp
            </tbody>
        </table>
    </div>
   </div>
</div>
        </div>
        <!-- /page content -->
        
        @include('admin/footer1')
        
        @include('admin/bottom_link')
<script>
$(document).ready(function(){
  var query_sid =$("#sid_sid_0").val();
  var query_year =$("#year_0").val();
  
  $("#adm_number").val(query_sid);
  $("#fees_year").val(query_year);
})
</script>