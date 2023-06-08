<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_shops', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->text('address_map')->nullable();
            $table->string('phone')->nullable();
            $table->text('mess_manager')->nullable();
            $table->text('mess_chat')->nullable();
            $table->text('page_fb')->nullable();
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
        Schema::dropIfExists('info_shop');
    }
}
