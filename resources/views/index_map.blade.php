@extends('layout')

@section('content')
    <!-- start subheader -->
    <section class="subHeader map">
        <div id="map-canvas"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-lg-offset-7 col-md-5 col-md-offset-7 col-sm-5 col-sm-offset-7 mapFilter">
                    <div class="filterHeader">
                        <ul class="filterNav tabs">
                            <li><a class="triangle" href="#tab1" data-purpose="ALL">ALL</a><span class="arrow-down"></span></li>
                            <li><a href="#tab1"  data-purpose="SALE">SALE</a></li>
                            <li><a href="#tab1"  data-purpose="RENT">RENT</a>
                            <li><a href="#tab1"  data-purpose="LEASE">LEASE</a></li>

                        </ul>
                    </div>
                    <div class="filterContent" id="tab1">
                        <form method="GET" action="/search" class="prop-search">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="formBlock">
                                        <label for="propertyType">Property Type</label><br/>
                                        <select name="propertyType" id="search-type" class="formDropdown">
                                            <option value="ANY">Any</option>
                                            <option value="Home">Home</option>
                                            <option value="Plots">Plots</option>
                                            <option value="Commercial">Commercial</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="formBlock">
                                        <label for="location">Sub Type</label><br/>
                                        <select name="subType" id="search-sub-type" class="formDropdown">
                                            <option value="">Any</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="formBlock">
                                        <label for="price-min">Price Range</label><br/>
                                        <div style="float:right; margin-top:-25px;">
                                            <div class="priceInput"><input type="text" name="priceMin" id="price-min" class="priceInput" /></div>
                                            <span style="float:left; margin-right:10px; margin-left:10px;">-</span>
                                            <div class="priceInput"><input type="text" name="priceMax" id="price-max" class="priceInput" /></div>
                                        </div><br/>
                                        <div class="priceSlider"></div>
                                        <div class="priceSliderLabel"><span>0</span><span style="float:right;">800,000</span></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="formBlock">
                                        <label for="city">Cities</label><br/>
                                        <select name="city" id="city" class="formDropdown">
                                            <option value="">Any</option>
                                            @foreach(\App\Cities::all() as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="formBlock">
                                        <label for="town">Town</label><br/>
                                        <select name="town" id="town" class="formDropdown">
                                            <option value="">Any</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="formBlock">
                                        <input class="buttonColor" type="submit" value="FIND PROPERTIES" style="margin-top:24px;">
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </form>
                    </div><!-- END TAB1 -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end subheader container -->
    </section><!-- end subheader section -->

    <!-- start big message -->
    <section class="bigMessage">
        <div class="container">
            <h1>Easy, fast & <span>affordable</span> A&A Esate</h1>
            <p>{{\App\Config::where('name', '=', 'description')->first()->value}}</p>
        </div>
    </section>
    <!-- end big message -->

    <!-- start recent properties -->
    <section class="properties">
        <div class="container">
            <h3>RECENT PROPERTIES</h3>
            <div class="divider"></div>
            <div class="row">
                @foreach($recent_listings as $listing)
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="propertyItem">
                            <div class="propertyContent">
                                <a class="propertyType" href="#">{{$listing->sub_type}}</a>
                                <a href="/property/{{$listing->id}}" class="propertyImgLink">
                                    <div class="recentListings">
                                        <img class="propertyImg" src="/storage/{{$listing->images->first()->image_uri}}" alt="" />
                                    </div>
                                </a>
                                <h4><a href="/property/{{$listing->id}}">{{$listing->title}}</a></h4>
                                <p>{{$listing->town->name}}, {{$listing->town->city->name}}</p>
                                <div class="divider thin"></div>
                                <p class="forSale">For {{$listing->purpose}}</p>
                                <p class="price">PKR {{$listing->price}}</p>
                            </div>
                            <table border="1" class="propertyDetails">
                                <tr>
                                    <td><img src="/images/icon-area.png" alt="" style="margin-right:7px;" />{{$listing->land_area}} {{$listing->area_units}}</td>

                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach

            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- end recent properties -->

    <!-- start services section -->
    <section class="services">
        <div class="container">
            <h1>We make your life <span>easy</span>. Here’s how.</h1><br/><br/>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <img src="images/listings-icon.png" alt="" /><br/><br/>
                    <h4>HOTTEST LISTINGS</h4>
                    <p>{{\App\Config::where('name', '=', 'hottest_listing_description')->first()->value}} </p>
                    <img class="serviceArrow" src="images/arrow.png" alt="" />
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <img src="images/agents-icon.png" alt="" /><br/><br/>
                    <h4>KNOWLEDGABLE AGENTS</h4>
                    <p>{{\App\Config::where('name', '=', 'knowledge_agents')->first()->value}} </p>
                    <img class="serviceArrow" src="images/arrow.png" alt="" />
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <img src="images/compass-icon.png" alt="" /><br/><br/>
                    <h4>EXPERTISE & GUIDANCE</h4>
                    <p>{{\App\Config::where('name', '=', 'expertise_guidance')->first()->value}} </p>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- end services section -->

    <!-- start top agents section -->
    <section class="topAgents">
        <div class="container">
            <div class="row">
                @foreach($agents as $agent)
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="agents-imageholder">
                            <img class="agentImg" src="/storage/{{$agent->image_uri}}" alt="" /><br/><br/>
                        </div>
                        <h4>{{strtoupper($agent->name)}}</h4>
                        <p>{{--{{$agent->Agent->description}}--}} Description goes here</p>
                        <ul class="socialIcons">
                            <li><a href="#"><img src="images/icon-fb.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/icon-twitter.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/icon-google.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/icon-rss.png" alt="" /></a></li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- end top agents section -->

    <!-- start widgets section -->
    <section class="genericSection">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>RECENT BLOG POSTS</h3>
                    <div class="divider"></div>
                    <div class="recentBlogPost">
                        <img class="blogThumb" src="/images/blog-thumb1.jpg" alt="" />
                        <div class="recentBlogContent">
                            <h4><a href="blog_single.html">AWESOME DREAM HOUSE IN A GREAT LOCATION</a></h4>
                            <p>Lorem ipsum dolor amet, consectetur adipiscing elit. Quisque
                                eget ante vel nunc posuere rhoncus. Donec quis elit sit...</p>
                            <a class="buttonGrey" href="#">READ MORE</a>
                            <div class="date"><p>Feb 5, 2014</p></div>
                        </div>
                    </div>
                    <div class="divider thin" style="margin-top:5px; margin-bottom:20px;"></div>
                    <div class="recentBlogPost">
                        <img class="blogThumb" src="/images/blog-thumb2.png" alt="" />
                        <div class="recentBlogContent">
                            <h4><a href="blog_single.html">AWESOME DREAM HOUSE IN A GREAT LOCATION</a></h4>
                            <p>Lorem ipsum dolor amet, consectetur adipiscing elit. Quisque
                                eget ante vel nunc posuere rhoncus. Donec quis elit sit...</p>
                            <a class="buttonGrey" href="#">READ MORE</a>
                            <div class="date"><p>Feb 5, 2014</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3>TESTIMONIALS</h3>
                    <div class="divider"></div>
                    <div>
                        <img class="blogThumb" src="/images/testimonial-thumb1.png" alt="" />
                        <h4>JOHN DOE</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
                            vehicula dapibus mauris, quis ullamcorper enim aliquet sed.
                            Maecenas eget tellus dui. Vivamus condimentum egestas nulla
                            quis vehicula. Sed justo turpis, commodo sit amet.</p>
                    </div>
                    <div class="divider thin" style="margin-top:20px; margin-bottom:20px;"></div>
                    <div>
                        <img class="blogThumb" src="/images/testimonial-thumb2.png" alt="" />
                        <h4>JOHN DOE</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
                            vehicula dapibus mauris, quis ullamcorper enim aliquet sed.
                            Maecenas eget tellus dui. Vivamus condimentum egestas nulla
                            quis vehicula. Sed justo turpis, commodo sit amet.</p>
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- end widgets section -->
@endSection


@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqb3fT3SbMSDMggMEK7fJOIkvamccLrjA"></script><!-- google maps -->
    <script>
        //intialize the map
        function initialize() {
            var markers = [];
            var content = [];
            var infoWindows = [];
            var mapOptions = {
                zoom: 6,
                center: new google.maps.LatLng(29.959043, 69.430908)
            };


            var map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

            @foreach($slider_listings as $listing)
                var marker_{{$loop->index}} = new google.maps.Marker({
                    position: {
                        lat : {{$listing->location ? $listing->location->lat : $listing->town->coords->lat}},
                        lng : {{$listing->location ? $listing->location->lng : $listing->town->coords->lng}}
                    },
                    map: map,
                    zoom: 14,
                    icon: '/images/pin.png'
                });

                var contentString_{{$loop->index}} = '<div class="info-box"><img src="/storage/{{$listing->images->first()->image_uri}}" style="max-width:100%; margin-bottom:10px;" alt="" /><h4>{{$listing->title}}</h4><p>{{$listing->description}}</p><a href="/property/{{$listing->id}}" class="buttonGrey">VIEW DETAILS</a><br/></div>';
                var infowindow_{{$loop->index}} = new google.maps.InfoWindow({ content: contentString_{{$loop->index}} });

                google.maps.event.addListener(marker_{{$loop->index}}, 'click', function() {
                    infowindow_{{$loop->index}}.open(map,marker_{{$loop->index}});
                });
            @endforeach

        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script>
        var Link = $.noUiSlider.Link;
        let $slider = $('.priceSlider');

        $($slider).noUiSlider({
            range: {
                'min': {{\App\Listings::all()->min('price')}},
                'max': {{\App\Listings::all()->max('price')}}
            }
            ,start: [{{\App\Listings::all()->min('price')}}, {{\App\Listings::all()->max('price')}}]
            ,step: 1000
            ,margin: 100000
            ,connect: true
            ,direction: 'ltr'
            ,orientation: 'horizontal'
            ,behaviour: 'tap-drag'
            ,serialization: {
                lower: [
                    new Link({
                        target: $("#price-min")
                    })
                ],

                upper: [
                    new Link({
                        target: $("#price-max")
                    })
                ],

                format: {
                    // Set formatting
                    decimals: 0,
                }
            }
        });

        $($slider).on('change', function(){
            console.log($($slider).val());
        });


    </script>
@endSection