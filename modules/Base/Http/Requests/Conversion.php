<?php

namespace Modules\Base\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//use Modules\Base\Models\Item;
class Conversion extends FormRequest
{
   
    public $methods=['POST','PATCH'];
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (in_array($this->getMethod(), $this->methods)) {
            /*$codum = $this->customer->getAttribute('codum');
            if(is_null(Item::find()));*/
            //dd(old('codum'));
            
            
        } 
        
        $reglas= [
           // 'codum' =>  'required|unique:ums|max:5|string',
           // 'unidad' => 'min:4|required|string',
            //'dimension' => 'max:1|min:1|required|string|alpha',
            ];
        
       return $reglas;
    }
}
