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
                @foreach($users as $agent)


                    <div class="col-lg-12">
                        <div class="propertyItem">
                            <div class="propertyContent row">
                                <div class="col-lg-5 col-md-5">
                                    <a href="/agent/{{$agent->id}}" class="propertyImgLink"><img class="propertyImgRow" src="/storage/{{$agent->image_uri}}" alt="" /></a>
                                </div>
                                <div class="col-lg-7 col-md-7 rowText agentRow">
                                    <h4><a href="/agent/{{$agent->id}}">{{$agent->name}}</a></h4>
                                    <a href="#" class="price"><span style="color:#4a4786;">68</span> Properties Listed</a><br/><br/>
                                    <p>{{$agent->phone}}<br/>{{$agent->email}}</p>
                                    <p>{{$agent->Agent->description ? $agent->Agent->description : 'No Description' }}</p>
                                    <table border="1" class="agentDetails in-row">
                                        <tr>
                                            <td>
                                                <ul class="socialIcons">
                                                    <li><a href="#"><img src="/images/icon-fb.png" alt="" /></a></li>
                                                    <li><a href="#"><img src="/images/icon-twitter.png" alt="" /></a></li>
                                                    <li><a href="#"><img src="/images/icon-google.png" alt="" /></a></li>
                                                    <li><a href="#"><img src="/images/icon-rss.png" alt="" /></a></li>
                                                </ul>
                                            </td>
                                            <td>
                                                <a href="agent_single.html" class="buttonGrey">READ MORE</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div><!-- end row -->

            @if($users->count())
                {{ $users->links('pagination.custom') }}
            @endif
        </div><!-- end container -->
    </section>
    <!-- end properties -->
@endSection