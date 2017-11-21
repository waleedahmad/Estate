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

                <a href="/admin/cities/{{$city->id}}">
                    <button class="buttonGrey">Back</button>
                </a>
            </div>


        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 add-town">
            <div class="col-lg-6">
                <form method="post" action="/admin/cities/town" enctype="multipart/form-data">
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

                        <input type="hidden" name="city_id" value={{$city->id}}>


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