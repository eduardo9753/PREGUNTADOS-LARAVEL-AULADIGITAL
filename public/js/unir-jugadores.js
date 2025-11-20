document.addEventListener('DOMContentLoaded', () => {
    const code = document.getElementById('game_id').value;
    console.log('Código del juego:', code);

    setInterval(() => loadPlayers(code), 3000);
    loadPlayers(code);
});

function loadPlayers(code) {
    fetch(`https://preunicursos.com/api/preguntados/game/get/${code}`)
        .then(res => res.json())
        .then(data => {
            console.log('datos', data);

            const playersContainer = document.getElementById('players-container');
            playersContainer.innerHTML = '';

            if (data.players && data.players.length > 0) {
                data.players.forEach(p => {
                    const li = document.createElement('li');
                    li.classList.add('list-group-item');
                    li.textContent = p.user?.name ?? `Jugador con id: ${p.user.id}`;
                    playersContainer.appendChild(li);
                });

                if (data.players.length >= data.max_players) {
                    document.getElementById('status-message').textContent = "¡Partida completa! Iniciando juego...";
                    setTimeout(() => {
                        console.log('Iniciando partida...');
                        window.location.href = `/game/play/${code}`;
                    }, 2000);
                } else {
                    document.getElementById('status-message').textContent = "Esperando más jugadores...";
                }
            } else {
                playersContainer.innerHTML = '<li class="list-group-item text-muted">Aún no hay jugadores unidos.</li>';
            }
        })
        .catch(() => console.log('Error cargando jugadores'));
}
