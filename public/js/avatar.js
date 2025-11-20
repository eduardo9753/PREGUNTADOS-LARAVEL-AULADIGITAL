// Variable global
let currentAvatarUrl = '';

document.addEventListener('DOMContentLoaded', () => {
    initAvatarSelection();
});

function initAvatarSelection() {
    const userId = document.getElementById('user_id').value;
    const botones = document.querySelectorAll('.escoger-avatar');

    botones.forEach(boton => {
        boton.addEventListener('click', () => {
            const imagen = boton.closest('.banquea-card').querySelector('img');
            const url = imagen.getAttribute('src');
            currentAvatarUrl = url;

            // Mostrar la URL en un input
            document.getElementById('avatarSeleccionado').value = url;

            // Marcar visualmente el avatar elegido
            botones.forEach(b => b.classList.remove('activo'));
            boton.classList.add('activo');

            // Confirmar guardado con SweetAlert
            Swal.fire({
                title: '¿Guardar este avatar?',
                text: '¿Deseas usar este personaje como tu avatar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#00ff85',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar',
                background: '#0f172a',
                color: '#e2e8f0'
            }).then((result) => {
                if (result.isConfirmed) {
                    saveAvatar(userId, currentAvatarUrl);
                }
            });
        });
    });
}

function saveAvatar(userId, avatarUrl) {
    if (!avatarUrl) {
        Swal.fire({
            icon: 'warning',
            title: 'Primero selecciona un avatar',
            background: '#0f172a',
            color: '#e2e8f0'
        });
        return;
    }

    fetch('https://preunicursos.com/api/preguntados/game/avatars', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            user_id: userId,
            avatar_url: avatarUrl
        })
    })
        .then(res => res.json())
        .then(data => {
            Swal.fire({
                title: '¡Avatar guardado!',
                text: 'Tu personaje ha sido registrado con éxito ⚡',
                icon: 'success',
                confirmButtonColor: '#00ff85',
                background: '#0f172a',
                color: '#e2e8f0'
            }).then(() => {
                window.location.href = '/home/game';
            });
        })
        .catch(err => {
            console.error(err);
            Swal.fire({
                icon: 'error',
                title: 'Error al guardar',
                text: 'Hubo un problema al registrar tu avatar 😔',
                background: '#0f172a',
                color: '#e2e8f0'
            });
        });
}
