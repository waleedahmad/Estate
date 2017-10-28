@extends('layout')

@section('title')
    {{$city->name}} -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    {{$city->name}}
                </h3>
                <a href="/admin/locations/city/{{$city->id}}/add">
                    <button class="buttonGrey">Add Town</button>
                </a>
            </div>


        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 cities">
            @foreach($city->towns as $town)
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                    <a href="/admin/locations/town/{{$town->id}}">
                        <div class="city">
                            {{$town->name}}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endSection

