<?php
namespace Modules\Base\Http\Controllers;
use Modules\Base\Models\Ums;
//use Illuminate\Routing\Controller as ControllerBase; 
use Modules\Base\Http\Controllers\ControllerBase;
use Modules\Base\Http\Requests\Ums as Request;
//use App\Rules\Um as RuleUm;
class Unidades extends ControllerBase
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    
    
    
    
    public function index()
    {
        
        $unidades = Ums::collect();
       // dd($unidades);
       // $categories = Category::enabled()->orderBy('name')->type('item')->pluck('name', 'id');
        $dimensiones=Ums::adimensiones();
        //var_dump(New Auth);die();
       //$user = Auth::user();
     //  dd($user);
        return view('base::unidades.index', compact('unidades','dimensiones'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        return view('base::unidades.create');
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request->input());
        
        
        $item = Ums::create($request->input());

       

        $message = trans('messages.success.added', ['type' => trans_choice('general.units', 1)]);

        flash($message)->success();

        return redirect()->route('unidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Common\Ums  $ums
     * @return \Illuminate\Http\Response
     */
    public function show(Ums $ums)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Common\Ums  $ums
     * @return \Illuminate\Http\Response
     */
    public function edit(Ums $ums,$id)
    {
    
        $ums=Ums::find($id);
        
        return view('base::unidades.edit', compact('ums'));
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Common\Ums  $ums
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ums $um,$id)
    {
        $um=Ums::find($id);
       // $this->validate($request, ['year' => new OlympicYear]);
        //$this->validate($request, ['codum' => new RuleUm($um)]);        
       
       /* $this->validateWithRule($request,
                'codum',
                new RuleUm($um));*/
        
        $um->update($request->input());
        
        
       

        $message = trans('messages.success.updated', ['type' => trans_choice('general.units', 1)]);

        flash($message)->success();

        return redirect()->route('unidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Common\Ums  $ums
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ums $ums)
    {
        //
    }
    
    public function import()
    {
        //
    }
    
    public function export()
    {
        //
    }
}
