<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            array('id' => '1','color_name' => 'Trắng','picture' => '1.jpg','product_id' => '1','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '2','color_name' => 'Đen','picture' => '2.jpg','product_id' => '1','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '3','color_name' => 'Nâu nhạt','picture' => '3.jpg','product_id' => '1','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '4','color_name' => 'Đỏ','picture' => '4.jpg','product_id' => '1','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '5','color_name' => 'Cam','picture' => '5.jpg','product_id' => '1','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '6','color_name' => 'Xanh đen','picture' => '6.jpg','product_id' => '2','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '7','color_name' => 'Hoạ tiết cartoon','picture' => '9.jpg','product_id' => '3','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '8','color_name' => 'Xanh đen hoạ tiết hoa','picture' => '10.jpg','product_id' => '3','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '9','color_name' => 'Vàng hoạ tiết hoa','picture' => '11.jpg','product_id' => '3','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '10','color_name' => 'Trắng','picture' => '12.jpg','product_id' => '4','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '11','color_name' => 'Tím','picture' => '14.jpg','product_id' => '4','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '12','color_name' => 'Xám','picture' => '15.jpg','product_id' => '5','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '13','color_name' => 'Đen','picture' => '18.jpg','product_id' => '6','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '14','color_name' => 'Xám','picture' => '20.jpg','product_id' => '7','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '15','color_name' => 'Đen','picture' => '22.jpg','product_id' => '7','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '16','color_name' => 'Đỏ','picture' => '24.jpg','product_id' => '8','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '17','color_name' => 'Kem','picture' => '28.jpg','product_id' => '8','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '22','color_name' => 'Đen','picture' => '30.jpg','product_id' => '9','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '23','color_name' => 'Kem','picture' => '31.jpg','product_id' => '9','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '24','color_name' => 'Vàng','picture' => '32.jpg','product_id' => '9','status' => '1','created_at' => '2022-07-13 22:43:42','updated_at' => '2022-07-13 22:43:42'),
            array('id' => '25','color_name' => 'Đen','picture' => '34.jpg','product_id' => '10','status' => '1','created_at' => '2022-07-13 22:50:28','updated_at' => '2022-07-13 22:50:28'),
            array('id' => '26','color_name' => 'Xám','picture' => '35.jpg','product_id' => '10','status' => '1','created_at' => '2022-07-13 22:50:28','updated_at' => '2022-07-13 22:50:28'),
            array('id' => '27','color_name' => 'Xanh','picture' => '36.jpg','product_id' => '10','status' => '1','created_at' => '2022-07-13 22:50:28','updated_at' => '2022-07-13 22:50:28'),
            array('id' => '28','color_name' => 'Đen','picture' => '38.jpg','product_id' => '11','status' => '1','created_at' => '2022-07-13 22:56:11','updated_at' => '2022-07-13 22:56:11'),
            array('id' => '29','color_name' => 'Xám','picture' => '37.jpg','product_id' => '11','status' => '1','created_at' => '2022-07-13 22:56:11','updated_at' => '2022-07-13 22:56:11'),
            array('id' => '30','color_name' => 'Đen','picture' => '41.jpg','product_id' => '12','status' => '1','created_at' => '2022-07-13 23:13:24','updated_at' => '2022-07-13 23:13:24'),
            array('id' => '31','color_name' => 'Nâu','picture' => '39.jpg','product_id' => '12','status' => '1','created_at' => '2022-07-13 23:13:24','updated_at' => '2022-07-13 23:13:24'),
            array('id' => '32','color_name' => 'Ghi','picture' => '40.jpg','product_id' => '12','status' => '1','created_at' => '2022-07-13 23:13:24','updated_at' => '2022-07-13 23:13:24'),
            array('id' => '33','color_name' => 'Xanh','picture' => '45.jpg','product_id' => '13','status' => '1','created_at' => '2022-07-13 23:27:44','updated_at' => '2022-07-13 23:27:44'),
            array('id' => '34','color_name' => 'Đen','picture' => '47.jpg','product_id' => '13','status' => '1','created_at' => '2022-07-13 23:27:44','updated_at' => '2022-07-13 23:27:44'),
            array('id' => '35','color_name' => 'Đen','picture' => '51.jpg','product_id' => '14','status' => '1','created_at' => '2022-07-13 23:31:50','updated_at' => '2022-07-13 23:31:50'),
            array('id' => '36','color_name' => 'Kem','picture' => '49.jpg','product_id' => '14','status' => '1','created_at' => '2022-07-13 23:31:50','updated_at' => '2022-07-13 23:31:50'),
            array('id' => '37','color_name' => 'Kem','picture' => '53.jpg','product_id' => '15','status' => '1','created_at' => '2022-07-13 23:36:14','updated_at' => '2022-07-13 23:36:14'),
            array('id' => '38','color_name' => 'Ghi Đậm','picture' => '54.jpg','product_id' => '15','status' => '1','created_at' => '2022-07-13 23:36:14','updated_at' => '2022-07-13 23:36:14'),
            array('id' => '39','color_name' => 'Đen','picture' => '55.jpg','product_id' => '15','status' => '1','created_at' => '2022-07-13 23:36:14','updated_at' => '2022-07-13 23:36:14'),
            array('id' => '40','color_name' => 'Xanh','picture' => '57.jpg','product_id' => '16','status' => '1','created_at' => '2022-07-13 23:40:22','updated_at' => '2022-07-13 23:40:22'),
            array('id' => '41','color_name' => 'Xám','picture' => '59.jpg','product_id' => '17','status' => '1','created_at' => '2022-07-13 23:45:54','updated_at' => '2022-07-13 23:45:54'),
            array('id' => '42','color_name' => 'Xanh','picture' => '62.jpg','product_id' => '17','status' => '1','created_at' => '2022-07-13 23:45:54','updated_at' => '2022-07-13 23:45:54'),
            array('id' => '43','color_name' => 'Xanh nhạt','picture' => '64.jpg','product_id' => '18','status' => '1','created_at' => '2022-07-13 23:53:15','updated_at' => '2022-07-13 23:53:15'),
            array('id' => '44','color_name' => 'Xanh','picture' => '67.jpg','product_id' => '19','status' => '1','created_at' => '2022-07-14 00:28:25','updated_at' => '2022-07-14 00:28:25'),
            array('id' => '45','color_name' => 'Đen Khói','picture' => '69.jpg','product_id' => '19','status' => '1','created_at' => '2022-07-14 00:28:25','updated_at' => '2022-07-14 00:28:25'),
            array('id' => '46','color_name' => 'Xanh Đậm','picture' => '72.jpg','product_id' => '19','status' => '1','created_at' => '2022-07-14 00:28:25','updated_at' => '2022-07-14 00:28:25'),
            array('id' => '47','color_name' => 'Xanh Nhạt','picture' => '70.jpg','product_id' => '19','status' => '1','created_at' => '2022-07-14 00:28:25','updated_at' => '2022-07-14 00:28:25'),
            array('id' => '48','color_name' => 'Xanh','picture' => '73.jpg','product_id' => '20','status' => '1','created_at' => '2022-07-14 00:33:50','updated_at' => '2022-07-14 00:33:50'),
            array('id' => '49','color_name' => 'Đen','picture' => '77.jpg','product_id' => '21','status' => '1','created_at' => '2022-07-14 00:37:41','updated_at' => '2022-07-14 00:37:41'),
            array('id' => '50','color_name' => 'Xanh Dương','picture' => '79.jpg','product_id' => '22','status' => '1','created_at' => '2022-07-14 00:41:58','updated_at' => '2022-07-14 00:41:58'),
            array('id' => '51','color_name' => 'Caro','picture' => '87.jpg','product_id' => '23','status' => '1','created_at' => '2022-07-14 00:48:45','updated_at' => '2022-07-14 00:48:45'),
            array('id' => '52','color_name' => 'Xanh Ngọc','picture' => '90.jpg','product_id' => '24','status' => '1','created_at' => '2022-07-14 00:51:46','updated_at' => '2022-07-14 00:51:46'),
            array('id' => '53','color_name' => 'Xanh Đậu','picture' => '92.jpg','product_id' => '25','status' => '1','created_at' => '2022-07-14 00:57:30','updated_at' => '2022-07-14 00:57:30'),
            array('id' => '54','color_name' => 'Xanh Nhạt','picture' => '93.jpg','product_id' => '25','status' => '1','created_at' => '2022-07-14 00:57:30','updated_at' => '2022-07-14 00:57:30'),
            array('id' => '55','color_name' => 'Vàng','picture' => '94.jpg','product_id' => '25','status' => '1','created_at' => '2022-07-14 00:57:30','updated_at' => '2022-07-14 00:57:30'),
            array('id' => '56','color_name' => 'Đen','picture' => '97.jpg','product_id' => '26','status' => '1','created_at' => '2022-07-14 01:02:27','updated_at' => '2022-07-14 01:02:27'),
            array('id' => '57','color_name' => 'Trắng','picture' => '99.jpg','product_id' => '26','status' => '1','created_at' => '2022-07-14 01:02:27','updated_at' => '2022-07-14 01:02:27'),
            array('id' => '58','color_name' => 'Vàng Nhạt','picture' => '96.jpg','product_id' => '26','status' => '1','created_at' => '2022-07-14 01:02:27','updated_at' => '2022-07-14 01:02:27'),
            array('id' => '59','color_name' => 'Đen','picture' => '106.jpg','product_id' => '27','status' => '1','created_at' => '2022-07-14 01:07:43','updated_at' => '2022-07-14 01:07:43'),
            array('id' => '60','color_name' => 'Trắng','picture' => '104.jpg','product_id' => '27','status' => '1','created_at' => '2022-07-14 01:07:43','updated_at' => '2022-07-14 01:07:43'),
            array('id' => '61','color_name' => 'Hồng','picture' => '105.jpg','product_id' => '27','status' => '1','created_at' => '2022-07-14 01:07:43','updated_at' => '2022-07-14 01:07:43'),
            array('id' => '62','color_name' => 'Vàng','picture' => '110.jpg','product_id' => '28','status' => '1','created_at' => '2022-07-14 01:12:33','updated_at' => '2022-07-14 01:12:33'),
            array('id' => '63','color_name' => 'Đen Phối Hoa','picture' => '113.jpg','product_id' => '29','status' => '1','created_at' => '2022-07-14 01:16:30','updated_at' => '2022-07-14 01:16:30'),
            array('id' => '64','color_name' => 'Xanh Chấm Bi','picture' => '116.jpg','product_id' => '30','status' => '1','created_at' => '2022-07-14 01:24:17','updated_at' => '2022-07-14 01:24:17'),
            array('id' => '65','color_name' => 'Hoa Vàng','picture' => '121.jpg','product_id' => '31','status' => '1','created_at' => '2022-07-14 19:41:20','updated_at' => '2022-07-14 19:41:20'),
            array('id' => '66','color_name' => 'Ren Trắng','picture' => '126.jpg','product_id' => '32','status' => '1','created_at' => '2022-07-14 19:45:44','updated_at' => '2022-07-14 19:45:44'),
            array('id' => '67','color_name' => 'Đen','picture' => '129.jpg','product_id' => '33','status' => '1','created_at' => '2022-07-14 19:48:53','updated_at' => '2022-07-14 19:48:53'),
            array('id' => '68','color_name' => 'Đen','picture' => '130.jpg','product_id' => '34','status' => '1','created_at' => '2022-07-14 20:16:39','updated_at' => '2022-07-14 20:16:39'),
            array('id' => '69','color_name' => 'Trắng','picture' => '133.jpg','product_id' => '35','status' => '1','created_at' => '2022-07-14 20:29:14','updated_at' => '2022-07-14 20:29:14'),
            array('id' => '70','color_name' => 'Kem','picture' => '135.jpg','product_id' => '36','status' => '1','created_at' => '2022-07-14 20:31:09','updated_at' => '2022-07-14 20:31:09'),
            array('id' => '71','color_name' => 'Xanh','picture' => '137.jpg','product_id' => '37','status' => '1','created_at' => '2022-07-14 20:33:12','updated_at' => '2022-07-14 20:33:12'),
            array('id' => '72','color_name' => 'Kem','picture' => '141.jpg','product_id' => '38','status' => '1','created_at' => '2022-07-14 20:36:03','updated_at' => '2022-07-14 20:36:03'),
            array('id' => '73','color_name' => 'Đen','picture' => '144.jpg','product_id' => '39','status' => '1','created_at' => '2022-07-14 20:38:33','updated_at' => '2022-07-14 20:38:33'),
            array('id' => '74','color_name' => 'Vàng','picture' => '143.jpg','product_id' => '39','status' => '1','created_at' => '2022-07-14 20:38:33','updated_at' => '2022-07-14 20:38:33'),
            array('id' => '75','color_name' => 'Xanh','picture' => '145.jpg','product_id' => '39','status' => '1','created_at' => '2022-07-14 20:38:33','updated_at' => '2022-07-14 20:38:33'),
            array('id' => '76','color_name' => 'Trắng','picture' => '148.jpg','product_id' => '40','status' => '1','created_at' => '2022-07-14 20:49:11','updated_at' => '2022-07-14 20:49:11'),
            array('id' => '77','color_name' => 'Đen','picture' => '147.jpg','product_id' => '40','status' => '1','created_at' => '2022-07-14 20:49:11','updated_at' => '2022-07-14 20:49:11'),
            array('id' => '78','color_name' => 'Trắng','picture' => '150.jpg','product_id' => '41','status' => '1','created_at' => '2022-07-14 20:52:57','updated_at' => '2022-07-14 20:52:57')
        ]);       
    }
}
