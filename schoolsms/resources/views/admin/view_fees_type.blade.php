@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
<!-- page content -->
        <div class="right_col" role="main">
    <div class="x_panel">
        
            @if(session()->has('msg'))
    
    <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <h3 class="text-center">{{session('msg')}}</h3>
</div>
    
    @endif
<a href="{{url('/admin')}}/fees-master" class="btn classic-btn btn-sm" style="margin-bottom: 10px;">Add Fee Type</a>
    <div class="form-group table-responsive">
        <table id="classListTbl" class="table table-striped jambo_table bulk_action">
               <thead>
                   <tr>
                       <th>Sl</th>
                       <th>Fees Type Name</th>
                       <th>Charges</th>
                       <th>Status</th>
                       <th>Action</th>
                   </tr>
               </thead>
               <tbody>
                   @php $sl = 1; @endphp
                   @foreach($data as $feesType)
                   <tr>
                       <td>{{$sl}}</td>
                       <td>{{$feesType->CLASS_NAME}}</td>
                       <td>{{$feesType->CHARGES}}</td>
                       <td>{{$feesType->FEES_STATUS}}</td>
                       <td><a href="edit-fees-type?feesid={{$feesType->CLASS_ID}}" class="btn classic-btn btn-sm">EDIT</a></td>
                   </tr>
                   @php $sl++; @endphp
                   @endforeach
               </tbody>
            </table>
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
    
    $(".alert").hide();
    
});

</script>