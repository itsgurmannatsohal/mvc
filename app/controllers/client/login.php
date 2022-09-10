<?php

namespace Controller;

class Login {
    public function get()
    {
        echo \View\Loader::make()->render("login.twig");
    }

    public function post() 
    {
        $enrolment_number = $_POST["enrolment_number"];
        $password = $_POST["password"];
        $rows = \Model\Post::login_enrolment_number($enrolment_number, $password);
        if ($rows) {
            $rows2 = \Model\Post::login_password($enrolment_number, $password);
            if ($rows2) {
            session_start();
            $_SESSION["enrolment_number"] = $enrolment_number;
            header("Location: /dashboard");
        } else {
            echo "Enrolment number or password is wrong";   
            }
        }
    }        
}