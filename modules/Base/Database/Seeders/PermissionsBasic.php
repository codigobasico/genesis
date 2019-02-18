<?php

namespace Modules\Base\Database\Seeders;

use App\Models\Model;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Database\Seeder;

class PermissionsBasic extends Seeder
{
   
   protected $prefijo; // El prefijo de los permisos pej : 'common' es el prefijo de  'create-common-unidades'
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        Model::unguard();

        $this->createBasic();

        Model::reguard();
    }

    private function controllers()
    {
        return [
              'base-unidades'
             ];
    } 
    
    
    private function permisosBasicos()
    {
        return ['create','update','read','delete'];
    }
    
    
    private function createBasic(){
        $role=Role::find(1);
       foreach($this->controllers() as $key=>$controller) {
          foreach($this->permisosBasicos() as $keyp=>$permiso) {
             $permission = Permission::firstOrCreate([
                        'name' => $permiso . '-' . $controller,
                        'display_name' => ucfirst($permiso) . ' ' .$controller,
                        'description' => ucfirst($permiso) .' '.$controller,
                    ]);
                            if (!$role->hasPermission($permission->name)) {
                                     $role->attachPermission($permission);
                            } else {
                                $this->command->info( $permission->name .': already exist');
                            }
           
          } 
           
       }
       
       //ATACCH to roles 
       
    }
    
    
    
    
    
    
  

}
