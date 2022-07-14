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
        if ($_SESSION["enrolment_number"]) {
            return true;
        } else {
            header("Location: /signin");
            die();
        }
    }
}