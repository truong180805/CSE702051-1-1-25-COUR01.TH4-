<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = DB::table('users')->pluck('id')->toArray();
        $movieIds = DB::table('movies')->pluck('id')->toArray();

        if (empty($userIds) || empty($movieIds)) {
            $this->command->warn('⚠️ Không có user hoặc movie nào. Hãy seed UserSeeder và MovieSeeder trước.');
            return;
        }

        $ratings = [
            [
                'user_id' => $userIds[0],
                'movie_id' => $movieIds[0],
                'rating' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $userIds[1] ?? $userIds[0],
                'movie_id' => $movieIds[0],
                'rating' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $userIds[2] ?? $userIds[0],
                'movie_id' => $movieIds[1] ?? $movieIds[0],
                'rating' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $userIds[1],
                'movie_id' => $movieIds[2] ?? $movieIds[0],
                'rating' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $userIds[0],
                'movie_id' => $movieIds[2] ?? $movieIds[0],
                'rating' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('ratings')->insert($ratings);
    }
}
