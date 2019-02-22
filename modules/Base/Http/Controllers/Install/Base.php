<?php

namespace Modules\Http\Controllers\Install;

use Artisan;
use App\Http\Requests\Install\Database as Request;
use App\Utilities\Installer;
use Illuminate\Routing\Controller;

class Base extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
         set_time_limit(300); // 5 minutes

        // Create tables
        Artisan::call('migrate', ['--path' => 'Database\Seeds\Roles','--force' => true]);

        // Create Roles
        Artisan::call('db:seed', ['--class' => 'Modules\Base\Database\Seeders\BaseDatabaseSeeder', '--force' => true]);

       
        return true;
        
        //return view('install.database.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
    }
    
}
