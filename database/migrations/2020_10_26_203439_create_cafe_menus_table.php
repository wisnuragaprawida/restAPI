<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCafeMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafe_menus', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('name');
            $table->longText('description');
            $table->integer('amount');
            $table->string('menuImage');
            $table->foreignId('cafe_id');
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
        Schema::dropIfExists('cafe_menus');
    }
}
