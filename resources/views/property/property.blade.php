@extends('layout')

@section('title')
    {{$listing->title}}, {{$listing->block->name}}, {{$listing->block->town->name}}, {{$listing->block->town->city->name}} -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            <h1>{{$listing->title}}</h1>
            <form class="searchForm" method="post" action="#">
                <input type="text" name="search" value="Search our site" />
            </form>
        </div><!-- end subheader container -->
    </section><!-- end subheader section -->

    <!-- start main content section -->
    <section class="properties">
        <div class="container">

            <div class="row">

                <!-- start content -->
                <div class="col-lg-9 col-md-9">
                    <div class="gallery">

                        <ul class="bxslider2">
                            @foreach($listing->images as $image)
                                <li><img src="/storage/{{$image->image_uri}}" alt="" /></li>
                            @endforeach
                        </ul>

                        <div id="bx-pager">
                            @foreach($listing->images as $image)

                                <a data-slide-index="{{$loop->index}}" href="#"><img src="/storage/{{$image->image_uri}}"  height="112" width="113" alt="" /></a>
                            @endforeach
                        </div>
                        <div class="sliderControls">
                            <span class="slider-prev"></span>
                            <span class="slider-next"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="overview">
                                <h4>OVERVIEW</h4>
                                <ul class="overviewList">
                                    <li>Property Type <span>{{$listing->type}}</span></li>
                                    <li>Property Sub Type <span>{{$listing->sub_type}}</span></li>
                                    <li>Contract Type <span>For {{$listing->purpose}}</span></li>
                                    <li>Location <span>{{$listing->block->town->name}}, {{$listing->block->town->city->name}}</span></li>
                                    <li>Size <span>{{$listing->land_area}} {{$listing->area_units}}</span></li>
                                </ul>
                            </div>
                            <div id="map-canvas-one-pin" class="mapSmall"></div>
                        </div>
                        <div class="col-lg-8">
                            <p class="price" style="float:right;">PKR {{$listing->price}}</p>
                            <p class="forSale" style="float:right; margin-right:20px;">For {{$listing->purpose}}</p>
                            <h1>{{$listing->title}}</h1>
                            <p>{{$listing->block->name}}, {{$listing->block->town->name}}, {{$listing->block->town->city->name}}</p>
                            <p>
                                {{$listing->description}}
                            </p>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    @if($listing->link)
                        <!-- start related properties -->
                            <h4>YOUTUBE VIDEO</h4>
                            <div class="divider thin"></div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    {!! $listing->link->embed_code !!}
                                </div>

                            </div><!-- end related properties row -->
                    @endif

                    <!-- start related properties -->
                    <h4>RELATED PROPERTIES</h4>
                    <div class="divider thin"></div>
                    <div class="row">
                        @foreach($r_listings as $listed)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="propertyItem">
                                    <div class="propertyContent">
                                        <a class="propertyType" href="/property/{{$listed->id}}">{{$listed->sub_type}}</a>
                                        <a href="/property/{{$listed->id}}" class="propertyImgLink">
                                            <div class="recentListings">
                                                <img class="propertyImg" src="/storage/{{$listed->images->first()->image_uri}}" alt="" />
                                            </div>
                                        </a>
                                        <h4><a href="/property/{{$listed->id}}">{{$listed->title}}</a></h4>
                                        <p>{{$listed->block->town->name}}, {{$listed->block->town->city->name}}</p>
                                        <div class="divider thin"></div>
                                        <p class="forSale">FOR {{$listed->purpose}}</p>
                                        <p class="price">PKR {{$listed->price}}</p>
                                    </div>
                                    <table border="1" class="propertyDetails">
                                        <tr>
                                            <td><img src="/images/icon-area.png" alt="" style="margin-right:7px;" />{{$listed->land_area}} {{$listed->area_units}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- end related properties row -->

                </div><!-- end content -->

                <!-- start sidebar -->
                <div class="col-lg-3 col-md-3">
                    <!-- start quick search widget -->
                    @if(Auth::check() && $listing->user_id != Auth::id())

                        @if(Auth::user()->type != 'admin')
                            <h3>Bookmark</h3>
                            <div class="divider"></div>
                            <button
                                    class="buttonColor listing-fav-toggle"
                                    style="margin-bottom: 20px; width: 100%;"
                                    data-id="{{$listing->id}}"

                                    data-status="{{Auth::user()->FavListing($listing->id)}}"
                            >
                                @if(Auth::user()->FavListing($listing->id))
                                    Remove From Favorites
                                @else
                                    Add to Favorites
                                @endif
                            </button>

                            <h3>Contact</h3>
                            <div class="divider"></div>

                            <a href="/message/to/{{$listing->user_id}}">
                                <button
                                        class="buttonColor listing-fav-toggle"
                                        style="margin-bottom: 20px; width: 100%;"
                                        data-id="{{$listing->id}}"

                                        data-status="{{Auth::user()->FavListing($listing->id)}}"
                                >
                                    Chat with {{$listing->user->name}}
                                </button>
                            </a>


                        @endif
                    @endif

                    <button
                            class="buttonColor"
                            style="margin-bottom: 20px; width: 100%;"
                    >
                        @if($listing->user->phone)
                            Phone : {{$listing->user->phone}}
                        @else
                            Phone : N/A
                        @endif

                    </button>

                    @include('partials.quick_search')
                    @include('partials.sidebar_property_types')

                </div><!-- end col -->
            </div><!-- end row -->

        </div><!-- end container -->
    </section>
    <!-- end main content -->

@endSection

@section('scripts')
    <script>
        $('.bxslider2').bxSlider({
            pagerCustom: '#bx-pager',
            nextSelector: '.slider-next',
            prevSelector: '.slider-prev',
            nextText: '<img src="/images/slider-next2.png" alt="Next" />',
            prevText: '<img src="/images/slider-prev2.png" alt="Previous" />'
        });
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqb3fT3SbMSDMggMEK7fJOIkvamccLrjA&amp;sensor=false"></script><!-- google maps -->
    <script>
        //intialize the map
        function initialize() {
            var mapOptions = {
                zoom: 13,
                center: new google.maps.LatLng(
                    '{{$listing->location ? $listing->location->lat : $listing->block->coords->lat}}',
                    '{{$listing->location ? $listing->location->lng : $listing->block->coords->lng}}'
                )
            };

            var map = new google.maps.Map(document.getElementById('map-canvas-one-pin'),
                mapOptions);


            // MARKERS
                        /****************************************************************/

            //add a marker1
            var marker = new google.maps.Marker({
                position: map.getCenter(),
                map: map,
                icon: '/images/pin.png'
            });



            // INFO BOXES
                        /****************************************************************/

            //show info box for marker1
            var contentString = '<div class="info-box"><img src="/storage/{{$listing->images->first()->image_uri}}" style="max-width:100%; margin-bottom:10px;" alt="" /><p>{{$listing->title}}</p></div>';

            var infowindow = new google.maps.InfoWindow({ content: contentString });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });

        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endSection