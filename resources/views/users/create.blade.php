<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 13/08/2018
 * Time: 07:01 PM
 */
?>

@extends('layouts.main')

@section('title')
    Create Profile
@endsection

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">


                <div class="col-lg-12" style="margin-top: 30px;">
                    <div class="profile-widget profile-widget-info">
                        <div class="panel-body">
                            <div class="col-lg-2 col-sm-2">
                                <h4 style="margin-left: -8px;">
                                    @if ($type == 1)
                                        Owner Profile
                                    @elseif ($type == 2)
                                        Partner Profile
                                    @elseif ($type == 3)
                                        Staff Account
                                    @elseif ($type == 4)
                                        Client Profile
                                    @endif
                                </h4>
                            </div>
                        </div>
                    </div>

                    <section class="panel">
                        @include("layouts.errors")
                        <div class="container bootstrap snippet">
                            <div class="row">
                                <div class="col-sm-10"></div>
                                <div class="col-sm-2"></div>
                            </div>
                            <form action="{{ route('save-profile') }}" method="post"
                                  class="form-horizontal">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-sm-3"><!--left col-->

                                        <div class="text-center">
                                            <img src="{{ asset('/public/images/user.png') }}"
                                                 class="img-circle img-thumbnail" alt="avatar">
                                            <h6></h6>
                                            <div class="file">
                                                <input name="picture" type="file"
                                                       class="text-center center-block file-upload">
                                            </div>
                                            <hr/>
                                            <br/>
                                        </div>


                                    </div><!--/col-3-->
                                    <div class="col-sm-9">
                                        <div class="tab-content">

                                            <input name="profile_type_id" type="hidden" value="{{ $type }}"/>
                                            <input name="new" type="hidden" value="{{ $new }}"/>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="name">Name</label>
                                                    <input name="name"
                                                           value="@if (empty(old('name')) && !empty($new) && !empty($info->owner)) {{ $info->owner }}@else{{ old('name') }}@endif"
                                                           class="form-control"
                                                           type="text" placeholder="name" required/>
                                                    {{--{!! $errors->first('name', '<p class="help-block">:message</p>') !!}--}}
                                                </div>


                                                <div class="col-md-6">
                                                    <label for="company_id">Company</label>
                                                    <select name="company_id" class="form-control" required>
                                                        <option>Select Company</option>
                                                        @foreach($companies as $company)
                                                            <option value="{{$company->id}}"
                                                                    @if (!empty(old('company_id')) && (old('company_id') == $company->id)) selected="selected"
                                                                    @elseif($info->id == $company->id) selected="selected" @endif>
                                                                {{$company->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="username">Username</label>
                                                    <input name="username"
                                                           value="@if (empty(old('username')) && !empty($new) && !empty($info->owner)) {{ strtolower($info->owner) }}@else{{ old('username') }}@endif"
                                                           readonly
                                                           onfocus="this.removeAttribute('readonly');"
                                                           class="form-control" type="text"
                                                           placeholder="Username" required/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="password">Password</label>
                                                    <input name="password" value="{{ old('password') }}"
                                                           class="form-control" type="password"
                                                           placeholder="Password" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="email">Email</label>
                                                    <input name="email"
                                                           value="@if (empty(old('email')) && !empty($info->email)) {{ $info->email }}@else{{ old('email') }}@endif"
                                                           class="form-control"
                                                           type="email"
                                                           placeholder="Email" required/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="phone">Phone</label>
                                                    <input name="phone"
                                                           value="@if (empty(old('phone')) && !empty($info->phone)) {{ $info->phone }}@else{{ old('phone') }}@endif"
                                                           class="form-control"
                                                           type="text"
                                                           placeholder="Phone" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="designation">Designation</label>
                                                    <input name="designation" value="{{ old('designation') }}"
                                                           class="form-control" type="text"
                                                           placeholder="Designation" required/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="department">Department</label>
                                                    <input name="department" value="{{ old('department') }}"
                                                           class="form-control" type="text"
                                                           placeholder="Department" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-6">
                                                    <label for="country">Country</label>
                                                    <select name="country" class="form-control" required>
                                                        <option>Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->id}}"
                                                                    @if (!empty(old('country')) && (old('country') == $country->id)) selected="selected"
                                                                    @elseif($info->country_id == $country->id) selected="selected" @endif>
                                                                {{$country->country_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="city">City</label>
                                                    <input name="city"
                                                           value="@if (empty(old('city')) && !empty($info->city)) {{ $info->city }}@else{{ old('city') }}@endif"
                                                           class="form-control"
                                                           type="text"
                                                           placeholder="City" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="address">Address</label>
                                                    <input name="address"
                                                           value="@if (empty(old('address')) && !empty($info->address)) {{ $info->address }}@else{{ old('address') }}@endif"
                                                           class="form-control address-field" type="text"
                                                           placeholder="Address" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="birthday">Birthday</label>
                                                    <input name="birthday" value="{{ old('birthday') }}"
                                                           class="form-control" type="text"
                                                           placeholder="Birthday" required/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="website_url">Website URL</label>
                                                    <input name="website_url"
                                                           value="@if (empty(old('website_url')) && !empty($info->website_url))  {{ $info->website_url }}@else{{ old('website_url') }}@endif"
                                                           class="form-control" type="text"
                                                           placeholder="Website URL" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="skype">Skype</label>
                                                    <input name="skype"
                                                           value="@if (empty(old('skype')) && !empty($info->skype))  {{ $info->skype }}@else{{ old('skype') }}@endif"
                                                           class="form-control"
                                                           type="text"
                                                           placeholder="Skype ID"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label for="likes">Likes</label>
                                                    <textarea name="likes" class="form-control"
                                                              placeholder="Likes" rows="5">{{ old("likes") }}</textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="dislikes">Dislikes</label>
                                                    <textarea name="dislikes" class="form-control"
                                                              placeholder="Dislikes"
                                                              rows="5">{{ old("dislikes") }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <a href="#">
                                                        <button class="btn btn-primary1 search-btn" type="submit">
                                                            <i class="fa fa-floppy-o" aria-hidden="true"></i>Save
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
                <!--main content end-->
            </section>
        </section>
    </div>
@endsection
