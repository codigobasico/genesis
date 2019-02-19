<?php

namespace Modules\Base\Observers;
use Modules\Base\Models\Item as Model;
//use Modules\Base\Models\Auditoria;
use Artisan;
use Auth;
Use Request;
Use Route;
class Item
{
  const __INSERTAR='insert'; 
  const __ACTUALIZAR='update'; 
  const __BORRAR='delete'; 
    
  

  
  //invocando al evento  creating : beforesave() en Yii
public function creating(Model $model)
    {
        $prefijo= \Modules\Base\Models\Category::find($model->category_id)->prefijo;
        $model->codigo=$model->correlativo($campo='codigo',
                null,
                $prefijo
                );

    }




  /**
     * Listen to the created event.
     *
     * @param  Model  $company
     * @return void
     */
    public function created(Model $model)
    {
       
        
       
    }
    
    
    public function updated(Model $model)
    {
        
       
    }

    /**
     * Listen to the deleted event.
     *
     * @param  Model  $company
     * @return void
     */
    public function deleted(Model $model)
    {
     
    }

    
   
    
    
}