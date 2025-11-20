@extends('layouts.app')

@section('inline-css')
@endsection

@section('main')
    <div class="dashboard-layout">
        <!-- Panel lateral -->
        @include('templates.aside')



        <!-- Contenido principal -->
        <main class="main-content">
            <div class="container-fluid">

                <div class="my-3" style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
                    <h1 class="lead" style="margin: 0;">Hola: {{ session('usuario.name') }}</h1>
                    <a href="{{ route('game.rank.show') }}">
                        <img src="{{ $avatar['avatar_url'] }}" alt="Avatar de {{ $avatar['avatar_url'] }}"
                            style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid #037065;">
                    </a>
                </div>


                <div class="cards-container mt-4 px-3">
                    <div class="row g-4 justify-content-center">

                        <!-- Partida Rápida -->
                        <div class="col-md-4 col-sm-6">
                            <div class="banquea-card text-center">
                                <div class="banquea-icon">
                                    <img src="https://cdn-icons-png.flaticon.com/512/10062/10062164.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                                <h5 class="fw-bold mb-2 text-success">Partida Rápida</h5>
                                <p class="text-muted mb-3">Comienza una partida individual al instante.</p>
                                <a href="{{ route('game.ruleta') }}" class="boton">Jugar</a>
                            </div>
                        </div>

                        <!-- Multijugador -->
                        <div class="col-md-4 col-sm-6">
                            <div class="banquea-card text-center">
                                <div class="banquea-icon">
                                    <img src="https://cdn-icons-png.flaticon.com/512/9998/9998334.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                                <h5 class="fw-bold mb-2 text-success">Multijugador</h5>
                                <p class="text-muted mb-3">Crea o únete a partidas con otros jugadores.</p>
                                <a href="{{ route('game.manager', ['user_id' => session('usuario.id')]) }}"
                                    class="boton">Ir a Multijugador</a>
                            </div>
                        </div>

                        <!-- Próximamente -->
                        <div class="col-md-4 col-sm-6">
                            <div class="banquea-card text-center locked">
                                <div class="banquea-icon">
                                    <img src="https://cdn-icons-png.flaticon.com/512/17578/17578259.png" alt=""
                                        style="width: 100%; height: 100%;">
                                </div>
                                <h5 class="fw-bold mb-2 text-secondary">Próximamente</h5>
                                <p class="text-muted mb-3">Trabajamos duro, nuevos modos de juego en desarrollo.</p>
                                <button class="banquea-btn disabled" disabled>Próximamente</button>
                            </div>
                        </div>

                        <!-- Unirse a una partida -->
                        <div class="col-md-6 mt-4">
                            <div class="banquea-card text-center p-4">
                                <div class="banquea-icon">🚀</div>
                                <h4 class="fw-bold mb-3 text-success">Unirse a una Partida</h4>
                                <p class="text-muted">Ingresa el código de la partida que te compartió tu amigo</p>

                                <input type="hidden" id="user_id" value="{{ session('usuario.id') }}">

                                <div class="input-group mb-3 justify-content-center">
                                    <input type="text" id="game-code"
                                        class="form-control text-center fs-5 rounded-pill shadow-sm"
                                        placeholder="Ejemplo: 1Q6OSG" maxlength="6" style="max-width: 200px;">
                                </div>

                                <button onclick="joinGame()" class="boton">Unirme a la partida</button>
                                {{--
                                <button onclick="joinGame()" class="banquea-btn">Unirme a la partida</button>
                                --}}
                            </div>
                        </div>
                    </div>
                </div>


                <script src="{{ asset('js/unirme-partida.js') }}"></script>
            </div>
        </main>
    </div>
@endsection
