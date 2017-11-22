@extends('layout')

@section('title')
    My Properties -
@endSection

@section('content')
    <div class="admin" >
        @include('user.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 user-admin">
            <a style="float:right; margin-top:-7px;" href="/user/submit_property" class="buttonGrey">+ Submit New Property</a>
            @if(Request::is('user/properties'))
                <h3>MY PROPERTIES</h3>
            @elseif(Request::is('user/properties/favorites'))
                <h3>FAVORITE PROPERTIES</h3>
            @else
                <h3>PENDING PROPERTIES</h3>
            @endif
            <div class="divider"></div>
            <table class="myProperties">


                @if($listings->count())

                    <tr class="myPropertiesHeader">
                        <td class="myPropertyImg">Image</td>
                        <td class="myPropertyAddress">Address</td>
                        <td class="myPropertyType">Type</td>
                        <td class="myPropertyStatus">Status</td>
                        <td class="myPropertyDate">Date Created</td>
                        <td class="myPropertyActions">Actions</td>
                    </tr>

                    @foreach($listings as $listing)
                        <tr class="my-property">
                            <td class="myPropertyImg">
                                <a href="/property/{{$listing->id}}">
                                    <img class="smallThumb"
                                         src="/storage/{{$listing->images->first()->image_uri}}"
                                         alt="" />
                                </a>
                            </td>
                            <td class="myPropertyAddress"><a href="/property/{{$listing->id}}"><h4>{{$listing->title}}</h4></a></td>
                            <td class="myPropertyType">{{$listing->sub_type}}</td>
                            <td class="myPropertyStatus">For {{$listing->purpose}}</td>
                            <td class="myPropertyDate">{{$listing->created_at->diffForHumans()}}</td>
                            <td class="myPropertyActions">
                                @if(Request::is('user/properties/favorites'))
                                    <span><a href="#" data-id="{{$listing->id}}" class="remove-fav-listing"><img class="icon" src="/images/icon-cross.png" alt="" />Remove from Favorite</a></span>
                                @else
                                    <span><a href="/property/{{$listing->id}}/edit"><img class="icon" src="/images/icon-pencil.png" alt="" />EDIT</a></span>
                                    <span><a href="#" data-id="{{$listing->id}}" class="remove-listing"><img class="icon" src="/images/icon-cross.png" alt="" />REMOVE</a></span>
                                    <span><a href="/property/{{$listing->id}}"><img class="icon" src="/images/icon-view.png" alt="" />VIEW</a></span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else


                    @if(Request::is('user/properties'))
                        You haven't submitted any properties yet.
                    @elseif(Request::is('user/properties/pending'))
                        No pending properties
                    @else
                        No favorite properties
                    @endif

                @endif
            </table>
            @if($listings->count())
                {{ $listings->links('pagination.custom') }}
            @endif
        </div>
    </div>
@endSection


@section('scripts')
    <script src="/lib/bootbox.js/bootbox.js"></script>
@endSection
