<div>


    {{-- Contenido principal --}}
    <div class="d-flex flex-column justify-content-center align-items-center min-vh-100 bg-light">
        @if ($finished)
            <div class="banquea-card shadow-lg border-0 rounded-4 text-center p-5" style="max-width: 700px;">
                <h3 class="text-gradient fw-bold mb-3">🎉 ¡Juego Completado!</h3>
                <h5 class="mb-3">Tu puntuación final:</h5>
                <h2 class="fw-bold text-primary mb-4">
                    {{ $correctAnswers }} / {{ $totalQuestions }} correctas
                </h2>

                {{--
                <button wire:click="reload" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold">
                    🔁 Jugar de nuevo
                </button>
                --}}

                <a href="{{ route('game.scoreSingle', [
                    'correct' => $correctAnswers,
                ]) }}"
                    class="boton boton-color-azul-oscuro fondo-cuerpo text-white">Ir al
                    Menú</a>
            </div>
        @else
            @if ($question)
                <div class="banquea-card shadow-lg border-0 rounded-4" style="width: 90%;">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase fw-bold text-primary mb-3">Pregunta</h6>
                        <h5 class="fw-semibold text-dark mb-4" style="text-align: justify">{!! $question['titulo'] !!}</h5>

                        <div class="row g-3 mb-4">
                            @foreach ($answers as $answer)
                                <div class="col-12 col-md-6">
                                    <div wire:click="selectAnswer({{ $answer['id'] }})"
                                        class="p-3 rounded-3 border text-center fw-medium
                                        @if ($selectedAnswer == $answer['id']) border-primary bg-primary text-white
                                        @elseif($isChecked && $answer['es_correcta']) border-success bg-success text-white
                                        @elseif($isChecked && !$answer['es_correcta'] && $selectedAnswer == $answer['id']) border-danger bg-danger text-white
                                        @else border-secondary-subtle @endif"
                                        style="transition: all 0.2s ease; cursor:pointer;">
                                        {{ $answer['titulo'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if (!$isChecked)
                            <button wire:click="checkAnswer" class="boton boton-color-verde-oscuro fondo-cuerpo"
                                @if (!$selectedAnswer) disabled @endif>
                                COMPROBAR
                            </button>
                        @else
                            <div class="mb-3">
                                @if ($isCorrect)
                                    <p class="fondo-azul fondo-cuerpo"> ¡Correcto!</p>
                                @else
                                    <p class="fondo-rojo fondo-cuerpo"> Incorrecto</p>
                                @endif
                            </div>
                            <button wire:click="nextQuestion"
                                class="boton boton-color-azul-oscuro fondo-cuerpo btn-animado ml-3">
                                SIGUIENTE
                            </button>
                        @endif
                    </div>

                    {{-- Barra de progreso estilizada --}}
                    <div class="banquea-card">
                        {{-- Encabezado --}}
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-semibold text-gradient">
                                🧩 Pregunta {{ $currentQuestion }} de {{ $totalQuestions }}
                            </span>
                            <span class="fw-semibold text-muted small">
                                {{ intval($progress) }}%
                            </span>
                        </div>

                        {{-- Tiempo restante --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-semibold text-secondary">⏱ Tiempo restante:</span>
                            <span class="fw-bold {{ $timeLeft <= 5 ? 'text-danger pulse' : 'text-success' }}">
                                {{ $timeLeft }} s
                            </span>
                        </div>

                        {{-- Barra visual --}}
                        <div class="progress banquea-progress-bar rounded-pill" style="height: 22px;">
                            <div class="progress-bar fw-semibold text-white" role="progressbar"
                                style="
                width: {{ $progress }}%;
                background: linear-gradient(90deg,
                    {{ $progress < 40 ? '#e53935' : ($progress < 80 ? '#fdd835' : '#00c853') }},
                    {{ $progress < 40 ? '#ff7043' : ($progress < 80 ? '#ffee58' : '#1de9b6') }}
                );
                transition: width 0.4s ease-in-out, background 0.4s ease-in-out;
            "
                                aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-muted">No hay preguntas disponibles para esta categoría.</p>
            @endif
        @endif
    </div>




    {{-- Script del temporizador --}}
    @section('scripts')
        <script>
            document.addEventListener("livewire:load", function() {
                setInterval(() => {
                    console.log('inciado');
                    Livewire.emit('tick');
                }, 1000);

                Livewire.on('autoNext', () => {
                    setTimeout(() => {
                        Livewire.emit('nextQuestion');
                    }, 1000);
                });
            });
        </script>
    @endsection
</div>
