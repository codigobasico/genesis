<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableItems extends Migration
{
    public function up()
    {
       
         
         Schema::table('items', function ($table) {
            if(!Schema::hasColumn('items','codum'))
            $table->string('codum',5)->nullable();
             if(!Schema::hasColumn('items','codigo'))
            $table->string('codigo',10)->unique();
             if(!Schema::hasColumn('items','nparte'))
            $table->string('nparte',15)->nullable();
             if(!Schema::hasColumn('items','marca'))
            $table->string('marca',30)->nullable();
             if(!Schema::hasColumn('items','modelo'))
            $table->string('modelo',30)->nullable();
             if(!Schema::hasColumn('items','clasificacion'))
            $table->string('clasificacion',30)->nullable();
             if(!Schema::hasColumn('items','esrotativo'))
            $table->boolean('esrotativo');
             if(!Schema::hasColumn('items','codean'))
            $table->string('codean',30)->nullable();
             if(!Schema::hasColumn('items','pesoneto'))
            $table->string('pesoneto',8)->nullable();
             $table->foreign('codum')->references('codum')->on('ums');
        });
       // DB::table('items')->update(['codigo'=>substr(strrev(uniqid()),0,10)]);
         
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function ($table) {
            $table->dropColumn([
                'codum','codigo','nparte','marca','modelo','clasificacion',
                'esrotativo','codean','pesoneto'
            ]);
        });
    }
}
