<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class UsersSlugsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::chunk(10, function ($users) {
        //     foreach ($users as $user) {
        //         if (empty($user->slug)) {
        //             $user->update([
        //                 'slug' => Str::slug($user->name)
        //             ]);
        //         }
        //     }
        // });

        foreach (User::count(10)->get() as $user) {
            $user->update([
                'slug' => Str::slug($user->name)
            ]);
        }
    }
}
