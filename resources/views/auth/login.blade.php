<!DOCTYPE html>
<html lang="en">

<head>
    <title>BarberX</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords"
        content="flat ui, admin  Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <meta name="csrf-token" content="csrf_token()">
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/assetsAdmin/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/assetsAdmin/css/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/assetsAdmin/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/assetsAdmin/icon/icofont/css/icofont.css')}}">
    {{-- Full Calendar Style --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/assetsAdmin/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/assetsAdmin/css/jquery.mCustomScrollbar.css')}}">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <div class="md-float-material">
                            <div class="auth-box" style="background: #1d2434">
                                <div class="text-center" width="400px">
                                    <img src="{{asset('assets/assetsAdmin/images/logo.png')}}" width="150px"
                                        alt="logo.png">
                                </div>
                                <div class="row m-b-10">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary" style="color: #d5b981">Sign In</h3>
                                    </div>
                                </div>
                                <hr style="background: rgb(70, 70, 70)">
                                <form action="{{route('login')}}" method="POST" class="mt-4">
                                    @csrf
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Your Email Address"
                                            style="background: #1d2434; border: none; border-bottom: 1px solid #d5b981;">
                                        <span class="md-line"></span>
                                    </div>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password"
                                            style="background: #1d2434; border: none; border-bottom: 1px solid #d5b981;">
                                        <span class="md-line"></span>
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-sm-7 col-xs-12">
                                            <div class="checkbox-fade fade-in-dark">
                                                <input type="checkbox" value="" style="">
                                                <label style="color: #d5b981">
                                                    <span class="">Remember me</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                            <a href="#" style="color: #d5b981" class="">
                                                Forgot Your Password?</a>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-block waves-effect text-center m-b-20 m-t-30 button-login"
                                        style="background: #d5b981; color: #1d2434; border: none; font-weight: bolder;">Log
                                        in</button>
                                </form>

                            </div>
                            </form>
                            <!-- end of form -->
                        </div>
                        <!-- Authentication card end -->
                    </div>
                    <!-- end of col-sm-12 -->
                </div>
                <!-- end of row -->
            </div>
            <!-- end of container-fluid -->
    </section>

    <script type="text/javascript" src="{{asset('assets/assetsAdmin/js/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/assetsAdmin/js/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/assetsAdmin/js/popper.js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/assetsAdmin/js/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('assets/assetsAdmin/js/jquery-slimscroll/jquery.slimscroll.js')}}">
    </script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('assets/assetsAdmin/js/modernizr/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/assetsAdmin/js/modernizr/css-scrollbars.js')}}"></script>
    {{-- FullCalendar --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- classie js -->
    <script type="text/javascript" src="{{asset('assets/assetsAdmin/js/classie/classie.js')}}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{asset('assets/assetsAdmin/js/script.js')}}"></script>
    <script src="{{asset('assets/assetsAdmin/js/pcoded.min.js')}}"></script>
    <script src="{{asset('assets/assetsAdmin/js/demo-12.js')}}"></script>
    <script src="{{asset('assets/assetsAdmin/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
</body>

</html>