<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Akun Admin BPBD Tetap untuk Pengujian
        User::updateOrCreate(
            ['email' => 'admin.bpbd@bandungkab.go.id'],
            [
                'name' => 'Admin BPBD Kabupaten Bandung',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // Akun Admin alternatif yang umum di modul (admin@example.com)
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Petugas BPBD Demo',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Minimal 5 Akun Petugas Dummy Menggunakan Faker (locale id_ID)
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
