@include('admin/header')

<div class="container">
    <h1 class="text-center">Setup Your Website</h1>
    <!--<div class="row">
        <div class="col-sm-4">
            
        </div>
        <div class="col-sm-4">
            
        </div>
        <div class="col-sm-4">
            
        </div>
    </div>-->
    <form>
        @csrf
    <div class="row">
        <div class="col-sm-4">
            <label>Enter Your School Name</label>
            <input type="text" name="schoolName" id="schoolName" class="form-control"/>
        </div>
        <div class="col-sm-4">
            <label>Select School Address</label>
            <textarea name="schoolAdd" id="schoolAdd" class="form-control"></textarea>
        </div>
        <div class="col-sm-4">
            <label>Enter Your School Name</label>
            <input type="text" name="schoolName" id="schoolName" class="form-control"/>
        </div>
    </div>
    </form>
</div>

</body>
</html>
@include('admin/footer')