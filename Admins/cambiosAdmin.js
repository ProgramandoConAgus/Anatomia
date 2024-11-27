
let accion//1 sera Actualizar Curso, 2 sera habilitar o deshabilitar usuario
const form = document.getElementById('baja-masiva-form');
const btnDeleteEvento = document.getElementById('btnEliminar');

document.addEventListener('DOMContentLoaded', function () {
    const p = document.getElementById('date-persist');
    const formData = new FormData();
    formData.append('action', 'getDate');

    fetch('./Admins/disableAllStudents.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.statusText}`);
            }
            return response.text(); 
        })
        .then(result => {
            let responseText = 'No se recibió una fecha válida';
            try {
                const data = JSON.parse(result);
                if (data && data.message) {
                    responseText = data.message; 
                    let val = responseText.split(" ");
                    p.innerHTML = 'Fecha de baja: ' + val[0];
                }
            } catch (error) {
                console.error('Error al analizar la respuesta JSON:', result);
            }

           
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
            p.innerHTML = 'Ocurrió un error al obtener la fecha.';
        });
});


//Selecciona todos los selects
let selects = document.querySelectorAll("select");
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

btnDeleteEvento.addEventListener('click',function (event){
    event.preventDefault(); 
    const formData = new FormData(form);
    formData.append('action','delete');
    disebledAllUsers(formData);
});

form.addEventListener('submit', function (event) {
    event.preventDefault(); 
    const formData = new FormData(form);
    formData.append('action','create');
    disebledAllUsers(formData);
    
});

function disebledAllUsers(formData){
    const date = document.getElementById('fecha-evento');
    date.value = '';
    fetch('./Admins/disableAllStudents.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => {

            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.statusText}`);
            }
            return response.text(); 
        })
        .then(text => {
            try {
                const data = JSON.parse(text);
                responseText =  data.message;
                if (data.status == 'success'){
                   
                    dateEvent = data.date;
                }
                
                const myModal = new bootstrap.Modal(document.getElementById('modalAlert-events'));
                const modalBody = document.getElementById('modal-body-events');
                modalBody.innerHTML = responseText;
                myModal.show();
                const pDatePersist = document.getElementById('date-persist');
                pDatePersist.innerHTML= "Fecha de baja: " + dateEvent;
            } catch (error) {
                console.error('La respuesta no es JSON válido:', text);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}