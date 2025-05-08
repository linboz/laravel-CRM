<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'benson.cheng@bcnetcom.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('bc123123'),
            ]
        );

        // Create customer user
        $customer = User::firstOrCreate(
            ['email' => 'benson.cheng@bcnetcom.com'],
            [
                'name' => 'Test Customer',
                'password' => Hash::make('bc123123'),
            ]
        );

        // Assign admin role
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }

        // Assign customer role
        $customerRole = Role::where('name', 'customer')->first();
        if ($customerRole) {
            $customer->assignRole($customerRole);
        }
    }
}
