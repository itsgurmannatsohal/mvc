<?php

namespace Utils;

class Auth
{
    public static function adminAuth()
    {
        session_start();
        if ($_SESSION["username"]) {
            return true;
        } else {
            header("Location: /signin");
            die();
        }
    }
    public static function userAuth()
    {
        session_start();
        if ($_SESSION["enrolmentNumber"]) {
            return true;
        } else {
            header("Location: /signin");
            die();
        }
    }
}