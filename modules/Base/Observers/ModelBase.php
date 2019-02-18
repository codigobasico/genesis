<?php

namespace Modules\Base\Observers;
use Modules\Base\Models\ModelBase as Model;
use Modules\Base\Models\Auditoria;
use Artisan;
use Auth;
Use Request;
Use Route;
class ModelBase
{
  const __INSERTAR='insert'; 
  const __ACTUALIZAR='update'; 
  const __BORRAR='delete'; 
    
  

  
  //invocando al evento  creating : beforesave() en Yii
public function creating(Model $model)
    {
        

    }




  /**
     * Listen to the created event.
     *
     * @param  Model  $company
     * @return void
     */
    public function created(Model $model)
    {
        $arreglo=static::getCommonsFields($model);   
       $arreglo['operacion']=self::__INSERTAR;
        if($model->isAuditable()){ 
            //dd($model->getDirty());
         foreach($model->getDirty() as $campo=>$valor){
            $arreglomayor= array_merge($arreglo,
                     [
                        'campo'=>$campo,
                         'oldvalue'=>'',
                         'newvalue'=>$valor,
                     ]
                     );
                        // dd($arreglomayor);
           Auditoria::create($arreglomayor);
             
         }
            
       }else{
          
       }

    }
    
    
    public function updated(Model $model)
    {
        
       $arreglo=static::getCommonsFields($model);   
       $arreglo['operacion']=self::__ACTUALIZAR;
        if($model->isAuditable()){            
         foreach($model->getDirty() as $campo=>$valor){
            $arreglomayor= array_merge($arreglo,
                     [
                        'campo'=>$campo,
                         'oldvalue'=>substr($model->getOriginal()[$campo],0,100),
                         'newvalue'=>substr($valor,0,100),
                     ]
                     );
                        // dd($arreglomayor);
           Auditoria::create($arreglomayor);
             
         }
            
       }else{
          
       }
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

    /**
     * Delete items in batch.
     *
     * @param  Model  $company
     * @param  $table
     * @return void
     */
    protected function deleteItems($company, $table)
    {
        foreach ($company->$table as $item) {
            $item->delete();
        }
    }
    
    private static  function getCommonsFields(Model $model){
       
        return [
           'creationdate'=>date('Y-m-d H:i:s'),
            'username'=>Auth::user()->name,  
            'userid'=>Auth::user()->id,  
            'modelo'=>get_class($model),
             'metodo'=> request()->method(),
              'clave'=> $model->getKey(),
               //'idmodelo'=> $model->getKey(),
                'campoclave'=> $model->getKeyName(),
                'noperacion'=> round(microtime(true) * 1000).'',
            'controlador'=>request()->route()->getAction()['controller'],
             'operacion'=>'',
              
        ];
    }
    
}