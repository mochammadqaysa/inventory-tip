<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <title>Tiara Indoprima</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->	
        <link type="text/css" rel="stylesheet" href="{{asset('balkon/css/reset.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('balkon/css/plugins.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('balkon/css/style.css')}}">
        <link type="text/css" rel="stylesheet" href="{{asset('balkon/css/yourstyle.css')}}">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="{{asset('argon2/assets/img/logo_backup.png')}}">
    </head>
    <body>
        <!-- loader -->
        <div class="loader">
            <div id="movingBallG">
                <div class="movingBallLineG"></div>
                <div id="movingBallG_1" class="movingBallG"></div>
            </div>
        </div>
        <!-- loader end -->
        <!--================= Main   ================-->
        <div id="main">
            <!--================= header ================-->
            @include('pages.landing_page.layouts.navbar')
            <!-- header  end -->
            <!--=============== wrapper ===============-->
            <div id="wrapper">
                <!-- content-holder  -->
                <div class="content-holder">
                    <!-- home-slider  -->
                    @yield('jumbotron')
                    <!-- home-slider end-->
                    <!--content-->	 
                    <div class="content">
                        @yield('content')	
                    </div>
                    <!-- content  end --> 
                    <!--=============== content-footer   ===============-->
                    <div class="height-emulator"></div>
                    <footer class="content-footer">
                        <div class="footer-inner">
                            <div class="row">
                                <div class="col-md-3">
                                    <a class="footer-logo" href="index.html"><img src="{{asset('balkon/images/tiaralogo.png')}}" alt=""></a>
                                </div>
                                <div class="col-md-9">
                                    <div class="footer-header fl-wrap"><span>Contacts</span></div>
                                    <div class="footer-box fl-wrap">
                                        <ul>
                                            <li><span>Email :</span><a href="#" target="_blank">info@tiara-indoprima.com</a></li>
                                            <li> <span>Adress :</span><a href="#" target="_blank">K.I. Trikencana Kavling 1 Jl. Terusan Kopo Km 11.5, Kab. Bandung - 40971, Indonesia</a></li>
                                            <li><span>Phone 1 :</span><a href="#">+6(222)5897440</a></li>
                                            <li><span>Phone 2 :</span><a href="#">+6(222)5897441</a></li>
                                            <li><span>Fax :</span><a href="#">+6(222)5897453</a></li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- <div class="col-md-5">
                                    <div class="footer-header fl-wrap"><span>02.</span> Subscribe</div>
                                    <div class="footer-box fl-wrap">
                                        <div class="subcribe-form fl-wrap">
                                            <span>Newsletter</span>
                                            <form id="subscribe">
                                                <input class="enteremail" name="email" id="subscribe-email" placeholder="email" spellcheck="false" type="text">
                                                <button type="submit" id="subscribe-button" class="subscribe-button">Submit</button>
                                                <label for="subscribe-email" class="subscribe-message"></label>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="fl-wrap policy-box">
                                        <p> &#169; PT. Tiara Indoprima   {{ date('Y') }}.  All rights reserved.  </p>
                                    </div>
                                </div>
                            </div>
                            <div class="to-top"><i class="fa fa-long-arrow-up"></i></div>
                        </div>
                    </footer>
                    <!-- content-footer end    -->
                </div>
                <!-- content-holder end -->
            </div>
            <!-- wrapper end -->
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script type="text/javascript" src="{{asset('balkon/js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('balkon/js/plugins.js')}}"></script>
        <script type="text/javascript" src="{{asset('balkon/js/scripts.js')}}"></script>
        @yield('script')
    </body>
</html>