@extends('backend.layouts.master')

@section('title', multilingual('backend.index.title'))

@section('content-title', multilingual('backend.index.title'))

@section('content-description', multilingual('backend.index.title'))



@include('widgets.grid',['grid' =>  $grid])