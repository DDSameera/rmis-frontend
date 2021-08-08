<?php

namespace App\Exceptions;

use Exception;


class TokenExpireException extends Exception
{
    public function render($request)
    {

        //Remove Session
        request()->session()->forget('bearer_token');

        return redirect('/login')->with('error', 'Token Expired. Please login');
    }
}
