@extends('layout')

@section('title')
    Login -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            <h1>Login Form</h1>
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
                    <h3>LOGIN</h3>
                    <div class="divider"></div>
                    <p style="font-size:13px;">Don't have an account yet? <a href="/register">Register here!</a></p>
                    <!-- start login form -->
                    <div class="filterContent sidebarWidget">
                        <form method="post" action="/login">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="login">Email</label><br/>
                                        <input type="text" name="email" id="login" value="{{old('email')}}" />

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
                                        <p style="font-size:13px;">Forgot Password? <a href="/password/reset">Recover here!</a></p>
                                    </div>
                                </div>



                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <input class="buttonColor" type="submit" value="LOGIN" style="margin-top:24px;">
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