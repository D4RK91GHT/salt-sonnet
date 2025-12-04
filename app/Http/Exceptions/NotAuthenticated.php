<?php

namespace App\Http\Exceptions;

use Exception;

class NotAuthenticated extends Exception
{
    public function render()
    {
        return redirect()->route('login');
    }
}