<?php

namespace Database\Seeders;

use App\Models\SimbeyeScans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SimbeyeScansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SimbeyeScans::factory(9000)->create();
    }
}
