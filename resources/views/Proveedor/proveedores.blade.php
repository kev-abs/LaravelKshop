<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Gestión de Proveedores</h2>

    <form id="formProveedor" class="card p-3 mb-4">
        <div class="row">
            <div class="col-md-2">
                <input type="number" id="idProveedor" class="form-control" placeholder="ID" required>
            </div>
            <div class="col-md-3">
                <input type="text" id="nombreEmpresa" class="form-control" placeholder="Empresa" required>
            </div>
            <div class="col-md-3">
                <input type="text" id="contacto" class="form-control" placeholder="Contacto">
            </div>
            <div class="col-md-2">
                <input type="text" id="telefono" class="form-control" placeholder="Teléfono">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Guardar</button>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                <input type="email" id="correo" class="form-control" placeholder="Correo">
            </div>
            <div class="col-md-8">
                <input type="text" id="direccion" class="form-control" placeholder="Dirección">
            </div>
        </div>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Empresa</th>
            <th>Contacto</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="tablaProveedores"></tbody>
    </table>
</div>

<script>
const API = "http://localhost:8080/proveedor";
let editando = false;

document.addEventListener("DOMContentLoaded", cargarProveedores);

function cargarProveedores() {
    fetch(API)
        .then(res => res.json())
        .then(data => {
            const tabla = document.getElementById("tablaProveedores");
            tabla.innerHTML = "";
            data.forEach(p => {
                tabla.innerHTML += `
                    <tr>
                        <td>${p.id_Proveedor}</td>
                        <td>${p.nombre_Empresa}</td>
                        <td>${p.contacto || ""}</td>
                        <td>${p.telefono || ""}</td>
                        <td>${p.correo || ""}</td>
                        <td>${p.direccion || ""}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick='editar(${JSON.stringify(p)})'>Editar</button>
                            <button class="btn btn-danger btn-sm" onclick="eliminar(${p.id_Proveedor})">Eliminar</button>
                        </td>
                    </tr>
                `;
            });
        });
}

document.getElementById("formProveedor").addEventListener("submit", function(e){
    e.preventDefault();

    const proveedor = {
        ID_Proveedor: document.getElementById("idProveedor").value,
        nombre_Empresa: document.getElementById("nombreEmpresa").value,
        contacto: document.getElementById("contacto").value,
        telefono: document.getElementById("telefono").value,
        correo: document.getElementById("correo").value,
        direccion: document.getElementById("direccion").value
    };

    if(editando){
        fetch(API + "/" + proveedor.ID_Proveedor, {
            method: "PUT",
            headers: {"Content-Type":"application/json"},
            body: JSON.stringify(proveedor)
        }).then(() => {
            editando = false;
            limpiar();
            cargarProveedores();
        });
    } else {
        fetch(API, {
            method: "POST",
            headers: {"Content-Type":"application/json"},
            body: JSON.stringify(proveedor)
        }).then(() => {
            limpiar();
            cargarProveedores();
        });
    }
});

function editar(p){
    editando = true;
    idProveedor.value = p.id_Proveedor;
    nombreEmpresa.value = p.nombre_Empresa;
    contacto.value = p.contacto;
    telefono.value = p.telefono;
    correo.value = p.correo;
    direccion.value = p.direccion;
}

function eliminar(id){
    if(confirm("¿Eliminar proveedor?")){
        fetch(API + "/" + id, {method:"DELETE"})
            .then(() => cargarProveedores());
    }
}

function limpiar(){
    formProveedor.reset();
}
</script>

</body>
</html>