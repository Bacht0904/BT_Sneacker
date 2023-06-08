<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoice_details')->insert([
            array('id' => '1','invoice_id' => '1','product_id' => '23','color_id' => '51','size_id' => '79','quantity' => '1','price' => '490000','total_price' => '490000','status' => '1','rated' => '0','created_at' => '2022-07-14 21:54:50','updated_at' => '2022-07-14 21:54:50'),
            array('id' => '2','invoice_id' => '1','product_id' => '24','color_id' => '52','size_id' => '82','quantity' => '1','price' => '460000','total_price' => '460000','status' => '1','rated' => '0','created_at' => '2022-07-14 21:54:50','updated_at' => '2022-07-14 21:54:50'),
            array('id' => '3','invoice_id' => '1','product_id' => '33','color_id' => '67','size_id' => '112','quantity' => '1','price' => '450000','total_price' => '450000','status' => '1','rated' => '0','created_at' => '2022-07-14 21:54:50','updated_at' => '2022-07-14 21:54:50'),
            array('id' => '4','invoice_id' => '2','product_id' => '1','color_id' => '1','size_id' => '1','quantity' => '4','price' => '295000','total_price' => '1180000','status' => '1','rated' => '0','created_at' => '2022-07-14 21:58:17','updated_at' => '2022-07-14 21:58:17'),
            array('id' => '5','invoice_id' => '2','product_id' => '12','color_id' => '30','size_id' => '39','quantity' => '3','price' => '259000','total_price' => '777000','status' => '1','rated' => '0','created_at' => '2022-07-14 21:58:17','updated_at' => '2022-07-14 21:58:17'),
            array('id' => '6','invoice_id' => '3','product_id' => '41','color_id' => '78','size_id' => '131','quantity' => '1','price' => '1290000','total_price' => '1290000','status' => '1','rated' => '0','created_at' => '2022-07-14 21:58:56','updated_at' => '2022-07-14 21:58:56'),
            array('id' => '7','invoice_id' => '4','product_id' => '39','color_id' => '75','size_id' => '123','quantity' => '1','price' => '360000','total_price' => '360000','status' => '1','rated' => '0','created_at' => '2022-07-14 21:59:13','updated_at' => '2022-07-14 21:59:13'),
            array('id' => '8','invoice_id' => '5','product_id' => '31','color_id' => '65','size_id' => '107','quantity' => '1','price' => '499000','total_price' => '499000','status' => '1','rated' => '0','created_at' => '2022-07-14 21:59:40','updated_at' => '2022-07-14 21:59:40'),
            array('id' => '9','invoice_id' => '5','product_id' => '32','color_id' => '66','size_id' => '108','quantity' => '1','price' => '479000','total_price' => '479000','status' => '1','rated' => '0','created_at' => '2022-07-14 21:59:40','updated_at' => '2022-07-14 21:59:40'),
            array('id' => '10','invoice_id' => '6','product_id' => '17','color_id' => '41','size_id' => '60','quantity' => '1','price' => '399000','total_price' => '399000','status' => '1','rated' => '0','created_at' => '2022-07-14 22:00:11','updated_at' => '2022-07-14 22:00:11'),
            array('id' => '11','invoice_id' => '6','product_id' => '20','color_id' => '48','size_id' => '71','quantity' => '1','price' => '399000','total_price' => '399000','status' => '1','rated' => '0','created_at' => '2022-07-14 22:00:11','updated_at' => '2022-07-14 22:00:11'),
            array('id' => '12','invoice_id' => '7','product_id' => '7','color_id' => '14','size_id' => '24','quantity' => '1','price' => '1200000','total_price' => '1200000','status' => '1','rated' => '0','created_at' => '2022-07-14 22:00:48','updated_at' => '2022-07-14 22:00:48'),
            array('id' => '13','invoice_id' => '7','product_id' => '4','color_id' => '11','size_id' => '14','quantity' => '1','price' => '870000','total_price' => '870000','status' => '1','rated' => '0','created_at' => '2022-07-14 22:00:48','updated_at' => '2022-07-14 22:00:48'),
            array('id' => '14','invoice_id' => '7','product_id' => '4','color_id' => '10','size_id' => '16','quantity' => '1','price' => '870000','total_price' => '870000','status' => '1','rated' => '0','created_at' => '2022-07-14 22:00:48','updated_at' => '2022-07-14 22:00:48'),
            array('id' => '15','invoice_id' => '8','product_id' => '9','color_id' => '24','size_id' => '30','quantity' => '2','price' => '1350000','total_price' => '2700000','status' => '1','rated' => '0','created_at' => '2022-07-14 22:01:10','updated_at' => '2022-07-14 22:01:10'),
            array('id' => '16','invoice_id' => '9','product_id' => '23','color_id' => '51','size_id' => '79','quantity' => '2','price' => '490000','total_price' => '980000','status' => '1','rated' => '0','created_at' => '2022-07-14 22:01:33','updated_at' => '2022-07-14 22:01:33'),
            array('id' => '17','invoice_id' => '10','product_id' => '30','color_id' => '64','size_id' => '103','quantity' => '2','price' => '699000','total_price' => '1398000','status' => '1','rated' => '0','created_at' => '2022-07-14 22:08:02','updated_at' => '2022-07-14 22:08:02'),
            array('id' => '18','invoice_id' => '10','product_id' => '32','color_id' => '66','size_id' => '110','quantity' => '3','price' => '479000','total_price' => '1437000','status' => '1','rated' => '0','created_at' => '2022-07-14 22:08:02','updated_at' => '2022-07-14 22:08:02'),
            array('id' => '19','invoice_id' => '10','product_id' => '33','color_id' => '67','size_id' => '114','quantity' => '2','price' => '450000','total_price' => '900000','status' => '1','rated' => '0','created_at' => '2022-07-14 22:08:02','updated_at' => '2022-07-14 22:08:02')
        ]);
    }
}
