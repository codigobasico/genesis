<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
          Schema::create('ums', function (Blueprint $table) {
           // $table->increments('id');
            $table->string('codum',5)->primary();
            //$table->string('codigo',8)->primary();
            $table->string('unidad');
            $table->char('dimension',1)->nullable();            
           $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
           //Schema::dropIfExists('items');
        DB::table('items')->truncate();
           Schema::dropIfExists('ums');
           
    }
}
