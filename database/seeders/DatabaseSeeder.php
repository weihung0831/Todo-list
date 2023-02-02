<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $count = 1;
        while ($count > 0) {
            Todo::create([
                'id' => $count,
                'title' => 'Test',
                'is_completed' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $count++;
        }
    }
}