<?php

namespace App\Http\Controllers\V1\Api\Auth;

use Illuminate\Http\Request;
use App\Exceptions\Api\UnknowException;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\V1\Api\ApiController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends ApiController
{
    use SendsPasswordResetEmails;

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $this->doAction(function () use ($response) {
            $this->linkResponse($response);
        });
    }

    protected function linkResponse($response)
    {
        $message = trans($response);

        if ($response == Password::INVALID_USER) {
            throw new UnknowException($message);
        }

        $this->compacts['message'] = trans($message);
    }
}
