<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableItems2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
       
         
         Schema::table('items', function ($table) {
            
             $table->dropColumn([
                'sku','sale_price','purchase_price','quantity'
            ]);
              if(!Schema::hasColumn('items','sku')) {
                  $table->string('sku', 191)->nullable();
              }
              if(!Schema::hasColumn('items','sale_price')) {
                $table->double('sale_price', 15, 4)->nullable();
              }
             
             if(!Schema::hasColumn('items','purchase_price')) {
                  $table->double('purchase_price', 15, 4)->nullable();
              }
           
              
              if(!Schema::hasColumn('items','quantity')) {
                   $table->integer('quantity')->nullable();
              }
            
             
             
             
            // $table->foreign('codum')->references('codum')->on('ums');
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
        Schema::table('items', function (Blueprint $table) {
          if(Schema::hasColumn('items','sku')) {
             $table->dropColumn('sku'); 
             $table->string('sku', 191);
          }
              
          if(Schema::hasColumn('items','sale_price')) {
              $table->dropColumn('sale_price');
              $table->double('sale_price', 15, 4);
          }
              
          if(Schema::hasColumn('items','purchase_price')){
              $table->dropColumn('purchase_price'); 
              $table->double('purchase_price', 15, 4);
          } 
             
           if(Schema::hasColumn('items','purchase_price')) {
               $table->dropColumn('quantity');
               $table->integer('quantity');
           }
             
           
        
             
        });
    }
}
