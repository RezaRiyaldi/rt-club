<?php

use Myth\Auth\Config\Auth as ConfigAuth;

class Auth extends ConfigAuth {
    public $views = [
        'login'           => 'auth/login',
        'register'        => 'auth/register',
        'forgot'          => 'Myth/Auth/Views/forgot',
        'reset'           => 'Myth/Auth/Views/reset',
        'emailForgot'     => 'Myth/Auth/Views/emails/forgot',
        'emailActivation' => 'Myth/Auth/Views/emails/activation',
    ];
}