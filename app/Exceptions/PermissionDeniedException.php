<?php

namespace App\Exceptions;

use Exception;

class PermissionDeniedException extends Exception
{
    public function render($request)
    {

        //Remove Session
        request()->session()->forget('bearer_token');

        //Remove User Role
        request()->session()->forget('user_role');

        return redirect('/login')->with('error', 'Permission Denied.');
    }
}
