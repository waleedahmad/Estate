@extends('layout')

@section('title')
    User Settings -
@endSection

@section('content')
    <div class="admin">
        @include('user.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 user-admin">
            <!-- start main content -->
            <section class="settings">
                <div class="row">
                    <div class="col-lg-6" >
                        <h3 id="mail-settings">Account Settings</h3>
                        <div class="divider"></div>
                        <!-- start login form -->
                        <div class="filterContent sidebarWidget">
                            <form method="post" action="/settings/email">
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="formBlock">
                                            <label for="login">Email</label><br/>
                                            <input type="text" name="email" value="{{Auth::user()->email}}" />

                                            @if($errors->has('email'))
                                                <div class="err">
                                                    * {{$errors->first('email')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="formBlock">
                                            <input class="buttonColor" type="submit" value="UPDATE ACCOUNT" style="margin-top:24px;">
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div><!-- end row -->
                                {{csrf_field()}}
                            </form><!-- end form -->

                            @if(Session::has('email_update'))
                                <div class="alertBox success text-center">
                                    <h4>{{Session::get('email_update')}}</h4>
                                </div>
                            @endif
                        </div><!-- end mail form -->
                    </div><!-- end col -->

                    @if(Auth::user()->Agent)
                        <div class="col-lg-6 " >
                            <h3 id="mail-settings">Agent Setings</h3>
                            <div class="divider"></div>
                            <!-- start login form -->
                            <div class="filterContent sidebarWidget">
                                <form method="post" action="/settings/agent">
                                    <div class="row">

                                        <div class="col-lg-12 col-md-12 col-sm-6">
                                            <div class="formBlock">
                                                <label for="login">Description</label><br/>
                                                <input type="text" name="description" value="{{Auth::user()->Agent->description}}" />

                                                @if($errors->has('description'))
                                                    <div class="err">
                                                        * {{$errors->first('description')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-6">
                                            <div class="formBlock">
                                                <label for="login">Office Number</label><br/>
                                                <input type="text" name="office_no" value="{{Auth::user()->Agent->office_phone}}" />

                                                @if($errors->has('office_no'))
                                                    <div class="err">
                                                        * {{$errors->first('office_no')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-6">
                                            <div class="formBlock">
                                                <label for="login">Facebook</label><br/>
                                                <input type="text" name="facebook" value="{{Auth::user()->Agent->facebook}}" />

                                                @if($errors->has('facebook'))
                                                    <div class="err">
                                                        * {{$errors->first('facebook')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-6">
                                            <div class="formBlock">
                                                <label for="login">Twitter</label><br/>
                                                <input type="text" name="twitter" value="{{Auth::user()->Agent->twitter}}" />

                                                @if($errors->has('twitter'))
                                                    <div class="err">
                                                        * {{$errors->first('twitter')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-6">
                                            <div class="formBlock">
                                                <label for="login">Google+</label><br/>
                                                <input type="text" name="google_plus" value="{{Auth::user()->Agent->google_plus}}" />

                                                @if($errors->has('google_plus'))
                                                    <div class="err">
                                                        * {{$errors->first('google_plus')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-6">
                                            <div class="formBlock">
                                                <input class="buttonColor" type="submit" value="UPDATE ACCOUNT" style="margin-top:24px;">
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div><!-- end row -->
                                    {{csrf_field()}}
                                </form><!-- end form -->

                                @if(Session::has('email_update'))
                                    <div class="alertBox success text-center">
                                        <h4>{{Session::get('email_update')}}</h4>
                                    </div>
                                @endif
                            </div><!-- end mail form -->
                        </div><!-- end col -->
                    @endif


                    <div class="col-lg-6 " id="profile-settings">
                        <h3>Profile Settings</h3>
                        <div class="divider"></div>
                        <!-- start login form -->
                        <div class="filterContent sidebarWidget">
                            <form method="post" action="/settings/profile" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="formBlock">
                                            <label for="name">Name</label><br/>
                                            <input type="text" name="name"  value="{{Auth::user()->name}}"/>
                                            @if($errors->has('name'))
                                                <div class="err">
                                                    * {{$errors->first('name')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="formBlock">
                                            <label for="name">Phone No.</label><br/>
                                            <input type="text" name="phone_no"  value="{{Auth::user()->phone}}"/>
                                            @if($errors->has('phone_no'))
                                                <div class="err">
                                                    * {{$errors->first('phone_no')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="formBlock">
                                            <label for="gender">Gender</label><br/>
                                            <select name="gender" class="formDropdown" style="padding:6px;">
                                                <option value="" @if(Auth::user()->gender === "")selected @endif>Select</option>
                                                <option value="Male" @if(Auth::user()->gender === "Male")selected @endif>Male</option>
                                                <option value="Female" @if(Auth::user()->gender === "Female")selected @endif>Female</option>
                                            </select>
                                            @if($errors->has('gender'))
                                                <div class="err">
                                                    * {{$errors->first('gender')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="formBlock">
                                            <label for="name">Profile Photo</label><br/>
                                            <input type="file" name="profile_picture"/>
                                            @if($errors->has('profile_picture'))
                                                <div class="err">
                                                    * {{$errors->first('profile_picture')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="formBlock">
                                            <input class="buttonColor" type="submit" value="UPDATE PROFILE" style="margin-top:24px;">
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div><!-- end row -->
                                {{csrf_field()}}
                            </form><!-- end form -->

                            @if(Session::has('profile_update'))
                                <div class="alertBox success text-center">
                                    <h4>{{Session::get('profile_update')}}</h4>
                                </div>
                            @endif
                        </div><!-- end prfile form -->
                    </div><!-- end col -->

                    <div class="col-lg-6 " id="password-settings">
                        <h3>Password Settings</h3>
                        <div class="divider"></div>
                        <!-- start login form -->
                        <div class="filterContent sidebarWidget">
                            <form method="post" action="/settings/password">
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="formBlock">
                                            <label for="pass">Old Password</label><br/>
                                            <input type="password" name="old_password" value="{{old('old_password')}}" />
                                            @if($errors->has('old_password'))
                                                <div class="err">
                                                    * {{$errors->first('old_password')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="formBlock">
                                            <label for="pass">New Password</label><br/>
                                            <input type="password" name="password" />
                                            @if($errors->has('password'))
                                                <div class="err">
                                                    * {{$errors->first('password')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="formBlock">
                                            <label for="pass">Confirm Password</label><br/>
                                            <input type="password" name="confirm_password" />
                                            @if($errors->has('password'))
                                                <div class="err">
                                                    * {{$errors->first('password')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="formBlock">
                                            <input class="buttonColor" type="submit" value="UPDATE PASSWORD" style="margin-top:24px;">
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div><!-- end row -->
                                {{csrf_field()}}
                            </form><!-- end form -->
                            @if(Session::has('password_update'))
                                <div class="alertBox success text-center">
                                    <h4>{{Session::get('password_update')}}</h4>
                                </div>
                            @endif
                        </div><!-- end password form -->
                    </div><!-- end col -->



                </div>
            </section>
            <!-- end main content -->
        </div>
    </div>
@endSection