@extends('layout')

@section('title')
    Edit Property -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            <h1>Edit Property</h1>
            <form class="searchForm" method="post" action="#">
                <input type="text" name="search" value="Search our site" />
            </form>
        </div><!-- end subheader container -->
    </section><!-- end subheader section -->

    <!-- start my properties list -->
    <section
            class="properties submit-property"
            data-lat="{{$listing->location ? $listing->location->lat : $listing->town->coords->lat}}"
            data-lng="{{$listing->location ? $listing->location->lng : $listing->town->coords->lng}}"
            data-action="edit"
            data-listing-id="{{$listing->id}}"
    >
        <div class="container">
            <form method="post" action="/user/update_property">
                <div class="row">
                    <div class="col-lg-12 col-md-12 listing-errors">
                        <h3>ERRORS</h3>
                        <div class="divider"></div>
                        <div class="errors">

                        </div>
                    </div>
                    <!-- start property info -->
                    <div class="col-lg-4 col-md-4">
                        <h3>PROPERTY DETAILS</h3>
                        <div class="divider"></div>
                        <div class="sidebarWidget submission">
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="property_title">Property Title</label><br/>
                                        <input type="text" name="property_title" id="property_title" value="{{$listing->title}}"/>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="description">Description</label><br/>
                                        <textarea name="description" id="description" class="formDropdown">{{$listing->description}}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="price">Price (PKR)</label><br/>
                                        <input type="text" name="price" id="price" value="{{$listing->price}}" />
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="land_area">Land Area</label><br/>
                                        <input type="text" name="land_area" id="land_area" value="{{$listing->land_area}}" />
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="area_units">Units</label><br/>
                                        <select name="area_units" id="area_units" class="formDropdown">
                                            <option value="">Select Units</option>
                                            <option value="Square Feet" @if($listing->area_units === 'Square Feet') selected @endif>Square Feet</option>
                                            <option value="Square Yards" @if($listing->area_units === 'Square Yards') selected @endif>Square Yards</option>
                                            <option value="Square Meters" @if($listing->area_units === 'Square Meters') selected @endif>Square Meters</option>
                                            <option value="Marla" @if($listing->area_units === 'Marla') selected @endif>Marla</option>
                                            <option value="Kanal" @if($listing->area_units === 'Kanal') selected @endif>Kanal</option>

                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="expire_after">Expires After</label><br/>
                                        <select name="expire_after" id="expire_after" class="formDropdown">
                                            <option value="1" @if($listing->expire_after->toDateString() === $listing->created_at->addMonth(1)->addDay()->toDateString()) selected @endif>1 Month</option>
                                            <option value="3" @if($listing->expire_after->toDateString() === $listing->created_at->addMonth(3)->addDay()->toDateString()) selected @endif>3 Month</option>
                                            <option value="6" @if($listing->expire_after->toDateString() === $listing->created_at->addMonth(6)->addDay()->toDateString()) selected @endif>6 Month</option>
                                        </select>
                                    </div>
                                </div>

                                <div style="clear:both;"></div>
                            </div><!-- end row -->
                        </div>
                    </div>
                    <!-- end property info -->

                    <!-- start additional info -->
                    <div class="col-lg-4 col-md-4">
                        <h3>PROPERTY TYPE AND LOCATION</h3>
                        <div class="divider"></div>
                        <div class="sidebarWidget submission">
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="purpose">Purpose</label><br/>
                                        <select name="purpose" id="purpose" class="formDropdown">
                                            <option value="">Select Purpose</option>
                                            <option value="Sale" @if($listing->purpose === 'Sale') selected @endif>For Sale</option>
                                            <option value="Rent" @if($listing->purpose === 'Rent') selected @endif>For Rent</option>
                                            <option value="Lease" @if($listing->purpose === 'Lease') selected @endif>For Lease</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="propertyType">Property Type</label><br/>
                                        <select name="propertyType" id="propertyType" class="formDropdown">
                                            <option value="">Select Property Type</option>
                                            <option value="Home" @if($listing->type === 'Home') selected @endif>Home</option>
                                            <option value="Plots" @if($listing->type === 'Plots') selected @endif>Plots</option>
                                            <option value="Commercial" @if($listing->type === 'Commercial') selected @endif>Commercial</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6 sub-types" style="display: block;">
                                    <div class="formBlock">
                                        <label for="subType">Sub Type</label><br/>
                                        <select name="subType" id="subType" class="formDropdown">
                                            <option value="">Select Sub Type</option>
                                            @if($listing->type === 'Home')
                                                <option value="House" @if($listing->sub_type === 'House') selected @endif>House</option>
                                                <option value="Flat" @if($listing->sub_type === 'Flat') selected @endif>Flat</option>
                                                <option value="Upper Portion" @if($listing->sub_type === 'Upper Portion') selected @endif>Upper Portion</option>
                                                <option value="Lower Portion" @if($listing->sub_type === 'Lower Portion') selected @endif>Lower Portion</option>
                                                <option value="Farm House" @if($listing->sub_type === 'Farm House') selected @endif>Farm House</option>
                                                <option value="Room" @if($listing->sub_type === 'Room') selected @endif>Room</option>
                                                <option value="Penthouse" @if($listing->sub_type === 'Penthouse') selected @endif>Penthouse</option>
                                            @elseif($listing->type === 'Plots')
                                                <option value="Residential Plot" @if($listing->sub_type === 'Residential Plot') selected @endif>Residential Plot</option>
                                                <option value="Commercial Plot" @if($listing->sub_type === 'Commercial Plot') selected @endif>Commercial Plot</option>
                                                <option value="Agricultural Land" @if($listing->sub_type === 'Agricultural Land') selected @endif>Agricultural Land</option>
                                                <option value="Industrial Land" @if($listing->sub_type === 'Industrial Land') selected @endif>Industrial Land</option>
                                                <option value="Plot File" @if($listing->sub_type === 'Plot File') selected @endif>Plot File</option>
                                                <option value="Plot Form" @if($listing->sub_type === 'Plot Form') selected @endif>Plot Form</option>
                                            @elseif($listing->type === 'Commercial')
                                                <option value="Office" @if($listing->sub_type === 'Office') selected @endif>Office</option>
                                                <option value="Shop" @if($listing->sub_type === 'Shop') selected @endif>Shop</option>
                                                <option value="Warehouse" @if($listing->sub_type === 'Warehouse') selected @endif>Warehouse</option>
                                                <option value="Factory" @if($listing->sub_type === 'Factory') selected @endif>Factory</option>
                                                <option value="Building" @if($listing->sub_type === 'Building') selected @endif>Building</option>
                                                <option value="Other" @if($listing->sub_type === 'Other') selected @endif>Other</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="city">City</label><br/>
                                        <select name="city" id="city" class="formDropdown">
                                            <option value="">Select City</option>
                                            @foreach(\App\Cities::all() as $city)
                                                <option value="{{$city->id}}" @if($listing->town->city->id === $city->id) selected @endif>{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6 available-towns" style="display: block;">
                                    <div class="formBlock">
                                        <label for="location">Location</label><br/>
                                        <select name="location" id="location" class="selectpicker formDropdown" data-live-search="true">
                                            <option value="">Select from list</option>
                                            @foreach($listing->town->city->towns as $town)
                                                <option value="{{$town->id}}" @if($listing->town_id === $town->id) selected @endif>{{$town->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6 location-map">
                                    <div class="formBlock">
                                        <label for="listing-form-map">Selected Location</label><br/>
                                        <div id="listing-form-map" style="width: 100%; min-height: 190px"></div>
                                    </div>
                                </div>

                                <input type="hidden" id="lat" value="">
                                <input type="hidden" id="lng" value="">

                                <div style="clear:both;"></div>
                            </div><!-- end row -->
                        </div>
                    </div>
                    <!-- end additional info -->

                    <!-- start amenities -->
                    <div class="col-lg-4 col-md-4">
                        <h3>IMAGES</h3>
                        <div class="divider"></div>
                        <div class="sidebarWidget submission property-images">
                            <div class="dropzone" id="dropzone">
                                <div class="dz-message" data-dz-message><span>Drop files here or Click to upload</span></div>
                            </div>
                        </div>
                    </div>
                {{csrf_field()}}
                <!-- end amenities -->
                    {{--
                                        <button id="submit-all">Submit all files</button>
                    --}}

                    <div class="col-lg-4 col-lg-offset-4 col-md-4">
                        <div class="formBlock">
                            <input class="buttonColor" id="submit-listing" type="submit" value="UPDATE PROPERTY">
                        </div>
                    </div>
                </div><!-- end row -->
            </form>
        </div><!-- end container -->
    </section>
@endSection

@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqb3fT3SbMSDMggMEK7fJOIkvamccLrjA"></script><!-- google maps -->
    <script src="/js/dropzone.js"></script>
    <script src="/lib/bootstrap-select/dist/js/bootstrap-select.js"></script>
@endSection

@section('styles')
    <link rel="stylesheet" href="/css/dropzone.css">
    <link rel="stylesheet" href="/lib/bootstrap-select/dist/css/bootstrap-select.css">
@endSection