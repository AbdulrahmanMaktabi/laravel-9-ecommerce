<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'root',
            'email'     => 'root@mail.com',
            'email_verified_at' => Carbon::now(),
            'password'  => Hash::make('secret'),
            'phone'     => '05523748302',
            'remember_token' => Str::random(60)
        ]);
    }
}
