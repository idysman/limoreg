<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'first_name' => 'System',
            'surname'=> 'SuperAdmin',
            'middle_name' => "system",
            'phone'=> '007',
            'email' => 'system@admin.com',
            "role" => '1',
            'password' => Hash::make('$y$tem@007'),
        ]);

    }
}
