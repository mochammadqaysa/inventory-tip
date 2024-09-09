@extends('pages.landing_page.layouts.root')


@section('content')
<!--  section  --> 
<section class="parallax-section header-section" data-scrollax-parent="true" id="serv1">
    <div class="bg"  data-bg="{{asset('balkon/images/bg/producthero.jpg')}}" data-scrollax="properties: { translateY: '200px' }"></div>
    <div class="overlay"></div>
    <div class="container big-container">
        <div class="section-title">
            <h3>What we do</h3>
            <div class="separator trsp-separator"></div>
            <h2>Services</h2>
            <p>Our services encompass cutting-edge solutions in thermoplastic sheets, films, and decorative surfaces, tailored to meet diverse industry needs.</p>
            <a href="#serv2" class="custom-scroll-link sect-scroll-link"><i class="fa fa-long-arrow-down"></i> <span>scroll down</span></a>
        </div>
    </div>
</section>
<!--  section  end--> 
<!--  section  --> 
<section   data-scrollax-parent="true" >
    <div class="container">
        <div class="section-container  fl-wrap">
            <!--serv-item end -->
            <div class="serv-item fl-wrap" id="serv2">
                <div class="row">
                    <div class="col-md-4">
                        <div class="pr-title">
                            Advertising
                            <span>When advertising has become a necessity in marketing your business, we offer a range of products suitable for indoor signage, display, showcase, and other interior goods. </span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="content-wrap about-wrap">
                            <div class="blog-media fl-wrap">
                                <div class="box-item">
                                    <img  src="{{asset('balkon/images/folio/advertise1.jpg')}}"  class="respimg" alt="">
                                    <div class="overlay"></div>
                                    <a href="{{asset('balkon/images/folio/advertise1.jpg')}}" class="image-popup popup-image"><i class="fa fa-search"  ></i></a>
                                </div>
                            </div>
                            <h3 class="bold-title">Advertising </h3>
                            <p>When advertising has become a necessity in marketing your business, we offer a range of products suitable for indoor signage, display, showcase, and other interior goods. Our products available in various colors and effects - such as solid and metallic colors, glossy-look, mirror-look, embossed surfaces, and other fantastic decors.
                                Key Features:
                            </p>
                            <ul class="pr-list">
                                <li><span>01.</span> Thickness up to 6.0 mm</li>
                                <li><span>02.</span>  Width up to 1860 mm</li>
                                <li><span>03.</span> Easy to thermoform</li>
                                <li><span>04.</span> Possible to offer in high UV resistance</li>
                                <li><span>05.</span> Suitable for further process (laser cutting, engraving, printing)</li>
                                <li><span>06.</span> Corona treatment on backside for excellent adhesion to other substrates</li>
                                <li><span>07.</span> Eco-friendly product (fully recyclable material)</li>
                                <li><span>08.</span> Does not contain any volatile organic chemicals</li>
                                <li><span>09.</span> Chemical resistance</li>
                            </ul>
                            <div class="clearfix"></div>
                            <span class="bold-separator"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--serv-item end -->
            <!--serv-item end -->
            <div class="serv-item fl-wrap" id="serv3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="pr-title">
                            Furniture & Interior Products

                            <span>Architects, contractors, cabinet makers (joinery), and homeowners are constantly seeking for new materials to give interior an added touch of glamorous with elegant look and feel. </span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="content-wrap about-wrap">
                            <div class="blog-media fl-wrap">
                                <div class="box-item">
                                    <img  src="{{asset('balkon/images/folio/kitchen6.jpg')}}" class="respimg"  alt="">
                                    <div class="overlay"></div>
                                    <a href="{{asset('balkon/images/folio/kitchen6.jpg')}}" class="image-popup popup-image"><i class="fa fa-search"  ></i></a>
                                </div>
                            </div>
                            <h3 class="bold-title">Furniture & Interior Products </h3>
                            <p>Architects, contractors, cabinet makers (joinery), and homeowners are constantly seeking for new materials to give interior an added touch of glamorous with elegant look and feel. From this concept, we have developed a range of luxurious sheets (high gloss finish), ready to be laminated on Particle Board, MDF, Plywood, and other substrates alike. The final products are used in kitchens, wardrobes, and door panels. Thicker sheets can be applied directly for wall cover (regular wall or bathroom wall), kitchen backsplash, and other interior accessories. To meet customer needs, we do accept color matching and other related requirement in order to give more options and flexibility
                                Key Features:
                            </p>
                            <ul class="pr-list">
                                <li><span>01.</span> Thickness from 0.8 mm to 4.0 mm</li>
                                <li><span>02.</span> Width up to 1860 mm</li>
                                <li><span>03.</span> Possible to offer in high UV</li>
                                <li><span>04.</span> Corona treatment on backside for excellent adhesion to other substrates</li>
                                <li><span>05.</span> Easy to clean and maintain</li>
                                <li><span>06.</span> Eco-friendly product (fully recyclable material)</li>
                                <li><span>07.</span> Does not contain any volatile organic chemicals</li>
                                <li><span>08.</span> Chemical resistance</li>
                                <li><span>09.</span> Heat resistance</li>
                            </ul>
                            <div class="clearfix"></div>
                            <span class="bold-separator"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--serv-item end -->
            <!--serv-item end -->
            <div class="serv-item fl-wrap" id="serv4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="pr-title">
                            In-Mold Decoration
                            <span>For In-Mold Decoration substrate, low-gel ABS sheet is required with thickness ranging 300 – 500 microns. Just to name a few, its usage is for laptop and mobile phone covers. </span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="content-wrap about-wrap">
                            <div class="blog-media fl-wrap">
                                <div class="box-item">
                                    <img  src="{{asset('balkon/images/folio/inmold1.jpg')}}" class="respimg"   alt="">
                                    <div class="overlay"></div>
                                    <a href="{{asset('balkon/images/folio/inmold1.jpg')}}" class="image-popup popup-image"><i class="fa fa-search"  ></i></a>
                                </div>
                            </div>
                            <h3 class="bold-title">In-Mold Decoration </h3>
                            <p>For In-Mold Decoration substrate, low-gel ABS sheet is required with thickness ranging 300 – 500 microns. Just to name a few, its usage is for laptop and mobile phone covers, air conditioner (AC) units, remote control, automotive and other transportation’s accessories, etc. With its precise thickness, our material allows further process of cutting and thermoforming to be effortless.
                                Key Features:
                            </p>
                            <ul class="pr-list">
                                <li><span>01.</span> Supplied in rolls</li>
                                <li><span>02.</span> Possible to offer in high UV resistance</li>
                                <li><span>03.</span> Easy to clean and maintain</li>
                                <li><span>04.</span> Eco-friendly product (fully recyclable material)</li>
                                <li><span>05.</span> Does not contain any volatile organic chemicals</li>
                                <li><span>06.</span> Chemical resistance</li>
                                <li><span>07.</span> Heat resistance</li>
                            </ul>
                            <div class="clearfix"></div>
                            <span class="bold-separator"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--serv-item end -->                         
            <!--serv-item end -->
            <div class="serv-item fl-wrap" id="serv4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="pr-title">
                            Automotive & Transport
                            <span>With lots of research and development, we have reinvented co-extruded sheet specifically developed for automotive and transportation industry in areas of interior and exterior parts. </span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="content-wrap about-wrap">
                            <div class="blog-media fl-wrap">
                                <div class="box-item">
                                    <img  src="{{asset('balkon/images/folio/carinterior3.jpg')}}" class="respimg"   alt="">
                                    <div class="overlay"></div>
                                    <a href="{{asset('balkon/images/folio/carinterior3.jpg')}}" class="image-popup popup-image"><i class="fa fa-search"  ></i></a>
                                </div>
                            </div>
                            <h3 class="bold-title">Automotive and Transport </h3>
                            <p>With lots of research and development, we have reinvented co-extruded sheet specifically developed for automotive and transportation industry in areas of interior and exterior parts. This sheet is suitable for thermoforming and has properties that comply with industry standards such as high impact resistance and UV stability. To meet customer needs, we do accept color matching and other related requirement in order to give more options and flexibility.
                                Key Features:
                            </p>
                            <ul class="pr-list">
                                <li><span>01.</span> Thickness up to 6.0 mm</li>
                                <li><span>02.</span>  Width up to 2000 mm</li>
                                <li><span>03.</span> High UV stability</li>
                                <li><span>04.</span> High impact strength</li>
                                <li><span>05.</span> Available in various solid & metallic colors</li>
                                <li><span>06.</span> Easy to thermoform</li>
                                <li><span>07.</span> Easy to clean</li>
                                <li><span>08.</span> Eco-friendly product (fully recyclable material)</li>
                                <li><span>09.</span> Does not contain any volatile organic chemicals</li>
                                <li><span>10.</span> Chemical resistance</li>
                                <li><span>11.</span> Heat resistance</li>
                            </ul>
                            <div class="clearfix"></div>
                            <span class="bold-separator"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--serv-item end -->                         
        </div>
        <div class="order-item fl-wrap">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-5">
                    <h3>Ready to order your project ? </h3>
                </div>
                <div class="col-md-3"><a href="{{route('landing.contacts')}}" class="btn float-btn flat-btn">Get in Touch</a></div>
            </div>
        </div>
    </div>
    <div class="limit-box fl-wrap"></div>
    <!--  partcile-dec--> 						   
    <div class="partcile-dec" data-parcount="200"></div>
    <!--  partcile-dec  end--> 
</section>
<!--  section  end--> 
@endsection