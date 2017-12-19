@extends('layout')

@section('title')
    Agents -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Agents
                </h3>

                <a href="/admin/admins/add">
                    <button class="buttonGrey">Add Admin</button>
                </a>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 ">
            @if($users->count())
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
                            Action
                        </th>

                        <th>
                            Created at
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr class="admin-row">
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
                                @if($user->id != Auth::user()->id)
                                    <button class="buttonGrey delete-admin"
                                            style="width: 100%; margin-top: 20px;"
                                            data-id="{{$user->id}}"
                                    >
                                        Delete Admin
                                    </button>
                                @endif
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
            @else
                No users found
            @endif

        </div>
    </div>
@endSection


@section('scripts')
    <script src="/lib/bootbox.js/bootbox.js"></script>
@endSection

