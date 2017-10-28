@extends('layout')

@section('title')
    Property Listings -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            @if(Request::is('search*'))
                <h1>Search</h1>
            @else
                <h1>Property Listings</h1>
            @endif
            <form class="searchForm" method="post" action="#">
                <input type="text" name="search" value="Search our site" />
            </form>
        </div><!-- end subheader container -->
    </section><!-- end subheader section -->

    <!-- start properties -->
    <section class="properties">
        <div class="container">
            @if(!Request::is('search*'))
                @include('listings.partials.header')
                <div class="divider"></div>

            @endif
            <div class="row">
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        @if($listings->count())
                            @foreach($listings as $listing)

                                <div class="col-lg-12">
                                    <div class="propertyItem">
                                        <div class="propertyContent row">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <a class="propertyType" href="#">{{$listing->sub_type}}</a>
                                                <a href="/property/{{$listing->id}}" class="propertyImgLink"><img class="propertyImgRow" src="/storage/{{$listing->images->first()->image_uri}}" alt="" /></a>
                                            </div>
                                            <div class="col-lg-8 rowText">
                                                <p class="price">PKR {{$listing->price}}</p>
                                                <p class="forSale">For {{$listing->purpose}}</p>
                                                <h4><a href="/property/{{$listing->id}}">{{$listing->title}}</a></h4><br/>
                                                <p>{{$listing->town->name}}, {{$listing->town->city->name}}</p>
                                                <p>{{$listing->description}}</p><br/>
                                                <table border="1" class="propertyDetails">
                                                    <tr>
                                                        <td><img src="/images/icon-area.png" alt="" style="margin-right:7px;" />{{$listing->land_area}} {{$listing->area_units}}</td>

                                                        <td>
                                                            {{$listing->sub_type}}
                                                        </td>
                                                    </tr>


                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @else
                            <div class="col-lg-12">
                                No listings found
                            </div>
                        @endif

                        @if($listings->count())
                            {{ $listings->links('pagination.custom') }}
                        @endif

                    </div><!-- end row -->
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