const gameId = document.getElementById('game_id').value;
const userId = document.getElementById('user_id').value;
const playerId = document.getElementById('player_id').value;

let timerInterval = null;
let timeLeft = 60;
let isLoading = false;
let currentQuestionId = null;

document.addEventListener('DOMContentLoaded', () => {
    loadNextQuestion();
    players(gameId);

    setInterval(() => {
        loadAnswerCounts(gameId);
    }, 3000);
    loadAnswerCounts(gameId);
});

function loadNextQuestion() {
    if (isLoading) return;
    isLoading = true;

    fetch(`https://preunicursos.com/api/preguntados/questions/next/${gameId}/${playerId}`)
        .then(res => res.json())
        .then(data => {
            isLoading = false;

            if (data.finished) {
                document.getElementById('question-container').classList.add('d-none');
                document.getElementById('status-message').textContent = data.message;
                document.getElementById('status-message').classList.remove('text-secondary');
                document.getElementById('status-message').classList.add('text-success');
                document.getElementById('results-container').classList.remove('d-none');

                //cargando los resultados
                loadResults(gameId);
                return;
            }

            currentQuestionId = data.id;

            document.getElementById('status-message').classList.add('d-none');
            document.getElementById('question-container').classList.remove('d-none');
            document.getElementById('question-text').textContent = data.question;

            const answersDiv = document.getElementById('answers');
            answersDiv.innerHTML = '';

            data.answers.forEach(answer => {
                const btn = document.createElement('button');
                btn.className = 'boton boton-color-verde-oscuro';
                btn.textContent = answer.text;
                btn.onclick = () => sendAnswer(answer.id, answer.correct);
                answersDiv.appendChild(btn);
            });

            startTimer();
        })
        .catch(err => {
            isLoading = false;
            console.error('Error al cargar la pregunta:', err);
        });
}

function startTimer() {
    timeLeft = 60;
    document.getElementById('timer').innerText = `⏳ Tiempo restante: ${timeLeft}s`;

    clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        timeLeft--;
        document.getElementById('timer').innerText = `⏳ Tiempo restante: ${timeLeft}s`;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            // Guardar como no respondida (answer_id null)
            sendAnswer(null, false);
        }
    }, 1000);
}

function sendAnswer(answerId, correct) {
    if (isLoading) return;
    isLoading = true;
    clearInterval(timerInterval);

    fetch(`https://preunicursos.com/api/preguntados/game/answer`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            game_id: gameId,
            user_id: userId,
            player_id: playerId,
            question_id: currentQuestionId,
            answer_id: answerId, // puede ser null si no respondieron
            correct: correct,
            time: 60 - timeLeft,
            category_type: 'question'
        })
    })
        .then(res => res.json())
        .then(() => {
            isLoading = false;
            loadNextQuestion();
        })
        .catch(err => {
            isLoading = false;
            console.error('Error al enviar respuesta:', err);
        });
}


function players(gameId) {
    fetch(`https://preunicursos.com/api/preguntados/game/players`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ game_id: gameId })
    })
        .then(res => res.json())
        .then(data => {
            const players = data.players || [];
            console.log("Data", players);

            const container = document.getElementById('playersList');
            container.innerHTML = '';

            players.forEach(p => {
                const col = document.createElement('div');
                // Responsive con Bootstrap: 1 columna en móvil, 2 en tablet, 3+ en pantallas grandes
                col.classList.add('col-12', 'col-sm-6', 'col-md-4', 'col-lg-3', 'col-xl-2', 'd-flex', 'justify-content-center');

                const avatarUrl = p.user.avatar.avatar_url || 'https://cdn-icons-png.flaticon.com/512/72/72648.png';
                const status = p.status === 'finished'
                    ? `<span class="text-gradient finished">Completó</span>`
                    : `<span class="player-status playing">🕹️ Jugando</span>`;

                col.innerHTML = `
                <div class="banquea-card w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                    <img src="${avatarUrl}" class="player-avatar mb-2 bg-white" alt="Avatar">
                    <p class="player-name mb-1">${p.user?.name || 'Jugador ' + p.user_id}</p>
                    ${status}
                </div>
            `;
                container.appendChild(col);
            });
        })
        .catch(err => {
            console.error('Error al obtener jugadores:', err);
        });
}


/**
 * PARA MOSTRAR LOS RESULTADOS
 */
function loadResults(gameId) {
    fetch(`https://preunicursos.com/api/preguntados/game/results/${gameId}`)
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('results');
            const winnerDiv = document.getElementById('winner-card');
            const resultsContainer = document.getElementById('results-container');

            container.innerHTML = '';
            winnerDiv.innerHTML = '';
            resultsContainer.classList.remove('d-none');

            // 🏆 Mostrar ganador destacado
            if (data.winner) {
                const w = data.winner;
                winnerDiv.classList.remove('d-none');
                winnerDiv.innerHTML = `
                    <h3>🏅 ¡Ganador!</h3>
                    <h2>${w.name}</h2>
                    <p>✅ Correctas: <strong>${w.correct}</strong></p>
                    <p>⏱️ Tiempo: <strong>${w.total_time.toFixed(2)}s</strong></p>
                `;
            }

            //Mostrar todos los jugadores
            data.results.forEach(r => {
                const div = document.createElement('div');
                div.classList.add('banquea-card');

                // Si es el ganador, agregamos un borde especial
                if (data.winner && r.user_id === data.winner.user_id) {
                    div.style.border = '3px solid #4caf50';
                }

                div.innerHTML = `
                    <h5 class="text-gradient">👤 ${r.name}</h5>
                    <p class="result-detail">✅ Correctas: <strong>${r.correct}</strong></p>
                    <p class="result-detail">❌ Incorrectas: <strong>${r.incorrect}</strong></p>
                    <p class="result-detail">⏱️ Tiempo total: <strong>${r.total_time.toFixed(2)}s</strong></p>
                    <p class="result-detail">🏆 Puntaje: <strong>${r.correct}</strong></p>
                `;
                container.appendChild(div);
            });
        })
        .catch(err => {
            console.error('Error al cargar resultados:', err);
        });
}


/**
 * PARA CONTAR LAS RESPUESTAS DEL USUARIO
 */
function loadAnswerCounts(gameId) {
    fetch(`https://preunicursos.com/api/preguntados/game/count/${gameId}`)
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('countAnswer');
            container.innerHTML = '';

            // Crear fila responsive
            const row = document.createElement('div');
            row.classList.add('row', 'g-3', 'justify-content-center');

            data.data.forEach(p => {
                const col = document.createElement('div');
                col.classList.add('col-12', 'col-sm-6', 'col-md-4', 'col-lg-3', 'col-xl-2');

                col.innerHTML = `
                    <div class="banquea-card text-center h-100">
                        <p class="player-name mb-1">${p.name}</p>
                        <p class="answered-count mb-0">
                            <span class="text-gradient">Preguntas respondidas:</span>
                            <strong>${p.answered}</strong>
                        </p>
                    </div>
                `;
                row.appendChild(col);
            });

            container.appendChild(row);
        })
        .catch(err => {
            console.error('Error al obtener conteo de respuestas:', err);
        });
}





