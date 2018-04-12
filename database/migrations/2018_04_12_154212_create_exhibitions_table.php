<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('exhibitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_en');
            $table->string('address');
            $table->string('address_en');
            $table->string('main_products', 511);
            $table->string('main_products_en', 511);
            $table->unsignedSmallInteger('rating')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('exhibitions');
    }
}
