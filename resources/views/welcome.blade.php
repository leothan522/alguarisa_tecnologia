@extends('layouts.bootstrap')

@section('title', "Bienvenido - ". config('app.name', 'Laravel'))

@section('content')

    <div x-data class="text-center mb-5 mb-sm-auto">
        @auth
            <a class="text-muted" href="{{ route('profile.show') }}" @click="mostrarPreloader()">{{ __('Profile') }}</a>
            <a class="text-muted ms-3" href="{{ route('dashboard') }}" @click="mostrarPreloader()">Dashboard</a>
        @else
            <a class="text-muted" href="{{ route('dashboard') }}" @click="mostrarPreloader()">{{ __('Log in') }}</a>
            @if (Route::has('register'))
                <a class="text-muted ms-3" href="{{ route('register') }}" @click="mostrarPreloader()">{{ __('Register') }}</a>
            @endif
        @endauth
    </div>

@endsection

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
@endpush
