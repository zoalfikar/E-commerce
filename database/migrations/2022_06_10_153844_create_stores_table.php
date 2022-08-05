<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->bigInteger('owner_id')->unsigned();
            $table->string('ownerName')->nullable();;
            $table->string('img')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->double('address_latitude')->nullable();
            $table->double('address_longitude')->nullable();
            $table->tinyInteger('active')->nullable();
            $table->tinyInteger('populer')->nullable();
            $table->string('pay_pal_key')->nullable();
            $table->string('razpory_key')->nullable();
            $table->string('myfatoora_key')->nullable();
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
