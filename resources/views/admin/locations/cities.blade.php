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
                <a href="/admin/cities/add">
                    <button class="buttonGrey">Add Cities</button>
                </a>
            </div>


        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 states">
            @foreach($states as $state)
                <div class="state">
                    <h3>
                        {{$state->name}}
                    </h3>
                    <div class="cities">
                        @if($state->cities->count())
                            @foreach($state->cities as $city)
                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 city-block">
                                    <a href="/admin/cities/{{$city->id}}">
                                        <div class="city">

                                            {{$city->name}}

                                            <span class="glyphicon glyphicon-remove remove-city" data-id="{{$city->id}}" aria-hidden="true"></span>
                                            <a href="/admin/cities/edit/{{$city->id}}">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </a>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <h4>No Cities</h4>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endSection


@section('scripts')
    <script src="/lib/bootbox.js/bootbox.js"></script>
@endSection



