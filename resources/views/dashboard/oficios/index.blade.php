@extends('adminlte::page')

@section('plugins.Lightbox', true)
@section('plugins.Select2', true)
@section('plugins.IcheckBootstrap', true)
@section('plugins.Summernote', true)

@section('title', 'Oficios')

@include('dashboard.oficios.header')

@section('content')
    @livewire('dashboard.oficios-component')
    <div>
        @livewire('dashboard.instituciones-component')
        @livewire('dashboard.personas-component')
    </div>
@endsection

@section('right-sidebar')
    @include('dashboard.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection

