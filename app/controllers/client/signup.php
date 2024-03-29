<?php

namespace Controller;

class Signup {
    public function get()
    {
        echo \View\Loader::make()->render("signup.twig");
    }

    public function post() 
    {
        $username = $_POST["username"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        if ($password1 == $password2) {
        $rows = \Model\Post::signup_username($username, $password1, $password2);
          if ($rows) {
            echo "User already exists";
          } else {
            $rows2 = \Model\Post::signup_password($username, $password1, $password2);
                if ($rows2){
                    session_start();
                    $_SESSION["username"] = $username;
                    echo \View\Loader::make()->render("templates/dashboard.twig", array(
                    "books" => \Model\Post::get_books(),
                    ));
                }
            }
        } else {
            echo "Passwords don't match";
        }
    }        
}