document.getElementById('updateLinks').addEventListener('submit', function (event) {
    event.preventDefault(); 

    const tipoLink = document.getElementById('tipoLink').value;
    const cursoLink = document.querySelector('select[name="cursoLink"]').value;
    const nuevoLink = document.querySelector('input[name="link"]').value;

    if (!tipoLink || !cursoLink || !nuevoLink) {
        alert('Por favor, completa todos los campos.');
        return;
    }

    // Separar el ID y el título del curso
    const [cursoId, cursoTitulo] = cursoLink.split('.');

    // Crear el objeto de datos a enviar
    const datos = {
        tipoLink,
        cursoId,
        cursoTitulo,
        nuevoLink,
    };

    // Enviar la solicitud al servidor
    fetch('./Admins/links.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al comunicarse con el servidor.');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Link actualizado correctamente.');
                // Opcional: Reiniciar el formulario
                document.getElementById('updateLinks').reset();
            } else {
                alert(`Error: ${data.message}`);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error inesperado.');
        });
});
