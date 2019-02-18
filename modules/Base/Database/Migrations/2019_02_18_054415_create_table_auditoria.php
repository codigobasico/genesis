<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



class CreateTableAuditoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria', function (Blueprint $table) {
            $table->increments('id');
             $table->string('descripcion',45)->nullable();
            $table->string('accion',45)->nullable();
            $table->string('controlador',120)->nullable();
            $table->string('metodo',5)->nullable();
             $table->string('clave',30)->nullable();
             $table->string('campoclave',30)->nullable();
               $table->string('modelo',95);
               $table->string('noperacion',20);
                $table->bigInteger('idmodelo')->nullable();
                 $table->string('campo',45);
                 $table->string('aliascampo',45)->nullable();
                 $table->string('creationdate',20);
                  $table->string('oldvalue',100)->nullable();   
                 $table->string('newvalue',100)->nullable();
                 $table->integer('userid');
                 $table->string('username',35);
                  $table->string('operacion',6);
            //$table->string('codigo',8)->primary();
           $table->index(['clave']);    
            $table->index(['modelo']); 
             $table->index(['campoclave']);  
              
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('auditoria');
    }
}

