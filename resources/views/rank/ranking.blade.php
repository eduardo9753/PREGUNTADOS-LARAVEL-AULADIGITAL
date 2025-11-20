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

                <div class="py-4">

                    <!-- ENCABEZADO DEL RANKING -->
                    <div class="banquea-card text-center mb-4">

                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <div class="banquea-icon">🥉</div>
                            <div class="banquea-icon" style="background:#d0e7ff; color:#2962ff;">🥈</div>
                            <div class="banquea-icon" style="background:#fff3cd; color:#ff9800;">🥇</div>
                        </div>

                        <div class="text-center mb-3">
                            <span class="banquea-icon mb-2">🏆</span>
                            <h3 class="fw-bold">Sé uno de los primeros</h3>
                            <p class="text-muted m-0">Los 10 mejores jugadores de Preguntados | Banquea</p>
                        </div>

                    </div>

                    <!-- LISTA DEL RANKING -->
                    <div class="banquea-card">

                        @foreach ($ranking as $i => $row)
                            <div class="d-flex align-items-center py-3 border-bottom" style="gap:15px;">

                                <!-- POSICIÓN -->
                                <div style="width:40px; text-align:center;">

                                    @if ($i + 1 == 1)
                                        <span style="font-size:26px;">🥇</span>
                                    @elseif($i + 1 == 2)
                                        <span style="font-size:26px;">🥈</span>
                                    @elseif($i + 1 == 3)
                                        <span style="font-size:26px;">🥉</span>
                                    @else
                                        <span class="fw-bold">{{ $i + 1 }}</span>
                                    @endif

                                </div>

                                <!-- AVATAR -->
                                <img src="{{ $row['user']['avatar']['avatar_url'] ?? 'https://cdn-icons-png.flaticon.com/512/1946/1946429.png' }}"
                                    class="rounded-circle"
                                    style="width:50px; height:50px; object-fit:cover; border:2px solid #e0e0e0;">

                                <!-- NOMBRE -->
                                <div class="flex-grow-1 fw-bold">
                                    {{ $row['user']['name'] }}
                                </div>

                                <!-- EXP -->
                                <div class="text-muted fw-bold">
                                    {{ $row['total_points'] }} EXP
                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>



            </div>
        </main>
    </div>
@endsection
