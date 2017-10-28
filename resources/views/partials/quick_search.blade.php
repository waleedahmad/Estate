<h3>QUICK SEARCH</h3>
<div class="divider"></div>
<div class="filterContent sidebarWidget">
    <form method="GET" action="/search">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-6">
                <div class="formBlock">
                    <label for="propertyType">Property Type</label><br/>
                    <select name="propertyType" id="propertyType" class="formDropdown">
                        <option value="ANY">Any</option>
                        <option value="Home">Home</option>
                        <option value="Plots">Plots</option>
                        <option value="Commercial">Commercial</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-6">
                <div class="formBlock">
                    <label for="location">Location</label><br/>
                    <select name="location" id="location" class="formDropdown">
                        <option value="ANY">Any</option>
                        @foreach(\App\Cities::all() as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input type="hidden" name="view" value="sidebar">

            <div class="col-lg-12 col-md-12 col-sm-6">
                <div class="formBlock">
                    <input class="buttonColor" type="submit" value="FIND PROPERTIES" style="margin-top:24px;">
                </div>
            </div>
            <div style="clear:both;"></div>
        </div><!-- end row -->
    </form><!-- end form -->
</div><!-- end quick search widget -->