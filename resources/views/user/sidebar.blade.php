<div class="admin-sidebar col-xs-12 col-sm-12 col-md-4 col-lg-2" style="margin-top: 20px;">


    <a @if(Request::path() === 'user/properties') class="active" @endif  href="/user/properties">My Properties</a>

    <a @if(Request::path() === 'user/properties/favorites') class="active" @endif  href="/user/properties/favorites">My Favorites</a>

    <a @if(Request::path() === 'user/properties/pending') class="active" @endif  href="/user/properties/pending">Pending Approval</a>

    <a @if(Request::path() === 'user/messages') class="active" @endif  href="/user/messages">Messages</a>


    <a @if(Request::path() === 'user/settings') class="active" @endif  href="/user/settings">Settings</a>
</div>