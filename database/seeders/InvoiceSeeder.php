<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoices')->insert([
            array('id' => '1','invoice_code' => '220714_VXJ0HS8DMpdp','user_id' => '14','voucher_id' => NULL,'quantity' => '3','ship_price' => '35000','until_price' => '1435000','name' => 'Phan Nguyễn Công Khanh','phone' => '0965795425','address' => '01 Đường Tạ An Khương, Phường 5, Thành phố Cà Mau, Cà Mau','status' => '4','canceler_id' => NULL,'reason' => NULL,'type_pay' => 'Tiền mặt','created_at' => '2022-01-14 21:54:50','updated_at' => '2022-01-14 21:54:50'),
            array('id' => '2','invoice_code' => '220714_BBZtgQCUmUA0','user_id' => '15','voucher_id' => NULL,'quantity' => '7','ship_price' => '35000','until_price' => '1992000','name' => 'Phan Hồng Thuý Liễu','phone' => '0965963482','address' => 'Thới Đông, Cờ Đỏ, Cần Thơ','status' => '4','canceler_id' => NULL,'reason' => NULL,'type_pay' => 'Tiền mặt','created_at' => '2022-02-14 21:58:17','updated_at' => '2022-02-14 21:58:17'),
            array('id' => '3','invoice_code' => '220714_8YHThl9OaQl5','user_id' => '13','voucher_id' => NULL,'quantity' => '1','ship_price' => '35000','until_price' => '1325000','name' => 'Hồ Thanh Toàn','phone' => '0937335698','address' => 'Bùi Hữu Nghĩa, Long Tuyền, Bình Thủy, Cần Thơ','status' => '4','canceler_id' => NULL,'reason' => NULL,'type_pay' => 'Tiền mặt','created_at' => '2022-02-14 21:58:56','updated_at' => '2022-02-14 21:58:56'),
            array('id' => '4','invoice_code' => '220714_6643w1WPQ719','user_id' => '12','voucher_id' => NULL,'quantity' => '1','ship_price' => '35000','until_price' => '395000','name' => 'Nguyễn Thị Kim Loan','phone' => '0389641237','address' => 'Đồng tâm, Đam Rông, Lâm Đồng','status' => '4','canceler_id' => NULL,'reason' => NULL,'type_pay' => 'Tiền mặt','created_at' => '2022-03-14 21:59:13','updated_at' => '2022-03-14 21:59:13'),
            array('id' => '5','invoice_code' => '220714_Ph3YU1xSjqqx','user_id' => '11','voucher_id' => NULL,'quantity' => '2','ship_price' => '35000','until_price' => '1013000','name' => 'Hà Văn Trung Tiến','phone' => '0376552369','address' => 'Đường Hùng Vương, Trần Phú, Quảng Ngãi','status' => '4','canceler_id' => NULL,'reason' => NULL,'type_pay' => 'Tiền mặt','created_at' => '2022-03-14 21:59:40','updated_at' => '2022-03-14 21:59:40'),
            array('id' => '6','invoice_code' => '220714_45Kpl8TRUhPW','user_id' => '10','voucher_id' => NULL,'quantity' => '2','ship_price' => '35000','until_price' => '833000','name' => 'Nguyễn Thị Kim','phone' => '0932589632','address' => '21 Hồ Đắc Di, An Cựu, Thành phố Huế, Thừa Thiên Huế','status' => '4','canceler_id' => NULL,'reason' => NULL,'type_pay' => 'Tiền mặt','created_at' => '2022-04-14 22:00:11','updated_at' => '2022-04-14 22:00:11'),
            array('id' => '7','invoice_code' => '220714_KahpuNshKAuK','user_id' => '9','voucher_id' => NULL,'quantity' => '3','ship_price' => '35000','until_price' => '2975000','name' => 'Phạm Thu Trang','phone' => '0393919567','address' => 'Kỳ Thọ, Kỳ Anh, Hà Tĩnh','status' => '4','canceler_id' => NULL,'reason' => NULL,'type_pay' => 'Tiền mặt','created_at' => '2022-04-14 22:00:48','updated_at' => '2022-04-14 22:00:48'),
            array('id' => '8','invoice_code' => '220714_zX7Wj8ER7lMX','user_id' => '8','voucher_id' => NULL,'quantity' => '2','ship_price' => '35000','until_price' => '2735000','name' => 'Phan Thanh Vinh','phone' => '0939658523','address' => '389 Lê Viết Thuật, Hưng Lộc, Thành phố Vinh, Nghệ An','status' => '4','canceler_id' => NULL,'reason' => NULL,'type_pay' => 'Tiền mặt','created_at' => '2022-05-14 22:01:10','updated_at' => '2022-05-14 22:01:10'),
            array('id' => '9','invoice_code' => '220714_Vi7V2s9FKyCZ','user_id' => '7','voucher_id' => NULL,'quantity' => '2','ship_price' => '35000','until_price' => '1015000','name' => 'Võ Minh Triết','phone' => '0329297549','address' => 'Thạnh Mỹ, Tân Phước, Tiền Giang','status' => '4','canceler_id' => NULL,'reason' => NULL,'type_pay' => 'Tiền mặt','created_at' => '2022-06-14 22:01:33','updated_at' => '2022-06-14 22:01:33'),
            array('id' => '10','invoice_code' => '220714_VHXDnNsbq1M6','user_id' => '6','voucher_id' => NULL,'quantity' => '7','ship_price' => '35000','until_price' => '3770000','name' => 'Trần Bách Hiệp','phone' => '0363934536','address' => '45 Đ. Hoàng Diệu, Phường 5, Thành phố Đà Lạt, Lâm Đồng','status' => '4','canceler_id' => NULL,'reason' => NULL,'type_pay' => 'Tiền mặt','created_at' => '2022-07-14 22:08:02','updated_at' => '2022-07-14 22:08:02')
        ]);
    }
}
