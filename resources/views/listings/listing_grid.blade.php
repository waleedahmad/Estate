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

    <!-- start recent properties -->
    <section class="properties">
        <div class="container">

            @if(!Request::is('search*'))
                @include('listings.partials.header')
                <div class="divider"></div>

            @endif
            <div class="row">
                @if($listings->count())
                    @foreach($listings as $listing)
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="propertyItem">
                                <div class="propertyContent">
                                    <a class="propertyType" href="#">{{$listing->sub_type}}</a>
                                    <a href="/property/{{$listing->id}}" class="propertyImgLink">
                                        <div class="listingGridImageHolder">
                                            <img class="propertyImg" src="/storage/{{$listing->images->first()->image_uri}}" alt="" />
                                        </div>
                                    </a>
                                    <h4><a href="/property/{{$listing->id}}">{{$listing->title}}</a></h4>
                                    <p>{{$listing->town->name}}, {{$listing->town->city->name}}</p>
                                    <div class="divider thin"></div>
                                    <p class="forSale">For {{$listing->purpose}}</p>
                                    <p class="price">PKR {{$listing->price}}</p>
                                </div>
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

                    @endforeach
                @else
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        No listings found
                    </div>

                @endif
            </div><!-- end row -->
            @if($listings->count())
                {{ $listings->links('pagination.custom') }}
            @endif

        </div><!-- end container -->
    </section>
    <!-- end recent properties -->
@endSection()
