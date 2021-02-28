<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from crm.thememinister.com/crmAdmin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Aug 2017 00:50:47 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CJ PSM</title>

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/dist/img/cj_logo.png" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap rtl -->
    <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Pe-icon-7-stroke -->
    <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css" />
    <!-- style css -->
    <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css" />
    <!-- Theme style rtl -->
    <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
</head>

<body class="background-image">

    <!-- Content Wrapper -->
    <div class="login-wrapper ">
        <div class="container-center">
            <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <span class="logo-mini">
                                    <img src="assets/dist/img/cj_logo.png" alt="">
                                </span>
                            </div>
                            <div class="header-title">

                                <strong>Progress Sales Management</strong>
                                <h3>Login</h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('login.process') }}" id="loginForm" validate>
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="username">ID</label>
                                <input type="text" placeholder="Enter Your ID" title="Please enter you ID" required value="" name="id" id="username" class="form-control">

                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required value="" name="password" id="password" class="form-control">
                            </div>
                            <?php
                            $company = Illuminate\Support\Facades\DB::table('tb_common_code')
                                ->where('hcode', '=', 'CO')
                                ->where('code', '!=', '*')
                                ->get();
                            $country = Illuminate\Support\Facades\DB::table('tb_common_code')
                                ->where('hcode', '=', 'CY')
                                ->where('code', '!=', '*')
                                ->get();
                            ?>

                            {{-- <div class="form-group">
                                <label class=" col-form-label">Login As</label>
                                <input id="company_id" name="company_id" type="text" class="form-control hidden" value="">
                                <div class="col-sm-12 bg-danger text-center">
                                    <input type="text" name="company" id="company" class="form-control">
                                    @foreach ($country as $cy)
                                    @foreach ($company as $co)
                                    <a id="btnLogin" href="{{ route('login.selectcompany').'?company='.$co->code.'&country='.$cy->code }}" class="btn btn-sm btn-add" style="padding:10px; margin: 10px;">{{ $cy->name.' - '.$co->name }}</a>
                                    @endforeach
                                    @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div>
                                <button class="btn btn-add">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- jQuery -->
    <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <!-- bootstrap js -->
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnLogin').click(function(e) {
                $.post("{{ route('login.process')}}", {
                        id: $('#id').val(),
                        password : $('#password').val()
                    },
                    function(data, status) {
                        alert("Data: " + data + "\nStatus: " + status);
                    });
            });
        });
    </script>

</body>

<!-- Mirrored from crm.thememinister.com/crmAdmin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Aug 2017 00:50:47 GMT -->

</html>