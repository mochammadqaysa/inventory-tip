@extends('pages.landing_page.layouts.root')

@section('content')
<div class="content">
  <!--  sroll-nav-wrap --> 
  {{-- <div class="sroll-nav-wrap">
      <div class="sroll-nav-container">
          <nav class="scroll-nav scroll-init fl-wrap">
              <ul>
                  <li><a class="scroll-link act-scrlink" href="#sec1">01.<span>Hero</span></a></li>
                  <li><a class="scroll-link" href="#sec2">02.<span>About</span></a></li>
                  <li><a class="scroll-link" href="#sec3">03.<span>Skills</span></a></li>
                  <li><a class="scroll-link" href="#sec4">04.<span>Video</span></a></li>
                  <li><a class="scroll-link" href="#sec5">05.<span>Team</span></a></li>
                  <li><a class="scroll-link" href="#sec6">06.<span>Story</span></a></li>
              </ul>
          </nav>
      </div>
  </div> --}}
  <!--  sroll-nav-wrap end --> 
  <!--  section --> 
  <section class="parallax-section header-section" data-scrollax-parent="true" id="sec1">
      <div class="bg"  data-bg="{{asset('argon2/assets/img/tiara.png')}}" data-scrollax="properties: { translateY: '200px' }"></div>
      <div class="overlay"></div>
      <div class="container big-container">
          <div class="section-title">
              <h3>Who we are</h3>
              <div class="separator trsp-separator"></div>
              <h2>About Us</h2>
              <p>Get to know PT. Tiara Indoprima, where innovation and our commitment to providing high-quality solutions are at the heart of every project we work on.</p>
              <a href="#sec2" class="custom-scroll-link sect-scroll-link"><i class="fa fa-long-arrow-down"></i> <span>scroll down</span></a>
          </div>
      </div>
  </section>
  <!--  section end --> 
  <!--  section --> 
  <section id="sec2" data-scrollax-parent="true" >
      <div class="container">
          <div class="section-container fl-wrap">
              <div class="row">
                  <div class="col-md-4">
                      <div class="pr-title">
                          Who We are
                          <span>we are a dedicated team of professionals committed to advancing the industry with our innovative solutions and unwavering quality in co-extruded thermoplastic products. </span>
                      </div>
                  </div>
                  <div class="col-md-8">
                      <div class="content-wrap about-wrap">
                          <div class="blog-media fl-wrap">
                              <div class="box-item">
                                  <img  src="images/folio/19.jpg"  class="respimg" alt="">
                                  <div class="overlay"></div>
                                  <a href="images/folio/19.jpg" class="image-popup popup-image"><i class="fa fa-search"  ></i></a>
                              </div>
                          </div>
                          <h3 class="bold-title">We are Tiara Indoprima</h3>
                          <p>At PT. Tiara Indoprima, we pride ourselves on our commitment to innovation and excellence. Our team of experts continuously seeks new ways to enhance our product offerings, ensuring that our solutions not only meet but exceed industry standards. By investing in advanced technology and rigorous quality control processes, we guarantee that each product delivers exceptional performance and durability. Our dedication to sustainability is reflected in our eco-friendly practices, which align with our goal of reducing environmental impact while providing top-tier solutions.
                          </p>
                          <p>With a strong global presence and a reputation for reliability, PT. Tiara Indoprima is well-positioned for future growth. We value our partnerships and strive to build long-lasting relationships with our clients by delivering superior products and outstanding customer service. As we continue to expand our market reach, we remain focused on innovation and quality, ensuring that we stay at the forefront of the industry and continue to meet the evolving needs of our customers worldwide.
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
              </div>
          </div>
      </div>
      <div class="bg dec-bg left-pos-dec"  data-bg="images/bg/14.jpg"></div>
  </section>
  <!--  section end -->  

  <!--  section  --> 
  <section id="sec6">
      <div class="container">
          <div class="row">
              <div class="col-md-4">
                  <div class="pr-title">
                      Our Story
                      <span>Our story is one of relentless innovation and growth, driven by a passion for excellence and a commitment to delivering top-quality thermoplastic solutions that meet the evolving needs of our global clients. </span>
                  </div>
              </div>
          </div>
          <div class="custom-inner-holder">
              <!-- 1 -->	
              <div class="custom-inner">
                  <div class="row">
                      <div class="col-md-4">
                          <div class="cus-inner-title fl-wrap">
                              <h3 >1</h3>
                          </div>
                      </div>
                      <div class="col-md-8">
                          <h4>How It Started</h4>
                          <p>PT. Tiara Indoprima is a sister company of PT. Carillon Indoprima (a private-label company with 90% of export product). Our family-owned group is headquartered in Java, Indonesia. The group has a history of more than 30 years in manufacturing Polyolefin like Polyethylene and Polypropylene film, netting for agricultural and industrial applications.</p>
                          
                          <span class="custom-inner-dec"></span>
                      </div>
                  </div>
              </div>
              <!-- 1 -->
          </div>
      </div>
      <div class="bg dec-bg left-pos-dec "  data-bg="images/bg/15.jpg"></div>
  </section>
  <!--  section end --> 
  <div class="limit-box fl-wrap"></div>
</div>
@endsection