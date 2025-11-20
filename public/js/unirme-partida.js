async function joinGame() {
    const code = document.getElementById('game-code').value.trim();
    const userId = document.getElementById('user_id').value;

    if (!code) {
        Swal.fire({
            icon: 'warning',
            title: '⚠️ Por favor ingresa un código de partida.',
            background: '#0f172a',
            color: '#e2e8f0',
            timer: 2000,
            showConfirmButton: false
        });
        return;
    }

    try {
        const res = await fetch('https://veterinaria.banquea.pe/api/preguntados/game/join', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ code, user_id: userId })
        });

        const data = await res.json();
        console.log('Respuesta:', data);

        if (data.error) {
            Swal.fire({
                icon: 'error',
                title: '❌ ' + data.error,
                background: '#0f172a',
                color: '#e2e8f0',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            });

            return;
        }

        Swal.fire({
            icon: 'success',
            title: '✅ ' + data.message,
            background: '#0f172a',
            color: '#e2e8f0',
            timer: 2000, 
            timerProgressBar: true,
            showConfirmButton: false
        }).then(() => {
            window.location.href = `/game/wait/${data.game_id}`;
        });

    } catch (error) {
        console.error(error);
        alert('⚠️ Error al unirse a la partida');
    }
}