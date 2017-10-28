@extends('layout')

@section('title')
    Tier Configuration -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Tier Configuration
                </h3>

                <a href="/admin/config/tiers/add">
                    <button class="buttonGrey">Add Tiers</button>
                </a>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 ">
            @if($tiers->count())
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Allowed Listings
                        </th>

                        <th>
                            Actions
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($tiers as $tier)
                        <tr class="tier">
                            <td>
                                {{$tier->name}}
                            </td>

                            <td>
                                {{$tier->allowed_listings}}
                            </td>

                            <td>
                                <a href="/admin/config/tiers/{{$tier->id}}/edit">Edit</a> /
                                <a href="#" class="delete-tier" data-id="{{$tier->id}}">Delete</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                No tiers available.
            @endif
        </div>
    </div>
@endSection

@section('scripts')
    <script src="/lib/bootbox.js/bootbox.js"></script>
@endSection
