<?php

namespace App\Core\Gard;

use App\Core\Abstract\Singleton;
use App\Core\Session;

class Auth extends Singleton{
    private Session $session;

    public function __construct()
    {
        $this->session = Session::getInstance();
    }
    // public function authGard(){
    //     if(!$this->session->get('user') ){
    //         header("location: " . $_ENV['WEB_ROOT'] . "/form");
    //     }
    // }

    public function __invoke()
    {
        if (!$this->session->get('user')) {
            header("Location: " . $_ENV['WEB_ROOT'] . "/form");
            exit;
        }
    }
}