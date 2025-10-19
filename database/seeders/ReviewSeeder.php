<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;



class ReviewSeeder extends Seeder
{
    public function run(): void
    { 

    
        $userIds = DB::table('users')->pluck('id')->toArray();
        $movieIds = DB::table('movies')->pluck('id')->toArray();

        if (empty($userIds) || empty($movieIds)) {
            $this->command->warn('⚠️ Không có user hoặc movie nào trong database. Hãy seed UserSeeder và MovieSeeder trước.');
            return;
        }

        $reviews = [
            [
                'user_id' => $userIds[0],
                'movie_id' => $movieIds[0],
                'content' => 'Một bộ phim xuất sắc, cốt truyện hấp dẫn và diễn viên thể hiện tuyệt vời!',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $userIds[1] ?? $userIds[0],
                'movie_id' => $movieIds[0],
                'content' => 'Phim rất hay nhưng tiết tấu hơi chậm ở đoạn đầu. Tuy nhiên tổng thể vẫn đáng xem.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $userIds[2] ?? $userIds[0],
                'movie_id' => $movieIds[1] ?? $movieIds[0],
                'content' => 'Tạm ổn, kỹ xảo đẹp nhưng kịch bản chưa thực sự đột phá.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $userIds[0],
                'movie_id' => $movieIds[2] ?? $movieIds[0],
                'content' => 'Phim hơi dài dòng, thiếu cao trào, xem khá mệt.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
                  
        ];

        DB::table('reviews')->insert($reviews);
        }
    }


