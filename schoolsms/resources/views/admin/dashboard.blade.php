@include('admin/top_link')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
@include('admin/left_bar')
@include('admin/header1')
        

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
           <div class="col-md-3 col-sm-6 text-center" style="margin-bottom: 0px; margin-top: 20px;">
               <span class="count_top"><i class="fa fa-user"></i> Total Student</span>
               <div style="font-size: 30px; line-height: 47px; font-weigth: 600;">{{$student[0]->TOTAL_STUDENT}}</div>
           </div>
           <div class="col-md-3 col-sm-6 text-center" style="margin-bottom: 0px; margin-top: 20px;">
               <span class="count_top"><i class="fa fa-user"></i> Total Staff</span>
               <div style="font-size: 30px; line-height: 47px; font-weigth: 600;">{{$staff[0]->TOTAL_STAFF}}</div>
           </div>
           <div class="col-md-3 col-sm-6 text-center" style="margin-bottom: 0px; margin-top: 20px;">
               <span class="count_top"><!--<i class="fa fa-user"></i>-->&#8377; Fee Collection</span>
               <div style="font-size: 30px; line-height: 47px; font-weigth: 600;">@php echo date('M'); @endphp &#8377; {{$fees[0]->TOTAL_FEES}}.00/-</div>
           </div>
           <div class="col-md-3 col-sm-6 text-center" style="margin-bottom: 0px; margin-top: 20px;">
               <span class="count_top"><i class="fa fa-user"></i> Present Staff</span>
               <div style="font-size: 30px; line-height: 47px; font-weigth: 600;">{{$pstaff[0]->TOTAL_PRESENT}}</div>
           </div>
          </div>
            <br/>


            
            <div class="row">
             
              <div class="col-md-3 col-sm-6">
                <div class="x_panel tile fixed_height_320">
                  <div class="x_title">
                    <h2>Student/Staff </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Overall</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 ">
                          <p class="">Users</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 ">
                          <p class="">Present</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                        <td>
                            <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                          </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Student </p>
                            </td>
                            <td>30%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Staff </p>
                            </td>
                            <td>10%</td>
                          </tr>
                          <!--<tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Blackberry </p>
                            </td>
                            <td>20%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Symbian </p>
                            </td>
                            <td>15%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Others </p>
                            </td>
                            <td>30%</td>
                          </tr>-->
                        </table>
                      </td>
                    </tr>
                  </table>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6 ">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>Student Volume </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="dashboard-widget-content">
                      <ul class="quick-list">
                        <li><i class="fa fa-user"></i><a href="#">Available Studnet</a></li>
                        
                      </ul>

                      <div class="sidebar-widget">
                        <h4>Available Studnet</h4>
                        <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                        <div class="goal-wrapper">
                          <span id="gauge-text" class="gauge-value gauge-chart pull-left">0</span>
                          <span class="gauge-value pull-left">%</span>
                          <span id="goal-text" class="goal-value pull-right">100%</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6 ">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>Staff Volume</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="dashboard-widget-content">
                      <ul class="quick-list">
                        <li><i class="fa fa-line-chart"></i><a href="#">Available Staff</a></li>
                        
                      </ul>

                      <div class="sidebar-widget">
                        <h4>Present Staff</h4>
                        <canvas width="150" height="80" id="chart_gauge_02" class="" style="width: 160px; height: 100px;"></canvas>
                        <div class="goal-wrapper">
                          <span id="gauge-text" class="gauge-value gauge-chart pull-left">0</span>
                          <span class="gauge-value pull-left">%</span>
                          <span id="goal-text" class="goal-value pull-right">100%</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6 ">
                <div class="x_panel fixed_height_320">
                  <div class="x_title">
                    <h2>Fee Collection</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="dashboard-widget-content">
                      <ul class="quick-list">
                        <li><i class="fa fa-line-chart"></i><a href="#">Fee Collection</a></li>
                        
                      </ul>

                      <div class="sidebar-widget">
                        <h4>Collections</h4>
                        <canvas width="150" height="80" id="chart_gauge_03" class="" style="width: 160px; height: 100px;"></canvas>
                        <div class="goal-wrapper">
                          <span class="gauge-value pull-left">$</span>
                          <span id="gauge-text2" class="gauge-value pull-left">3,200</span>
                          <span id="goal-text2" class="goal-value pull-right">$5,000</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        
        @include('admin/footer1')
        
        @include('admin/bottom_link')
