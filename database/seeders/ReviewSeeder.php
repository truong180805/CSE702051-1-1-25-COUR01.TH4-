<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Movie;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::firstOrCreate(
            ['email' => 'doraemon@example.com'],
            ['name' => 'doraemon', 'password' => bcrypt('123456')]
        );

        $user2 = User::firstOrCreate(
            ['email' => 'kien@example.com'],
            ['name' => 'kien', 'password' => bcrypt('123456')]
        );

        $movieTitles = [
            "Avatar",
            "Avengers: Endgame",
            "Barbie",
            "Black Panther",
            "Doctor Strange",
            "Dune",
            "Forrest Gump",
            "Gladiator",
            "Guardians of the Galaxy",
            "Inception",
            "Interstellar",
            "Iron Man",
            "Joker",
            "Oppenheimer",
            "Parasite",
            "Spider-Man: No Way Home",
            "Tenet",
            "The Dark Knight",
            "The Matrix",
            "The Shawshank Redemption",
            "Titanic",
        ];

        $movies = [];
        foreach ($movieTitles as $title) {
            $movies[$title] = Movie::firstOrCreate(['title' => $title]);
        }

        $this->command->info('Phim hiện có: ' . implode(', ', array_keys($movies)));

        $reviews = [
            [
                'user_id' => $user1->id,
                'movie_id' => $movies['Inception']->id,
                'rating' => 4,
                'content' => 'Phim có cốt truyện phức tạp nhưng cực kỳ hấp dẫn!',
            ],
            [
                'user_id' => $user2->id,
                'movie_id' => $movies['The Dark Knight']->id,
                'rating' => 5,
                'content' => 'Heath Ledger diễn quá đỉnh, đúng là Joker huyền thoại!',
            ],
            [
                'user_id' => $user1->id,
                'movie_id' => $movies['Interstellar']->id,
                'rating' => 5,
                'content' => 'Một hành trình đầy cảm xúc qua không gian và thời gian!',
            ],
            [
                'user_id' => $user2->id,
                'movie_id' => $movies['Avatar']->id,
                'rating' => 4,
                'content' => 'Thế giới Pandora thật choáng ngợp!',
            ],
            [
                'user_id' => $user1->id,
                'movie_id' => $movies['Oppenheimer']->id,
                'rating' => 5,
                'content' => 'Một tuyệt phẩm của Nolan, vừa khoa học vừa tâm lý!',
            ],
            [
                'user_id' => $user2->id,
                'movie_id' => $movies['Titanic']->id,
                'rating' => 5,
                'content' => 'Một chuyện tình bất hủ giữa đại dương lạnh giá.',
            ],
        ];

        
        foreach ($reviews as $r) {
            Review::updateOrCreate(
                [
                    'user_id' => $r['user_id'],
                    'movie_id' => $r['movie_id'],
                ],
                $r
            );
        }

        $this->command->info('✅ Đã thêm hoặc cập nhật đánh giá thành công!');
    }
}
