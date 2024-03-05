    <script src="{{ asset('admin_template/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_template/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_template/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_template/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('admin_template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_template/vendor/libs/hammer/hammer.js') }}"></script>
    {{-- <script src="{{ asset('admin_template/vendor/libs/i18n/i18n.js') }}"></script> --}}
    <script src="{{ asset('admin_template/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('admin_template/vendor/js/menu.js') }}"></script>
    
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('admin_template/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('admin_template/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('admin_template/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin_template/js/main.js') }}"></script>
    

    <!-- Page JS -->
    <script src="{{ asset('admin_template/js/dashboards-analytics.js') }}"></script>


    <!-- Vendors JS -->
    <script src="{{ asset('admin_template/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('admin_template/js/extended-ui-sweetalert2.js') }}"></script>

    <script src="{{ asset('rodry/js/swetalert2.js') }}"></script>

    <script>
        window.addEventListener('load', function() {
            setTimeout(() => {
                var loader = document.getElementById('loading-wrapper');
                loader.style.display = 'none';
            }, 500);
        });


        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');



        //para cerrar la session
        let btn_cerrar_session = document.getElementById("btn-cerrar-session");
        btn_cerrar_session.addEventListener("click", async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('formulario_salir')).entries());
            try {
                let respuesta = await fetch("{{ route('salir') }}",{
                    method:"POST",
                    headers:{
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                alerta_top(dato.tipo, dato.mensaje);
                setTimeout(() => {
                    window.location = '';
                }, 1500);

            } catch (error) {
                console.log('Ocurrio un error: '+error);
            }
        });


        //MIXIN alerta
        function alerta_top(tipo, mensaje){
            let toast = window.Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                padding: '25px',
            });
            toast.fire({
                icon: tipo,
                title: mensaje,
                padding: '25px',
            });
        }
        //alerta top-end
        function alerta_top_end(tipo, mensaje){
            Swal.fire({
                position: "top-end",
                icon: tipo,
                title: mensaje,
                showConfirmButton: false,
                timer: 2000
            });
        }

        function validar_boton(valor, msj, boton) {
            // Obtener el elemento del botón
            let boton_env = document.getElementById(boton);

            // Eliminar cualquier contenido existente en el botón
            boton_env.innerHTML = '';

            if (valor === true) {
                // Crear un nuevo spinner
                let nuevo_icono = document.createElement('span');
                nuevo_icono.className = "spinner-border";

                // Crear un contenedor div para el spinner y el mensaje
                let contenedor = document.createElement("div");
                contenedor.appendChild(nuevo_icono);

                // Agregar un espacio en blanco al contenedor
                contenedor.appendChild(document.createTextNode("\u00A0")); // Espacio en blanco

                // Agregar el mensaje al contenedor
                contenedor.appendChild(document.createTextNode(msj));

                // Agregar el contenedor al botón
                boton_env.appendChild(contenedor);

                // Deshabilitar el botón
                boton_env.disabled = true;
            }

            if (valor === false) {
                // Si el valor es falso, mostrar el mensaje en el botón
                boton_env.innerHTML = msj;

                // Habilitar el botón
                boton_env.disabled = false;
            }
        }





        //para vaciar los errores
        function vaciar_errores(array){
            let nuevo_array = array;
            nuevo_array.forEach(element => {
                document.getElementById(element).innerHTML = '';
            });
        }
        //para vaciar los input, textrarea y select
        function vaciar_formulario(formulario){
            Array.from(formulario.elements).forEach(elemento => {
                // Verifica si es un campo de formulario (input, textarea, select)
                if (['input', 'textarea', 'select'].includes(elemento.tagName.toLowerCase())) {
                    // Limpia el valor del campo
                    elemento.value = '';
                }
            });
        }





        //para desabilitar el enter
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
                if(e.keyCode == 13) {
                    e.preventDefault();
                }
            }))
        });


        // Obtén todos los elementos con la clase "monto_number"
        let elementos11 = document.querySelectorAll(".monto_number");

        // Agrega eventos "focus" y "keyup" a cada elemento
        elementos11.forEach(function(elemento) {
            elemento.addEventListener("focus", function(event) {
                event.target.select();
            });

            elemento.addEventListener("keyup", function(event) {
                event.target.value = event.target.value
                    .replace(/\D/g, "")
                    .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            });
        });


    //para que solo acepte letras  <input type="text" onkeypress="return soloLetras(event)">
    function soloLetras(e){
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = "8-37-39-46";
        tecla_especial = false
        for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }
        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    //para que solo acepte numeros <input type="text" onkeypress="return soloNumeros(event)">
    function soloNumeros(e){
        let key = window.Event ? e.which : e.keyCode
        return ((key >= 48 && key <= 57) || (key==8))
    }
    //para que solo acepte numeros float <input type="text" onkeypress="return filterFloat(event, this)">
    function filterFloat(evt,input){
        // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
        var key = window.Event ? evt.which : evt.keyCode;
        var chark = String.fromCharCode(key);
        var tempValue = input.value+chark;
            if(key >= 48 && key <= 57){
                if(filter(tempValue)=== false){
                    return false;
                }else{
                    return true;
                }
            }else{
                if(key == 8 || key == 13 || key == 0) {
                    return true;
                }else if(key == 46){
                        if(filter(tempValue)=== false){
                            return false;
                        }else{
                            return true;
                        }
                }else{
                    return false;
                }
            }
        }
    function filter(__val__){
        var preg = /^([0-9]+\.?[0-9]{0,2})$/;
        if(preg.test(__val__) === true){
            return true;
        }else{
        return false;
        }

    }


    //para el separador de comas
    function conSeparadorComas(monto) {
        let saldoRespuesta = new Intl.NumberFormat('es-BO', { style: 'currency', currency: 'BOB' }).format(monto);
        return saldoRespuesta;
    }

    // Obtener todos los inputs con la clase 'uppercase-input'
    let inputs = document.querySelectorAll('.uppercase-input');

    // Iterar sobre los inputs y agregar evento de escucha
    inputs.forEach(function(input) {
        input.addEventListener('input', function(event) {
            // Convertir el texto a mayúsculas
            this.value = this.value.toUpperCase();
        });
    });

    </script>