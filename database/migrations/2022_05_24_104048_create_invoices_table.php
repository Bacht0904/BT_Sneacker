<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->integer('quantity');
            $table->integer('ship_price')->nullable();
            $table->integer('until_price');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->tinyInteger('status')->default(1);//0: Đã huỷ, 1:Chờ xác nhận, 2:Xác nhận, 3:Đang giao, 4:Đã giao
            $table->tinyInteger('destroy_status')->nullable();//0. ko co j, 1. huy luc cho xac nhan, 2. huy luc da xac nhan, 3. huy luc dang giao
            $table->unsignedBigInteger('canceler_id')->nullable();//id của người huỷ đơn hàng
            $table->string('reason')->nullable();//Lý do huỷ đơn hàng
            $table->string('type_pay')->nullable()->default('Tiền mặt');
            $table->timestamps();

            // $table->foreign('user-id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
