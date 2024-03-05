<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario\Controlador_login;
use App\Http\Controllers\Usuario\Controlador_usuario;

//AQUI PARA LOS NO AUTENTICADOS DE LOS USUSARIOS
Route::prefix('/')->middleware(['no_autenticados'])->group(function(){
    Route::get('/', function(){
        return view('login');
    })->name('login');
    Route::get('/login', function(){
        return view('login');
    })->name('login');

    Route::controller(Controlador_login::class)->group(function(){
        Route::post('ingresar', 'ingresar')->name('cl_ingresar');
    });
});

Route::prefix('/admin')->middleware(['autenticados'])->group(function(){
    Route::controller(Controlador_login::class)->group(function (){
        Route::get('inicio', 'inicio')->name('inicio');
        Route::post('mensaje', 'mensaje')->name('in_mensaje');
        Route::post('salir','cerrar_session')->name('salir');
    });

    Route::controller(Controlador_usuario::class)->group(function(){
        /**
         * ADMINISTRACION DEL PERFIL
         */
        Route::get('perfil','perfil')->name('perfil');
        Route::post('guardar_password', 'guardar_password')->name('pe_guardar');
        /**
         * FIN DE ADMINISTRACION DE PERFIL
         */

        /**
         * ADMINISTRAR ROLES
         */
        Route::get('roles', 'roles')->name('roles');
        Route::post('roles_guardar','roles_guardar')->name('rol_guardar');
        Route::post('roles_editar','roles_editar')->name('rol_editar');
        Route::post('roles_editar_guardar','roles_editar_guardar')->name('rol_editar_g');
        Route::delete('roles_eliminar','roles_eliminar')->name('rol_eliminar');
        /**
         * FIN DE ADMINISTRAR LOS ROLES
         */

        /**
         * ADMINISTRAR PERMISOS
         */
        Route::get('permisos', 'permisos')->name('permisos');
        Route::post('guardar_permiso','guardar_permiso')->name('per_guardar');
        Route::get('permiso_listar','permiso_listar')->name('per_listar');
        Route::post('permiso_editar','permiso_editar')->name('per_editar');
        Route::post('permiso_editar_guardar','permiso_editar_guardar')->name('pergu_editar');
        Route::delete('permiso_eliminar','permiso_eliminar')->name('per_eliminar');
        /**
         * FIN DE ADMINISTRAR LOS PERMISOS
         */

    });
});