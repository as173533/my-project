@extends('admin::layouts.main')

@section('content')

@php
use Illuminate\Support\Str;
@endphp
<div class="clearfix">
    <div class="dash-bottom-part">
        <div class="bottom-part-1">
            <div class="col-sm-12">
                <h1 class="dash_heading">DASHBOARD</h1>
                <div class="row">
                    
                    
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('users')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                    <div class="media-left">
                                        <h1>{{isset($total_user)?$total_user:'0'}}</h1>
                                        <h2>TOTAL USER REGISTERED</h2>
                                    </div>
                                    <div class="media-right">
                                        <i class="fa fa-users" style="font-size: 6em;color: #ffff;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div> 
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('admin-cat-index')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                    <div class="media-left">
                                        <h1>{{isset($total_category)?$total_category:'0'}}</h1>
                                        <h2>TOTAL CATEGORY</h2>
                                    </div>
                                    <div class="media-right">
                                        <i class="fa fa-sitemap" style="font-size: 6em;color: #ffff;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div> 
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-cst-4">
                        <a href="{{route('admin-project-index')}}">
                            <div class="inner-box d-flex align-items-center gradient-bg-1">
                                <div class="media justify-content-between align-items-center d-flex">
                                    <div class="media-left">
                                        <h1>{{isset($total_projects)?$total_projects:'0'}}</h1>
                                        <h2>TOTAL PROJECTS</h2>
                                    </div>
                                    <div class="media-right">
                                        <i class="fa fa-sitemap" style="font-size: 6em;color: #ffff;" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div> 
                        </a>
                    </div>
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop