@extends('layouts.app')

@section('inline-css')
@endsection

@section('main')
    <div class="dashboard-layout">

        @include('templates.aside')

        <main class="main-content">
            <div class="container-fluid">

                <div class="py-4">

                    <!-- ENCABEZADO -->
                    <div class="banquea-card text-center mb-4">
                        <span class="banquea-icon mb-2">🧾</span>
                        <h3 class="fw-bold">Reglas del Juego - Preguntados</h3>
                        <p class="text-muted m-0">Conoce cómo funciona cada modo antes de jugar</p>
                    </div>

                    <!-- MODO SINGLE -->
                    <div class="banquea-card mb-4">
                        <h4 class="fw-bold mb-3">🎯 Modo Single (Individual)</h4>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">🔢</div>
                            <div class="fw-bold flex-grow-1">El juego contiene <strong>10 preguntas</strong>.</div>
                        </div>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">⏱️</div>
                            <div class="fw-bold flex-grow-1">Cada pregunta tiene un tiempo límite de <strong>60
                                    segundos</strong>.</div>
                        </div>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">🎡</div>
                            <div class="fw-bold flex-grow-1">La categoría se selecciona mediante una <strong>ruleta de
                                    categorías</strong>.</div>
                        </div>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">🧠</div>
                            <div class="fw-bold flex-grow-1">El sistema te dirige automáticamente a las preguntas.</div>
                        </div>

                        <!-- ITEM PUNTAJES -->
                        <div class="d-flex align-items-start py-3" style="gap:15px;">
                            <div style="font-size:22px;">🏆</div>
                            <div class="fw-bold flex-grow-1">
                                <div>Puntajes del modo Single:</div>

                                <!-- SUB ITEMS -->
                                <div class="mt-2 ps-4">
                                    <div class="d-flex py-1"><span style="font-size:18px;">✅</span>&nbsp; 8 a 10 correctas →
                                        <strong>+30 puntos</strong>
                                    </div>
                                    <div class="d-flex py-1"><span style="font-size:18px;">🟡</span>&nbsp; 5 a 7 correctas →
                                        <strong>+15 puntos</strong>
                                    </div>
                                    <div class="d-flex py-1"><span style="font-size:18px;">❌</span>&nbsp; Menos de 5
                                        correctas → <strong>-30 puntos</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODO MULTIJUGADOR -->
                    <div class="banquea-card">
                        <h4 class="fw-bold mb-3">👥 Modo Multijugador</h4>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">🔢</div>
                            <div class="fw-bold flex-grow-1">Cada partida tiene <strong>10 preguntas</strong>.</div>
                        </div>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">⏱️</div>
                            <div class="fw-bold flex-grow-1">Cada pregunta tiene un límite de <strong>60 segundos</strong>.
                            </div>
                        </div>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">🎡</div>
                            <div class="fw-bold flex-grow-1">La categoría se elige mediante una <strong>ruleta de
                                    categorías</strong>.</div>
                        </div>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">👥</div>
                            <div class="fw-bold flex-grow-1">Máximo de <strong>4 jugadores</strong> por partida.</div>
                        </div>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">🔐</div>
                            <div class="fw-bold flex-grow-1">Se genera un <strong>código de partida</strong> para compartir.
                            </div>
                        </div>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">🚀</div>
                            <div class="fw-bold flex-grow-1">El juego inicia automáticamente cuando todos ingresan al lobby.
                            </div>
                        </div>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">🧠</div>
                            <div class="fw-bold flex-grow-1">Cada respuesta correcta suma <strong>+1 punto</strong>.</div>
                        </div>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">
                            <div style="font-size:22px;">🏁</div>
                            <div class="fw-bold flex-grow-1">El primer jugador en terminar todas las preguntas finaliza la
                                partida.</div>
                        </div>

                        <!-- ITEM -->
                        <div class="d-flex align-items-center py-3" style="gap:15px;">
                            <div style="font-size:22px;">🏆</div>
                            <div class="fw-bold flex-grow-1">El ganador recibe <strong>+50 puntos extra</strong>.</div>
                        </div>
                    </div>

                </div>
            </div>
        </main>

    </div>
@endsection
