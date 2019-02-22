<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConversiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('conversiones', function (Blueprint $table) {
            $table->increments('id');
             $table->string('codigo',10);
            $table->string('codumbase',5);
             $table->string('codumotro',5);
             $table->integer('cantbase');
               $table->integer('cantotra');
             $table->double('factor',10,3)->nullable();
           $table->index(['codigo']);  
           $table->index(['codumbase']);
           $table->index(['codumotro']); 
               $table->foreign('codigo')->references('codigo')->on('items');
               $table->foreign('codumbase')->references('codum')->on('ums');
               $table->foreign('codumotro')->references('codum')->on('ums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('conversiones');
    }
}
