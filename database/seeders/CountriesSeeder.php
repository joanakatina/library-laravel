<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (($handle = fopen("C:/xampp/htdocs/library/database/countries.csv", "r")) !== FALSE) {
            fgetcsv($handle); // skip first line with column names
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                DB::table('countries')->insert([
                    'country' => $data[0],
                    'latitude' => !empty($data[1]) ? $data[1] : NULL,
                    'longitude' => !empty($data[2]) ? $data[2] : NULL,
                    'name' => $data[3],
                ]);
            }
            fclose($handle);
        }
    }
}
