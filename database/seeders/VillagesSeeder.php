<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Village::insert([
            ['name' => 'العرض'],
            ['name' => 'الحدبه'],
            ['name' => 'الروضه'],
            ['name' => 'جبره'],
            ['name' => 'عراض العول'],
            ['name' => 'زهرالجنان'],
            ['name' => 'عريشه'],
            ['name' => 'بلادالغريب'],
            ['name' => 'دارالحصاه'],
            ['name' => 'القوز'],
            ['name' => 'السيله'],
            ['name' => 'النخش'],
            ['name' => 'باهزيل'],
            ['name' => 'بالعقبه'],
            ['name' => 'محيصن'],
            ['name' => 'الدروع'],
            ['name' => 'زبيد'],
        ]);
    }
}
