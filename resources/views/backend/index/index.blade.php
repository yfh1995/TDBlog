@extends('backend.layouts.master')

@section('title', multilingual('backend.index.title'))

@section('style')

    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />

@endsection

@section('after-script')

    <script type="text/javascript" src="{{ asset('js/index.js') }}" ></script>

@endsection

@section('content')

    <h1>Hello World!</h1>

@endsection