<?php
namespace Modules\Base\Http\Controllers;
use App\Http\Controllers\Controller;
class ControllerBase extends Controller
{
   /*
    * request  : Objeto Request App\Http\Requests\Request 
    * rules    :  Matriz de objetos Rules 
    */
    public function validateWithRule($request,$field,$rule){
       
        $request->validate($request, [$field => $rule]);
      return true;
        
    }
}