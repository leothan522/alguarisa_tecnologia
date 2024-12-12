@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Territorio')

@section('content')
    @livewire('dashboard.territorio-component')
@endsection

@section('right-sidebar')
    @include('dashboard.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection


