<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);

        $admin = User::factory()->create([
            'name' => 'Fany Theodore',
            'email' => 'fany@owner.com',
            'password' => '123456'
        ]);

        $admin->assignRole($adminRole);

        Product::factory()->create();
    }
}
