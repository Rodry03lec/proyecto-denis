<?php

namespace Database\Seeders;

use App\Models\Configuracion\Tipologia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Seeder_tipologia extends Seeder
{
    /**
     * Run the database seeds.
     */
    

    public function run(): void{
        $tipologia = array(
            [
                'nombre'=>'nombre1',
                'descripcion'=>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas cumque obcaecati adipisci ad, omnis quod assumenda sunt, perspiciatis ipsam et commodi dolor dolores, accusamus exercitationem veritatis nulla fugit dolorem nemo!',
            ],

            [
                'nombre'=>'nombre2',
                'descripcion'=>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptas cumque obcaecati adipisci ad, omnis quod assumenda sunt, perspiciatis ipsam et commodi dolor dolores, accusamus exercitationem veritatis nulla fugit dolorem nemo!',
            ],
        );

        for ($i=1; $i < 10 ; $i++) { 
            foreach ($tipologia as $lis) {
                $new_tipologia = new Tipologia();
                $new_tipologia->nombre = $lis['nombre'];
                $new_tipologia->descripcion =  $lis['descripcion'];
                $new_tipologia->save();
            }
        }
        
    }
}
