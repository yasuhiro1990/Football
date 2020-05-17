<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::connection('mysql4')->create('peoples', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->integer('user_id');
            $table->integer('professional'); //
            $table->integer('normal');
            
            
            $table->integer('beginner');
            $table->string('none'); //
            $table->timestamps();
            
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::connection('mysql4')->dropIfExists('peoples');
    }
}
