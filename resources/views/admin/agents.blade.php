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
                            Featured
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
                                <button class="buttonGrey toggle-agent"
                                        style="width: 100%; margin-top: 20px;"
                                        data-status="{{$user->Agent->featured}}"
                                        data-id="{{$user->id}}"
                                >
                                    @if($user->Agent->featured)
                                        Remove Featured
                                    @else
                                        Show Featured
                                    @endif
                                </button>
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
