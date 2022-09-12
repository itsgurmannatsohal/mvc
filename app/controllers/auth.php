<?php

namespace Utils;

class Auth
{
    public static function auth()
    {
        session_start();
        if ($_SESSION["username"]) {
            return true;
        } else {
            header("Location: /signin");
            die();
        }
    }
}