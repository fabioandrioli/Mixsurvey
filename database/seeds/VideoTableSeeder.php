<?php

use Illuminate\Database\Seeder;
use App\Video;
class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::create([
            'title' => 'Video Motivacional de teste',
            'description' => 'Video apenas para testar a nova classe',
            'link' => 'https://www.youtube.com/embed/d6uV3GSLpgc',
            'user_id' => 1,
        ]);

        Video::create([
            'title' => 'Video Motivacional de teste',
            'description' => 'Video apenas para testar a nova classe',
            'link' => 'https://www.youtube.com/embed/eoB0KUbolaU',
            'user_id' => 1,
        ]);

        Video::create([
            'title' => 'Video Motivacional de teste',
            'description' => 'Video apenas para testar a nova classe',
            'link' => 'https://www.youtube.com/embed/eoB0KUbolaU',
            'user_id' => 1,
        ]);

        Video::create([
            'title' => 'Video Motivacional de teste',
            'description' => 'Video apenas para testar a nova classe',
            'link' => 'https://www.youtube.com/embed/eoB0KUbolaU',
            'user_id' => 1,
        ]);
    }
}
