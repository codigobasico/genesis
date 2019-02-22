<?php

namespace Modules\Base\Scopes;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\Company;

class CompanyNewScope extends Company
{
    
    public function apply(Builder $builder, Model $model)
    {
       
        
        $table = $model->getTable();

        /*
         * AQUI LA DIFERENCIA
         * 
         */
        $skip_tables = [ 'conversiones', 'ums','companies', 'jobs', 'migrations', 'notifications', 'permissions', 'role_user', 'roles', 'sessions', 'users'];
        /*
         * FIN DE LA DIFERENCIA
         * 
         */
        
        
        if (in_array($table, $skip_tables)) {
            return;
        }

        // Skip if already exists
        if ($this->exists($builder, 'company_id')) {
            return;
        }

        // Apply company scope
        $builder->where($table . '.company_id', '=', session('company_id'));
    }
    

    
    
   
}