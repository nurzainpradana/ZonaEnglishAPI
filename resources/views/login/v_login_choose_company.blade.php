<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from crm.thememinister.com/crmAdmin/clist.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Aug 2017 00:50:47 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CJ PSM</title>
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/dist/img/cj_logo.png" type="image/x-icon">
    <!-- Start Global Mandatory Style
         =====================================================================-->
    <!-- jquery-ui css -->
    <link href="{{ asset('assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap rtl -->
    <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Lobipanel css -->
    <link href="{{ asset('assets/plugins/lobipanel/lobipanel.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Pace css -->
    <link href="{{ asset('assets/plugins/pace/flash.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Pe-icon -->
    <link href="{{ asset('assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet" type="text/css" />
    <!-- Themify icons -->
    <link href="{{ asset('assets/themify-icons/themify-icons.css') }}" rel="stylesheet" type="text/css" />
    <!-- dataTables css -->
    <link href="{{ asset('assets/plugins/datatables/dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- End Global Mandatory Style
         =====================================================================-->
    <!-- Start Theme Layout Style
         =====================================================================-->
    <!-- Theme style -->
    <link href="{{ asset('assets/dist/css/stylecrm.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/dist/css/balloon.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme style rtl -->
    <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
    <!-- End Theme Layout Style
         =====================================================================-->
</head>

<body class="hold-transition sidebar-mini">
    <!--preloader-->
    <!-- <div id="preloader">
      <div id="status"></div>
   </div> -->
    <!-- Site wrapper -->
    @php($roles = Session('role'))
        <div class="wrapper">
            <header class="main-header">
                <a href="" class="logo">
                    <!-- Logo -->
                    <span class="logo-mini text-black">
                        PSM
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/dist/img/cj_cheiljedang.png') }}" alt="">
                    </span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top">

                    <!-- searchbar-->
                    <!-- <a href="#search"><span class="pe-7s-search"></span></a>
                   <div id="search">
                      <button type="button" class="close">×</button>
                      <form>
                         <input type="search" value="" placeholder="type keyword(s) here" />
                         <button type="submit" class="btn btn-add">Search...</button>
                      </form>
                   </div> -->
                    <div class="navbar-brand text-white"><b>Progress Sales</b> Management</div>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- user -->
                            <li class="dropdown dropdown-user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- <img src="assets/dist/img/avatar5.png" class="img-circle" width="45" height="45" alt="user"></a> -->

                                    <p class="text-white"><b>{!! Session::get('name') !!} </b><br>[ {{ $roles }} ]
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('logout') }}">
                                            <i class="fa fa-sign-out"></i> Signout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>




            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-body  p-1 text-center">
                                        <span class="text-center"><h3>Choose Company</h3></span>
                                        <div class="container-fluid">
                                          <div class="row">
                                          <form action="#" method="GET"></form>
                                             @php($data = DB::table('tb_common_code')
                                             ->where('hcode', '=', 'CO')
                                             ->where('code','!=','*')->get())
                                             @foreach ($data as $d)
                                             <a href="{{ route('login.selectcompany').'?company='.$d->code }}" class="btn border" style="padding:20px; margin: 20px">
                                                <img height="90px" src="{{ asset('public/photo/' . $d->photo) }}" alt="">
                                             </a>
                                              @endforeach
                                          </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content-wrapper -->
        </div>
        <!-- ./wrapper -->
        <!-- Start Core Plugins
             =====================================================================-->
        <!-- jQuery -->
        <script src="{{ asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
        <!-- jquery-ui -->
        <script src="{{ asset('assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- lobipanel -->
        <script src="{{ asset('assets/plugins/lobipanel/lobipanel.min.js') }}" type="text/javascript"></script>
        <!-- CKEditor 4 js -->
        <script src="{{ asset('assets/ckeditor4/ckeditor.js') }}" type="text/javascript"></script>
        <!-- Pace js -->
        <script src="{{ asset('assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
        <!-- table-export js -->
        <script src="{{ asset('assets/plugins/table-export/tableExport.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/table-export/jquery.base64.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/table-export/html2canvas.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/table-export/sprintf.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/table-export/jspdf.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/table-export/base64.js') }}" type="text/javascript"></script>
        <!-- dataTables js -->
        <!-- <script src="{{ asset('assets/plugins/datatables/dataTables.min.js') }}" type="text/javascript"></script> -->
        <!-- SlimScroll -->
        <script src="{{ asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <!-- FastClick -->
        <script src="{{ asset('assets/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
        <!-- CRMadmin frame -->
        <script src="{{ asset('assets/dist/js/custom.js') }}" type="text/javascript"></script>


        <!-- Page level plugins -->
        <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- End Core Plugins
             =====================================================================-->
        <!-- Start Theme label Script
             =====================================================================-->
        <!-- Dashboard js -->
        <script src="{{ asset('assets/dist/js/dashboard.js') }}" type="text/javascript"></script>

        @yield('scripts')
        <script>
            $(document).ready(function() {});

        </script>
        <!-- End Theme label Script
             =====================================================================-->
    </body>

    </html>
