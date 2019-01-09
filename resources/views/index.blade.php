@extends('layouts.master')

@section('page-content')
    <div class="title-bar">
        <h1 class="title-bar-title">
            <span class="d-ib">Quick Overview</span>
        </h1>
    </div>
    <div class="row gutter-xs">
        <div class="col-md-6 col-lg-3">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="media">
                        <div class="media-middle media-left">
                            <span class="bg-primary-inverse circle sq-48">
                                <span class="icon icon-user"></span>
                            </span>
                        </div>
                        <div class="media-middle media-body">
                            <h6 class="media-heading">Regions</h6>
                            <h3 class="media-heading">
                                <span class="fw-l">1,031,760</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card bg-info">
                <div class="card-body">
                    <div class="media">
                        <div class="media-middle media-left">
                            <span class="bg-info-inverse circle sq-48">
                                <span class="icon icon-shopping-bag"></span>
                            </span>
                        </div>
                        <div class="media-middle media-body">
                            <h6 class="media-heading">Admins</h6>
                            <h3 class="media-heading">
                                <span class="fw-l">1,256</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card bg-warning">
                <div class="card-body">
                    <div class="media">
                        <div class="media-middle media-left">
                            <span class="bg-warning-inverse circle sq-48">
                                <span class="icon icon-inr"></span>
                            </span>
                        </div>
                        <div class="media-middle media-body">
                            <h6 class="media-heading">Samiti</h6>
                            <h3 class="media-heading">
                                <span class="fw-l">&#8377; 155,352.47</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card bg-info">
                <div class="card-body">
                    <div class="media">
                        <div class="media-middle media-left">
                            <span class="bg-info-inverse circle sq-48">
                                <span class="icon icon-clock-o"></span>
                            </span>
                        </div>
                        <div class="media-middle media-body">
                            <h6 class="media-heading">Events</h6>
                            <h3 class="media-heading">
                                <span class="fw-l">00:07:56</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection