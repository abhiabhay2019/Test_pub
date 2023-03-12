    
    <!-- jQuery -->
    <script src="{{ URL::asset('public/public/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
   <script src="{{ URL::asset('public/public/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('public/public/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ URL::asset('public/public/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{ URL::asset('public/public/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- jQuery Sparklines -->
    <script src="{{ URL::asset('public/public/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- morris.js -->
    <script src="{{ URL::asset('public/public/raphael/raphael.min.js')}}"></script>
    <script src="{{ URL::asset('public/public/morris.js/morris.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{ URL::asset('public/public/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ URL::asset('public/public/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{ URL::asset('public/public/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{ URL::asset('public/public/Flot/jquery.flot.js')}}"></script>
    <script src="{{ URL::asset('public/public/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ URL::asset('public/public/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{ URL::asset('public/public/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ URL::asset('public/public/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{ URL::asset('public/public/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{ URL::asset('public/public/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{ URL::asset('public/public/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{ URL::asset('public/public/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ URL::asset('public/public/moment/min/moment.min.js')}}"></script>
    <script src="{{ URL::asset('public/public/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ URL::asset('public/public/build/js/custom.min.js')}}"></script>

  </body>
</html>

<script>
        $(document).ready(function(){
            get_head_list();
            get_current_url();
        });
        
        function get_head_list(){
           var role_id = $("#USER_ROLE").val();
           $("#side_bar").html('<li><a href="../dashboard"><i class="fa fa-home"></i> Home </a></li>');
            $.ajax({
                url:'get-headlist',
                data:'list_head=true&role_id='+role_id,
                dataType:'Json',
                success:function(res){
                    
                    if(res.length ==0){
                        $("#side_bar").html('<li><a href="dashboard"><i class="fa fa-home"></i> Home </a></li>');
                    }else{
                        var lists = '';
                        for(var i = 0; i < res.length; i++){
                            if(i == 0){
                            lists +='<li><a href="dashboard"><i class="'+res[i].FAB_ICON_CLASS+'"></i>'+res[i].HEAD_NAME+'</a></li>';
                            }else{
                               lists +='<li id="'+res[i].HEAD_ID+'" onclick="get_sub_head(\''+res[i].HEAD_ID+'\')"><a><i class="'+res[i].FAB_ICON_CLASS+'"></i><span class="fa fa-chevron-down"></span>'+res[i].HEAD_NAME+'</a></li>'; 
                            }
                        }
                        $("#side_bar").html(lists);
                    }
                }
            })
        }
        
        function get_sub_head(head_id, li_name = ''){
            
            $("li").removeClass("active");
            $("#"+head_id).addClass("active");
            $(".child_menu").css("display","none");
            
            
            $.ajax({
                url:'get-subhead',
                data:'list_subhead=true&head_id='+head_id,
                dataType:'Json',
                success:function(res){
                    var lists = '';
                    if(res.length ==0){
                        $("#"+head_id).append('');
                        
                    }else{
                        lists += '<ul class="nav child_menu" id="sub_'+head_id+'">';
                        for(var i = 0; i < res.length; i++){
                            if(i == 0){
                            lists +='<li id="'+res[i].SUB_HEAD_LINK+'"><a href="'+res[i].SUB_HEAD_LINK+'">'+res[i].SUB_HEAD_NAME+'</a></li>';
                            }else{
                            lists +='<li id="'+res[i].SUB_HEAD_LINK+'"><a href="'+res[i].SUB_HEAD_LINK+'">'+res[i].SUB_HEAD_NAME+'</a></li>'; 
                            }
                        }
                        lists +='</ul>';
                        $("#"+head_id).append(lists);
                        
                        $("#sub_"+head_id).css("display","block");
                        $("#"+li_name).addClass("current-page");
                    }
                }
            })
        }
        
        function get_current_url(){
        var current_url = window.location.pathname;
        var url_arr = current_url.split("/");
        var arr_count = parseInt(url_arr.length)-1;
        
        $.ajax({
            url:'get_current_url',
            data:'url_name='+url_arr[arr_count],
            dataType:'Json',
            success:function(res){
                //alert(res);
                $("li").removeClass("current-page");
                if(res.length == 0){
                    
                }else{
                    for(var i = 0; i < res.length; i++){
                        get_sub_head(res[i].HEAD_ID, res[i].SUB_HEAD_LINK)
                        
                    }
                }
            }
        })
        }
        
        
    </script>