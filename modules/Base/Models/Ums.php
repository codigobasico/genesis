<?php

namespace Modules\Base\Models;
//use Modules\Base\Models\ModelBase;
//use App\Scopes\Company;

class Ums extends ModelBase
{
   protected $table = 'ums';
   protected $fillable=['codum','unidad','dimension'];
   protected $primaryKey = 'codum';
   public $incrementing = false;
   public $timestamps = false;
   protected $dates = ['deleted_at'];
   
   /* protected static function boot()
    {
         parent::boot();
    }*/
   //override porque estos valores no dependen de lninguna compania
  public function scopeCompanyId($query, $company_id)
    {
        
      return $query;
    }
   
    
  public static function adimensiones(){
     return ['L'=>'Longitud','M'=>'Masa','T'=>'Tiempo','E'=>'Escalar'];
  }
  
  public function items()
{
    return $this->hasMany('App\Models\Common\Item', 'codum', 'codum');
}
  
}
