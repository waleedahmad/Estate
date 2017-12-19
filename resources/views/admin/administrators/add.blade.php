@extends('layout')

@section('title')
    Add Configuration -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Add Administrator
                </h3>

                <a href="/admin/admins">
                    <button class="buttonGrey">Back</button>
                </a>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 ">
            <div class="col-lg-6">
                <form method="post" action="/admin/admins" enctype="multipart/form-data">
                    <div class="row">

                        <div class="formBlock">
                            <label for="town">Administrator Name</label><br/>
                            <input type="text" name="name" id="name" value="{{old('name')}}"/>
                            @if($errors->has('name'))
                                <div class="err">
                                    * {{$errors->first('name')}}
                                </div>
                            @endif
                        </div>

                        <div class="formBlock">
                            <label for="town">Email</label><br/>
                            <input type="text" name="email" id="email" value="{{old('email')}}"/>
                            @if($errors->has('email'))
                                <div class="err">
                                    * {{$errors->first('email')}}
                                </div>
                            @endif
                        </div>

                        <div class="formBlock">
                            <label for="password">Password</label><br/>
                            <input type="password" name="password" id="password" value="{{old('password')}}"/>
                            @if($errors->has('password'))
                                <div class="err">
                                    * {{$errors->first('password')}}
                                </div>
                            @endif
                        </div>

                        <div class="formBlock">
                            <label for="confirm_password">Confirm Password</label><br/>
                            <input type="password" name="confirm_password" id="confirm_password" value="{{old('confirm_password')}}"/>
                            @if($errors->has('confirm_password'))
                                <div class="err">
                                    * {{$errors->first('confirm_password')}}
                                </div>
                            @endif
                        </div>

                        <div class="formBlock">
                            <label for="town">Gender</label><br/>
                            <select name="gender" class="formDropdown" style="padding:6px;">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @if($errors->has('gender'))
                                <div class="err">
                                    * {{$errors->first('gender')}}
                                </div>
                            @endif
                        </div>

                        <div class="formBlock">
                            <label for="town">Phone no</label><br/>
                            <input type="text" name="phone_no" id="phone_no" value="{{old('phone_no')}}"/>
                            @if($errors->has('phone_no'))
                                <div class="err">
                                    * {{$errors->first('phone_no')}}
                                </div>
                            @endif
                        </div>


                        <div class="formBlock">
                            <input class="buttonGrey" type="submit" value="ADD ADMIN" style="margin-top:24px;">
                        </div>
                        <div style="clear:both;"></div>

                        @if(Session::has('template_update'))
                            <div class="alertBox success text-center">
                                <h4>{{Session::get('template_update')}}</h4>
                            </div>
                        @endif
                    </div><!-- end row -->
                    {{csrf_field()}}
                </form><!-- end form -->

            </div><!-- end col -->
        </div>
    </div>
@endSection