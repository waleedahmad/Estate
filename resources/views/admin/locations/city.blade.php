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
                <a href="/admin/city/{{$city->id}}/town/add">
                    <button class="buttonGrey">Add Town</button>
                </a>
            </div>


        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 cities">
            @foreach($city->towns as $town)
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 town-block">
                    <a href="/admin/cities/town/{{$town->id}}">
                        <div class="city">
                            {{$town->name}}

                            <span class="glyphicon glyphicon-remove remove-town" data-id="{{$town->id}}" aria-hidden="true"></span>
                            <a href="/admin/cities/town/{{$town->id}}/edit">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endSection

@section('scripts')
    <script src="/lib/bootbox.js/bootbox.js"></script>
@endSection


