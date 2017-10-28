@extends('layout')

@section('title')
    Add Town -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Add Town for {{$city->name}}
                </h3>

                <a href="/admin/locations/{{$city->id}}">
                    <button class="buttonGrey">Back</button>
                </a>
            </div>


        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 add-town">
            <div class="col-lg-6">
                <form method="post" action="/admin/locations/city/add" enctype="multipart/form-data">
                    <div class="row">

                        <div class="formBlock">
                            <label for="town">Town Name</label><br/>
                            <input type="text" name="town" id="town" data-city-name="{{$city->name}}"/>
                            @if($errors->has('town'))
                                <div class="err">
                                    * {{$errors->first('town')}}
                                </div>
                            @endif
                        </div>

                        <div id="long-lat">

                        </div>

                        <div class="formBlock">
                            <input class="buttonGrey" type="button" value="Find Coordinates" id="geocode-address">
                        </div>

                        <div class="formBlock">
                            <div id="town-form-map" style="width: 100%; height: 480px;"></div>
                        </div>

                        <input type="hidden" name="city_id" value={{$city->id}}>
                        <input type="hidden" name="lat" value="" id="loc-lat">
                        <input type="hidden" name="lng" value="" id="loc-lng">


                        <div class="formBlock">
                            <input class="buttonGrey" type="submit" value="ADD TOWN" style="margin-top:24px;">
                        </div>
                        <div style="clear:both;"></div>

                        @if(Session::has('template_update'))
                            <div class="alertBox success text-center">
                                <h4>{{Session::get('template_update')}}</h4>
                            </div>
                        @endif
                    </div><!-- end row -->
                    {{csrf_field()}}
                </form><!-- end form -->

            </div><!-- end col -->

        </div>
    </div>
@endSection

@section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqb3fT3SbMSDMggMEK7fJOIkvamccLrjA"></script><!-- google maps -->
@endSection

@section('post_scripts')
    <script>
        APP.ADD_TOWN();
    </script>
@endSection
