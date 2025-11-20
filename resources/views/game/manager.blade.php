@extends('layouts.app')

@section('inline-css')
@endsection

@section('main')
    <div class="dashboard-layout">
        <!-- Panel lateral -->
        @include('templates.aside')

        <!-- Contenido principal -->
        <main class="main-content">
            <div class="container-fluid mt-5">
                <div class="banquea-card shadow p-4">
                    <h3 class="mb-3 text-center">🎮 Crear partida</h3>

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                     @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('game.create') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Selecciona una categoría</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="max_players" class="form-label">Número máximo de jugadores</label>
                            <input type="number" name="max_players" id="max_players" class="form-control" min="2"
                                max="4" value="2" required>
                        </div>

                        <input type="hidden" name="creator_id" value="{{ auth()->id() ?? 1 }}">

                        <div class="text-center">
                            <button type="submit" class="boton boton-color-verde-oscuro">🚀 Crear partida</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
