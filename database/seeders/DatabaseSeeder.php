<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use App\Models\comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create([
            'name' => 'Test User',

        ]);
        User::factory()->create([
            'name'=>'admin',
            'email'=>'admin@password.com',
            'password'=>bcrypt('password'),
            'admin'=>1

        ]);
        Task::factory(10)->create([
            'taskCreator_id'=>User::factory(),
            'assigneduser_id'=>User::factory()

        ]);
        comment::factory(10)->create([

        ]);

    }
}
