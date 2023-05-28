<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Database extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TaiKhoan', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->integer('trangthai');
            $table->timestamps();
            $table->SoftDeletes();
        });
        Schema::create('NguoiDung', function (Blueprint $table) {
            $table->id();
            $table->string('hoten');
            $table->string('HinhAnh');
            $table->date('ngaysinh');
            $table->string('diachi')->nullable();
            $table->string('sdt');
            $table->string('email');
            $table->integer('idTaiKhoan');
            $table->foreign('idTaiKhoan')->references('id')->on('TaiKhoan');
            $table->integer('isAdmin');
            $table->integer('trangthai');
            $table->timestamps();
            $table->SoftDeletes();
        });
        Schema::create('SanPham', function (Blueprint $table) {
            $table->id();
            $table->string('tensp');
            $table->string('thuonghieu');
            $table->longtext('mota');
            $table->integer('trangthai');
            $table->timestamps();
            $table->SoftDeletes();
        });
        Schema::create('SP_Detail', function (Blueprint $table) {
            $table->id();
            $table->integer('soluong');
            $table->integer('idSP');
            $table->foreign('idSP')->references('id')->on('SanPham');
            $table->string('size');
            $table->string('color');
            $table->bigInteger('dongia');
            $table->integer('trangthai');
            $table->timestamps();
            $table->SoftDeletes();
           
        });
        Schema::create('HoaDon', function (Blueprint $table) {
            $table->id();
            $table->date('NgayTao');
            $table->integer('idUser');
            $table->foreign('idUser')->references('id')->on('NguoiDung');
            $table->integer('trangthai');
            $table->timestamps();
            $table->SoftDeletes();
        });
        Schema::create('CT_HoaDon', function (Blueprint $table) {
            $table->id();
            $table->integer('idHD');
            $table->foreign('idHD')->references('id')->on('HoaDon');
            $table->integer('idSP');
            $table->foreign('idSP')->references('id')->on('SP_Detail');
            $table->integer('idKM');
            $table->foreign('idKM')->references('id')->on('KhuyenMai');
            $table->integer('soluong');
            $table->bigInteger('dongia');
            $table->bigInteger('thanhtien');
            $table->integer('trangthai');
            $table->timestamps();
            $table->SoftDeletes();
        });
        Schema::create('KhuyenMai', function (Blueprint $table) {
            $table->id();
            $table->integer('phantram');  
            $table->date('NgayBatDau');
            $table->date('NgayKetThuc');
            $table->integer('trangthai');
            $table->SoftDeletes();
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
    }
}
