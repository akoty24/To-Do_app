<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Task 1 for Category 1',
                'description' => 'Description for Task 1',
                'status' => 'pending',
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Task 2 for Category 1',
                'description' => 'Description for Task 2',
                'status' => 'completed',
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Task 1 for Category 2',
                'description' => 'Description for Task 1',
                'status' => 'in progress',
                'category_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Task 2 for Category 2',
                'description' => 'Description for Task 2',
                'status' => 'pending',
                'category_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Task 1 for Category 3',
                'description' => 'Description for Task 1',
                'status' => 'completed',
                'category_id' => 3,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Task 2 for Category 3',
                'description' => 'Description for Task 2',
                'status' => 'in progress',
                'category_id' => 3,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert tasks into the database
        DB::table('tasks')->insert($tasks);
    }
}
