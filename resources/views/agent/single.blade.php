@extends('layout')

@section('title')
    Agents -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            <h1>{{$agent->name}}</h1>
        </div><!-- end subheader container -->
    </section><!-- end subheader section -->

    <!-- start main content section -->
    <section class="properties">
        <div class="container">

            <div class="row">

                <!-- start content -->
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="agentImg" src="/storage/{{$agent->image_uri}}" alt="" style="width: 100%;"/>
                            <div class="overview">
                                <h4>AGENT INFO</h4>
                                <ul class="overviewList">
                                    <li>Email <span>{{$agent->email}}</span></li>
                                    <li>Mobile Phone <span>{{$agent->phone ? $agent->phone : 'N/A'}}</span></li>
                                    <li>Office Phone <span>{{$agent->Agent->office_phone ? $agent->Agent->office_phone : 'N/A' }}</span></li>
                                </ul>
                                <div class="divider thin" style="margin-top:0px;"></div>
                                <ul class="socialIcons agent">
                                    <li><a target="_blank" href="{{$agent->Agent->facebook}}"><img src="/images/icon-fb.png" alt="" /></a></li>
                                    <li><a target="_blank" href="{{$agent->Agent->twitter}}"><img src="/images/icon-twitter.png" alt="" /></a></li>
                                    <li><a target="_blank" href="{{$agent->Agent->google_plus}}"><img src="/images/icon-google.png" alt="" /></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <h1>{{$agent->name}}</h1>
                            {{$agent->agent->description}}
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <!-- start related properties -->
                    <h4>CURRENTLY LISTED PROPERTIES BY <a href="/agent/{{$agent->id}}">{{$agent->name}}</a></h4>
                    <div class="divider thin"></div>
                    <div class="row">

                        @foreach($agent->listings as $listing)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="propertyItem">
                                    <div class="propertyContent">
                                        <a class="propertyType" href="/property/{{$listing->id}}">{{$listing->type}}</a>
                                        <a href="/property/{{$listing->id}}" class="propertyImgLink">

                                            <div class="listingGridImageHolder">
                                                <img class="propertyImg"
                                                     src="/storage/{{$listing->images->first()->image_uri}}"
                                                     alt=""
                                                />
                                            </div>
                                        </a>
                                        <h4><a href="/property/{{$listing->id}}">
                                                {{strlen($listing->title) > 30 ? substr($listing->title, 0 , 27).'...' : $listing->title}}
                                            </a>
                                        </h4>
                                        <p>{{strlen($listing->block->name) > 30 ? substr($listing->block->name, 0 , 30).'...': $listing->block->name}}<br>
                                            {{$listing->block->town->name}},
                                            {{$listing->block->town->city->name}}
                                        </p>                                        <div class="divider thin"></div>
                                        <p class="forSale">FOR {{$listing->purpose}}</p>
                                        <p class="price">PKR{{$listing->price}}</p>
                                    </div>
                                    <table border="1" class="propertyDetails">
                                        <tr>
                                            <td><img src="/images/icon-area.png" alt="" style="margin-right:7px;" />{{$listing->land_area}} {{$listing->area_units}}</td>
                                            <td>{{$listing->sub_type}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- end related properties row -->

                    <br/>
                </div><!-- end content -->

                <!-- start sidebar -->
                <div class="col-lg-3 col-md-3">
                    <a href="/message/to/{{$agent->id}}">
                        <input class="buttonColor" type="submit" value="CONTACT AGENT" style="margin-bottom: 30px;"/>
                    </a>
                    @include('partials.quick_search')


                    @include('partials.sidebar_property_types')

                </div><!-- end col -->
            </div><!-- end row -->

        </div><!-- end container -->
    </section>
    <!-- end main content -->
@endSection