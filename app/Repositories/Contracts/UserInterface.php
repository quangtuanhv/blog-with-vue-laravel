<?php

namespace App\Repositories\Contracts;

interface UserInterface extends RepositoryInterface
{
    public function active($token);

    public function register($inputs, $roleId);
}
