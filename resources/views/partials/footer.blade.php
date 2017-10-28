<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <h4><a class="footerLogo" href="#"><img src="/images/logoGreen.png" alt="{{\App\Config::where('name', '=', 'app_name')->first()->value}}" />{{\App\Config::where('name', '=', 'app_name')->first()->value}} <span>Estate</span></a></h4>
                <p>{{\App\Config::where('name', '=', 'description')->first()->value}}</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <h4>CONTACT</h4>
                <ul class="contactList">
                    <li><img class="icon" src="/images/icon-pin.png" alt="" /> {{\App\Config::where('name', '=', 'address')->first()->value}}</li>
                    <li><img class="icon" src="/images/icon-phone.png" alt="" /> {{\App\Config::where('name', '=', 'phone')->first()->value}}</li>
                    <li><img class="icon" src="/images/icon-mail.png" alt="" /> {{\App\Config::where('name', '=', 'email')->first()->value}}</li>
                </ul>
            </div>
            {{--<div class="col-lg-3 col-md-3 col-sm-6">
                <h4>TWITTER</h4>
                <ul>
                    <li><a href="#">@JohnDoe</a> Lorem ipsum dolor amet,
                        adipiscing elit. Maecenas eget tellus.<br/><span>5 MINUTES AGO</span></li>
                    <li><a href="#">@JohnDoe</a> Lorem ipsum dolor amet,
                        adipiscing elit. Maecenas eget tellus.<br/><span>5 MINUTES AGO</span></li>
                </ul>
            </div>--}}
            <div class="col-lg-4 col-md-4 col-sm-6">
                <h4>NEWSLETTER</h4>
                <p>{{\App\Config::where('name', '=', 'newsletter_description')->first()->value}}</p>
                <form class="subscribeForm" method="post" action="#">
                    <input type="text" name="email" value="Your email" class="input footer" />
                    <input type="submit" name="submit" value="SEND" class="buttonColor" />
                </form>
            </div>
        </div><!-- end row -->
    </div><!-- end footer container -->
</footer>