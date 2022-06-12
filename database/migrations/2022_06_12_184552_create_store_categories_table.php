<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->bigInteger('store_id')->unsigned()->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('populer')->default('0');
            $table->string('img')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_descrip')->nullable();
            $table->string('meta_kewwords')->nullable();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('store_categories');
    }
}
