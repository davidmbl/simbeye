<?php

namespace Database\Seeders;

use App\Models\Simbeye;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SimbeyeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Simbeye::factory(30)->create();
    }
}
