<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['title' => 'Romanas'],
            ['title' => 'Drama'],
            ['title' => 'Detektyvas'],
            ['title' => 'Fantastika'],
            ['title' => 'Eilėraščiai'],
            ['title' => 'Enciklopedija'],
            ['title' => 'Istorija'],
            ['title' => 'Žodynas'],
            ['title' => 'Sveikata'],
            ['title' => 'Kulinarija'],
            ['title' => 'Menas']
        ];
        foreach ($items as $item) {
            DB::table('genres')->insert($item);
        }
    }
}
