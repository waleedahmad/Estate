@extends('layout')

@section('title')
    Edit Block -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    {{$block->name}}, {{$block->town->name}}, {{$block->town->city->name}}
                </h3>

                <a href="/admin/cities/town/{{$block->town->id}}">
                    <button class="buttonGrey">Back</button>
                </a>
            </div>


        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 add-block">
            <div class="col-lg-6">
                <form method="post" action="/admin/cities/town/block/update" enctype="multipart/form-data">
                    <div class="row">

                        <div class="formBlock">
                            <label for="town">Town Name</label><br/>
                            <input type="text" name="block" id="block" value="{{$block->name}}" data-town-name="{{$block->town->name}}" data-city-name="{{$block->town->city->name}}"/>
                            @if($errors->has('block'))
                                <div class="err">
                                    * {{$errors->first('block')}}
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

                        <input type="hidden" name="id" value={{$block->id}}>
                        <input type="hidden" name="lat" value="{{$block->coords->lat}}" id="loc-lat">
                        <input type="hidden" name="lng" value="{{$block->coords->lng}}" id="loc-lng">


                        <div class="formBlock">
                            <input class="buttonGrey" type="submit" value="UPDATE BLOCK" style="margin-top:24px;">
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
        APP.ADD_BLOCK();
        $("#geocode-address").click();
    </script>
@endSection