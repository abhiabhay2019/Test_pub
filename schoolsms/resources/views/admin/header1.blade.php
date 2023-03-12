<!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                
                <ul class=" navbar-right">
                    <li class="nav-item"><a href="{{url('/admin')}}/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                     @if(session(0)->USER_ROLE != 'ADMIN')
                    <li class="nav-item"><a href="#"><i class="fa fa-user"></i>&nbsp;
                      {{session('sName')}}</a>&nbsp;&nbsp;</li>
                   @else
                  <li class="nav-item dropdown open" style="padding-left: 15px; padding-right: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;
                      {{session('sName')}}&nbsp;&nbsp;
                      <i class="fa fa-cog"></i>
                    </a>
                    
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{url('/admin')}}/fees-master">Fees Master</a>
                    <a class="dropdown-item" href="{{url('/admin')}}/view-fees-type">View Fees Master</a>
                    <a class="dropdown-item" href="{{url('/admin')}}/role-master">Manage Role</a>
                    <a class="dropdown-item" href="{{url('/admin')}}/user-master">Manage Control</a>
                    <a class="dropdown-item" href="{{url('/admin')}}/time-master">Routine Time</a>
                    <!--<a class="dropdown-item" href="{{url('/admin')}}/day-master">Routine Day</a>-->
                    <a class="dropdown-item" href="{{url('/admin')}}/routine-master">Routine Master</a>
                    <a class="dropdown-item" href="{{url('/admin')}}/manage-header">Manage Header</a>
                    <a class="dropdown-item" href="{{url('/admin')}}/manage-pages">Page Setup</a>
                    <a class="dropdown-item" href="{{url('/admin')}}/deactive-list">Deactive List</a>
                    </div>
                    @endif
                  </li>
  
                </ul>
              </nav>
                
            </div>
                
          </div>
          
        <!-- /top navigation -->