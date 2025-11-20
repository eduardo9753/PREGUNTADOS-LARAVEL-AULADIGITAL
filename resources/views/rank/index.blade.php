@extends('layouts.app')

@section('inline-css')
@endsection

@section('main')
    <div class="dashboard-layout">
        <!-- Panel lateral -->
        @include('templates.aside')



        <!-- Contenido principal -->
        <main class="main-content">
            <div class="rank-wrapper">
                <h1 class="rank-title-main">Camino de Rangos Banquea</h1>

                <div class="rank-carousel-container">
                    <button class="nav-btn left" id="prevRank">⟵</button>

                    <div id="rankCarousel" class="rank-carousel">
                        @foreach ($ranks as $index => $rank)
                            @php
                                $isCurrent = $currentRank && $rank['id'] == $currentRank['id'];
                                $isUnlocked = $currentRank && $rank['id'] <= $currentRank['id'];
                            @endphp

                            <div class="rank-slide {{ $index === 0 ? 'active' : '' }}">

                                <div
                                    class="rank-bubble {{ $isCurrent ? 'current' : ($isUnlocked ? 'unlocked' : 'locked') }}">
                                    <img src="{{ asset('rango/' . $rank['avatar']) }}" alt="">
                                </div>

                                @if ($isCurrent)
                                    <span class="rank-badge">🏅 Actual</span>
                                @endif

                                <p class="rank-name">{{ $rank['name'] }}</p>
                                <p class="rank-range">{{ $rank['min_points'] }} - {{ $rank['max_points'] ?? '+' }} pts</p>

                            </div>
                        @endforeach
                    </div>

                    <button class="nav-btn right" id="nextRank">⟶</button>
                </div>

                <div class="rank-indicator">
                    <span id="rankIndex">1</span> / {{ count($ranks) }}
                </div>

                <div class="rank-points-box">
                    ⭐ Tus puntos actuales: <strong>{{ $totalPoints }}</strong>
                </div>
            </div>

            <script src="{{ asset('js/rank.js') }}"></script>
        </main>
    </div>
@endsection
