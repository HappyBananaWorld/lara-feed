<?php

namespace Database\Seeders;

use App\Models\Feed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FeedSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->seed() as $data)
        {
            Feed::create($data);
        }
    }

    public function seed() : array
    {
        return [
          [
              'title'=>'Laravel News',
              'description'=>Str::random(10),
              'url'=>'https://feed.laravel-news.com',
          ],
            [
              'title'=>'Dev To',
              'description'=>Str::random(10),
              'url'=>'https://dev.to/rss',
          ],
            [
              'title'=>'securinglaravel',
              'description'=>Str::random(10),
              'url'=>'https://securinglaravel.com/rss',
          ],
            [
              'title'=>'Laracast',
              'description'=>Str::random(10),
              'url'=>'https://laracasts.com/feed',
          ],
            [
              'title'=>'freek dev',
              'description'=>Str::random(10),
              'url'=>'https://freek.dev/feed',
          ],
        ];
    }
}
