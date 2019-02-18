<?php

namespace Modules\Base\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'auditoria';
  // protected $fillable=['codum','unidad','dimension'];
   //protected $primaryKey = 'codum';
  /// public $incrementing = false;
   public $timestamps = false;
    protected $guarded=['id'];
}
