<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();



        // Category::factory(50)->create();
        // Store::factory(10)->create();
        // Product::factory(500)->create();


        // $this->run(UserSeeder::class);

        // User::create([
        //     'name'          => 'root',
        //     'email'         => 'root@mail.com',
        //     'password'      => Hash::make('secret'),
        // ]);
    }
}
