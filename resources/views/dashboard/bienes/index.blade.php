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
    @livewire('dashboard.modal-ubicaciones-component')
    @livewire('dashboard.modal-oficios-vinculados-component')
    @livewire('dashboard.modal-busqueda-component')
    @livewire('dashboard.modal-oficios-component')
@endsection

@section('right-sidebar')
    @include('dashboard.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection



