function BorrarUsuario(userId){
   // Crear el cuerpo de los datos que se enviarán en la solicitud
   let data = new FormData();
   //agregas toda la informacion apta para ser leida
   data.append('userId', userId);  

   console.log(data);

   //Enviar la solicitud al archivo PHP que ejecutara el delete
    fetch('./Admins/BorrarUsuarios/borrarUsuario.php',{
        method: 'POST',
        body: data

    })
    .then(response => {
        // Verificar si la respuesta es OK (código 200)
        console.log(response);
    return response.json(); // Convertir la respuesta a JSON
    })
    .then(result => {
        if (result.success) {
            $('#confirmDeleteModal' + userId).modal('hide');  // Cierra el modal correspondiente

            Swal.fire({
              title: 'Éxito',
              text: result.message,
              icon: 'success',
              confirmButtonText: 'Continuar'
            }).then(() => {
                // Redirigir al panel
                window.location.href = './Admins/panel-admin.php'; // Cambia esto a la URL de tu panel
            });
        }
        console.log('Respuesta del servidor:', result); // Ver la respuesta original

    })
    .catch(error => console.error('Error en la solicitud:', error));
};
