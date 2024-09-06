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
            <header class="main-header">
                <!-- logo -->
                <a class="logo-holder" href="index.html"><img src="{{asset('balkon/images/tiaralogo.png')}}" alt=""></a>
                <!-- logo end -->  
                <!-- share button-->  
                <div class="show-share-wrap">
                    <div class="show-share"><span>Share</span><img src="{{asset('balkon/images/share.png')}}" alt=""></div>
                </div>
                <!-- share button end-->  		
                <!-- search button--> 	 
                <div class="show-search show-fixed-search vissearch"><i class="fa fa-search"></i></div>
                <!-- search button end --> 
                <!-- mobile nav --> 
                <div class="nav-button-wrap">
                    <div class="nav-button vis-main-menu"><span></span><span></span><span></span></div>
                </div>
                <!-- mobile nav end--> 
                <!--  navigation --> 
                <div class="nav-holder">
                    <nav>
                        <ul>
                            <li>
                                <a href="index.html" class="act-link">Home </a>
                                <!--second level -->   
                                <ul>
                                    <li><a href="index.html">Slider</a></li>
                                    <li><a href="index2.html">Image</a></li>
                                    <li><a href="index3.html">Video</a></li>
                                    <li><a href="index4.html">Slideshow</a></li>
                                    <li><a href="index5.html">Carousel</a></li>
                                    <li><a href="index6.html">Sidebar menu</a></li>
                                    <li>
                                        <!--third level -->
                                        <a>Onepage</a>
                                        <ul>
											<li><a href="onepage-slider.html">Slider</a></li>
											<li><a href="onepage-image.html">Image</a></li>
											<li><a href="onepage-video.html">Video</a></li>
											<li><a href="onepage-slideshow.html">Slideshow</a></li>
											<li><a href="onepage-carousel.html">Carousel</a></li>
											<li><a href="onepage-sidebarmenu.html">Sidebar menu</a></li>
                                        </ul>
                                        <!--third level end-->
                                    </li>									
                                </ul>
                                <!--second level end-->
                            </li>
                            <li>
                                <a href="portfolio.html">Portfolio</a>
                                <!--second level -->
                                <ul>
                                    <li>
                                        <!--third level -->
                                        <a>Single</a>
                                        <ul>
                                            <li><a href="portfolio-single.html">Carousel</a></li>
                                            <li><a href="portfolio-single2.html">Gallery </a></li>
                                            <li><a href="portfolio-single3.html">Fullwidth Slider</a></li>
                                            <li><a href="portfolio-single4.html">Slider</a></li>
                                            <li><a href="portfolio-single5.html">Video</a></li>
                                            <li><a href="portfolio-single6.html">Vertical Images</a></li>
                                        </ul>
                                        <!--third level end-->
                                    </li>
                                    <li><a href="portfolio2.html">Fullwidth 2</a></li>
                                    <li><a href="portfolio3.html">Sibebar filter</a></li>
                                    <li><a href="portfolio4.html">Boxed</a></li>
                                    <li><a href="portfolio5.html">Boxed 2</a></li>
                                    <li><a href="portfolio6.html">Sibebar filter 2</a></li>
                                    <li><a href="portfolio7.html">Parallax</a></li>
                                    <li><a href="portfolio8.html">Fullwidth 3</a></li>
                                    <li><a href="portfolio9.html">Fullwidth 4</a></li>
                                </ul>
                                <!--second level end-->
                            </li>
                            <li>
                                <a href="about.html"  >About</a>
                                <!--second level end-->
                                <ul>
                                    <li><a href="about-personal.html">Personal</a></li>
                                    <li><a href="services.html">Services</a></li>
                                </ul>
                                <!--second level end-->
                            </li>
                            <li>
                                <a href="contact.html">Contacts </a>
                            </li>
                            <li>
                                <a href="shop.html">Shop</a>
                                <!--second level end-->
                                <ul>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="product-single.html">Product Single</a></li>
                                </ul>
                                <!--second level end-->
                            </li>
                            <li>
                                <a href="blog.html">Journal</a>
                                <!--second level end-->
                                <ul>
                                    <li><a href="blog-grid.html">Grid</a></li>
                                    <li><a href="blog-masonry.html">Masonry</a></li>
                                    <li><a href="blog-single.html">Post Single</a></li>
                                    <li><a href="404.html">404</a></li>
                                </ul>
                                <!--second level end-->
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- navigation  end -->
            </header>
            <!-- header  end -->
            <!--=============== wrapper ===============-->
            <div id="wrapper">
                <!-- content-holder  -->
                <div class="content-holder">
                    <!-- home-slider  -->
                    <div class="fs-gallery-wrap home-slider fl-wrap full-height" data-autoplayslider="5000">
                        <div class="slide-progress-container">
                            <div class="slide-progress-content">
                                <div class="slide-progress-warp">
                                    <div class="slide-progress"></div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-container" data-scrollax-parent="true" >
                            <div class="swiper-wrapper"  >
                                <!-- swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="bg"  data-bg="{{asset('balkon/images/bg/heroindex1.jpg')}}" data-scrollax="properties: { translateY: '250px' }" ></div>
                                    <a href="{{asset('balkon/images/bg/heroindex1.jpg')}}" class="  gallery-popup image-popup"><i class="fa fa-search"  ></i></a>
                                    <div class="overlay"></div>
                                    <!-- hero-wrap-->           
                                    <div class="hero-wrap alt">
                                        <div class="container">
                                            <div class="hero-item">
                                            	<h3>predefined chunks</h3>
                                                <h2>Balkon Architecture <br> Studio</h2>
                                                <div class="clearfix"></div>
                                                <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
                                                <div class="clearfix"></div>
                                                <a href="portfolio.html" class="btn float-btn flat-btn">Our portfolio</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- hero-wrap end-->   
                                </div>
                                <!-- swiper-slide end-->
                                <!-- swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="bg"  data-bg="{{asset('balkon/images/bg/heroindex2.jpg')}}" data-scrollax="properties: { translateY: '250px' }" ></div>
                                    <a href="{{asset('balkon/images/bg/heroindex2.jpg')}}" class="  gallery-popup image-popup"><i class="fa fa-search"  ></i></a>
                                    <div class="overlay"></div>
                                    <!-- hero-wrap-->           
                                    <div class="hero-wrap alt">
                                        <div class="container">
                                            <div class="hero-item">
                                            	<h3>molestie faucibus</h3>                                            
                                                <h2> Architecture Project<br> Title</h2>
                                                <div class="clearfix"></div>
                                                <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
                                                <div class="clearfix"></div>
                                                <a href="portfolio-single.html" class="btn float-btn flat-btn">View Project</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- hero-wrap end-->   
                                </div>
                                <!-- swiper-slide end-->
                                <!-- swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="bg"  data-bg="{{asset('balkon/images/bg/heroindex3.jpg')}}" data-scrollax="properties: { translateY: '250px' }" ></div>
                                    <a href="{{asset('balkon/images/bg/heroindex3.jpg')}}" class="  gallery-popup image-popup"><i class="fa fa-search"  ></i></a>
                                    <div class="overlay"></div>
                                    <!-- hero-wrap-->           
                                    <div class="hero-wrap alt">
                                        <div class="container">
                                            <div class="hero-item">
                                            	<h3>tend to repeat</h3>                                            
                                                <h2> Interior <br> Project Title</h2>
                                                <div class="clearfix"></div>
                                                <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
                                                <div class="clearfix"></div>
                                                <a href="portfolio-single.html" class="btn float-btn flat-btn">View Project</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- hero-wrap end-->   
                                </div>
                                <!-- swiper-slide end-->
                                <!-- swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="bg"  data-bg="{{asset('balkon/images/bg/heroindex4.jpg')}}" data-scrollax="properties: { translateY: '250px' }" ></div>
                                    <a href="{{asset('balkon/images/bg/heroindex4.jpg')}}" class="gallery-popup image-popup"><i class="fa fa-search"  ></i></a>
                                    <div class="overlay"></div>
                                    <!-- hero-wrap-->           
                                    <div class="hero-wrap alt">
                                        <div class="container">
                                            <div class="hero-item">
                                            	<h3>Cras lacinia magna</h3>                                              
                                                <h2> Our services <br> What we do</h2>
                                                <div class="clearfix"></div>
                                                <p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary .</p>
                                                <div class="clearfix"></div>
                                                <a href="services.html" class="btn float-btn flat-btn">Our Services</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- hero-wrap end-->   
                                </div>
                                <!-- swiper-slide end-->
                            </div>
                            <div class="sw-button swiper-button-next"><i class="fa fa-angle-right"></i></div>
                            <div class="sw-button swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <!-- home-slider end-->
                    <!--content-->	 
                    <div class="content">
                        <!--section -->	
                        <section id="sec2" data-scrollax-parent="true" >
                            <div class="container">
                                <div class="section-container fl-wrap">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="content-wrap about-wrap">
                                                <h3 class="bold-title">Welcome !  We are Balkon .  <br>   Architecture Studio <br> From NY</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.  
                                                    Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus.
                                                </p>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras lacinia magna vel molestie faucibus. Donec auctor et urnaLorem ipsum dolor sit amet, consectetur adipiscing elit.  
                                                </p>
                                                <br><br>
                                                <h3 class="bold-title">What we do</h3>
                                                <div class="pr-tags fl-wrap">
                                                    <span>Services : </span>
                                                    <ul>
                                                        <li><a href="#">Architecture</a></li>
                                                        <li><a href="#">Design</a></li>
                                                        <li><a href="#">Photography</a></li>
                                                    </ul>
                                                </div>
                                                <span class="bold-separator"></span>
                                                <div class="clearfix"></div>
                                                <a href="portfolio.html" class="btn float-btn flat-btn">Our portfolio</a>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="box-item">
                                                <img  src="{{asset('balkon/images/bg/whoindex.jpg')}}"  class="respimg" alt="">
                                                <div class="overlay"></div>
                                                <a href="{{asset('balkon/images/bg/whoindex.jpg')}}" class="image-popup popup-image"><i class="fa fa-search"  ></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg dec-bg left-pos-dec"  data-bg="balkon/images/bg/14.jpg"></div>
                        </section>
                        <!--section end  -->	
                        <!--section -->	
                        <section  >
                            <div class="bg"  data-bg="{{asset('balkon/images/folio/hall1.jpg')}}"></div>
                            <div class="overlay"></div>
                            <div class="container">
                                <div class="intro-text fl-wrap">
                                    <h2>Entrust your project <br>to our team of  <br>professionals</h2>
                                    <a href="services.html" class="btn float-btn flat-btn">Our Services</a>
                                    <a href="contact.html" class="btn float-btn flat-btn">Get in Touch</a>
                                </div>
                            </div>
                        </section>
                        <!--section end  -->	
                        <!--section -->	                             	 
                        <section >
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="pr-title">
                                            Our Featured Work
                                            <span>Lorem Ipsum generators on the Internet tend to repeat king this the first true generator . </span>
                                        </div>
                                    </div>
                                </div>
                                <!--parallax-item -->	
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-7">
                                        <div class="parallax-item fl-wrap" data-scrollax-parent="true">
                                            <div class="parallax-header fl-wrap">
                                                <span>01.</span>
                                                <ul>
                                                    <li><a href="#">Advertising</a></li>
                                                </ul>
                                            </div>
                                            <img  src="{{asset('balkon/images/folio/advertise1.jpg')}}"   alt="">
                                            <div class="parallax-text left-pos" data-scrollax="properties: { translateY: '-250px' }">
                                                <h3><a href="portfolio-single.html">Advertising</a></h3>
                                                <h4>When advertising has become a necessity in marketing your business, we offer a range of products suitable for indoor signage, display, showcase, and other interior goods.</h4>
                                                <a href="portfolio-single.html" class="btn float-btn flat-btn">View project</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--parallax-item end-->	
                                <!--parallax-item -->	
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="parallax-item fl-wrap" data-scrollax-parent="true">
                                            <div class="parallax-header fl-wrap">
                                                <span>02.</span>
                                                <ul>
                                                    <li><a href="#">Design</a></li>
                                                    <li><a href="#">Architecture </a></li>
                                                </ul>
                                            </div>
                                            <img  src="{{asset('balkon/images/folio/kitchen6.jpg')}}"   alt="">
                                            <div class="parallax-text right-pos" data-scrollax="properties: { translateY: '-250px' }">
                                                <h3><a href="portfolio-single.html">Furniture & Interior Products</a></h3>
                                                <h4>Architects, contractors, cabinet makers (joinery), and homeowners are constantly seeking for new materials to give interior an added touch of glamorous with elegant look and feel.</h4>
                                                <a href="portfolio-single.html" class="btn float-btn flat-btn">View project</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--parallax-item end-->	                    
                                <!--parallax-item -->	
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-7">
                                        <div class="parallax-item fl-wrap" data-scrollax-parent="true">
                                            <div class="parallax-header fl-wrap">
                                                <span>03.</span>
                                                <ul>
                                                    <li><a href="#">Design</a></li>
                                                    <li><a href="#">Architecture </a></li>
                                                </ul>
                                            </div>
                                            <img  src="{{asset('balkon/images/folio/inmold1.jpg')}}"   alt="">
                                            <div class="parallax-text left-pos" data-scrollax="properties: { translateY: '-250px' }">
                                                <h3><a href="portfolio-single.html">In-Mold Decoration</a></h3>
                                                <h4>For In-Mold Decoration substrate, low-gel ABS sheet is required with thickness ranging 300 – 500 microns. Just to name a few, its usage is for laptop and mobile phone covers</h4>
                                                <a href="portfolio-single.html" class="btn float-btn flat-btn">View project</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--parallax-item end-->	
                                <!--parallax-item -->	
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="parallax-item fl-wrap" data-scrollax-parent="true">
                                            <div class="parallax-header fl-wrap">
                                                <span>04.</span>
                                                <ul>
                                                    <li><a href="#">Design</a></li>
                                                    <li><a href="#">Architecture </a></li>
                                                </ul>
                                            </div>
                                            <img  src="{{asset('balkon/images/folio/carinterior3.jpg')}}"   alt="">
                                            <div class="parallax-text right-pos" data-scrollax="properties: { translateY: '-250px' }">
                                                <h3><a href="portfolio-single.html">Automotive & Transport</a></h3>
                                                <h4>With lots of research and development, we have reinvented co-extruded sheet specifically developed for automotive and transportation industry in areas of interior and exterior parts.</h4>
                                                <a href="portfolio-single.html" class="btn float-btn flat-btn">View project</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--parallax-item end-->	                       
                            </div>
                            <div class="partcile-dec" data-parcount="250"></div>
                        </section>
                        <!--section end  -->	
                        <!--section -->	
                        {{-- <section class="parallax-section header-section  " data-scrollax-parent="true" id="sec6">
                            <div class="bg"  data-bg="{{asset('balkon/images/bg/1.jpg')}}" data-scrollax="properties: { translateY: '200px' }"></div>
                            <div class="overlay"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="pr-title">
                                            Testimonials
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="single-slider testilider fl-wrap" data-effects="slide">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">
                                                    <!-- swiper-slide -->
                                                    <div class="swiper-slide">
                                                        <div class="testi-item fl-wrap">
                                                            <h3>Andy Smith</h3>
                                                            <p>"All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words"</p>
                                                            <a href="#" class="btn float-btn flat-btn" target="_blank">Via Twitter</a>
                                                        </div>
                                                    </div>
                                                    <!-- swiper-slide end-->
                                                    <!-- swiper-slide -->
                                                    <div class="swiper-slide">
                                                        <div class="testi-item fl-wrap">
                                                            <h3>Liza Mirovsky</h3>
                                                            <p>"Vestibulum orci felis, ullamcorper non condimentum non, ultrices ac nunc. Mauris non ligula suscipit, vulputate mi accumsan, dapibus felis. Nullam sed sapien dui. Nulla auctor sit amet sem non porta. Integer iaculis tellus nulla, quis imperdiet magna venenatis vitae"</p>
                                                            <a href="#" class="btn float-btn flat-btn" target="_blank">Via Facebook</a>
                                                        </div>
                                                    </div>
                                                    <!-- swiper-slide end-->
                                                    <!-- swiper-slide -->
                                                    <div class="swiper-slide">
                                                        <div class="testi-item fl-wrap">
                                                            <h3>Gary Trust</h3>
                                                            <p>"If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text."</p>
                                                            <a href="#" class="btn float-btn flat-btn" target="_blank">Via Myspace</a>
                                                        </div>
                                                    </div>
                                                    <!-- swiper-slide end-->
                                                </div>
                                                <div class="swiper-pagination"></div>
                                                <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                                                <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section> --}}
                        <!--section end  -->	
                        <!--section -->	
                        <section>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="pr-title">
                                            Companies who trust us
                                            <span>Lorem Ipsum generators on the Internet tend to repeat king this the first true generator . </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clients-list fl-wrap">
                                    <ul>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/cherdchai.jpg')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/mocphat.jpg')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/egr.png')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/gervin.png')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/nationalfurniture.png')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/dwa.png')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/gmk.jpeg')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/smarttechtex.jpg')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/tz.jpg')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/sunyu.png')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/supremedecor.png')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/urban.png')}}" alt=""> </a></li>
                                        <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/wren.png')}}" alt=""> </a></li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                        <!--section end  -->	
                        <!--social-wrap -->	  
                        {{-- <div class="social-wrap fl-wrap">
                            <ul>
                                <li><a href="#" target="_blank" ><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" target="_blank" ><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#" target="_blank" ><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#" target="_blank" ><i class="fa fa-tumblr"></i></a></li>
                            </ul>
                        </div> --}}
                        <!--social-wrap end-->	
                    </div>
                    <!-- content  end --> 
                    <!--=============== content-footer   ===============-->
                    <div class="height-emulator"></div>
                    <footer class="content-footer">
                        <div class="footer-inner">
                            <div class="row">
                                <div class="col-md-3">
                                    <a class="footer-logo" href="index.html"><img src="{{asset('balkon/images/logo.png')}}" alt=""></a>
                                </div>
                                <div class="col-md-4">
                                    <div class="footer-header fl-wrap"><span>01.</span> Contacts</div>
                                    <div class="footer-box fl-wrap">
                                        <ul>
                                            <li><span>Mail :</span><a href="#" target="_blank">yourmail@domain.com</a></li>
                                            <li> <span>Adress :</span><a href="#" target="_blank">USA 27TH Brooklyn NY</a></li>
                                            <li><span>Phone :</span><a href="#">+7(111)123456789</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-5">
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <div class="fl-wrap policy-box">
                                        <p> &#169; Balkon   2017.  All rights reserved.  </p>
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
            <!--search-form-holder -->  
            <div class="search-form-holder fixed-search">
                <div class="search-form-bg"></div>
                <div class="search-form-wrap">
                    <div class="container">
                        <form class="searchform" method="get"  >
                            <input type="text" autocomplete="off"   name="s" placeholder="Type and Enter to Search">
                        </form>
                        <div class="close-fixed-search"></div>
                    </div>
                    <div class="dublicated-text"></div>
                </div>
            </div>
            <!--search-form-holder  end-->  
            <!-- Share container  -->
            {{-- <div class="share-wrapper isShare">
                <div class="share-container"></div>
            </div> --}}
            <!-- Share container  end-->
            <!-- footer -->
            {{-- <footer class="main-footer">
                <div class="fixed-title"><span>Home Slider</span></div>
                <div class="footer-social">
                    <ul>
                        <li><a href="#" target="_blank" ><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" target="_blank" ><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#" target="_blank" ><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#" target="_blank" ><i class="fa fa-tumblr"></i></a></li>
                    </ul>
                </div>
            </footer> --}}
            <!-- footer end-->
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script type="text/javascript" src="{{asset('balkon/js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('balkon/js/plugins.js')}}"></script>
        <script type="text/javascript" src="{{asset('balkon/js/scripts.js')}}"></script>
    </body>
</html>