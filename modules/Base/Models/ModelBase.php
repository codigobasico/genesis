<?php

namespace Modules\Base\Models;
use Request;
use Route;
use Modules\Base\Observers\ModelBase as ObservadorBase; 
use App\Models\Model;
use Modules\Base\Scopes\CompanyNewScope;


class ModelBase extends Model
{
    public $logable=true; //Si es auditable;

    
    /*
     * Registra el manejador de eventos para 
     * cualquier instancia de clase hija invoca
     * a la clase ObservadorBase como manejador de eventos      * 
     */
    protected static function boot()
    {
        
        
        
        
        //no activar porque si no se activa el scope global Company
        //En su lugar usar el scope local 
       // parent::boot(); 
        
        
        //Este es el nuevo scope a usar 
        static::addGlobalScope(new CompanyNewScope);
        
        //Con la funcion estatica static:: me aseguro de que 
        //las clases hijas invocaran a la misma clase  : ObservadorBase
        static::observe(ObservadorBase::class );
    }

    
    
   public function isAuditable(){
       return ($this->logable && $this->isDirty())?true:false;
   }
   
   public function correlativo($campo=null,$longitud=null,$prefijo=null,$camporef=null){
      $calculado=null;
       if(is_null($campo))
          $campo=$this->getKeyName ();
       //dd($this->{$camporef});
       //dd(!($campo=='id'));
      if(!($campo=='id')){
          //dd($this->{$camporef});
           if(is_null($longitud))
            $longitud=config('items.lenghtCode');
         if(!is_null($prefijo)){
             $prefijo=trim($prefijo.''); $longitud=strlen($longitud)-strlen($prefijo);
           }else{
               $prefijo='';
           }
        
        if(!is_null($camporef) ){
            $calculado=static::query()->where($camporef,$this->{$camporef})->max($campo) ;
        } else{
            $calculado=static::query()->max($campo) ;
        }
        $calculado=(string)((integer)$calculado+1);
       $calculado=(is_null($calculado))?'1':$calculado.'';
       return $prefijo.str_pad($calculado, $longitud, '0', STR_PAD_LEFT);
   }
   
   }
  
   
   
   /*
    * Esta funcion sobreescribe la funcion 
    * y habilita los filter para modulos Cosa que 
    * no lo hacia en la clase padre;  arrojaba error 
    * porque la cadena de la clase  Comenzaba con '\App\\' .  y no con '\Modules\\' . 
    */
   public function modelFilter()
    {
      
        
// Check if is api or web
        if (Request::is('api/*')) {
            $arr = array_reverse(explode('\\', explode('@', app()['api.router']->currentRouteAction())[0]));
            $folder = $arr[1];
            $file = $arr[0];
        } else {
            list($folder, $file) = explode('/', Route::current()->uri());
        }
  
        if (empty($folder) || empty($file)) {
            return $this->provideFilter();
        }

        $class = '\Modules\\' . ucfirst($folder) . '\Filters\\' . ucfirst($file);
    
        return $this->provideFilter($class);
    }
   
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    
}
