@extends('layout')

@section('title')
    Contact -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            <h1>Contact</h1>
            <form class="searchForm" method="post" action="#">
                <input type="text" name="search" value="Search our site" />
            </form>
        </div><!-- end subheader container -->
    </section><!-- end subheader section -->

    <!-- start main content -->
    <section class="properties">
        <div class="container">
            <div class="row">

                <!-- start left column -->
                <div class="col-lg-4 col-md-4">
                    <div id="map-canvas-one-pin" class="mapSmall"></div>
                    <p>
                        {{\App\Config::where('name', '=', 'description')->first()->value}}
                    </p><br/>
                </div><!-- end left column -->

                <!-- start contact form -->
                <div class="col-lg-8 col-md-8">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h3>GET IN TOUCH</h3>
                            <div class="divider"></div>
                            <ul class="contactDetails">
                                <li><img src="/images/icon-mail.png" alt="" />{{\App\Config::where('name', '=', 'email')->first()->value}}</li>
                                <li><img src="/images/icon-phone.png" alt="" />{{\App\Config::where('name', '=', 'phone')->first()->value}}</li>
                                <li><img src="/images/icon-pin.png" alt="" />{{\App\Config::where('name', '=', 'address')->first()->value}}</li>
                            </ul>
                            <form method="post" action="/contact" id="contact-us">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="formBlock">
                                            <label for="contactName">Your Name</label><br/>
                                            <input type="text" name="contactName" id="contactName" class="requiredField" value=""/>
                                            @if($errors->has('contactName'))
                                                <div class="err">
                                                    * {{$errors->first('contactName')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="formBlock">
                                            <label for="email">Your Email</label><br/>
                                            <input type="text" name="email" id="email" class="requiredField email" value=""/>
                                            @if($errors->has('email'))
                                                <div class="err">
                                                    * {{$errors->first('email')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="formBlock">
                                            <label for="message">Your Message</label><br/>
                                            <textarea name="comments" id="message" class="requiredField formDropdown"></textarea>
                                            @if($errors->has('comments'))
                                                <div class="err">
                                                    * {{$errors->first('comments')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        @if(Session::has('message'))
                                            <div class="alertBox success text-center">
                                                <h4>{{Session::get('message')}}</h4>
                                            </div>
                                        @endif
                                    </div>
                                    {{csrf_field()}}
                                    <div class="col-lg-3 col-lg-offset-9 col-md-4 col-md-offset-8 col-sm-4 col-sm-offset-8">
                                        <div class="formBlock">
                                            <input class="buttonColor" type="submit" value="SEND" />
                                            <input type="hidden" name="submitted" id="submitted" value="true" />
                                        </div>
                                    </div>
                                </div><!-- end row -->
                            </form><!-- end form -->
                        </div><!-- col -->
                    </div><!-- end row -->
                </div><!-- end contact form -->

            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- end main content -->
@endSection

@section('scripts')

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqb3fT3SbMSDMggMEK7fJOIkvamccLrjA&amp;sensor=false"></script><!-- google maps -->
    <script type="text/javascript" src="/js/map-one-pin.js"></script> <!-- map script -->

    <script type="text/javascript">

    $(document).ready(function() {
        $('form#contact-us').submit(function() {
            $('form#contact-us .error').remove();
            var hasError = false;
            $('.requiredField').each(function() {
                if($.trim($(this).val()) == '') {
                    var labelText = $(this).prev('label').text();
                    $(this).parent().append('<span class="error">This field is required!</span>');
                    $(this).addClass('inputError');
                    hasError = true;
                } else if($(this).hasClass('email')) {
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if(!emailReg.test($.trim($(this).val()))) {
                        var labelText = $(this).prev('label').text();
                        $(this).parent().append('<span class="error">Sorry! You\'ve entered an invalid email.</span>');
                        $(this).addClass('inputError');
                        hasError = true;
                    }
                }
            });
            if(!hasError) {
                var formInput = $(this).serialize();
                $.post($(this).attr('action'),formInput, function(data){
                    $('form#contact-us').slideUp("fast", function() {
                        $(this).before('<p class="tick"><strong>Thanks!</strong> Your email has been delivered!</p>');
                    });
                });
            }

            return false;
        });
    });
    </script>
@endSection