@extends('layout')

@section('title')
    Agents -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            <h1>Agents</h1>
            <form class="searchForm" method="post" action="#">
                <input type="text" name="search" value="Search our site" />
            </form>
        </div><!-- end subheader container -->
    </section><!-- end subheader section -->

    <!-- start properties -->
    <section class="properties">
        <div class="container">

            <div class="row">
                <div class="col-lg-9 col-md-9">
                    <div class="row">

                        @foreach($users as $agent)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="propertyItem">
                                    <div class="propertyContent">
                                        <a href="/agent/{{$agent->id}}" class="propertyImgLink">
                                            <div class="agentGridImageHolder">
                                                <img class="propertyImg" src="/storage/{{$agent->image_uri}}" alt="" />
                                            </div>
                                        </a>
                                        <h4><a href="/agent/{{$agent->id}}">{{$agent->name}}</a></h4>
                                        <p>{{$agent->Agent->description ? $agent->Agent->description : 'No Description' }}</p>
                                    </div>

                                    <table border="1" class="agentDetails">
                                        <tr>
                                            <td><a href="/agent/{{$agent->id}}" class="buttonGrey">READ MORE</a></td>
                                            <td>{{$agent->phone}}<br/>{{substr($agent->email, 0, 15)}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- end row -->
                    @if($users->count())
                        {{ $users->links('pagination.custom') }}
                    @endif
                </div><!-- end col -->

                <!-- START SIDEBAR -->
                <div class="col-lg-3 col-md-3">
                    @include('partials.quick_search')

                    @include('partials.sidebar_property_types')

                </div><!-- end col -->
            </div><!-- end row -->

        </div><!-- end container -->
    </section>
    <!-- end properties -->

@endSection