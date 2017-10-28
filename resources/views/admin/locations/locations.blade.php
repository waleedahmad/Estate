@extends('layout')

@section('title')
    Available Locations -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Available Cities
                </h3>
                <a href="/admin/locations/cities/add">
                    <button class="buttonGrey">Add Cities</button>
                </a>
            </div>


        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 cities">
            @foreach($cities as $city)
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <a href="/admin/locations/{{$city->id}}">
                        <div class="city">
                            {{$city->name}}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endSection

