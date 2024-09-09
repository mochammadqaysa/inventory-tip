@extends('pages.landing_page.layouts.root')

@section('jumbotron')
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
                            <h3>PT. Tiara Indoprima</h3>
                            <h2>Redefining Products <br> Through Experience</h2>
                            <div class="clearfix"></div>
                            <p>Imagination, Innovation, Collaboration</p>
                            <div class="clearfix"></div>
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
                            <h3>PT. Tiara Indoprima</h3>                                            
                            <h2> Furniture & Interior<br> Products</h2>
                            <div class="clearfix"></div>
                            <p>Architects, contractors, cabinet makers (joinery), and homeowners are constantly seeking for new materials to give interior an added touch of glamorous with elegant look and feel.</p>
                            <div class="clearfix"></div>
                            <a href="{{route('landing.portofolio')}}" class="btn float-btn flat-btn">View Portofolio</a>
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
                            <h3>PT. Tiara Indoprima</h3>                                            
                            <h2> In-Mold Decoration</h2>
                            <div class="clearfix"></div>
                            <p>In-mold decoration is a manufacturing process used to apply decorative elements or finishes directly onto a product's surface during its molding process. This technique is commonly used in industries like automotive, consumer electronics, and packaging.</p>
                            <div class="clearfix"></div>
                            <a href="{{route('landing.portofolio')}}" class="btn float-btn flat-btn">View Portofolio</a>
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
                            <h3>PT. Tiara Indoprima</h3>                                              
                            <h2> Our services <br> What we do</h2>
                            <div class="clearfix"></div>
                            <p>We approach product development as a collaborative journey with our clients, customizing our high gloss solution to suit the needs of different industries & application</p>
                            <div class="clearfix"></div>
                            <a href="{{route('landing.services')}}" class="btn float-btn flat-btn">Our Services</a>
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
@endsection

@section('content')
<!--section -->	
<section id="sec2" data-scrollax-parent="true" >
    <div class="container">
        <div class="section-container fl-wrap">
            <div class="row">
                <div class="col-md-7">
                    <div class="content-wrap about-wrap">
                        <h3 class="bold-title"> We are Tiara Indoprima .  <br>   Plastic Extrusion Manufacturing <br> From Bandung</h3>
                        <p>PT. Tiara Indoprima is a dynamic private enterprise in the area of co-extruded thermoplastic sheets, films, and laminated decorative surfaces. Our semi-finished products stand for high quality, UV stability, heat and chemical resistance, and environment friendly. We have sourced the best raw materials in the market and are using latest technologies supplied by world’s leading manufacturers, to ensure our product quality exceeds your expectations. Our products has been sold worldwide and we are confident to see growth in the future.
                        </p>
                        <br><br>
                        <h3 class="bold-title">What we do</h3>
                        <div class="pr-tags fl-wrap">
                            <span>Services : </span>
                            <ul>
                                <li><a href="#">Manufacturing</a></li>
                                <li><a href="#">Advertising</a></li>
                                <li><a href="#">Furniture Products</a></li>
                                <li><a href="#">Interior Products</a></li>
                            </ul>
                        </div>
                        <span class="bold-separator"></span>
                        <div class="clearfix"></div>
                        <a href="{{route('landing.portofolio')}}" class="btn float-btn flat-btn">Our portfolio</a>
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
            <a href="{{route('landing.services')}}" class="btn float-btn flat-btn">Our Services</a>
            <a href="{{route('landing.contacts')}}" class="btn float-btn flat-btn">Get in Touch</a>
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
                    <span>Explore our diverse portfolio of featured projects, showcasing our expertise across advertising, furniture & interior products, in-mold decoration, and automotive industries. </span>
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
                        <h3><a href="">Advertising</a></h3>
                        <h4>When advertising has become a necessity in marketing your business, we offer a range of products suitable for indoor signage, display, showcase, and other interior goods.</h4>
                        <a href="" class="btn float-btn flat-btn">View project</a>
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
                            <li><a href="#">Furniture</a></li>
                            <li><a href="#">Interior </a></li>
                        </ul>
                    </div>
                    <img  src="{{asset('balkon/images/folio/kitchen6.jpg')}}"   alt="">
                    <div class="parallax-text right-pos" data-scrollax="properties: { translateY: '-250px' }">
                        <h3><a href="">Furniture & Interior Products</a></h3>
                        <h4>Architects, contractors, cabinet makers (joinery), and homeowners are constantly seeking for new materials to give interior an added touch of glamorous with elegant look and feel.</h4>
                        <a href="" class="btn float-btn flat-btn">View project</a>
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
                            <li><a href="#">In-Mold Decoration</a></li>
                        </ul>
                    </div>
                    <img  src="{{asset('balkon/images/folio/inmold1.jpg')}}"   alt="">
                    <div class="parallax-text left-pos" data-scrollax="properties: { translateY: '-250px' }">
                        <h3><a href="">In-Mold Decoration</a></h3>
                        <h4>For In-Mold Decoration substrate, low-gel ABS sheet is required with thickness ranging 300 – 500 microns. Just to name a few, its usage is for laptop and mobile phone covers</h4>
                        <a href="" class="btn float-btn flat-btn">View project</a>
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
                            <li><a href="#">Automotive</a></li>
                            <li><a href="#">Transport </a></li>
                        </ul>
                    </div>
                    <img  src="{{asset('balkon/images/folio/carinterior3.jpg')}}"   alt="">
                    <div class="parallax-text right-pos" data-scrollax="properties: { translateY: '-250px' }">
                        <h3><a href="">Automotive & Transport</a></h3>
                        <h4>With lots of research and development, we have reinvented co-extruded sheet specifically developed for automotive and transportation industry in areas of interior and exterior parts.</h4>
                        <a href="" class="btn float-btn flat-btn">View project</a>
                    </div>
                </div>
            </div>
        </div>
        <!--parallax-item end-->	                       
    </div>
    <div class="partcile-dec" data-parcount="250"></div>
</section>
<!--section end  -->	
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="pr-title">
                    Companies who trust us
                    <span>PT. Tiara Indoprima has been trusted by various leading companies, which reflects our commitment to quality and customer satisfaction. </span>
                </div>
            </div>
        </div>
        <div class="clients-list fl-wrap">
            <ul>
                <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/mitsubishi.png')}}" alt=""> </a></li>
                <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/subaru.png')}}" alt=""> </a></li>
                <li><a href="#" target="_blank"> <img src="{{asset('balkon/images/clients/honda.jpg')}}" alt=""> </a></li>
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
@endsection