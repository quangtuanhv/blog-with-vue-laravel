<?php

namespace App\Http\Controllers\V1\Api\Auth;

use App\Models\User;
use App\Models\Role;
use App\Services\PassportService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Exceptions\Api\UnknowException;
use App\Exceptions\Api\NotFoundException;
use App\Repositories\Contracts\UserInterface;
use App\Http\Controllers\V1\Api\ApiController;

class AuthController extends ApiController
{
    protected $dataSelected = [
        'id',
        'name',
        'email',
        'avatar'
    ];

    public function __construct (UserInterface $userRepository)
    {
        parent::__construct($userRepository);
    }

    public function login(LoginRequest $request, PassportService $passport)
    {
        $data = $request->only('email', 'password');

        $user = $this->repository->select($this->dataSelected)->where('email', $data['email'])
            ->with(['roles' => function ($query) {
                $query->where('type', Role::TYPE_SYSTEM);
            }])
            ->first();

        if (!$user) {
            throw new NotFoundException('Not Found user');
        }

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => User::ACTIVE])) {
            throw new UnknowException('User not active or credential invalid');
        }

        return $this->getData(function () use ($passport, $data, $user) {
            $this->compacts['auth'] = $passport->requestGrantToken($data);
            $this->compacts['user'] = $user;
        });
    }

    public function logout()
    {
        if (!$this->user) {
            throw new UnknowException('Access token was invalid');
        }

        try {
            $this->user->token()->revoke();
        } catch (Exception $e) {
            return $this->responseFail();
        }

        return $this->trueJson();
    }
}
