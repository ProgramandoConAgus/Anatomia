document.addEventListener('DOMContentLoaded', mostrarEventos());

const form = document.getElementById('baja-masiva-form');
const btnDeleteEvento = document.getElementById('btnEliminar');
function mostrarEventos() {
    const p = document.getElementById('date-persist');
    const formData = new FormData();
    formData.append('action', 'getAllEvents');  // Cambié a 'getAllEvents' para obtener todos los eventos

    fetch('./Admins/disableAllStudents.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())  // Asumiendo que la respuesta es JSON
    .then(data => {
        console.log(data);  // Verifica lo que se recibe
        if (data.status == 'success') {
            let eventsList = "Eventos programados:<br />";
            data.events.forEach(event => {
                eventsList += `Nombre: ${event.name}, Fecha de inicio: ${event.starts}<br />`;
            });
            p.innerHTML = eventsList;
        } else {
            p.innerHTML = 'No se encontraron eventos.';
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        p.innerHTML = 'Ocurrió un error al obtener los eventos.';
    });
}

btnDeleteEvento.addEventListener('click', function (event) {
    event.preventDefault(); 
    const curso=document.getElementById("borrarEventoCurso")
    const nombreCurso = curso.value.split(".");

    const formData = new FormData(form);
    formData.append('curso',nombreCurso[1]);
    formData.append('action', 'delete');
    disebledAllUsers(formData);
});

form.addEventListener('submit', function (event) {
    event.preventDefault(); 
    const formData = new FormData(form);
    formData.append('action', 'create');
    disebledAllUsers(formData);
});

function disebledAllUsers(formData) {
    const date = document.getElementById('fecha-evento');
    date.value = '';  // Limpiar el campo de fecha

    fetch('./Admins/disableAllStudents.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.statusText}`);
            }
            return response.json();  // Asegurarse de que la respuesta se procese como JSON
        })
        .then(data => {
            console.log('Respuesta del servidor:', data);  // Ver lo que el servidor devuelve

            const myModal = new bootstrap.Modal(document.getElementById('modalAlert-events'));
            const modalBody = document.getElementById('modal-body-events');
            modalBody.innerHTML = data.message;  // Mostrar el mensaje en el modal
            myModal.show();  // Mostrar el modal

            // Verificar si 'data.events' está definido y es un arreglo antes de usar 'forEach'
            if (data.status === 'success') {
                mostrarEventos()
            } else {
                pDatePersist.innerHTML = 'No se encontraron eventos.';  // Si no hay eventos o no es un arreglo
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
            const pDatePersist = document.getElementById('date-persist');
            pDatePersist.innerHTML = 'Ocurrió un error al obtener los eventos.';  // Mensaje de error
        });
}




//Selecciona todos los selects
let selects = document.querySelectorAll("select:not(.exclude-select)");
let responseText="";
let dateEvent = "";
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


// Selecciona todos los switches (checkboxes) con la clase 'check-input-users'
let switches = document.querySelectorAll(".check-input-users");

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
        actualizarUsuario(switchId,isChecked,accion)
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
    return response.json(); // Convertir la respuesta a JSON
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