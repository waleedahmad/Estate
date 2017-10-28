@extends('layout')

@section('title')
    Layout Configuration -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Layout Configuration
                </h3>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 ">
            <div class="col-lg-6">
                <div class="">
                    <form method="post" action="/admin/config/layout" enctype="multipart/form-data">
                        <div class="row">

                            <div class="formBlock">
                                <label for="home_layout">Home Page Layout</label><br/>
                                <select name="home_layout" class="formDropdown" style="padding:6px;">
                                    <option value="Home Horizontal Filter" @if($config[0]->layout_name === "Home Horizontal Filter")selected @endif>Home Horizontal Filter</option>
                                    <option value="Home Map" @if($config[0]->layout_name === "Home Map")selected @endif>Home Map</option>
                                </select>
                                @if($errors->has('home_layout'))
                                    <div class="err">
                                        * {{$errors->first('home_layout')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="listing_layout">Listing Page Layout</label><br/>
                                <select name="listing_layout" class="formDropdown" style="padding:6px;">
                                    <option value="Listing Grid" @if($config[1]->layout_name === "Listing Grid")selected @endif>Listing Grid</option>
                                    <option value="Listing Grid Sidebar" @if($config[1]->layout_name === "Listing Grid Sidebar")selected @endif>Listing Grid Sidebar</option>
                                    <option value="Listing Grid Masonry" @if($config[1]->layout_name === "Listing Grid Masonry")selected @endif>Listing Grid Masonry</option>
                                    <option value="Listing Row" @if($config[1]->layout_name === "Listing Row")selected @endif>Listing Row</option>
                                    <option value="Listing Row Sidebar" @if($config[1]->layout_name === "Listing Row Sidebar")selected @endif>Listing Row Sidebar</option>
                                </select>
                                @if($errors->has('gender'))
                                    <div class="err">
                                        * {{$errors->first('gender')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="agents_layout">Agents Page Layout</label><br/>
                                <select name="agents_layout" class="formDropdown" style="padding:6px;">
                                    <option value="Agent Listing Grid" @if($config[2]->layout_name === "Agent Listing Grid")selected @endif>Agent Listing Grid</option>
                                    <option value="Agent Listing Grid Sidebar" @if($config[2]->layout_name === "Agent Listing Grid Sidebar")selected @endif>Agent Listing Grid Sidebar</option>
                                    <option value="Agent Listing Row" @if($config[2]->layout_name === "Agent Listing Row")selected @endif>Agent Listing Row</option>
                                    <option value="Agent Listing Row Sidebar" @if($config[2]->layout_name === "Agent Listing Row Sidebar")selected @endif>Agent Listing Row Sidebar</option>

                                </select>
                                @if($errors->has('gender'))
                                    <div class="err">
                                        * {{$errors->first('gender')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="contact_layout">Contact Page Layout</label><br/>
                                <select name="contact_layout" class="formDropdown" style="padding:6px;">
                                    <option value="Contact" @if($config[3]->layout_name === "Contact")selected @endif>Contact</option>
                                    <option value="Contact Wide" @if($config[3]->layout_name === "Contact Wide")selected @endif>Contact Wide</option>
                                </select>
                                @if($errors->has('gender'))
                                    <div class="err">
                                        * {{$errors->first('gender')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <input class="buttonGrey" type="submit" value="UPDATE LAYOUT" style="margin-top:24px;">
                            </div>
                            <div style="clear:both;"></div>

                            @if(Session::has('layout_update'))
                                <div class="alertBox success text-center">
                                    <h4>{{Session::get('layout_update')}}</h4>
                                </div>
                            @endif
                        </div><!-- end row -->
                        {{csrf_field()}}
                    </form><!-- end form -->


                </div><!-- end prfile form -->
            </div><!-- end col -->
        </div>
    </div>
@endSection