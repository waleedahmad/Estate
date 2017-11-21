@extends('layout')

@section('title')
    Edit City -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Edit City
                </h3>
            </div>


        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 ">
            <div class="col-lg-6">
                <form method="post" action="/admin/cities/update" enctype="multipart/form-data">
                    <div class="row">

                        <div class="formBlock">
                            <label for="state">State</label><br/>
                            <select name="state" id="state" class="formDropdown">
                                <option value="">Select State</option>
                                @foreach(\App\State::all() as $state)
                                    <option value="{{$state->id}}" @if($state->id === $city->state_id) selected @endif >{{$state->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state'))
                                <div class="err">
                                    * {{$errors->first('state')}}
                                </div>
                            @endif
                        </div>

                        <div class="formBlock">
                            <label for="city">City Name</label><br/>
                            <input type="text" name="city" value="{{old('city') ? old('city') : $city->name}}"/>
                            @if($errors->has('city'))
                                <div class="err">
                                    * {{$errors->first('city')}}
                                </div>
                            @endif
                        </div>

                        <input type="hidden" value="{{$city->id}}" name="id">

                        <div class="formBlock">
                            <input class="buttonGrey" type="submit" value="ADD CITY" style="margin-top:24px;">
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

