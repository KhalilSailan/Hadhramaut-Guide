<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('professions')->insert([
            ['name'=>'كهربائي'],
            ['name'=>'سباكه'],
            ['name'=>'صيدلي'],
            ['name'=>'مهندس'],
            ['name'=>'مبرمج'],
            ['name'=>'بناء'],
            ['name'=>'دكتور'],
            ['name'=>'تكسي'],
        ]);
    }
}
