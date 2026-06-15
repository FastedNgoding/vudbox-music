<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = ['Pop', 'Rock', 'Electronic', 'Hip Hop', 'Jazz', 'R&B', 'Acoustic', 'Classical'];

        foreach ($genres as $name) {
            Genre::firstOrCreate([
                'name' => $name,
                'slug' => Str::slug($name)
            ]);
        }
    }
}
