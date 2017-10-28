@extends('layout')

@section('title')
    Agents -
@endSection

@section('content')
    <!-- start subheader -->
    <section class="subHeader page">
        <div class="container">
            <h1>Agent Single</h1>
            <form class="searchForm" method="post" action="#">
                <input type="text" name="search" value="Search our site" />
            </form>
        </div><!-- end subheader container -->
    </section><!-- end subheader section -->

    <!-- start main content section -->
    <section class="properties">
        <div class="container">

            <div class="row">

                <!-- start content -->
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="agentImg" src="/images/agent5.jpg" alt="" />
                            <div class="overview">
                                <h4>AGENT INFO</h4>
                                <ul class="overviewList">
                                    <li>Email <span>jDoe@easyliving.com</span></li>
                                    <li>Mobile Phone <span>123-456-7890</span></li>
                                    <li>Office Phone <span>123-456-7890</span></li>
                                </ul>
                                <div class="divider thin" style="margin-top:0px;"></div>
                                <ul class="socialIcons agent">
                                    <li><a href="#"><img src="/images/icon-fb.png" alt="" /></a></li>
                                    <li><a href="#"><img src="/images/icon-twitter.png" alt="" /></a></li>
                                    <li><a href="#"><img src="/images/icon-google.png" alt="" /></a></li>
                                    <li><a href="#"><img src="/images/icon-rss.png" alt="" /></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <h1>John Doe</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu dignissim erat, el
                                placerat risus. Proin luctus tortor vitae varius elementum. Duis ut condimentum
                                risus, ac accumsan dui. Donec nibh elit, elementum dapibus massa sit amet, lacus
                                faucibus lacus.</p>

                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                                turpis egestas. Curabitur at est eu ipsum auctor suscipit. Pellentesque habitant
                                morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer
                                dolor mi, pulvinar nec nibh ut, tincidunt vulputate odio.Vivamus fermentum lorem
                                bibendum arcu, a venenatis odio pretium sit amet. Curabitur at est eu ipsum auctor
                                suscipit. Pellentesque habitant morbi tristique senectus et netus et malesuada
                                fames ac turpis egestas.</p>

                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                                turpis egestas. Curabitur at est eu ipsum auctor suscipit. Pellentesque habitant
                                morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer
                                dolor mi, pulvinar nec nibh ut, tincidunt vulputate odio.Vivamus fermentum lorem
                                bibendum arcu, a venenatis odio pretium sit amet.</p><br/>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <!-- start related properties -->
                    <h4>CURRENTLY LISTED PROPERTIES BY <a href="#">JOHN DOE</a></h4>
                    <div class="divider thin"></div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="propertyItem">
                                <div class="propertyContent">
                                    <a class="propertyType" href="#">FAMILY HOME</a>
                                    <a href="property_single.html" class="propertyImgLink"><img class="propertyImg" src="/images/home3.jpg" alt="" /></a>
                                    <h4><a href="property_single.html">587 Smith Avenue</a></h4>
                                    <p>Baltimore, MD</p>
                                    <div class="divider thin"></div>
                                    <p class="forSale">FOR SALE</p>
                                    <p class="price">$687,000</p>
                                </div>
                                <table border="1" class="propertyDetails">
                                    <tr>
                                        <td><img src="/images/icon-area.png" alt="" style="margin-right:7px;" />2,412m</td>
                                        <td><img src="/images/icon-bed.png" alt="" style="margin-right:7px;" />6 Beds</td>
                                        <td><img src="/images/icon-drop.png" alt="" style="margin-right:7px;" />3 Baths</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="propertyItem">
                                <div class="propertyContent">
                                    <span class="openHouse">OPEN HOUSE</span>
                                    <a class="propertyType" href="#">APARTMENT</a>
                                    <a href="property_single.html" class="propertyImgLink"><img class="propertyImg" src="/images/home3.jpg" alt="" /></a>
                                    <h4><a href="property_single.html">587 Smith Avenue</a></h4>
                                    <p>Baltimore, MD</p>
                                    <div class="divider thin"></div>
                                    <p class="forSale">FOR RENT</p>
                                    <p class="price">$1,200/mo</p>
                                </div>
                                <table border="1" class="propertyDetails">
                                    <tr>
                                        <td><img src="/images/icon-area.png" alt="" style="margin-right:7px;" />2,412m</td>
                                        <td><img src="/images/icon-bed.png" alt="" style="margin-right:7px;" />6 Beds</td>
                                        <td><img src="/images/icon-drop.png" alt="" style="margin-right:7px;" />3 Baths</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="propertyItem">
                                <div class="propertyContent">
                                    <a class="propertyType" href="#">FAMILY HOME</a>
                                    <a href="property_single.html" class="propertyImgLink"><img class="propertyImg" src="/images/home3.jpg" alt="" /></a>
                                    <h4><a href="property_single.html">587 Smith Avenue</a></h4>
                                    <p>Baltimore, MD</p>
                                    <div class="divider thin"></div>
                                    <p class="forSale">FOR SALE</p>
                                    <p class="price">$687,000</p>
                                </div>
                                <table border="1" class="propertyDetails">
                                    <tr>
                                        <td><img src="/images/icon-area.png" alt="" style="margin-right:7px;" />2,412m</td>
                                        <td><img src="/images/icon-bed.png" alt="" style="margin-right:7px;" />6 Beds</td>
                                        <td><img src="/images/icon-drop.png" alt="" style="margin-right:7px;" />3 Baths</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div><!-- end related properties row -->

                    <br/>

                    <!-- start contact form -->
                    <h4>CONTACT AGENT</h4>
                    <div class="divider thin"></div>
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
                                    <input class="buttonColor" type="submit" value="CONTACT AGENT" />
                                </div>
                            </div>
                        </div><!-- end row -->
                    </form><!-- end form -->
                    <!-- end contact form -->
                    <br/>
                </div><!-- end content -->

                <!-- start sidebar -->
                <div class="col-lg-3 col-md-3">
                    <!-- start quick search widget -->
                    <h3>QUICK SEARCH</h3>
                    <div class="divider"></div>
                    <div class="filterContent sidebarWidget">
                        <form method="post" action="#">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="propertyType">Property Type</label><br/>
                                        <select name="property type" id="propertyType" class="formDropdown">
                                            <option value="">Any</option>
                                            <option value="Country2">Family Home</option>
                                            <option value="Country3">Apartment</option>
                                            <option value="Country4">Condo</option>
                                            <option value="Country5">Villa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="location">Location</label><br/>
                                        <select name="location" id="location" class="formDropdown">
                                            <option value="">Any</option>
                                            <option value="Country2">Option 1</option>
                                            <option value="Country3">Option 2</option>
                                            <option value="Country4">Option 3</option>
                                            <option value="Country5">Option 4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <label for="price">Price Range</label><br/>
                                        <select name="price" id="price" class="formDropdown">
                                            <option value="">Any</option>
                                            <option value="Country2">Option 1</option>
                                            <option value="Country3">Option 2</option>
                                            <option value="Country4">Option 3</option>
                                            <option value="Country5">Option 4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="formBlock">
                                        <input class="buttonColor" type="submit" value="FIND PROPERTIES" style="margin-top:24px;">
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                            </div><!-- end row -->
                        </form><!-- end form -->
                    </div><!-- end quick search widget -->

                    <!-- start recent posts widget -->
                    <h3>RECENT POSTS</h3>
                    <div class="divider"></div>
                    <div class="recentPosts sidebarWidget">
                        <h4><a href="#">AWESOME DREAM HOUSE IN A GREAT LOCATION</a></h4>
                        <a href="#">READ MORE</a>
                        <p class="date">Feb 5, 2014</p>
                        <div style="clear:both;"></div>
                        <div class="divider thin"></div>
                        <h4><a href="#">AWESOME DREAM HOUSE IN A GREAT LOCATION</a></h4>
                        <a href="#">READ MORE</a>
                        <p class="date">Feb 5, 2014</p>
                        <div style="clear:both;"></div>
                        <div class="divider thin"></div>
                        <h4><a href="#">AWESOME DREAM HOUSE IN A GREAT LOCATION</a></h4>
                        <a href="#">READ MORE</a>
                        <p class="date">Feb 5, 2014</p>
                        <div style="clear:both;"></div>
                    </div>
                    <!-- end recent posts widget -->

                    <!-- start property types widget -->
                    <h3>PROPERTY TYPES</h3>
                    <div class="divider"></div>
                    <div class="propertyTypesWidget sidebarWidget">
                        <ul>
                            <li><h4><a href="#">FAMILY HOUSE</a></h4></li>
                            <li><h4><a href="#">SINGLE HOUSE</a></h4></li>
                            <li><h4><a href="#">APARTMENT</a></h4></li>
                            <li><h4><a href="#">CONDO</a></h4></li>
                            <li><h4><a href="#">VILLA</a></h4></li>
                            <li><h4><a href="#">OFFICE BUILDING</a></h4></li>
                        </ul>
                    </div>
                    <!-- end property types widget -->

                </div><!-- end col -->
            </div><!-- end row -->

        </div><!-- end container -->
    </section>
    <!-- end main content -->
@endSection