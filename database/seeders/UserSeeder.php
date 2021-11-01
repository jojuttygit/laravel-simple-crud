<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use User, Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
    
        try {
            $user = new User;
            $user->name = "admin";
            $user->email = "admin@laravel.io";
            $user->password = Hash::make('admin123');
            $user->save();
            $this->command->info('Admin User Successfully Inserted');
        } catch (Exception $e) {
            $this->command->info('Failed to Admin User');
        }
    }
}
