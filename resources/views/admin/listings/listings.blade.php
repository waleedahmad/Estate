@extends('layout')

@section('title')
    Property Listings -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Active Listings
                </h3>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 ">


            <!-- start recent properties -->
            <section class="properties">
                <div class="container">
                    <ul class="propertyCat_list option-set">
                        <li>
                            <a href="/admin/listings/approved"
                               data-filter="*"
                               @if(Request::is('admin/listings/approved'))
                               class="current triangle"
                                    @endif >
                                ALL
                            </a>
                        </li>

                        <li>
                            <a href="/admin/listings/approved/Sale"
                               data-filter="*"
                               @if(Request::is('admin/listings/approved/Sale'))
                               class="current triangle"
                                    @endif >
                                FOR SALE
                            </a>
                        </li>

                        <li>
                            <a href="/admin/listings/approved/Rent"
                               data-filter="*"
                               @if(Request::is('admin/listings/approved/Rent'))
                               class="current triangle"
                                    @endif >
                                FOR RENT
                            </a>
                        </li>

                        <li>
                            <a href="/admin/listings/approved/Lease"
                               data-filter="*"
                               @if(Request::is('admin/listings/approved/Lease'))
                               class="current triangle"
                                    @endif >
                                FOR LEASE
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

                                                        <td class="disapprove-listing" data-id="{{$listing->id}}">
                                                            Disapprove
                                                        </td>

                                                        <td class="delete-listing" data-id="{{$listing->id}}">
                                                            Delete
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

