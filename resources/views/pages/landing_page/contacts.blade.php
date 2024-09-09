@extends('pages.landing_page.layouts.root')
@section('content')
<section class="parallax-section header-section" data-scrollax-parent="true">
    <div class="bg"  data-bg="{{asset('balkon/images/bg/3.jpg')}}" data-scrollax="properties: { translateY: '200px' }"></div>
    <div class="overlay"></div>
    <div class="container big-container">
        <div class="section-title">
            <h3>Contact Details</h3>
            <div class="separator trsp-separator"></div>
            <h2>Get In Touch <br> with us</h2>
            <p>Can't wait to work together or have questions? Contact us and find out how we can help you achieve your needs.</p>
            <a href="#sec1" class="custom-scroll-link sect-scroll-link"><i class="fa fa-long-arrow-down"></i> <span>scroll down</span></a>
        </div>
    </div>
</section>
<!--  section  end-->
<!--  section  -->
<section >
    <div class="container">
        <div class="contact-details-wrap fl-wrap" id="sec1">
            <div class="row">
                <div class="col-md-3">
                    <div class="small-sec-title">
                        <h3>Contact details :</h3>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="contact-details fl-wrap">
                        <div class="row border-dec">
                            <div class="col-md-6">
                                <h4><span>01.</span>Office in Bandung</h4>
                                <ul>
                                    <li><span>Mail :</span><a href="#" target="_blank">info@tiara-indoprima.com</a></li>
                                    <li><span>Adress :</span><a href="#" target="_blank">K.I. Trikencana Kavling 1 Jl. Terusan Kopo Km 11.5, Kab. Bandung - 40971, Indonesia</a></li>
                                    <li><span>Phone 1 :</span><a href="#">+6(222)5897440</a></li>
                                    <li><span>Phone 2 :</span><a href="#">+6(222)5897441</a></li>
                                    <li><span>Fax :</span><a href="#">+6(222)5897453</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h4><span>02.</span>Work Hours</h4>
                                <ul>
                                    <li><span>Monday - Friday : </span> 08.00 - 17.00</li>
                                    <li><span>Saturday: </span> 08.00 - 12.00 </li>
                                    <li><span>Sunday :</span> Off work </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="map-box">
            <div  id="map-canvas"></div>
        </div>
    </div>
    <!--  partcile-dec  -->
    <div class="partcile-dec" data-parcount="200"></div>
    <!--  partcile-dec  end-->
</section>
@endsection

@section('script')

<script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFdSZ3yH3xMyoQhIWgVjnsSd7LaujEHbw&callback=initMap"></script>
<script>
  function initMap() {
    $(() => {
      $('#map-canvas').gmap3({
        map: {
          options: {
            center: {lat: -6.988728110380635, lng: 107.55494668743424},
            zoom: 19,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          }
        },
        marker: {
          values: [
            {latLng: [-6.988728110380635, 107.55494668743424], data: 'Bandung Office'}
          ],
          options: {
            icon: '{{asset("balkon/images/pointmap.svg")}}'
          },
          events: {
            mouseover: function(marker, event, context) {
              var map = $(this).gmap3("get");
              var infowindow = $(this).gmap3({get: {name: "infowindow"}});
              if (infowindow) {
                infowindow.open(map, marker);
                infowindow.setContent(context.data);
              } else {
                $(this).gmap3({
                  infowindow: {
                    anchor: marker, 
                    options: {content: context.data}
                  }
                });
              }
            }
          }
        }
      });
    });
  }

</script>


<script type="text/javascript" src="{{asset('balkon/js/map.js')}}"></script>

@endsection