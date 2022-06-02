<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cat_id');
            $table->string('name')->nullable();
            $table->string('slug');
            $table->mediumText('small_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('orginal_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('img')->nullable();
            $table->string('qty')->nullable();
            $table->string('tax')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('trending')->nullable();
            $table->mediumText('meta_title')->nullable();
            $table->mediumText('meta_descrip')->nullable();
            $table->mediumText('meta_kewwords')->nullable();
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodects');
    }
}
