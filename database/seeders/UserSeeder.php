<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating the first user (Edber Vuçitërna)
        User::create([
            'name' => 'Edber Vuçitërna',
            'email' => 'edbervuciterna@proton.me',
            'password' => Hash::make('Edber123'),
        ]);

        // Creating the second user (Filan Fisteku)
        User::create([
            'name' => 'Filan Fisteku',
            'email' => 'filan@fisteku.com',
            'password' => Hash::make('Filan123'),
        ]);
    }
}
