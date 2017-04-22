<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/web/car/getuserinfo',
        '/web/car/saveuserinfo',
        '/web/car/login',
        '/web/car/register',
        '/web/car/savepassword',
        '/web/car/resetpassword',
        '/web/car/checkversion',

        '/web/express/index',
    ];
}
