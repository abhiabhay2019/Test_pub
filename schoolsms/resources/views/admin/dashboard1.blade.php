@include('admin/header')

<div class="">
		
<ul class="breadcrumb">
<li><a href="{{url('/admin')}}/dashboard" class="active">Home</a></li>

</ul>

</div>

<div class="container">
    <div class="row form-group">
  <div class="col-sm-3 well" style="background-color: #FA7D52;">
    <div class="card text-center">
        <div class="card-body">
            <h3 class="card-title">Total Student</h3>
            
            <p class="card-text">{{$student[0]->TOTAL_STUDENT}}</p>
            <a href="{{url('/admin')}}/manage-student" class="btn btn-primary">View More</a>
        </div>
    </div>
  </div>
  
  <div class="col-sm-3 well" style="background-color: #FBFCFC;">
    <div class="card text-center">
        <div class="card-body">
            <h3 class="card-title">Total Staff</h3>
            <p class="card-text">{{$staff[0]->TOTAL_STAFF}}</p>
            <a href="{{url('/admin')}}/view-staff" class="btn btn-primary">View More</a>
        </div>
    </div>
  </div>
  
  <div class="col-sm-3 well" style="background-color: #7DCEA0;">
    <div class="card text-center">
        <div class="card-body">
            <h3 class="card-title">Fee Collection</h3>
            <p class="card-text">@php echo date('M'); @endphp &#8377; {{$fees[0]->TOTAL_FEES}}.00/-</p>
            <a href="{{url('/admin')}}/fees-reports" class="btn btn-primary">View More</a>
        </div>
    </div>
  </div>
  
  <div class="col-sm-3 well" style="background-color: #F7DC6F;">
    <div class="card text-center">
        <div class="card-body">
            <h3 class="card-title">Present Staff</h3>
            <p class="card-text">{{$pstaff[0]->TOTAL_PRESENT}}</p>
            <a href="{{url('/admin')}}/view-staff" class="btn btn-primary">View More</a>
        </div>
    </div>
  </div>
  
</div>
<!---- row close !--->

<div class="row form-group">
    <div class="col-sm-6">
        <div class="row form-group" style="padding: 10px;">
          <canvas id="myChart" style="height: 100%; width: 100%;">
          <!---- chart create dynamically !--->  
        </canvas>  
        </div>
        <div class="row form-group">
            <label style="background-color:#5BDE2E; padding: 5px;">Total Student &nbsp; &nbsp;<span id="student">{{$student[0]->TOTAL_STUDENT}}</span></label>
            <label style="background-color:#F00D0A; padding: 5px;">Total Staff &nbsp; &nbsp;<span id="staff">{{$staff[0]->TOTAL_STAFF}}</span></label>
            <label style="background-color:#BFE2FA; padding: 5px;">Total Fee Count &nbsp; &nbsp;<span id="fees">{{$fees[0]->TOTAL_FEES_COUNT}}</span></label>
            <label style="background-color:#E5E8EA; padding: 5px;">Persent Staff &nbsp; &nbsp;<span id="pstaff">{{$pstaff[0]->TOTAL_PRESENT}}</span></label>
        </div>
    </div>
    
    <div class="col-sm-6">
        <div class="row form-group text-center">
            <label>Total Received Fees By Monts</label>
            <input type="hidden" id="student" value="{{$student[0]->TOTAL_STUDENT}}"/>
            
        </div>
        <div class="row form-group">
          <canvas id="myChart1" style="height: 100%; width: 100%;">
          <!---- chart create dynamically !--->  
        </canvas>  
        </div>
        
    </div>
</div>
</div>

</body>
</html>

