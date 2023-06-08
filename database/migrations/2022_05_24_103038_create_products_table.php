<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->integer('price');
            $table->unsignedBigInteger('product_type_id');
            $table->string('product_barcode');
            $table->unsignedBigInteger('brand_id');
            $table->integer('popular')->default(0);
            $table->integer('quantity_status')->default(1);
            $table->integer('num_like')->default(0);
            $table->double('num_rate')->default(0);
            $table->text('description', 64);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
