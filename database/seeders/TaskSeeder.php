<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the users
        $edber = User::where('email', 'edbervuciterna@proton.me')->first();
        $filan = User::where('email', 'filan@fisteku.com')->first();

        // Create 5 random tasks for Edber
        for ($i = 0; $i < 5; $i++) {
            Task::create([
                'title' => 'Task ' . ($i + 1),
                'description' => 'Description for task ' . ($i + 1),
                'priority' => rand(1, 3), // Random priority between 1 and 3
                'status' => rand(0, 1), // Random status between 0 and 1
                'user_id' => $edber->id,
            ]);
        }

        // Create 5 random tasks for Filan
        for ($i = 0; $i < 5; $i++) {
            Task::create([
                'title' => 'Task ' . ($i + 1),
                'description' => 'Description for task ' . ($i + 1),
                'priority' => rand(1, 3), // Random priority between 1 and 3
                'status' => rand(0, 1), // Random status between 0 and 1
                'user_id' => $filan->id,
            ]);
        }
    }
}
