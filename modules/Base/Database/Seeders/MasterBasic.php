<?php

namespace Modules\Base\Database\Seeders;

use App\Models\Model;
//use App\Models\Auth\Permission;
use Modules\Base\Models\Ums;
use Illuminate\Database\Seeder;

class MasterBasic extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->createBasic();

        Model::reguard();
    }

    private function datosBase()
    {
        return [
            'ums'=>[ ['UND','UNIDAD','E'],
                 ['KG','KILOGRAMO','M'],
                  ['GR','GRAMO','M'],
                  ['LB','LIBRA','M'],
                 ['GL','GALON AMERICANO','V'],
                    ['LT','LITRO','V'],
                  ['CIL','CILINDRO','V'],
                ['CAJ','CAJA','E'],
            ['PAR','PAR','E'],
            ['JGO','JUEGO','E'],
             ['M','METRO','L'],
            ['CM','CENTIMETRO','L'],
            ['MM','MILIMETRO','L'],
            ['PULG','PULGADA','L'],
            ['PIE','PIE','L']            
             ],
            
          
            
            ];
    } 
    
    private function camposUms(){
        return [
            'ums'=>['codum','unidad','dimension'],
        ];
    }
    
    private function buildUms(){
        $campos=[];
        foreach($this->datosBase()['ums'] as $clave=>$lista){
               $campos[]=array_combine($this->camposUms()['ums'], $lista);
        }
        return $campos;
    }
    
    
    
    private function createBasic(){
        //$role=Role::find(1);
        foreach($this->buildUms() as $clave=>$valores){            
            Ums::firstOrCreate($valores);
            $this->command->info('Creando unidades de medida '.$valores['codum'].'=> '. $valores['unidad']);

        }
    }
    
    
    
    
    
    
  

}
