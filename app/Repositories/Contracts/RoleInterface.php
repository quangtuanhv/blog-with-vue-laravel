<?php

namespace App\Repositories\Contracts;

interface RoleInterface extends RepositoryInterface
{
    public function findRoleOrFail($roleNames, $roleType);

    public function getRoles($roleType);
}
