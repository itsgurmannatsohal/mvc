<?php

namespace Controller;

class login {
    public function get()
    {
        echo \View\Loader::make()->render("login.twig");
    }

    public function post() 
    {
        $enrolmentNumber = $_POST["enrolmentNumber"];
        $password = $_POST["password"];
        $rows = \Model\Post::loginA($enrolmentNumber, $password);
        if ($rows){
            $rows2 = \Model\Post::loginB($enrolmentNumber, $password);
            if ($rows2) {
            session_start();
            $_SESSION["enrolmentNumber"] = $enrolmentNumber;
            header("Location: /dashboard");
        } else {
            echo "Enrolment number or password is wrong";   
        }
        }

        
    }        
}