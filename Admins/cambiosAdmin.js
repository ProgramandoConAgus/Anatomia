
const form = document.getElementById('baja-masiva-form');
const upLoadArchivoForm = document.getElementById('upLoadArchivoForm');
const btnDeleteEvento = document.getElementById('btnEliminar');
const dirPdfs = document.getElementById("dirPdfs");
const btnDeletePdf = document.getElementById("btnDeletePdf");

//----addEvents----
document.addEventListener('DOMContentLoaded', () => {
    mostrarEventos();
    getPdfs();

});
btnDeletePdf.addEventListener('click', function (event) {
    removePdf();
})

form.addEventListener('submit', function (event) {
    event.preventDefault(); 
    const formData = new FormData(form);
    formData.append('action', 'create');
    disebledAllUsers(formData);
});

btnDeleteEvento.addEventListener('click', function (event) {
    event.preventDefault(); 
    const curso=document.getElementById("borrarEventoCurso")
    const nombreCurso = curso.value.split(".");

    const formData = new FormData(form);
    formData.append('curso',nombreCurso[1]);
    formData.append('action', 'delete');
    disebledAllUsers(formData);
});

upLoadArchivoForm.addEventListener('submit', function (event) {
    event.preventDefault();
    upLoadPdf(this);
})

//----functions----
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


//----------------------------PDF-----------------------------------------

function upLoadPdf(form) {

    const progressContainer = document.getElementById("uploadProgressContainerPdf");
    const progressBar = document.getElementById("uploadProgressBarPdf");

    progressContainer.style.display = "block";
    const formData = new FormData(form);
    formData.append('action', '1');
    form.reset()

    const xhr = new XMLHttpRequest();

    xhr.open("POST", "./Admins/managmentPdf.php", true);

    xhr.upload.addEventListener("progress", function (e) {
        if (e.lengthComputable) {
            const percentComplete = (e.loaded / e.total) * 100;
            progressBar.style.width = percentComplete + "%";
            progressBar.innerHTML = Math.floor(percentComplete) + "%";
        }
    });

    xhr.onload = function () {
        let response;
        try {

            response = JSON.parse(xhr.responseText);

        } catch (error) {
            console.error("Error al parsear la respuesta del servidor:", error);
            progressBar.classList.add("bg-danger");
            progressBar.innerHTML = "Error en la respuesta del servidor.";
            return;
        }

        if (response.status === 'success') {

            progressBar.classList.add("bg-success");
            progressBar.innerHTML = response.message;

            setTimeout(() => {
                progressContainer.style.display = "none";
                progressBar.classList.remove("bg-success");
                progressBar.style.width = "0%";

                //recargamos directorios en pantalla
                getPdfs();
            }, 2000);


        } else {
            progressBar.classList.add("bg-danger");
            progressBar.innerHTML = response.message || "Error desconocido.";
            setTimeout(() => {
                progressContainer.style.display = "none";
                progressBar.classList.remove("bg-danger");
                progressBar.style.width = "0%";
            }, 2000);
        }

    };

    xhr.onerror = function () {
        progressBar.classList.add("bg-danger");
        progressBar.innerHTML = "Error de conexión.";
        setTimeout(() => {
            progressContainer.style.display = "none";
            progressBar.classList.remove("bg-danger");
            progressBar.style.width = "0%";
        }, 2000);
    };

    xhr.send(formData);

};

function getPdfs() {
    const formData = new FormData();
    formData.append('action', '2');
    fetch('./Admins/managmentPdf.php', {
        method: 'POST',
        body: formData
    }).then(response => {

        if (!response.ok) {
            throw new Error('Error en la respuesta: ' + response.status);
        }
        return response.json();
    }).then(result => {
        builderDir(result)
    }).catch(error => { console.log(error) })
}

function builderDir(data) {
    const arrayData = data.data;
    const jsonData = [];
    if (arrayData) {
        for (let i = 0; i < arrayData.length; i++) {
            let row = arrayData[i];
            let path = row.pdf_path.split('/'); // Dividir la ruta por "/"

            if (path.length < 4) continue; // Ignorar rutas con menos de 3 niveles

            let nameDir = path[2]; // Carpeta principal ( el nombre de categoria)
            let file = path[3];    // Archivo dentro de la carpeta


            let existingFolder = jsonData.find(folder => folder.name === nameDir); // Buscar si la carpeta ya existe en jsonData

            if (existingFolder) {
                // Si la carpeta existe, agregar el archivo
                existingFolder.files.push({
                    name: file,
                    type: 'file'
                });
            } else {
                // Si no existe, crear una nueva entrada de carpeta
                jsonData.push({
                    name: nameDir,
                    id: Math.floor(1000 + Math.random() * 9000),
                    files: [{
                        name: file,
                        type: 'file'
                    }]
                });
            }
        }
    }
    renderFolders(jsonData);
}

