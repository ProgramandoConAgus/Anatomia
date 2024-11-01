
let accion//1 sera Actualizar Curso, 2 sera habilitar o deshabilitar usuario

//Selecciona todos los selects
let selects = document.querySelectorAll("select");
//Recorre cada select escuchando un cambio
selects.forEach(function(select) {
    select.addEventListener("change", function() {
        
        let options=[]
        data=select.selectedOptions[0].value.split(".")
        for(let opciones of select.selectedOptions){

            options.push(opciones.value.split(".")[0])
            
        }
        accion=1
        actualizarUsuario(data[1],options,accion)
    });
});


// Selecciona todos los switches (checkboxes) con la clase 'form-check-input'
let switches = document.querySelectorAll(".form-check-input");

// Recorre cada switch escuchando un cambio
switches.forEach(function(switchElement) {
    switchElement.addEventListener("change", function() {
        let switchId = this.id; // Obtiene la id del usuario
        let isChecked = this.checked; //Obtiene el valor booleano del switch
        if(isChecked){
            isChecked=1
        }
        else{
            isChecked=2
        }
        console.log(switchId+"."+isChecked)
        accion=2
        //actualizarUsuario(switchId,isChecked,accion)
    });
});


function actualizarUsuario(userId, id, tipoAccion) {
    // Crear el cuerpo de los datos que se enviarán en la solicitud
    let data = new FormData();
    //agregas toda la informacion apta para ser leida
    data.append('userId', userId);  
    data.append('id', id);
    data.append('tipoAccion', tipoAccion);
   
    console.log(data)
    // Enviar la solicitud al archivo PHP que hará el UPDATE en la base de datos
    fetch('./Admins/updateAdmin.php', {
        method: 'POST',
        body: data
    })
    .then(response => {
        // Verificar si la respuesta es OK (código 200)
        if (!response.ok) {
        throw new Error('Error en la respuesta: ' + response.status);
    }
    return response.text(); // Convertir la respuesta a JSON
    })
    .then(result => {
        console.log('Respuesta del servidor:', result); // Ver la respuesta original

        if (result.status === 'success') {
            console.log('Usuario actualizado correctamente');
            console.log(result.message)
        } else {
            console.error('Error al actualizar el usuario:', result.message);
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));
    
}
