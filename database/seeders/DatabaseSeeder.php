<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\EtalaseBook;
use App\Models\PivotEtalaseBook;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'David Aprilio',
            'email' => 'david@gmail.com',
            'email_verified_at' => now(),
            // 'class' => 'TKJ 2',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'J92IXUNpkjO0rOQ5byMiYe4oKoEa3Ro',
        ]);
        User::factory(5)->create();

        $this->call([
            EtalaseGroupSeeder::class
        ]);

        EtalaseBook::factory(6)->create();
        Book::factory(20)->create();
        PivotEtalaseBook::factory(24)->create();
    }
}
