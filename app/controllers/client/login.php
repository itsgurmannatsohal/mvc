<?php

namespace Controller;

class Login {
    public function get()
    {
        echo \View\Loader::make()->render("login.twig");
    }

    public function post() 
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

    $rows = \Model\AdminPost::admin_role($username);
    if ($rows){
        
        $rows = \Model\AdminPost::admin_login($username, $password);
        if ($rows) {
            session_start();
            $_SESSION["username"] = $username;
            header("Location: /admin/books");
        } else {
        echo "Username or password is wrong";
        }   
    } else {
    $rows = \Model\Post::login_enrolment_number($username, $password);
        if ($rows) {
            $rows = \Model\Post::login_password($username, $password);
            if ($rows) {  
            session_start();
            $_SESSION["username"] = $username;
            header("Location: /dashboard");
    }   else {
            echo "Username or password is wrong";   
            }     
}
}}}