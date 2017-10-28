@extends('layout')

@section('title')
    Templates Configuration -
@endSection

@section('content')
    <div class="admin">
        @include('admin.sidebar')

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10">
            <div class="page-header">
                <h3>
                    Template Configuration
                </h3>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-10 ">
            <div class="col-lg-6">
                <div>
                    <form method="post" action="/admin/config/template" enctype="multipart/form-data">
                        <div class="row">

                            <div class="formBlock">
                                <label for="app_name">App Name</label><br/>
                                <input type="text" name="app_name"  value="{{\App\Config::where('name', '=', 'app_name')->first()->value}}"/>
                                @if($errors->has('app_name'))
                                    <div class="err">
                                        * {{$errors->first('app_name')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="description">App Description</label><br/>
                                <textarea name="description" class="formDropdown">{{\App\Config::where('name', '=', 'description')->first()->value}}</textarea>
                                @if($errors->has('description'))
                                    <div class="err">
                                        * {{$errors->first('description')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="phone">Phone No</label><br/>
                                <input type="text" name="phone"  value="{{\App\Config::where('name', '=', 'phone')->first()->value}}"/>
                                @if($errors->has('phone'))
                                    <div class="err">
                                        * {{$errors->first('phone')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="address">Address</label><br/>
                                <input type="text" name="address"  value="{{\App\Config::where('name', '=', 'address')->first()->value}}"/>
                                @if($errors->has('address'))
                                    <div class="err">
                                        * {{$errors->first('address')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="email">Email</label><br/>
                                <input type="text" name="email"  value="{{\App\Config::where('name', '=', 'email')->first()->value}}"/>
                                @if($errors->has('email'))
                                    <div class="err">
                                        * {{$errors->first('email')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="email">Facebook</label><br/>
                                <input type="text" name="facebook"  value="{{\App\Config::where('name', '=', 'facebook')->first()->value}}"/>
                                @if($errors->has('facebook'))
                                    <div class="err">
                                        * {{$errors->first('facebook')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="email">Twitter</label><br/>
                                <input type="text" name="twitter"  value="{{\App\Config::where('name', '=', 'twitter')->first()->value}}"/>
                                @if($errors->has('twitter'))
                                    <div class="err">
                                        * {{$errors->first('twitter')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="email">Google Plus</label><br/>
                                <input type="text" name="google_plus"  value="{{\App\Config::where('name', '=', 'google_plus')->first()->value}}"/>
                                @if($errors->has('google_plus'))
                                    <div class="err">
                                        * {{$errors->first('google_plus')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="description">Hottest Listing Description</label><br/>
                                <textarea name="hottest_listing_description" class="formDropdown">{{\App\Config::where('name', '=', 'hottest_listing_description')->first()->value}}</textarea>
                                @if($errors->has('hottest_listing_description'))
                                    <div class="err">
                                        * {{$errors->first('hottest_listing_description')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="description">Knowledgeable Agents Description</label><br/>
                                <textarea name="knowledge_agents"  class="formDropdown">{{\App\Config::where('name', '=', 'knowledge_agents')->first()->value}}</textarea>
                                @if($errors->has('knowledge_agents'))
                                    <div class="err">
                                        * {{$errors->first('knowledge_agents')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="description">Experts & Guidance Description</label><br/>
                                <textarea name="expertise_guidance" class="formDropdown">{{\App\Config::where('name', '=', 'expertise_guidance')->first()->value}}</textarea>
                                @if($errors->has('expertise_guidance'))
                                    <div class="err">
                                        * {{$errors->first('expertise_guidance')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="description">Newsletter Description</label><br/>
                                <textarea name="newsletter_description" name="newsletter_description" class="formDropdown">{{\App\Config::where('name', '=', 'newsletter_description')->first()->value}}</textarea>
                                @if($errors->has('newsletter_description'))
                                    <div class="err">
                                        * {{$errors->first('newsletter_description')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="footer_title">Footer Title</label><br/>
                                <input type="text" name="footer_title"  value="{{\App\Config::where('name', '=', 'footer_title')->first()->value}}"/>
                                @if($errors->has('footer_title'))
                                    <div class="err">
                                        * {{$errors->first('footer_title')}}
                                    </div>
                                @endif
                            </div>

                            <div class="formBlock">
                                <label for="description">Footer Description</label><br/>
                                <textarea name="footer_description" name="description" class="formDropdown">{{\App\Config::where('name', '=', 'footer_description')->first()->value}}</textarea>
                                @if($errors->has('footer_description'))
                                    <div class="err">
                                        * {{$errors->first('footer_description')}}
                                    </div>
                                @endif
                            </div>


                            <div class="formBlock">
                                <input class="buttonGrey" type="submit" value="UPDATE TEMPLATE" style="margin-top:24px;">
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


                </div><!-- end prfile form -->
            </div><!-- end col -->
        </div>
    </div>
@endSection