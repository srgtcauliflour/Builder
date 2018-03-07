<?php

namespace App\Service;

use Core\Helper;
use Core\Connection;

class Auth
{
    private $users;
    private $tokenLength;

    public function __construct()
    {
        $this->users = Connection::get()->table('users');
        $this->tokenLength = 12;
    }

    public function signup($data)
    { 
        $this->users->insert([
            'token' => $this->generateToken(),
        ]);
    }

    public function login()
    {
        # code...
    }

    public function sendResetCode()
    {
        # code...
    }

    public function createRole($data)
    {
        $data['type'] = 'role';
        return (new Type())-create($data);
    }

    public function generateToken()
    {
        $token = Helper::randomString($this->tokenLength);

        if ($this->tokenExists($token))
        {
            $this->generateToken();
        }
        else
        {
            return $token;
        }
    }

    public function tokenExists($token)
    {
        $count = $this->users->where('token', '=', $token)->count();
        return ($count > 0) ? true : false;
    }

    public function emailExists($email)
    {
        $count = $this->users->where('email', '=', $email)->count();
        return ($count > 0) ? true : false;
    }

}
