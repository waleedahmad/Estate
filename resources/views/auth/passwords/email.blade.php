@extends('layout')

@section('title')
    Reset Password -
@endSection

@section('content')
    <!-- start main content -->
    <section class="auth">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-lg-offset-3">
                    <h3>Recover Password</h3>
                    <div class="divider"></div>
                    <!-- start login form -->
                    <div class="filterContent sidebarWidget">
                        <form method="post" action="{{ route('password.email') }}">
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
                                        <input class="buttonColor" type="submit" value="RECOVER PASSWORD" style="margin-top:24px;">
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