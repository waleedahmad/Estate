@extends('layout')

@section('content')
    <!-- start subheader -->
    <section class="sliderControls">
        <div>
            <span class="slider-prev"></span>
            <span class="slider-next"></span>
        </div>
    </section>

    <section class="subHeader home bxslider">
        @foreach($slider_listings as $listing)
            <div id="slide1" style="background-image: url('/storage/{{$listing->images->first()->image_uri}}');background-repeat:no-repeat;background-size:cover;">
                <div class="container">
                    <div class="col-lg-6">
                        <h1>{{$listing->title}}</h1>
                        <div class="sliderTextBox">
                            <p>{{substr($listing->description, 0, 100)}}... </p>
                            <a class="buttonGrey large" href="/property/{{$listing->id}}"><span class="icon-button-arrow"></span><span class="buttonText">VIEW DETAILS</span></a>
                            @if(Auth::checK())
                                @if($listing->user_id != Auth::user()->id)
                                    @if(Auth::user()->type != 'admin')
                                        <span class="or">OR</span>
                                        <a class="buttonColor" href="/message/to/{{$listing->user->id}}">
                                            <span class="icon-button-user"></span>
                                            <span class="buttonText">CONTACT AGENT</span>
                                        </a>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-lg-offset-3"><h1 class="sliderPrice">{{$listing->price}}</h1></div>
                </div>
            </div>
        @endforeach
    </section>

    <!-- start horizontal filter -->
    <section class="filter">
        <div class="container">
            <div class="filterHeader">
                <ul class="filterNav tabs">
                    <li><a class="current triangle" href="#tab1">ALL PROPERTIES</a></li>
                    <li><a href="#tab1" data-purpose="Sale">FOR SALE</a></li>
                    <li><a href="#tab1" data-purpose="Rent">FOR RENT</a></li>
                    <li><a href="#tab1" data-purpose="Lease">FOR LEASE</a></li>

                </ul>
                <div class="filterHeadButton"><a class="buttonGrey" href="/listings">VIEW ALL LISTINGS</a></div>
            </div>
            <div class="filterContent" id="tab1">
                <form method="GET" action="/search" class="prop-search">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="formBlock">
                                <label for="propertyType">Property Type</label><br/>
                                <select name="propertyType" id="search-type" class="formDropdown">
                                    <option value="Any">Any</option>
                                    <option value="Home">Home</option>
                                    <option value="Plots">Plots</option>
                                    <option value="Commercial">Commercial</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="formBlock">
                                <label for="location">Sub Type</label><br/>
                                <select name="subType" id="search-sub-type" class="formDropdown">
                                    <option value="Any">Any</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="formBlock">
                                <label for="price-min">Price Range</label><br/>
                                <div style="float:right; margin-top:-25px;">
                                    <div class="priceInput"><input type="text" name="priceMin" id="price-min" class="priceInput" /></div>
                                    <span style="float:left; margin-right:10px; margin-left:10px;">-</span>
                                    <div class="priceInput"><input type="text" name="priceMax" id="price-max" class="priceInput" /></div>
                                </div><br/>
                                <div class="priceSlider"></div>
                                <div class="priceSliderLabel"><span>0</span><span style="float:right;">{{\App\Listings::all()->max('price')}}</span></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="formBlock">
                                <label for="state">State</label><br/>
                                <select name="state" id="state" class="formDropdown">
                                    <option value="Any">Any</option>
                                    @foreach(\App\State::all() as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="formBlock">
                                <label for="city">City</label><br/>
                                <select name="city" id="city" class="formDropdown">
                                    <option value="Any">Any</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="formBlock">
                                <label for="town">Town</label><br/>
                                <select name="town" id="town" class="formDropdown">
                                    <option value="Any">Any</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="formBlock">
                                <label for="block">Block</label><br/>
                                <select name="block" id="block" class="formDropdown">
                                    <option value="Any">Any</option>
                                </select>
                            </div>
                        </div>


                        <input type="hidden" name="view" value="main">
                        <input type="hidden" name="purpose" id="purpose" value="ALL">

                        <div class="col-lg-3 col-md-3 col-sm-6" style="float:right">
                            <div class="formBlock">
                                <input class="buttonColor" type="submit" value="FIND PROPERTIES" style="margin-top: 24px;">
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </form>
            </div><!-- END TAB1 -->

        </div><!-- END CONTAINER -->
    </section>
    <!-- end horizontal filter -->

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
                                <p>{{$listing->block->name}}, {{$listing->block->town->name}}, {{$listing->block->town->city->name}}</p>
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
                        @if($agent->Agent->description)
                            <p>{{strlen($agent->Agent->description) > 30 ? substr($agent->Agent->description,0 ,27).'...' :  $agent->Agent->description }}</p>
                        @else
                            <p>N/A</p>
                        @endif
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

    {{--<!-- start widgets section -->
    <section class="genericSection">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>RECENT BLOG POSTS</h3>
                    <div class="divider"></div>
                    <div class="recentBlogPost">
                        <img class="blogThumb" src="images/blog-thumb1.jpg" alt="" />
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
                        <img class="blogThumb" src="images/blog-thumb2.png" alt="" />
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
                        <img class="blogThumb" src="images/testimonial-thumb1.png" alt="" />
                        <h4>JOHN DOE</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
                            vehicula dapibus mauris, quis ullamcorper enim aliquet sed.
                            Maecenas eget tellus dui. Vivamus condimentum egestas nulla
                            quis vehicula. Sed justo turpis, commodo sit amet.</p>
                    </div>
                    <div class="divider thin" style="margin-top:20px; margin-bottom:20px;"></div>
                    <div>
                        <img class="blogThumb" src="images/testimonial-thumb2.png" alt="" />
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
    <!-- end widgets section -->--}}


@endSection

@section('scripts')
    <script>
        //call bxslider for sub header section
        $(document).ready(function(){
            $('.bxslider').bxSlider({
                auto: true,
                pager: false,
                nextSelector: '.slider-next',
                prevSelector: '.slider-prev',
                nextText: '<img src="/images/slider-next.png" alt="slider next" />',
                prevText: '<img src="/images/slider-prev.png" alt="slider prev" />'
            });
        });
    </script>

    <script>

        if($('.priceSlider').length){
            let $min = $('#price-min'),
                $max = $('#price-max');

            $($min).val(parseInt(100));
            $($max).val({{\App\Listings::all()->max('price')}});
            var slider = document.getElementsByClassName('priceSlider')[0];

            noUiSlider.create(slider, {
                range: {
                    'min': 0,
                    'max': {{\App\Listings::all()->max('price')}}
                }
                ,step: 1000
                ,start: [100, {{\App\Listings::all()->max('price')}}]
                ,connect: true
                ,direction: 'ltr'
                ,orientation: 'horizontal'
                ,behaviour: 'tap-drag'
            });

            slider.noUiSlider.on('change', function(values){
                console.log(values);
                $($min).val(parseInt(values[0]));
                $($max).val(parseInt(values[1]));
            });
        }
    </script>
@endSection

@section('post_scripts')
    <script>
        APP.SEARCH();
    </script>
@endSection