<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlideDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slide_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            // $table->foreign('product-id')->references('id')->on('products');
            // $table->foreign('slide-id')->references('id')->on('slides');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slide_details');
    }
}
