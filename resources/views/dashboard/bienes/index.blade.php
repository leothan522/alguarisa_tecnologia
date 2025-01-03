@extends('adminlte::page')

@section('plugins.Lightbox', true)
@section('plugins.Select2', true)

@section('title', 'Bienes')

@section('content')
    @livewire('dashboard.bienes-component')
    @livewire('dashboard.tipos-component')
    @livewire('dashboard.marcas-component')
    @livewire('dashboard.modelos-component')
    @livewire('dashboard.colores-component')
    @livewire('dashboard.condiciones-component')
    @livewire('dashboard.ubicaciones-component')
@endsection

@section('right-sidebar')
    @include('dashboard.bienes.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection



