@extends('layout')

@section('title')
    Contact -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            <h1>Contact Us Wide</h1>
            <form class="searchForm" method="post" action="#">
                <input type="text" name="search" value="Search our site" />
            </form>
        </div><!-- end subheader container -->
    </section><!-- end subheader section -->

    <!-- start map -->
    <section>
        <div id="map-canvas-one-pin" class="mapContact"></div>
    </section>
    <!-- end map -->

    <!-- start main content -->
    <section class="properties">
        <div class="container">
            <div class="row">

                <!-- start left column -->
                <div class="col-lg-4 col-md-4">
                    <img class="contactImg" src="/images/office-building.jpg" alt="" />
                    <p>Duis elementum ullamcorper mi, ut sit ullamcorper
                        urna fringilla eget. In in non lectus sit amet lorem
                        convallis lorem et quis nunc. Sed ullamcorper purus. Duis elementum ullamcorper
                        mi, ut sit ullamcorper urna fringilla eget. In in non
                        lectus sit amet lorem convallis lorem et quis nunc.
                        Sed ullamcorper purus.</p>

                    <p>Duis elementum ullamcorper mi, ut sit ullamcorper
                        urna fringilla eget. In in non lectus sit amet lorem
                        convallis lorem et quis nunc.</p>

                    <p>Sed ullamcorper purus.Duis elementum ullamcorper
                        mi, ut sit ullamcorper urna fringilla eget. In in non
                        lectus sit amet lorem convallis lorem et quis nunc.
                        Sed ullamcorper purus.</p>
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
                            <form method="post" action="#">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="formBlock">
                                            <label for="name">Your Name</label><br/>
                                            <input type="text" name="name" id="name" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="formBlock">
                                            <label for="email">Your Email</label><br/>
                                            <input type="text" name="email" id="email" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="formBlock">
                                            <label for="message">Your Message</label><br/>
                                            <textarea name="message" id="message" class="formDropdown"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-lg-offset-9 col-md-4 col-md-offset-8 col-sm-4 col-sm-offset-8">
                                        <div class="formBlock">
                                            <input class="buttonColor" type="submit" value="SEND" />
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
@endSection