@extends('adminlte::page')

@section('plugins.Lightbox', true)
@section('plugins.Select2', true)

@section('title', 'Bienes')

@section('content')
    @livewire('dashboard.bienes-component')
    @livewire('dashboard.tipos-component')
@endsection

@section('right-sidebar')
    @include('dashboard.bienes.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection



