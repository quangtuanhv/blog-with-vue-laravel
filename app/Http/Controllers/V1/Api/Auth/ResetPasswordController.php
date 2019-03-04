<?php

namespace App\Http\Controllers\V1\Api\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exceptions\Api\UnknowException;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\V1\Api\ApiController;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class ResetPasswordController extends ApiController
{
    use ResetsPasswords;

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $this->doAction(function () use ($response) {
            if ($response != Password::PASSWORD_RESET) {
                throw new UnknowException(trans($response));
            }

            $this->compacts['message'] = trans($response);
        });
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => $password,
            'remember_token' => Str::random(60),
        ])->save();
    }
}
