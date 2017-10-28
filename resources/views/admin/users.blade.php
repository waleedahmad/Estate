@extends('layout')

@section('title')
    Registered Users -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Registered Users
                </h3>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 ">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Picture
                        </th>
                        <th>
                            Name
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Gender
                        </th>

                        <th>
                            Type
                        </th>

                        <th>
                            Created at
                        </th>
                    </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="imageholder">
                                <img src="/storage/{{$user->image_uri}}" alt="">
                            </div>
                        </td>

                        <td>
                            {{$user->name}}
                        </td>

                        <td>
                            {{$user->email}}
                        </td>

                        <td>
                            @if($user->gender)
                                {{$user->gender}}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <select class="user-type formDropdown" data-user-id="{{$user->id}}">
                                <option value="agent" @if($user->Agent) selected @endif>Agent</option>
                                <option value="user" @if(!$user->Agent) selected @endif>User</option>
                            </select>
                        </td>

                        <td>
                            {{$user->created_at->diffForHumans()}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @if($users->count())
                {{$users->links('pagination.custom') }}
            @endif

        </div>
    </div>
@endSection