<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\RoleInterface;
use App\Exceptions\Api\NotFoundException;

class RoleRepository extends BaseRepository implements RoleInterface
{
    public function model()
    {
        return Role::class;
    }

    public function findRoleOrFail($roleNames, $roleType)
    {
        $roleNames = is_array($roleNames) ? $roleNames : [$roleNames];

        $roles = $this->where('type', $roleType);

        if ($roleNames != ['*']) {
            $roles = $roles->whereIn('name', $roleNames);
        }

        if (count($roleNames) == 1) {
            $roles = $roles->first();

            if (is_null($roles)) {
                throw new NotFoundException('Role' . $roleNames[0] . 'not exists in system');
            }
        } else {
            $roles = $roles->get();

            if ($roles->isEmpty()) {
                throw new NotFoundException('Roles' . implode(',', $roleNames) . 'not exists in system');
            }
        }

        return $roles;
    }

    public function getRoles($roleType)
    {
        return $this->where('type', $roleType)->get();
    }
}
