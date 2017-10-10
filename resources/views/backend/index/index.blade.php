@extends('backend.layouts.master')

@section('title', multilingual('backend.index.title'))

@section('style')

    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />

@endsection

{{--@section('content-title', multilingual('backend.index.title'))--}}

{{--@section('content-description', multilingual('backend.index.title'))--}}

@section('content-title', 'Dashboard')

@section('content-description', 'Description...')

@section('content')

    <div class="col-md-12">
        <div class="box">
            <div style="height: 100px"></div>
        </div>
    </div>

@endsection

@section('after-script')

    <script type="text/javascript" src="{{ asset('js/index.js') }}" ></script>

@endsection