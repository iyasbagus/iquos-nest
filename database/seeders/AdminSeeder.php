<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // Pastikan model User diimpor
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cek jika admin sudah ada, jika sudah maka tidak perlu menambah lagi
        if (User::where('email', 'admin@example.com')->doesntExist()) {
            // Membuat akun admin
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com', // Ganti dengan email admin yang diinginkan
                'password' => bcrypt('1'), // Ganti dengan password admin yang diinginkan
            ]);

            // Memberikan role admin ke akun ini
            $admin->assignRole('admin', 'creator');  // Pastikan role 'admin' sudah ada
        }
    }
}
