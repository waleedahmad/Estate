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
                    {{$conversation->friend->name}}
                </div>
            </div>

            <div class="thread">
                @foreach($conversation->getMessages() as $message)
                    <div class="@if($message->from === Auth::user()->id) your-message @else their-message @endif">
                        {{$message->message}}
                    </div>
                @endforeach
            </div>

            <div class="sender">
                <textarea type="text" id="chat-message" data-type="existing" data-conversation-id="{{$conversation->id}}" data-user-id="{{$conversation->friend->id}}" placeholder="Type a message"></textarea>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="/lib/bootbox.js/bootbox.js"></script>
@endSection
