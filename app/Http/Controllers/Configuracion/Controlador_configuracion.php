<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\Tipologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Controlador_configuracion extends Controller
{
    public function tipologia(){
        $data['menu'] = 4;
        $data['listar_tipologia'] = Tipologia::get();
        return view('administrador.configuracion.tipologia', $data);
    }

    //para guardar
    public function tipologia_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre'        => 'required',
            'descripcion'   => 'required'
        ]);
        if($validar->fails()){
            $data = array(
                'tipo'=>'errores',
                'mensaje'=>$validar->errors()
            );
        }else{
            $tipologia_save = new Tipologia();
            $tipologia_save->nombre = $request->nombre;
            $tipologia_save->descripcion = $request->descripcion;
            $tipologia_save->save();
            if($tipologia_save->id){
                $data = array(
                    'tipo'=>'success',
                    'mensaje'=>'Se inserto con exito'
                );
            }else{
                $data = array(
                    'tipo'=>'error',
                    'mensaje'=>'Ocurrio un error'
                );
            }
        }
        return response()->json($data);
    }
}
