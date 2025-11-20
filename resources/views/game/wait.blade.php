@extends('layouts.app')

@section('inline-css')
@endsection

@section('main')
    <div class="dashboard-layout">
        <!-- Panel lateral -->
        @include('templates.aside')

        <!-- Contenido principal -->
        <main class="main-content">
            <div class="container mt-5">

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-lg p-4 text-center">
                    <h3 class="mb-3">🎮 Esperando jugadores...</h3>
                    <p class="text-muted">Comparte este código con tus amigos para que se unan:</p>

                    <div class="display-4 fw-bold mb-4">
                        <input type="text" class="form-control text-center" value="{{ $game['code'] }}" id="game_code">
                        <input type="hidden" value="{{ $game['id']}}" id="game_id">
                    </div>

                    <div id="players-list" class="mb-4">
                        <h5>👥 Jugadores en la partida:</h5>
                        <ul class="list-group" id="players-container">
                            <li class="list-group-item">Cargando jugadores...</li>
                        </ul>
                    </div>

                    <div id="status-message" class="mt-3 text-secondary">Esperando que se unan todos...</div>

                    <div class="mt-4">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
            </div>
        </main>

        <script src="{{ asset('js/unir-jugadores.js') }}"></script>
    </div>
@endsection
