<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserInterface;
use Exception;
use Facades\ {
    App\Services\PassportService
};

class UserController extends FrontendController
{
    public function __construct(UserInterface $userRepository)
    {
        parent::__construct($userRepository);
    }

    public function index()
    {
        $this->view = null;

        return $this->viewRender();
    }

    public function active($tokenConfirm)
    {
        try {
            $user = $this->repository->active($tokenConfirm);

            if (!$user) {
                throw new Exception();
            }

            return redirect('/')->with('access_token', PassportService::getTokenByUser($user));
        } catch (Exception $e) {
            return redirect('/');
        }
    }
}
