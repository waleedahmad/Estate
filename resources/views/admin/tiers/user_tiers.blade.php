@extends('layout')

@section('title')
    User Tiers -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    User Tiers
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
                            Tier
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
                                <select class="user-tier formDropdown" data-user-id="{{$user->id}}">

                                    @foreach($tiers as $tier)
                                        <option
                                                value="{{$tier->id}}"
                                                @if($user->Tier->count() && $user->Tier->tier_id === $tier->id)
                                                selected
                                                @endif
                                        >
                                            {{$tier->name}} - {{$tier->allowed_listings}}
                                        </option>
                                    @endforeach
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
            @else
                No users found
            @endif

        </div>
    </div>
@endSection
