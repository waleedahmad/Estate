<ul class="propertyCat_list option-set">
    <li><a href="/listings"  @if(Request::is('listings')) class="current triangle" @endif>ALL</a></li>
    <li><a href="/listings/Sale" @if(Request::is('listings/Sale')) class="current triangle" @endif>FOR SALE</a></li>
    <li><a href="/listings/Rent" @if(Request::is('listings/Rent')) class="current triangle" @endif>FOR RENT</a></li>
    <li><a href="/listings/Lease" @if(Request::is('listings/Lease')) class="current triangle" @endif>FOR LEASE</a></li>
</ul>

{{--
<ul class="propertySort_list">
    <li style="padding-right:0px;">
        <form style="margin-top:-10px;">
            <div class="formBlock">
                <select name="property type" id="propertyType" class="formDropdown" style="padding:6px;">
                    <option value="">Any</option>
                    <option value="Family Home">Family Home</option>
                    <option value="Apartment">Apartment</option>
                    <option value="Condo">Condo</option>
                    <option value="Villa">Villa</option>
                </select>
            </div>
        </form>
    </li>
    <li><p>Property Type:</p></li>
    <li><div style="width:1px; height:45px; margin-top:-12px; background-color:#c5c5c5;"></div></li>
</ul>--}}
