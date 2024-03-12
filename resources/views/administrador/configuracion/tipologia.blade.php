@extends('principal')
@section('titulo', '| TIPOLOGIA')

@section('estilos')
    <style>
        
    </style>
@endsection

@section('contenido')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">TIPOLIGIA</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_nuevo_tipologia">
                <i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Nuevo</span>
            </button>
        </div>
        <div class="table-responsive text-nowrap p-4" >
            <table class="table" id="table_permiso" style="width: 100%">
                <thead class="table-dark">
                    <tr>
                        <th>Nº</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCIÓN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($listar_tipologia as $lis)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lis->nombre }}</td>
                            <td>{{ $lis->descripcion }}</td>
                            <td>
                                <div class="d-inline-block tex-nowrap">
                                    <button class="btn btn-sm btn-icon" onclick="editar_tipologia('{{ $lis->id }}')" type="button">
                                    <i class="ti ti-edit" ></i>
                                    </button>
                                    <button class="btn btn-sm btn-icon" onclick="eliminar_tipologia('{{ $lis->id }}')" type="button">
                                    <i class="ti ti-trash" ></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <!-- Add tipologia Modal -->
    <div class="modal fade" id="modal_nuevo_tipologia" aria-hidden="true" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Nuevo Tipologia</h3>
                    </div>
                    <form id="formulario_tipologia" class="row" method="POST" autocomplete="off">
                        @csrf
                        <div class="col-12 mb-3">
                            <label class="form-label" for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control"
                                placeholder="Ingrese el permiso" autofocus />
                            <div id="_nombre" ></div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="descripcion">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="5" class="form-control"></textarea>
                            <div id="_descripcion" ></div>
                        </div>
                    </form>
                    <div class="col-12 text-center demo-vertical-spacing">
                        <button id="btn_guardar_nuevo_tiologia" class="btn btn-primary me-sm-3 me-1">Guardar</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close" >Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Add tipologia Modal -->

@endsection

@section('scripts')
    <script>
        let btn_guardar_nuevo_tiologia = document.getElementById('btn_guardar_nuevo_tiologia');
        let form_tipologia = document.getElementById('formulario_tipologia');
        btn_guardar_nuevo_tiologia.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(form_tipologia).entries());
            vaciar_errores();
            try {
                let respuesta = await fetch('{{ route("tip_guardar") }}', {
                    method: "POST",
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json(); 

                if(dato.tipo==='errores'){
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p class="text-sm text-danger" >` + obj[key] +`</p>`;
                    }
                }
                if(dato.tipo==='success'){
                    alerta_top(dato.tipo, dato.mensaje);
                    setTimeout(() => {
                        window.location = '';
                    }, 1500);
                }
                if(dato.tipo==='error'){
                    alerta_top(dato.tipo, dato.mensaje);
                }

            } catch (error) {
                console.log(error);
            }
        });

        function vaciar_errores(){
            let array = ['_nombre', '_descripcion'];
            array.forEach(element => {
                document.getElementById(element).innerHTML = '';
            });
        }
    </script>
@endsection