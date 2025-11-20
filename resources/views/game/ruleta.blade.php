@extends('layouts.app')

@section('inline-css')
@endsection

@section('main')
    <div class="dashboard-layout">
        <!-- Panel lateral -->
        @include('templates.aside')

        <!-- Contenido principal -->
        <main class="main-content">
            @livewire('ruleta', ['user' => 1], key(1))
        </main>
    </div>
@endsection
