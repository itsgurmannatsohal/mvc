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
        $rows = \Model\Post::adminLogin($username, $password);
        if ($rows) {
            session_start();
            $_SESSION["username"] = $username;
            echo \View\Loader::make()->render("templates/adminBooks.twig", array(
            "books" => \Model\Post::get_books(),
        ));
        } else {
            echo "username or password is wrong";   
        }
    }        
}


class Books {
    public function get() {
        echo \View\Loader::make()->render("templates/adminBooks.twig", array(
            "books" => \Model\Post::get_books(),
        ));
    }
}

class Requests {
    public function get() {
        echo \View\Loader::make()->render("templates/adminRequests.twig", array(
            "requests" => \Model\Post::get_requests(),
        ));
    }

    // public function post() {
    //     $caption = $_POST["caption"];
    //     \Model\Post::create($caption);
    //     echo \View\Loader::make()->render("templates/home.twig", array(
    //         "posts" => \Model\Post::get_all(),
    //         "posted" => true,
    //     ));
    // }
}