<?php
namespace Modules\Base\Models;
//use Module\Base\Models\ModelBase;
use App\Models\Setting\Category as Categoria;


class Category extends Categoria
{
   

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['prefijo','company_id', 'name', 'type', 'color', 'enabled'];

    
}
