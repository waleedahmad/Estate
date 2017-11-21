@extends('layout')

@section('title')
    Edit Town -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    {{$town->name}}, {{$town->city->name}}
                </h3>

                <a href="/admin/cities/{{$town->city->id}}">
                    <button class="buttonGrey">Back</button>
                </a>
            </div>


        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 add-town">
            <div class="col-lg-6">
                <form method="post" action="/admin/cities/towns/update" enctype="multipart/form-data">
                    <div class="row">

                        <div class="formBlock">
                            <label for="town">Town Name</label><br/>
                            <input type="text" name="town" id="town" value="{{$town->name}}"/>
                            @if($errors->has('town'))
                                <div class="err">
                                    * {{$errors->first('town')}}
                                </div>
                            @endif
                        </div>

                        <input type="hidden" value="{{$town->id}}" name="id">

                        <div class="formBlock">
                            <input class="buttonGrey" type="submit" value="UPDATE TOWN" style="margin-top:24px;">
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