function createFolder(folder) {
    const li = document.createElement("li");
    li.classList.add("list-group-item");
    li.classList.add('folder')
    li.style.cursor = "pointer";
    const icon = document.createElement("i");
    icon.classList.add("bi", "bi-folder-fill", "text-warning");
    li.appendChild(icon);

    const span = document.createElement("span");

    span.type = "folder";
    span.id = `spn-folder${folder.id}`;

    span.textContent = folder.name;

    li.appendChild(span)
    if (folder.files && folder.files.length > 0) {
        const button = document.createElement("button");
        button.classList.add("btn", "btn-link", "btn-sm", "float-end");
        button.setAttribute("data-bs-toggle", "collapse");
        button.setAttribute("data-bs-target", `#folder${folder.id}`);
        button.innerHTML = '<i class="bi bi-chevron-down"></i>';
        li.appendChild(button);

        const ul = document.createElement("ul");
        ul.classList.add("list-group", "collapse", "mt-2");
        ul.id = 'folder' + folder.id;

        folder.files.forEach((file) => {
            if (file.type === "file") {
                ul.appendChild(createFile(file, span));
            } else if (file.type === "folder") {
                ul.appendChild(createFolder(file));
            }
        });

        li.appendChild(ul);
    }
    span.addEventListener('click', () => {
        setStyle(span)
    });

    return li;
}

function createFile(file, parentSpan) {
    const li = document.createElement("li");
    li.classList.add("list-group-item");
    li.classList.add("file");
    li.style.cursor = "pointer";

    const icon = document.createElement("i");
    icon.classList.add("bi", "bi-file-earmark-pdf");
    li.appendChild(icon);

    const span = document.createElement("span");
    span.textContent = file.name;
    span.type = "file"
    span.idParent = parentSpan.id;
    span.nameDir = parentSpan.textContent
    li.appendChild(span)
    span.addEventListener('click', () => {
        setStyle(span)
    });
    return li;
}

function renderFolders(data) {
    debugger
    const ul = document.createElement("ul");
    ul.classList.add("list-group");

    data.forEach((folder) => {
        ul.appendChild(createFolder(folder));
    });
    dirPdfs.innerHTML = "";

    dirPdfs.appendChild(ul);
}

function setStyle(span) {
    // Verificar si el span ya está seleccionado
    const isSelected = span.classList.contains('selected-pdf');

    // Alternar las clases solo en el span actual
    span.classList.toggle('text-primary', !isSelected);
    span.classList.toggle('selected-pdf', !isSelected);

    // Si el span no es un archivo, procesar los hijos del li
    if (span.type !== 'file') {
        const parentLi = span.parentElement;
        const ul = parentLi.querySelector('ul');

        if (ul) {
            // Aplicar o remover clases a todos los spans hijos
            const childSpans = ul.querySelectorAll('span');
            childSpans.forEach((childSpan) => {
                childSpan.classList.toggle('text-primary', !isSelected);
                childSpan.classList.toggle('selected-pdf', !isSelected);
            });
        }
    }
}

function prparedFromDeletePdf() {
    debugger
    const request = [];
    const containerDir = document.getElementById('dirPdfs');
    const listItems = Array.from(containerDir.getElementsByClassName('selected-pdf')); // Convertir a array

    listItems.forEach((element) => {
        if (element.type === 'file') {
            const nameDir = element.nameDir // Obtiene el nombre del directorio
            if (!nameDir) return; // Saltar si no tiene el atributo

            // Buscar si ya existe la carpeta en el request
            let existingFolder = request.find(folder => folder.name === nameDir);

            if (existingFolder) {
                // Agregar el archivo a la carpeta existente
                existingFolder.files.push({
                    name: element.textContent,
                    type: 'file'
                });
            } else {
                // Crear una nueva carpeta con el archivo
                request.push({
                    name: nameDir,
                    files: [{
                        name: element.textContent,
                        type: 'file'
                    }]
                });
            }
        }
    });

    console.log(JSON.stringify(request));
    return JSON.stringify(request);
}
function removePdf() {
    const json = prparedFromDeletePdf();
    const progressContainer = document.getElementById("uploadProgressContainerPdf");
    const progressBar = document.getElementById("uploadProgressBarPdf");

    progressContainer.style.display = "block";
    const formData = new FormData(form);
    formData.append('action', '3');
    formData.append('data', json);

    const xhr = new XMLHttpRequest();

    xhr.open("POST", "./Admins/managmentPdf.php", true);

    xhr.upload.addEventListener("progress", function (e) {
        if (e.lengthComputable) {
            const percentComplete = (e.loaded / e.total) * 100;
            progressBar.style.width = percentComplete + "%";
            progressBar.innerHTML = Math.floor(percentComplete) + "%";
        }
    });

    xhr.onload = function () {
        let response;
        try {

            response = JSON.parse(xhr.responseText);

        } catch (error) {
            console.error("Error al parsear la respuesta del servidor:", error);
            progressBar.classList.add("bg-danger");
            progressBar.innerHTML = "Error en la respuesta del servidor.";
            return;
        }

        if (response.status === 'success') {

            progressBar.classList.add("bg-success");
            progressBar.innerHTML = response.message;

            setTimeout(() => {
                progressContainer.style.display = "none";
                progressBar.classList.remove("bg-success");
                progressBar.style.width = "0%";

                //recargamos directorios en pantalla
                getPdfs();
            }, 2000);


        } else {
            progressBar.classList.add("bg-danger");
            progressBar.innerHTML = response.message || "Error desconocido.";
            setTimeout(() => {
                progressContainer.style.display = "none";
                progressBar.classList.remove("bg-danger");
                progressBar.style.width = "0%";
            }, 2000);
        }

    };

    xhr.onerror = function () {
        progressBar.classList.add("bg-danger");
        progressBar.innerHTML = "Error de conexión.";
        setTimeout(() => {
            progressContainer.style.display = "none";
            progressBar.classList.remove("bg-danger");
            progressBar.style.width = "0%";
        }, 2000);
    };

    xhr.send(formData);


}

