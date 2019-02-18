<?php

namespace Modules\Base\Http\Controllers\Modals;

use Modules\Base\Http\Controllers\ControllerBase as Controller;
use Modules\Base\Http\Requests\Ums as Request;
use Illuminate\Http\Request as CRequest;
use Modules\Base\Models\Ums;

class Unidades extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        // Add CRUD permission check
       /* $this->middleware('permission:create-settings-categories')->only(['create', 'store', 'duplicate', 'import']);
        $this->middleware('permission:read-settings-categories')->only(['index', 'show', 'edit', 'export']);
        $this->middleware('permission:update-settings-categories')->only(['update', 'enable', 'disable']);
        $this->middleware('permission:delete-settings-categories')->only('destroy');
    */
        }
        

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(CRequest $request)
    {
       
        //dd("holis");
        $type = $request['type'];
        
        $html = view('base::modals.unidades.create', compact( 'type'))->render();

        return response()->json([
            'success' => true,
            'error' => false,
            'message' => 'null',
            'html' => $html,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        

        $category = Ums::create($request->all());

        $message = trans('messages.success.added', ['type' => trans_choice('general.categories', 1)]);

        return response()->json([
            'success' => true,
            'error' => false,
            'data' => $category,
            'message' => $message,
            'html' => 'null',
        ]);
    }
}
