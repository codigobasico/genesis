<?php

namespace Modules\Base\Models;

use Illuminate\Database\Eloquent\Model;

class Conversion extends \Modules\Base\Models\ModelBase
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

