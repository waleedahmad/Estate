@extends('layout')

@section('title')
    Add Property -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            <h1>Submit Property</h1>
            <form class="searchForm" method="post" action="#">
                <input type="text" name="search" value="Search our site" />
            </form>
        </div><!-- end subheader container -->
    </section><!-- end subheader section -->

    <!-- start my properties list -->
    <section class="properties">
        <div class="container">
            <form method="post" action="/user/submit_property">
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
                                        <input type="text" name="property_title" id="property_title" />
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="description">Description</label><br/>
                                        <textarea name="description" id="description" class="formDropdown"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="price">Price (PKR)</label><br/>
                                        <input type="text" name="price" id="price" />
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="land_area">Land Area</label><br/>
                                        <input type="text" name="land_area" id="land_area" />
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="area_units">Units</label><br/>
                                        <select name="area_units" id="area_units" class="formDropdown">
                                            <option value="">Select Units</option>
                                            <option value="Square Feet">Square Feet</option>
                                            <option value="Square Yards">Square Yards</option>
                                            <option value="Square Meters">Square Meters</option>
                                            <option value="Marla">Marla</option>
                                            <option value="Kanal">Kanal</option>

                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="expire_after">Expires After</label><br/>
                                        <select name="expire_after" id="expire_after" class="formDropdown">
                                            <option value="1">1 Month</option>
                                            <option value="3">3 Month</option>
                                            <option value="6">6 Month</option>
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
                                            <option value="Sale">For Sale</option>
                                            <option value="Rent">For Rent</option>
                                            <option value="Lease">For Lease</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="propertyType">Property Type</label><br/>
                                        <select name="propertyType" id="propertyType" class="formDropdown">
                                            <option value="">Select Property Type</option>
                                            <option value="Home">Home</option>
                                            <option value="Plots">Plots</option>
                                            <option value="Commercial">Commercial</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6 sub-types">
                                    <div class="formBlock">
                                        <label for="subType">Sub Type</label><br/>
                                        <select name="subType" id="subType" class="formDropdown">
                                            <option value="">Select Sub Type</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="city">City</label><br/>
                                        <select name="city" id="city" class="formDropdown">
                                            <option value="">Select City</option>
                                            @foreach(\App\Cities::all() as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6 available-towns">
                                    <div class="formBlock">
                                        <label for="town">Town</label><br/>
                                        <select name="town" id="town" class="formDropdown selectpicker" data-live-search="true" data-width="100%">
                                            <option value="">Select from list</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6 available-blocks">
                                    <div class="formBlock">
                                        <label for="blocks">Blocks</label><br/>
                                        <select name="blocks" id="block" class="formDropdown selectpicker" data-live-search="true" data-width="100%">
                                            <option value="">Select from list</option>
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
                            <div id="dropzone">
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
                            <input class="buttonColor" id="submit-listing" type="submit" data-action="add" value="SUBMIT PROPERTY">
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

@section('post_scripts')
    <script>
        APP.SUBMIT_LISTING();
    </script>
@endSection