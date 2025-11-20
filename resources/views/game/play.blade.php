@extends('layouts.app')

@section('inline-css')
@endsection

@section('main')
    <div class="dashboard-layout">

        <main class="main-content">
            <div class="container-fluid mt-5">
                <div id="game-area" class="card shadow-lg p-4 text-center">
                    <h3 class="text-gradient">🎮 Partida #{{ $game['code'] }}</h3>
                    <input type="text" hidden name="game_id" id="game_id" value=" {{ $game['id'] }} ">
                    <input type="text" hidden name="user_id" id="user_id" value=" {{ session('usuario.id') }} ">
                    <input type="text" hidden name="player_id" id="player_id" value=" {{ $currentPlayer['id'] }} ">

                    <div class="container mt-3">
                        <p class="small text-muted">
                            ⚠️ ¡Atención! El juego termina en cuanto el primer jugador complete las 10 preguntas. ¡Responde
                            rápido!
                        </p>
                    </div>

                    <div class="container mt-3">
                        <div id="playersList" class="row g-3 justify-content-center"></div>
                    </div>

                    <div class="container mt-3">
                        <div id="countAnswer" class="row g-3 justify-content-center"></div>
                    </div>

                    <div id="status-message" class="my-3 text-secondary">Cargando preguntas...</div>

                    <div id="question-container" class="d-none">
                        <div class="card my-3">
                            <div class="card-body">
                                <h4 id="question-text" class="mb-4"></h4>
                            </div>
                        </div>
                        <div id="answers" class="d-grid gap-2"></div>
                        <div id="timer" class="mt-3 text-muted"></div>
                    </div>

                    <div id="results-container" class="my-4 text-center d-none">
                        <h2 class="mb-4 text-gradient">🏆 Resultados Finales</h2>

                        <div id="winner-card" class="winner-card d-none"></div>

                        <div id="results" class="results-grid"></div>

                        <a href="{{ route('game.home') }}" class="boton boton-color-verde-oscuro">Volver al Inicio</a>
                    </div>


                </div>
            </div>
        </main>

        <script src="{{ asset('js/play.js') }}"></script>
    </div>
@endsection
