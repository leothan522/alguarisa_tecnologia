@extends('adminlte::page')

@section('plugins.Lightbox', true)

@section('title', 'Empresas')

@section('content')
    @livewire('dashboard.empresas-component')
@endsection

@section('right-sidebar')
    @include('dashboard.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection



