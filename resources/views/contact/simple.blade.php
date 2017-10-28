@extends('layout')

@section('title')
    Contact -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            <h1>Contact Us</h1>
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
                    <p>Duis elementum ullamcorper mi, ut sit ullamcorper
                        urna fringilla eget. In in non lectus sit amet lorem
                        convallis lorem et quis nunc.</p>

                    <p>Sed ullamcorper purus.Duis elementum ullamcorper
                        mi, ut sit ullamcorper urna fringilla eget. In in non
                        lectus sit amet lorem convallis lorem et quis nunc.
                        Sed ullamcorper purus.</p><br/>
                </div><!-- end left column -->

                <!-- start contact form -->
                <div class="col-lg-8 col-md-8">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h3>GET IN TOUCH</h3>
                            <div class="divider"></div>
                            <ul class="contactDetails">
                                <li><img src="/images/icon-mail.png" alt="" />info@easyLivingTheme.com</li>
                                <li><img src="/images/icon-phone.png" alt="" />1-800-192-0978</li>
                                <li><img src="/images/icon-pin.png" alt="" />467 Smith Drive Baltimore, MD</li>
                            </ul>
                            <form method="post" action="http://rypepixel.com/easy-living/contact.php" id="contact-us">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="formBlock">
                                            <label for="contactName">Your Name</label><br/>
                                            <input type="text" name="contactName" id="contactName" class="requiredField" value="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="formBlock">
                                            <label for="email">Your Email</label><br/>
                                            <input type="text" name="email" id="email" class="requiredField email" value="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="formBlock">
                                            <label for="message">Your Message</label><br/>
                                            <textarea name="comments" id="message" class="requiredField formDropdown"></textarea>
                                        </div>
                                    </div>
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