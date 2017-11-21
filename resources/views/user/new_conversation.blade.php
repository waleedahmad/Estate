@extends('layout')

@section('title')
    Messages -
@endsection

@section('content')

    @include('user.messages_sidebar')

    <div class="messages col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="messages-content">
            <div class="title">

                <div class="current-user">
                    New message to {{$user->name}}
                </div>
            </div>

            <div class="thread">
            </div>

            <div class="sender">
                <form action="/user/conversation/init" method="POST" id="new-con-form">
                    {{csrf_field()}}
                    <textarea type="text" name="message" id="chat-message" data-type="new" placeholder="Type a message and remember to be nice."></textarea>
                    <input type="hidden" value="{{$user->id}}" name="to_user">
                </form>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/lib/bootbox.js/bootbox.js"></script>
@endSection
