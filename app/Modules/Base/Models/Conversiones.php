<?php

namespace App\Modules\Base\Models;

use Illuminate\Database\Eloquent\Model;

class Conversiones extends ModelBase
{
    protected $table = 'conversiones';
   protected $fillable=['codumbase','codigo','codumotro','cantbase','cantotro'];
   //protected $primaryKey = 'codum';
  // public $incrementing = false;
   public $timestamps = false;
   //protected $dates = ['deleted_at'];
   
   
   //overrido no depeden de la comañia 
    public function scopeCompanyId($query, $company_id)
    {
        
      return $query;
    }
}
