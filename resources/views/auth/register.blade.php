@extends('layout')

@section('title')
    Register -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            <h1>Register Form</h1>
            <form class="searchForm" method="post" action="#">
                <input type="text" name="search" value="Search our site" />
            </form>
        </div><!-- end subheader container -->
    </section><!-- end subheader section -->

    <!-- start main content -->
    <section class="properties">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-lg-offset-4">
                    <h3>REGISTER</h3>
                    <div class="divider"></div>
                    <p style="font-size:13px;">Already have an account? <a href="/login">Login here!</a></p>
                    <!-- start login form -->
                    <div class="filterContent sidebarWidget">
                        <form method="post" action="/register" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="name">Name</label><br/>
                                        <input type="text" name="name" id="name"  value="{{old('name')}}"/>
                                        @if($errors->has('name'))
                                            <div class="err">
                                                * {{$errors->first('name')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="email">Email</label><br/>
                                        <input type="text" name="email" id="email"  value="{{old('email')}}"/>
                                        @if($errors->has('email'))
                                            <div class="err">
                                                * {{$errors->first('email')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="pass">Password</label><br/>
                                        <input type="password" name="password" id="pass" value="{{old('password')}}" />
                                        @if($errors->has('password'))
                                            <div class="err">
                                                * {{$errors->first('password')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="confirmPass">Confirm Password</label><br/>
                                        <input type="password" name="confirm_password" id="confirm_password" />
                                        @if($errors->has('confirm_password'))
                                            <div class="err">
                                                * {{$errors->first('confirm_password')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <input class="buttonColor" type="submit" value="REGISTER" style="margin-top:24px;">
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                            </div><!-- end row -->
                            {{csrf_field()}}

                        </form><!-- end form -->
                    </div><!-- end login form -->
                </div><!-- end col -->

            </div>
        </div><!-- end container -->
    </section>
    <!-- end main content -->

@endSection