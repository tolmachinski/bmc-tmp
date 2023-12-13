@extends('layouts.app')

@section('title', 'New York City Mortgage Loans & Investor Financing | Contact Us')
@section('description', 'Have questions about mortage loans or financing your investments? Black Mountain Capitals experts can help. Contact us now!')

@section('headScript')
<script>
  gtag('config', 'AW-10883150489/7RuWCLfq7-MDEJnlvsUo', {
    'phone_conversion_number': '(646) 504- 3255'
  });
</script>
@endsection

@section('content')
<section class="firm-content">
    <aside class="orange-section">
        <div>
            <p>
                <span>{{$sectionText->heading}}</span>
                {{$sectionText->line_1}}
                <span class="small-size">{{$sectionText->line_2}}</span>
            </p>
            <a href="#" class="btn-down"></a>
        </div>
    </aside>
</section>
<section class="contact">
    <div class="main">
        <div class="clearfix">
            <div class="left large-60">
                <span class="btn black">contact us</span>
                <div class="contact-details">
                    @foreach($contactUs as $contact)
                        <div>
                            <h3>{{ $contact->title_1 }}</h3>
                            <span>{!! $contact->address_1 !!}</span>

                            <h3>{{ $contact->title_2 }}</h3>
                            <span>{!! $contact->address_2 !!}</span>

                            <div>
                                <ul class="socials">
                                    <li>
                                        <a href="{!! $contact->facebook !!}" class="facebook"></a>
                                    </li>
                                    <li>
                                        <a href="{!! $contact->twitter !!}" class="twitter"></a>
                                    </li>
                                    <li>
                                        <a href="{!! $contact->in !!}" class="linkedin"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="right large-40">


                <div class="store-image">
                    <img src="/images/bmc-store.jpg" alt="bmc store">
                </div>

                <span class="btn black" id="form_anchor">Submit Request</span>

                <div class="form-contact">
                    <div class="form">
                        <form onsubmit="window.lintrk('track', { conversion_id: 10644425 });" name="form" method="post"  action="{!! route('send_email') !!}#form_anchor">
                            {{ csrf_field() }}
                            <div style="color: red;">
                            </div>

                            <ul>
                                <li class="first-field">
                                    
                                    <input type="email" placeholder="Email address" id="form_email" name="email" value="{{ isset($data['email']) ? $data['email'] : '' }}" >
                                        @if($errors->has('email'))
                                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                </li>
                                <li class="field">
                                    
                                    <input type="text" placeholder="Subject" id="form_subject" name="subject" value="{{ isset($data['subject']) ? $data['subject'] : '' }}" >
                                        @if($errors->has('subject'))
                                            <div class="alert alert-danger">{{ $errors->first('subject') }}</div>
                                        @endif
                                </li>
                                <li class="field">
                                    
                                    <input type="text" placeholder="Contact number" id="form_contact_number" value="{{ isset($data['contact_number']) ? $data['contact_number'] : '' }}" name="contact_number">
                                        @if($errors->has('contact_number'))
                                            <div class="alert alert-danger">{{ $errors->first('contact_number') }}</div>
                                        @endif
                                </li>
                                <li class="last-field">
                                    
                                    <textarea id="form_description" placeholder="Description" name="description" value="" >{{ isset($data['description']) ? $data['description'] : '' }}</textarea>
                                        @if($errors->has('description'))
                                            <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                                        @endif
                                </li>
                                
                                
                                    <div style="display:flex; justify-content: end; text-align:right">{!! htmlFormSnippet() !!}</div>

                                    @if($errors->has(recaptchaFieldName()))
                                        <div class="alert alert-danger">{{ $errors->first(recaptchaFieldName()) }}</div>
                                    @endif   
                                       
                            </ul>
                            <button type="submit" id="form_save" name="save]">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="map" id="map"></div>--}}
</section>

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready( function() {
        $('.form-contact form li')
                .focusin( function() { $(this).addClass('focus'); })
                .focusout( function() {
                            var input = $(this).find('input');
                            var txt = $(this).find('textarea');

                            if (empty(input.val()) && empty(txt.val())) {
                                $(this).removeClass('focus');
                            }
                        }
                );

        $('.form-contact form li').each(function() {
            var input = $(this).find('input');
            var txt = $(this).find('textarea');

            if (!empty(input.val()) || !empty(txt.val())) {
                $(this).addClass('focus');
            }
        });

    });
</script>

{{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD-a0L4vUQ2NrbEJJvRe8XVhNngHLbMAg&sensor=false"></script>--}}

<script type="text/javascript">

    var lat = 40.751226;
    var lng = -73.979987;

    // When the window has finished loading create our google map below
    //google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {

            scrollwheel: false,

            // How zoomed in you want the map to start at (always required)
            zoom: 15,

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(lat, lng), // New York

            // How you would like to style the map.
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#000000"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":"4"}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"on"},{"saturation":"-100"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":20},{"visibility":"on"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"administrative.neighborhood","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"on"},{"lightness":"80"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#797979"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":20}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"landscape.natural.landcover","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"landscape.natural.terrain","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#dfdfdf"},{"lightness":21},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fed41c"},{"visibility":"on"},{"weight":"3.00"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#fed41c"},{"gamma":"0.6"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#fed41c"},{"weight":"4.00"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry.stroke","stylers":[{"weight":"1"},{"gamma":"0.6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#b8b8b8"},{"lightness":18},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#b6b6b6"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"},{"color":"#656565"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#cdcdcd"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#b6b6b6"},{"visibility":"on"}]},{"featureType":"road.local","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#c5c5c5"},{"lightness":19},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c0d8e3"},{"lightness":17},{"visibility":"on"}]}]
        };

        // Get the HTML DOM element that will contain your map
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lng),
            map: map
        });

        var infowindow = new google.maps.InfoWindow({
            content: "275 Madison Avenue, 6th Fl<br />" +
            "New York, NY 10016<br />" +
            "T: 646.504.3255<br />" +
            "F: 646.607.5639<br />" +
            "E: info@blackmountaincapital.biz"
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });

    }
</script>
@endsection
