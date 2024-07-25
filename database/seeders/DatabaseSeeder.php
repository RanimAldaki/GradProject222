<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

<<<<<<< HEAD

=======
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(StatusSeeder::class);
<<<<<<< HEAD
        $this->call(DeviceSeeder::class);
=======
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
    }
}
