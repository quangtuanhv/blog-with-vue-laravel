<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        \DB::table('role_user')->truncate();

        // Create user admin and set role for admin
        $idRoleAdmin = Role::ofRole(Role::TYPE_SYSTEM, Role::ROLE_ADMIN)->get();

        factory(User::class)
            ->states(Role::ROLE_ADMIN)
            ->create()
            ->roles()
            ->attach($idRoleAdmin);

        factory(User::class, 20)->create()->each(function ($user) {
            $idRoleUser = Role::ofRole(Role::TYPE_SYSTEM, Role::ROLE_USER)->get();
            $userIds = User::where('id', '<>', $user->id)->pluck('id')->toArray();
            $user->roles()->attach($idRoleUser);
        });
    }

}
