<?php

namespace Database\Seeders;

use App\Enums\Role\RoleEnum;
use App\Models\Param;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = [
            'name' => 'user',
            'email' => 'user@mail.ru',
            'password' => Hash::make(12345678)
        ];

        $user2 = User::firstOrCreate([
            'email' => $user['email'],
        ], $user);

        $role = Role::firstOrCreate(['title' => RoleEnum::ADMIN->value]);
        $user2->roles()->sync($role->id);
        $param = [
            'title' => 'Размер',
            'filter_type' => 3
        ];
        $param2 = [
            'title' => 'Цвет',
            'filter_type' => 3
        ];
        $param3 = [
            'title' => 'Материал',
            'filter_type' => 3
        ];
        $param4 = [
            'title' => 'Рост',
            'filter_type' => 1
        ];
        
        Param::firstOrCreate($param);
        Param::firstOrCreate($param2);
        Param::firstOrCreate($param3);
        Param::firstOrCreate($param4);
    }
}
