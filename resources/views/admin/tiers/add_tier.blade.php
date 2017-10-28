@extends('layout')

@section('title')
    Add Configuration -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Add Tier
                </h3>

                <a href="/admin/config/tiers">
                    <button class="buttonGrey">Back</button>
                </a>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 ">
            <div class="col-lg-6">
                <form method="post" action="/admin/config/tiers" enctype="multipart/form-data">
                    <div class="row">

                        <div class="formBlock">
                            <label for="town">Tier Name</label><br/>
                            <input type="text" name="name" id="name" value="{{old('name')}}"/>
                            @if($errors->has('name'))
                                <div class="err">
                                    * {{$errors->first('name')}}
                                </div>
                            @endif
                        </div>

                        <div class="formBlock">
                            <label for="allowed_listings">Allowed Listings</label><br/>
                            <input type="text" name="allowed_listings" id="allowed_listings" value="{{old('allowed_listings')}}"/>
                            @if($errors->has('allowed_listings'))
                                <div class="err">
                                    * {{$errors->first('allowed_listings')}}
                                </div>
                            @endif
                        </div>

                        <div class="formBlock">
                            <input class="buttonGrey" type="submit" value="ADD TIER" style="margin-top:24px;">
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