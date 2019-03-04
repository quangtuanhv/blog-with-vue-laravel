<?php

namespace App\Http\Controllers\V1\Api\Auth;

use App\Models\Role;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\V1\Api\ApiController;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Contracts\RoleInterface;

class RegisterController extends ApiController
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserInterface $userRepository, RoleInterface $roleRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only('name', 'email', 'password', 'gender', 'birthday');

        return $this->doAction(function () use ($data) {
            $role = $this->roleRepository->findRoleOrFail(Role::ROLE_USER, Role::TYPE_SYSTEM);
            $this->compacts['infor'] = $this->userRepository->register($data, $role->id);
        });
    }
}
