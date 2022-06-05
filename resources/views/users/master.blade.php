@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('users.partials._header')
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-2">
                @include('users.partials._left_side')
            </div>
            <div class="col-lg-6">
                @include('users.partials._news_feed')
            </div>
            <div class="col-lg-2">
                @include('users.partials._right_side')
            </div>
        </div>
    </div>
@endsection