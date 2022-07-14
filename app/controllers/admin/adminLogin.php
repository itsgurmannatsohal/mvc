<?php

namespace Controller;

class AdminLogin {
    public function get()
    {
        echo \View\Loader::make()->render("adminLogin.twig");
    }

    public function post() {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $rows = \Model\AdminPost::adminLogin($username, $password);
        if ($rows) {
            session_start();
            $_SESSION["username"] = $username;
            header("Location: /admin/books");
        } else {
            echo "username or password is wrong";   
        }
    }        
}