@include('admin.layouts.header')

@extends('layouts.sidenav')

{{-- Web site Title --}}
@section('title')
    Administration :: @parent
@endsection


{{-- Sidebar --}}
@section('sidebar')
    @include('admin.partials.nav')
@endsection

