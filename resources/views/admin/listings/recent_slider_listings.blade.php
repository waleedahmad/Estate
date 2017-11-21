@extends('layout')

@section('title')
    Sliders & Recent Listings -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Sliders & Recent Listings
                </h3>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 ">
            <!-- start recent properties -->
            <section class="properties">
                <div class="container">
                    <ul class="propertyCat_list option-set" style="width:378px;">
                        <li>
                            <a href="/admin/listings/slider_recent"
                               data-filter="*"
                               @if(Request::is('admin/listings/slider_recent'))
                               class="current triangle"
                                    @endif >
                                ALL
                            </a>
                        </li>

                        <li>
                            <a href="/admin/listings/slider_recent/Slider"
                               data-filter="*"
                               @if(Request::is('admin/listings/slider_recent/Slider'))
                               class="current triangle"
                                    @endif >
                                Slider Listings
                            </a>
                        </li>

                        <li>
                            <a href="/admin/listings/slider_recent/Recent"
                               data-filter="*"
                               @if(Request::is('admin/listings/slider_recent/Recent'))
                               class="current triangle"
                                    @endif >
                                Recent Listings
                            </a>
                        </li>
                    </ul>

                    <div class="divider"></div>
                    <div class="row">
                        @if($listings->count())
                            @foreach($listings as $listing)

                                <div class="col-lg-12 listing-item">
                                    <div class="propertyItem">
                                        <div class="propertyContent row">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <a target="_blank" class="propertyType" href="#">{{$listing->sub_type}}</a>
                                                <a target="_blank" href="/property/{{$listing->id}}" class="propertyImgLink">
                                                    <div class="listingGridRowImageHolder">
                                                        <img class="propertyImgRow" src="/storage/{{$listing->images->first()->image_uri}}" alt="" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-8 rowText">
                                                <p class="price">PKR {{$listing->price}}</p>
                                                <p class="forSale">For {{$listing->purpose}}</p>
                                                <h4><a target="_blank" href="/property/{{$listing->id}}">{{$listing->title}}</a></h4><br/>
                                                <p>{{$listing->block->name}}, {{$listing->block->town->name}}, {{$listing->block->town->city->name}}</p>
                                                <p>{{$listing->description}}</p><br/>
                                                <table border="1" class="propertyDetails">
                                                    <tr>

                                                        <td class="toggle-slider" data-status="{{$listing->show_slider}}" data-id="{{$listing->id}}">
                                                            @if($listing->show_slider)
                                                                Remove from Slider
                                                            @else
                                                                Add to Slider
                                                            @endif
                                                        </td>

                                                        <td class="toggle-recent" data-status="{{$listing->show_recent}}" data-id="{{$listing->id}}">
                                                            @if($listing->show_recent)
                                                                Remove from Recent
                                                            @else
                                                                Add to Recent
                                                            @endif
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
                                No listings available.
                            </div>
                        @endif


                        @if($listings->count())
                            {{ $listings->links('pagination.custom') }}
                        @endif
                    </div><!-- end container -->
                </div>
            </section>
            <!-- end recent properties -->
        </div>
    </div>
@endSection

@section('scripts')
    <script src="/lib/bootbox.js/bootbox.js"></script>
@endSection

