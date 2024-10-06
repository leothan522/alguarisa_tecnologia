@extends('adminlte::page')

@section('plugins.Lightbox', true)
@section('plugins.Select2', true)
@section('plugins.IcheckBootstrap', true)
@section('plugins.Summernote', true)

@section('title', 'Oficios')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-file-invoice"></i> Oficios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                </ol>
            </div>
        </div>
    </div>
@endsection

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

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop


