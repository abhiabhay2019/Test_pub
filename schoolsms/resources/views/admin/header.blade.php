<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin || Zone</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('../public/calendar_assets/calendar.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{asset('../public/front/chart_js/chart.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<style>
	.navbar{
	/*	margin-top: 20px;*/
	}
	
	body{
  position: relative;
  display: block;
  height: 100vh;
  /*overflow-y: scroll;*/
}

.navbar{
  top: 0px;
}

#footer-div{
    margin: 0px;
    width: 100%;
    margin: 0px;
    padding: 0px;
}
.footer-bs {
    background-color: #3c3d41;
	padding: 60px 40px;
	color: rgba(255,255,255,1.00);
	margin-top: 0px;
	border-bottom-right-radius: 6px;
	border-top-left-radius: 0px;
	border-bottom-left-radius: 6px;
}
.footer-bs .footer-brand, .footer-bs .footer-nav, .footer-bs .footer-social, .footer-bs .footer-ns { padding:10px 25px; }
.footer-bs .footer-nav, .footer-bs .footer-social, .footer-bs .footer-ns { border-color: transparent; }
.footer-bs .footer-brand h2 { margin:0px 0px 10px; }
.footer-bs .footer-brand p { font-size:12px; color:rgba(255,255,255,0.70); }

.footer-bs .footer-nav ul.pages { list-style:none; padding:0px; }
.footer-bs .footer-nav ul.pages li { padding:5px 0px;}
.footer-bs .footer-nav ul.pages a { color:rgba(255,255,255,1.00); font-weight:bold; text-transform:uppercase; }
.footer-bs .footer-nav ul.pages a:hover { color:rgba(255,255,255,0.80); text-decoration:none; }
.footer-bs .footer-nav h4 {
	font-size: 11px;
	text-transform: uppercase;
	letter-spacing: 3px;
	margin-bottom:10px;
}

.footer-bs .footer-nav ul.list { list-style:none; padding:0px; }
.footer-bs .footer-nav ul.list li { padding:5px 0px;}
.footer-bs .footer-nav ul.list a { color:rgba(255,255,255,0.80); }
.footer-bs .footer-nav ul.list a:hover { color:rgba(255,255,255,0.60); text-decoration:none; }

.footer-bs .footer-social ul { list-style:none; padding:0px; }
.footer-bs .footer-social h4 {
	font-size: 11px;
	text-transform: uppercase;
	letter-spacing: 3px;
}
.footer-bs .footer-social li { padding:5px 4px;}
.footer-bs .footer-social a { color:rgba(255,255,255,1.00);}
.footer-bs .footer-social a:hover { color:rgba(255,255,255,0.80); text-decoration:none; }

.footer-bs .footer-ns h4 {
	font-size: 11px;
	text-transform: uppercase;
	letter-spacing: 3px;
	margin-bottom:10px;
}
.footer-bs .footer-ns p { font-size:12px; color:rgba(255,255,255,0.70); }

@media (min-width: 768px) {
	.footer-bs .footer-nav, .footer-bs .footer-social, .footer-bs .footer-ns { border-left:solid 1px rgba(255,255,255,0.10); }
}
</style>
</head>
<body>

 <nav class="navbar navbar-inverse" id="mNavbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="dashboard" class="navbar-brand">IPS</a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class=""><a href="dashboard">Dashboard</a></li>
               
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Student Management <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('/admin')}}/add-student">Add Student</a></li>
                        <li><a href="{{url('/admin')}}/manage-student">Manage Student</a></li>
                        <li><a href="manage-notices">Notice</a></li>
                        <li><a href="manage-events">Events</a></li>
                        
                    </ul>
                </li>
                
                
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Manage Classes <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="add-class">Add Class</a></li>
                        <li><a href="show-routine">Class Wise Routtine</a></li>
                        <li><a href="#">Add S Attendance</a></li>
                        <li><a href="#">Students Results</a></li>
                        
                    </ul>
                </li>
                
                
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Manage Staff <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('/admin')}}/add-staff">Add Staff</a></li>
                        <li><a href="{{url('/admin')}}/view-staff">Manage Staff</a></li>
                       
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Attendance<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Students Attendance Reports</a></li>
                        <li><a href="{{url('/admin/staff-attendance')}}">Mark Attendance</a></li>
                        <li><a href="{{url('/admin/staff-attendance-report')}}">Attendance Reports</a></li>
                      
                       
                    </ul>
                </li>
            
                
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Manage Accounts <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('/admin')}}/add-fees">Add Fees</a></li>
                        <li><a href="{{url('/admin')}}/fees-reports">View Fees Reports</a></li>
                        <li><a href="{{url('/admin')}}/pending-fees">View Pending Fees</a></li>
                        <li><a href="{{url('/admin')}}/student-fees">Student Wise Fees</a></li>
                        <li><a href="#">Manage Staff Salary</a></li>
                       
                    </ul>
                </li>
            </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> {{session('sName')}}</a></li>
      <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="glyphicon glyphicon-cog"></span> Settings <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('/admin')}}/fees-master">Fees Master</a></li>
                        <li><a href="{{url('/admin')}}/view-fees-type">View Fees Master</a></li>
                        <li><a href="{{url('/admin')}}/role-master">Manage Role</a></li>
                        <li><a href="{{url('/admin')}}/time-master">Routine Time</a></li>
                        <!--<li><a href="{{url('/admin')}}/day-master">Routine Day</a></li>-->
                        <li><a href="{{url('/admin')}}/routine-master">Routine Master</a></li>
                        <li><a href="{{url('/admin')}}/manage-header">Manage Header</a></li>
                    </ul>
                </li>
      <li><a href="{{url('/admin')}}/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>