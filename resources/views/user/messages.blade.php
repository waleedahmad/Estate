@extends('layout')

@section('title')
    Messages
@endsection

@section('content')

    @include('user.messages_sidebar')

    <div class="messages col-xs-12 col-sm-12 col-md-9 col-lg-9 messages">
        <div class="messages-content">
            <div class="title">
                <div class="current-user">

                </div>
            </div>

            <div class="thread">
                <div class="alert alert-info" role="alert">
                    Choose a conversation from sidebar.
                </div>
            </div>


        </div>
    </div>

@endsection

@section('scripts')
    <script src="/lib/bootbox.js/bootbox.js"></script>
@endSection
