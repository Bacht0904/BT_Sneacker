<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            array('id' => '1','brand_name' => 'H&M','company' => 'H&M fashion','company_code' => '860000','bank_num' => '4789909','bank_name' => 'ACB - Ngan Hang A Chau','bank_account_name' => 'H&M FASHION COMPANY','phone_number' => '0314472520','email' => 'hmfashion@gmail.com','status' => '1','created_at' => '2022-07-13 22:59:39','updated_at' => '2022-07-13 22:59:39'),
            array('id' => '2','brand_name' => 'Puma','company' => 'Puma fashion','company_code' => '887000','bank_num' => '14667889675','bank_name' => 'Ngan Hang TMCP Cong Thuong Viet Nam - Vietin Bank','bank_account_name' => 'PUMA FASHION COMPANY','phone_number' => '0950480425','email' => 'pumafashion@gmail.com','status' => '0','created_at' => '2022-07-13 22:59:39','updated_at' => '2022-07-13 22:57:20'),
            array('id' => '3','brand_name' => 'Adidas','company' => 'Adidas fashion','company_code' => '899000','bank_num' => '140089007766','bank_name' => 'Ngan Hang TMCP Cong Thuong Viet Nam - Vietin Bank','bank_account_name' => 'ADIDAS FASHION COMPANY','phone_number' => '0760828920','email' => 'adidasfashion@gmail.com','status' => '1','created_at' => '2022-07-13 22:59:39','updated_at' => '2022-07-13 22:59:39'),
            array('id' => '4','brand_name' => 'K&K Fashion','company' => 'CTY TNHH KHANG KHÔI','company_code' => '3256943','bank_num' => '93456952311','bank_name' => 'Ngân hàng Thương mại Cổ phần Quân đội - MB Bank','bank_account_name' => 'HO THI THU NHI','phone_number' => '0964589631','email' => 'kkfashion@gmail.com','status' => '1','created_at' => '2022-07-13 22:59:39','updated_at' => '2022-07-13 23:16:50'),
            array('id' => '5','brand_name' => 'NEM FASHION','company' => 'Công ty TNHH Dịch vụ và Thương mại An Thành','company_code' => '4651320','bank_num' => '84651324615622','bank_name' => 'Ngân hàng Thương mại Cổ phần Quân đội - MB Bank','bank_account_name' => 'TRAN VAN NAM','phone_number' => '0958332332','email' => 'nem@gmail.com','status' => '1','created_at' => '2022-07-13 23:00:52','updated_at' => '2022-07-13 23:17:03'),
            array('id' => '6','brand_name' => 'Chic-Land','company' => 'CÔNG TY TNHH THỜI TRANG NGỌC THÀNH','company_code' => '0102296853','bank_num' => '465132465645','bank_name' => 'Ngân hàng TMCP Sài Gòn Thương Tín - Sacombank.','bank_account_name' => 'NGUYEN THI THUY TRANG','phone_number' => '0868580388','email' => 'chiland@gmail.com','status' => '1','created_at' => '2022-07-13 23:03:16','updated_at' => '2022-07-13 23:17:49'),
            array('id' => '7','brand_name' => 'HNOSS','company' => 'Công ty cổ phần Hnoss','company_code' => '0305880944','bank_num' => '4104656565','bank_name' => 'Ngân hàng TMCP Việt Nam Thịnh Vượng - VP Bank','bank_account_name' => 'VO THANH TRUNG','phone_number' => '0934862177','email' => 'hnossfashion@gmail.com','status' => '1','created_at' => '2022-07-13 23:05:59','updated_at' => '2022-07-13 23:19:14'),
            array('id' => '8','brand_name' => 'FM STYLE','company' => 'Công ty cổ phần FM','company_code' => '465151565','bank_num' => '46538565652','bank_name' => 'Ngân hàng Nông nghiệp và Phát triển Nông thôn Việt Nam - Agribank','bank_account_name' => 'PHAN THANH NHANH','phone_number' => '0974063762','email' => 'fmstyle@gmail.com','status' => '1','created_at' => '2022-07-13 23:15:42','updated_at' => '2022-07-13 23:20:10'),
            array('id' => '9','brand_name' => 'ACFC','company' => 'Công Ty TNHH Thời Trang & Mỹ Phẩm Âu Châu','company_code' => '030468','bank_num' => '465348156','bank_name' => 'Ngân hàng TMCP Sài Gòn Thương Tín - Sacombank.','bank_account_name' => 'TRAN MINH THANH','phone_number' => '0939658943','email' => 'acfc@gmail.com','status' => '1','created_at' => '2022-07-14 20:21:30','updated_at' => '2022-07-14 20:27:26')
        ]);
    }
}
