<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::connection('mysql2')->create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('representative'); //
            $table->string('team');
            $table->string('user_id');
            $table->string('fav_id');
            $table->string('city');
            $table->string('hope_game'); //
            $table->string('introduce');//
            $table->string('image_path')->nullable();  // 画像のパスを保存するカラム
            $table->date('day');
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
        Schema::connection('mysql2')->dropIfExists('favorites');
    }
}
