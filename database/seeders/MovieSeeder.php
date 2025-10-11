<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Inception',
                'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'release_date' => '2010-07-16',
                'genre' => 'Sci-Fi',
                'created_at' => now(),
                'updated_at' => now(),
                'avg_rating' => 4.50,
                'poster_url' => 'https://example.com/inception.jpg',
                'trailer_url' => 'https://example.com/inception-trailer.mp4',
            ],
            [
                'title' => 'The Dark Knight',
                'description' => 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham. The Dark Knight must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'release_date' => '2008-07-18',
                'genre' => 'Action',
                'created_at' => now(),
                'updated_at' => now(),
                'avg_rating' => 4.75,
                'poster_url' => 'https://example.com/dark-knight.jpg',
                'trailer_url' => 'https://example.com/dark-knight-trailer.mp'
            ],
            [
                'title' => 'Interstellar',
                'description' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanitys survival.',
                'release_date' => '2014-11-07',
                'genre' => 'Adventure',
                'created_at' => now(),
                'updated_at' => now(),
                'avg_rating' => 4.60,
                'poster_url' => 'https://example.com/interstellar.jpg',
                'trailer_url' => 'https://example.com/interstellar-trailer.mp4',
            ],
            // Thêm nhiều phim hơn nếu cần
        ];
        foreach ($movies as $movie) {
            DB::table('movies')->insert($movie);
        }
    }
}