@include('admin/footer')
<script>
    $(document).ready(function(){
        getChart();
        getChart1();
    })
    
    function getChart() {
        
    var ctx = document.getElementById("myChart").getContext("2d");

    var student_count = document.getElementById("student").innerHTML;
    var staff_count = document.getElementById("staff").innerHTML;
    var fee_count = document.getElementById("fees").innerHTML;
    var current_staff = document.getElementById("pstaff").innerHTML;

    // Creating Chart Class Object
    var myChart = new Chart(ctx, {
      // Type of Chart - bar, line, pie, doughnut, radar, polarArea
      type: "doughnut",

      // The data for our dataset
      data: {
        // Data Labels
        labels: ["Total Student", "Total Staff", "Fee Count This Month", "Persent Staff"],

        datasets: [
          // Data Set 1
          {
            //  Chart Label
            label: "School Data",

            // Actual Data
            data: [student_count, staff_count, fee_count, current_staff],

            // Background Color
            backgroundColor: [
              "#5BDE2E",
              "#F00D0A",
              "#BFE2FA",
              "#E5E8EA",
            ],

            // Border Color
            borderColor: [
              "#5BDE2E",
              "#F00D0A",
              "#BFE2FA",
              "#E5E8EA",
            ],

            // Border Width
            borderWidth: 1,
          },
        ],
      },

      // Configuration options go here
      options: {
        // Set Responsiveness By Default Its True
        // When Its True Canvas Width Height won't work
        responsive: false,

        // Set Padding
        layout: {
          padding: {
            left: 0,
            right: 50,
            top: 0,
            bottom: 0,
          },
        },

        // Configure ToolTips
        tooltips: {
          enabled: true, // Enable/Disable ToolTip By Default Its True
          backgroundColor: "red", // Set Tooltip Background Color
          titleFontFamily: "Comic Sans MS", // Set Tooltip Title Font Family
          titleFontSize: 30, // Set Tooltip Font Size
          titleFontStyle: "bold italic",
          titleFontColor: "yellow",
          titleAlign: "center",
          titleSpacing: 3,
          titleMarginBottom: 50,
          bodyFontFamily: "Comic Sans MS",
          bodyFontSize: 20,
          bodyFontStyle: "italic",
          bodyFontColor: "black",
          bodyAlign: "center",
          bodySpacing: 3,
        },

        // Custom Chart Title
        /* title: {
           display: true,
           text: "Project Tracker",
           position: "bottom",
           fontSize: 25,
           fontFamily: "Comic Sans MS",
           fontColor: "red",
           fontStyle: "bold italic",
           padding: 20,
           lineHeight: 10,
         },*/

        // Legends Configuration
        legend: {
          display: false,
          position: "bottom", // top left bottom right
          align: "end", // start end center
          labels: {
            fontColor: "red",
            fontSize: 16,
            boxWidth: 20,
          },
        },

        animation: {
          duration: 3000,
          easing: "easeInOutBounce",
        },

        // We have Three Events - events which take string array, onHover and Onclick which take function
        // Example of events
        // This chart will not respond to mousemove, etc
        // mousemove, mouseout, click, touchstart, touchmove
        // events: ["click"],

        // onClick Example
        // onClick: function () {
        //   console.log("On Click");
        // },

        // onHover Example - It will work
        // onHover: function () {
        //   console.log("On Hover");
        // },
      },
    });
  }
  
  
  function getChart1() {
        
    var ctx = document.getElementById("myChart1").getContext("2d");

    //var JanCount = document.getElementById("student").innerHTML;
    var JanCount = 28000;
    var FabCount = 30000;
    var MarCount = 20000;
    var AprCount = 35000;
    var MayCount = 25000;
    var JunCount = 40000;
    var JulCount = 45000;
    var AugCount = 25000;
    var SepCount = 38000;
    var OctCount = 43000;
    var NovCount = 46000;
    var DecCount = 50000;
    
    // Creating Chart Class Object
    var myChart = new Chart(ctx, {
      // Type of Chart - bar, line, pie, doughnut, radar, polarArea
      
      type: "bar",

      // The data for our dataset
      data: {
        // Data Labels
        labels: ['Jan','Fab','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],

        datasets: [
          // Data Set 1
          {
            //  Chart Label
            label: "School Data",

            // Actual Data
            data: [JanCount, FabCount, MarCount, AprCount, MayCount, JunCount, JulCount, AugCount, SepCount, OctCount, NovCount, DecCount,0],

            // Background Color
            backgroundColor: [
              "#5BDE2E",
              "#F00D0A",
              "#BFE2FA",
              "#E5E8EA",
              "red",
              "green",
              "blue",
              "orange",
              "yellow",
              "brown",
              "tomato",
            ],

            // Border Color
            borderColor: [
              "#5BDE2E",
              "#F00D0A",
              "#BFE2FA",
              "#E5E8EA",
            ],

            // Border Width
            borderWidth: 2,
          },
        ],
      },

      // Configuration options go here
      options: {
        // Set Responsiveness By Default Its True
        // When Its True Canvas Width Height won't work
        responsive: true,

        // Set Padding
        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0,
          },
        },

        // Configure ToolTips
        tooltips: {
          enabled: true, // Enable/Disable ToolTip By Default Its True
          backgroundColor: "red", // Set Tooltip Background Color
          titleFontFamily: "Comic Sans MS", // Set Tooltip Title Font Family
          titleFontSize: 30, // Set Tooltip Font Size
          titleFontStyle: "bold italic",
          titleFontColor: "yellow",
          titleAlign: "center",
          titleSpacing: 3,
          titleMarginBottom: 50,
          bodyFontFamily: "Comic Sans MS",
          bodyFontSize: 20,
          bodyFontStyle: "italic",
          bodyFontColor: "black",
          bodyAlign: "center",
          bodySpacing: 3,
        },

        // Custom Chart Title
        /* title: {
           display: true,
           text: "Project Tracker",
           position: "bottom",
           fontSize: 25,
           fontFamily: "Comic Sans MS",
           fontColor: "red",
           fontStyle: "bold italic",
           padding: 20,
           lineHeight: 10,
         },*/

        // Legends Configuration
        legend: {
          display: false,
          position: "bottom", // top left bottom right
          align: "end", // start end center
          labels: {
            fontColor: "red",
            fontSize: 16,
            boxWidth: 20,
          },
        },

        animation: {
          duration: 3000,
          easing: "easeInOutBounce",
        },

        // We have Three Events - events which take string array, onHover and Onclick which take function
        // Example of events
        // This chart will not respond to mousemove, etc
        // mousemove, mouseout, click, touchstart, touchmove
        // events: ["click"],

        // onClick Example
        // onClick: function () {
        //   console.log("On Click");
        // },

        // onHover Example - It will work
        // onHover: function () {
        //   console.log("On Hover");
        // },
      },
    });
  }
</script>