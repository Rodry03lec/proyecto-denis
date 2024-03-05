<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Seeder_usuario extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        $usuario = new User();
        $usuario->usuario = 'admin';
        $usuario->password = Hash::make('rodry');
        $usuario->ci = '10028685';
        $usuario->nombres = 'Rodrigo';
        $usuario->apellidos = 'Lecoña Quispe';
        $usuario->estado =  'activo';
        $usuario->id_persona = '0';
        $usuario->save();

        for ($i=1; $i <= 1000; $i++) { 
            $permiso = new Permission();
            $permiso->name = $i.'permiso'.$i;
            $permiso->save();
        }
    }

    
}
