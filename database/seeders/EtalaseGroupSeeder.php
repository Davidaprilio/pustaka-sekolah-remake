<?php

namespace Database\Seeders;

use App\Models\EtalaseGroup;
use Illuminate\Database\Seeder;

class EtalaseGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EtalaseGroup::insert([
            [
                'user_id' => 1,
                'name' => 'Pelajaran',
                'slug' => 'pelajaran'
            ],
            [
                'user_id' => 1,
                'name' => 'Komik',
                'slug' => 'komik'
            ],
            [
                'user_id' => 1,
                'name' => 'Novel',
                'slug' => 'novel'
            ],
        ]);
    }
}
