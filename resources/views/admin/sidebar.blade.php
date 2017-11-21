<div class="admin-sidebar col-xs-12 col-sm-12 col-md-4 col-lg-2">

    <a @if(Request::is('admin/listings/submissions') || Request::is('admin/listings/submissions/*')) class="active" @endif href="/admin/listings/submissions">Listing Submissions</a>

    <a @if(Request::is('admin/listings/approved') || Request::is('admin/listings/approved/*')) class="active" @endif href="/admin/listings/approved">Approved Listings</a>

    <a @if(Request::is('admin/listings/slider_recent') || Request::is('admin/listings/slider_recent/*')) class="active" @endif href="/admin/listings/slider_recent">Sidebar & Recent Listings</a>


    <a @if(Request::path() === 'admin/users') class="active" @endif  href="/admin/users">Users</a>

    <a @if(Request::path() === 'admin/users/tiers') class="active" @endif  href="/admin/users/tiers">User Tiers</a>


    <a @if(Request::is('admin/config/tiers*')) class="active" @endif  href="/admin/config/tiers">Tiers Configuration</a>

    <a @if(Request::path() === 'admin/config/layout') class="active" @endif  href="/admin/config/layout">Layout Configuration</a>

    <a @if(Request::path() === 'admin/config/template') class="active" @endif  href="/admin/config/template">Template Configuration</a>

    <a @if(Request::path() === 'admin/agents') class="active" @endif  href="/admin/agents">Agents</a>

    <a @if(Request::is('admin/cities*')) class="active" @endif  href="/admin/cities">Locations</a>

</div>