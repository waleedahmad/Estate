<!-- start call to action -->
<section class="callToAction" style="padding-top:70px;">
    <div class="container">
        <div class="ctaBox">
            <div class="col-lg-9">
                <h1>{{\App\Config::where('name', '=', 'footer_title')->first()->value}}</h1>
                <p>{{\App\Config::where('name', '=', 'footer_description')->first()->value}}</p>
            </div>
            <div class="col-lg-3">
                <a style="float:right; margin-top:15px;" class="buttonColor" href="/contact">CONTACT US</a>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
</section>
<!-- end call to action -->