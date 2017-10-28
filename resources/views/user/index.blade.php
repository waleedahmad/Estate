@extends('layout')

@section('title')
    Manage Account -
@endSection

@section('content')
    <div class="admin">
        @include('user.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 user-admin">
            <div class="page-header">
                <h3>
                    Manage Account
                </h3>
            </div>
            <h4>
                Welcome {{Auth::user()->name}}!
            </h4>
        </div>
    </div>
@endSection