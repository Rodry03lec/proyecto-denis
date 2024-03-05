@extends('principal')
@section('titulo', '| ROLES')
@section('contenido')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">ROLES</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalScrollable">
                <i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Nuevo Rol</span>
            </button>
        </div>
    </div>

    <!-- Role cards -->
    <div class="row g-4 py-4">
        @foreach ($listar_roles as $lis)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="d-flex justify-content-between">
                            <h6 class="fw-normal mb-2">Total 4 users</h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Allen Rieske" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Julee Rossignol" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="../../assets/img/avatars/3.png" alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="John Doe" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="../../assets/img/avatars/1.png" alt="Avatar">
                                </li>
                            </ul>
                        </div> --}}
                        <div class="d-flex justify-content-between align-items-end mt-1">
                            <div class="role-heading">
                                <h4 class="mb-1">{{ $lis->name }}</h4>
                                <div class="d-inline-block tex-nowrap">
                                    <button class="btn btn-sm btn-icon" type="button">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon" onclick="eliminar_rol('{{ $lis->id }}')" type="button">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-icon" type="button">
                                <i class="ti ti-eye ti-md"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!--/ Role cards -->



    <div class="modal fade" id="modalScrollable" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Rol</h5>
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add role form -->
                    <form id="formulario_nuevo_rol" class="row g-3">
                        <div class="col-12 mb-4">
                            <label class="form-label" for="nombre_rol">Rol</label>
                            <input type="text" id="nombre_rol" name="nombre_rol" class="form-control"
                                placeholder="Ingrese el nombre del rol" tabindex="-1" />
                            <div id="_nombre_rol" ></div>
                        </div>
                        <div class="col-12">
                            <h5>Permisos</h5>
                            <!-- Permission table -->
                            <div class="table-responsive">
                                <table class="table table-flush-spacing">
                                    <tbody>
                                        
                                        @if ($permisos->isEmpty())
                                            <hr>
                                            No hay ningun permiso registrado
                                        @else
                                            <tr>
                                                <td class="text-nowrap fw-medium">Seleccionar todos<i class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Seleccionar todos los permisos disponibles solo para superadministrador"></i></td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="marcar_des"  onchange="marcar_desmarcar(this);" />
                                                    </div>
                                                </td>
                                            </tr>
                                            @foreach ($permisos as $key => $value)
                                                <tr>
                                                    <td class="text-nowrap fw-medium">{{ $value->name }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="form-check me-3 me-lg-5">
                                                                <input class="form-check-input" type="checkbox" name="permisos[]" id="{{ $value->id }}" value="{{ $value->name }}"/>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- Permission table -->
                        </div>
                    </form>
                    <!--/ Add role form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn_guardar_nuevo_rol">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let form_rol_nuevo = document.getElementById('formulario_nuevo_rol');
        let boton_rol_guardar = document.getElementById('btn_guardar_nuevo_rol');

        //para marcar o desmarcar nuevos permisos
        function marcar_desmarcar(source){
            let checkboxes = form_rol_nuevo.getElementsByTagName('input'); 
            for(i=0;i<checkboxes.length;i++){ 
                if(checkboxes[i].type == "checkbox"){
                    checkboxes[i].checked=source.checked; 
                }
            }
        }

        //para guardar el rol con los permisos
        boton_rol_guardar.addEventListener('click', async ()=>{
            let nombre_rol = document.getElementById('nombre_rol').value;
            let permisos = [];
            let chexbox = document.querySelectorAll('input[name="permisos[]"]:checked'); 
            chexbox.forEach(function (checkbox) {
                permisos.push(checkbox.value);
            });
            validar_boton(true, 'Guardando', 'btn_guardar_nuevo_rol');
            try {
                let respuesta = await fetch("{{ route('rol_guardar') }}",{
                    method:'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        nombre_rol : nombre_rol,
                        permisos : permisos
                    })
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                    validar_boton(false, 'Guardar', 'btn_guardar_nuevo_rol');
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    setTimeout(() => {
                        location.reload();
                    }, 1600);
                    
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                    validar_boton(false, 'Guardar', 'btn_guardar_nuevo_rol');
                }
            } catch (error) {
                console.log('Ocurrio un error :'+ error);
            }
        });


        //para eliminar el rol
        function eliminar_rol(id){

            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminarlo",
                cancelButtonText: "Cancelar",
                customClass: {
                    confirmButton: "btn btn-primary me-3 waves-effect waves-light",
                    cancelButton: "btn btn-label-secondary waves-effect waves-light"
                },
                buttonsStyling: false
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        let respuesta = await fetch("{{ route('rol_eliminar') }}",{
                            method: "DELETE",
                            headers:{
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({id:id})
                        });
                        let dato = await respuesta.json();
                        if(dato.tipo === 'success'){
                            alerta_top(dato.tipo, dato.mensaje);
                            setTimeout(() => {
                                location.reload();
                            }, 1600);
                        }
                        if(dato.tipo === 'error'){
                            alerta_top(dato.tipo, dato.mensaje);
                        }
                    } catch (error) {
                        console.log('Error de datos : '+error);
                    }
                }else{
                    alerta_top('error', 'Se cancelo');
                }
            });
        }

    </script>
@endsection
