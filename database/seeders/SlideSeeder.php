<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slides')->insert([
            array(
                'picture'=>'slide_02.jpg',
                'description'=>'<p>Đây là dáng người có vai nhỏ và to dần xuống phần hông. Những người làm việc văn phòng, ít vận động thường sẽ thuộc kiểu thân hình này. Theo thời gian nếu càng ít vận động và chế độ ăn không lành mạnh thì phần bụng và hông của người có thân hình tam giác sẽ càng to ra.</p><p>Đây là dáng người kén mặc đồ vì áo nam được thiết kế theo kiểu dáng rộng phần vai và từ ngực trở xuống sẽ bằng nhau.</p><p>Nếu bạn là người sở hữu thân hình này, bạn nên chọn áo polo rộng hơn so với thân hình của mình để không bị lộ quá nhiều phần bụng. Ngoài ra nên chọn những kiểu áo polo kẻ dọc hoặc phối màu trắng ở phần vai giúp tạo cảm giác phần vai to hơn và phối màu tối từ phần thân giữa trở xuống để tạo cảm giác thân dưới nhỏ lại.&nbsp;</p>',
                'status'=>1,
                'created_at'=>Carbon::now(),
            ),
            array(
                'picture'=>'slide_03.jpg',
                'description'=>'<h3 style="text-align:center;"><span style="color:hsl(30,75%,60%);">[Graceful_Shop best saller 30%]</span></h3><p><span style="color:hsl(0,0%,0%);">Chi tiết chương trình</span></p><p>❤️Voucher 30% cho tất cả sản phẩm dưới đây</p><p>👉Thời gian từ 01/06 - 06/06/2022</p><p>👉Truy cập shop tại: graceful.shop.vn</p><p style="text-align:center;">😍😍😍😍</p>',
                'status'=>1,
                'created_at'=>Carbon::now(),
            ),
            array(
                'picture'=>'slide_04.jpg',
                'description'=>'<h3 style="text-align:center;"><span style="color:hsl(30, 75%, 60%);">[Mùa hè đến rồi]</span></h3><p><span style="color:hsl(0, 0%, 0%);">Nhanh tay chọn những sản phẩm yêu thích đi nào</span></p><p>😍Sản phẩm siêu hot mùa này</p>👉Truy cập shop tại: graceful.shop.vn</p>',
                'status'=>1,
                'created_at'=>Carbon::now(),
            ),
        ]);
    }
}
