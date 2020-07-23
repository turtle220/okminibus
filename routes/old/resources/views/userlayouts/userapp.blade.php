<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <title>bookin</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
</head>
<body>
    <style type="text/css">
        .alert-success {
            
            position: fixed;
            right: 0px;
            top:10px;
            z-index: 20;

        }

        .ajax-alert {
            display: none;
        }

        .alert-danger {

            position: fixed;
            right: 0px;
            top:10px;
            z-index: 20;

        }
    </style>

    <div class="alert alert-success ajax-alert alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success!</strong> .
    </div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success!</strong> Indicates a successful or positive action.
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error!</strong> .
    </div>
    @endif
     @yield('modals')               
    <div class="loading-overlay">

        <div id="fountainG">

            <div id="fountainG_1" class="fountainG"></div>

            <div id="fountainG_2" class="fountainG"></div>

            <div id="fountainG_3" class="fountainG"></div>

            <div id="fountainG_4" class="fountainG"></div>

            <div id="fountainG_5" class="fountainG"></div>

            <div id="fountainG_6" class="fountainG"></div>

            <div id="fountainG_7" class="fountainG"></div>

            <div id="fountainG_8" class="fountainG"></div>

        </div>



    </div>
         <!-- Left Panel -->
    
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Island & Tour</a>
                <a class="navbar-brand hidden" href="{{ url('/') }}">I</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <!-- <li class="active">
                        <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li> -->
                    
                    <li>
                        <a href="{{ url('/') }}"> <i class="menu-icon fa fa-ticket"></i>{{__('custom.ticket')}}</a>
                    </li>
                    @if(Auth::user()->role == 1 || Auth::user()->role == 2)

                    <li>
                        <a href="{{ url('invoice') }}"> <i class="menu-icon fa fa-tag"></i>{{__('custom.invoice')}}</a>
                    </li>
                    @endif
                    @if(Auth::user()->role == 1)
                    <li>
                        <a href="{{ url('users') }}"> <i class="menu-icon fa fa-users"></i>{{__('custom.usermanagement')}}</a>
                    </li>
                    @endif
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
    
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar"> -->
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="user-menu dropdown-menu">
                           <!--  <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a> -->
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                                  document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i> {{ __('Logout') }}
                            </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                          
                        </div>
                    </div>
                    <!-- language select -->
                    <!-- <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language">
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
        <div class="content mt-3">
            <iframe id="my_iframe" style="display:none;"></iframe>
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

  
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/init-scripts/data-table/datatables-init.js') }}"></script>
    @yield('scripts')
    
    <!-- <script src="{{ asset('vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
      <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/widgets.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script> -->
    <script>
        // (function($) {
        //     "use strict";

        //     jQuery('#vmap').vectorMap({
        //         map: 'world_en',
        //         backgroundColor: null,
        //         color: '#ffffff',
        //         hoverOpacity: 0.7,
        //         selectedColor: '#1de9b6',
        //         enableZoom: true,
        //         showTooltip: true,
        //         values: sample_data,
        //         scaleColors: ['#1de9b6', '#03a9f5'],
        //         normalizeFunction: 'polynomial'
        //     });
        // })(jQuery);
    $(document).ready(function(){
      $('.dropdown-submenu a.test').on("click", function(e){
        $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
          });
        });

        $(document).on('show.bs.modal', '.modal', function () {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
    </script>
</body>
</html>
