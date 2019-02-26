<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        $roles = [
            'admin',
            'user',
            'owner',
            'moderator',
            'member',
            'blocked',
        ];

        foreach ($roles as $value) {
            factory(Role::class)->create([
                'name' => $value,
                'type' => (in_array($value, ['admin', 'user'])) ? 1 : 2,
            ]);
        }
    }
}
