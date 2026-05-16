<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF');

        $this->call([
            UserSeeder::class,
            PickupLocationSeeder::class,
            VehicleSeeder::class,
            BookingSeeder::class,
        ]);

        DB::statement('PRAGMA foreign_keys = ON');
    }
}
