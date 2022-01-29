<?php

namespace Database\Seeders;

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
        \App\Models\User::create([
            'name' => 'David Aprilio',
            'email' => 'david@gmail.com',
            'email_verified_at' => now(),
            'class' => 'TKJ 2',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'J92IXUNpkjO0rOQ5byMiYe4oKoEa3Ro',
        ]);
        \App\Models\User::factory(5)->create();

        $this->call([
            EtalaseGroupSeeder::class
        ]);

        \App\Models\EtalaseBook::factory(6)->create();
        // \App\Models\Book::factory(20)->create();
        // \App\Models\PivotEtalaseBook::factory(24)->create();

    }
}
