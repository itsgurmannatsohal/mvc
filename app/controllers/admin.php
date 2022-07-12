<?php

namespace Controller;

class viewAdminLogin {
    public function get()
    {
        echo \View\Loader::make()->render("adminLogin.twig");
    }

    public function post() {
        $username = $_POST["username"];
        $password = $_POST["password"];
        if(/*no admin in db*/){
            echo "Admin doesn't exist"
        };
        else {
            if(/*password matches*/){
            //make session
            //execute func adminLogin
            echo \View\Loader::make()->render("templates/adminBooks.twig", array(
            "books" => \Model\Post::get_books(),
        ));
            }
            else {
                echo "Incorrect username or password"
            }
        }        
    }
}

class viewBooks {
    public function get() {
        echo \View\Loader::make()->render("templates/adminBooks.twig", array(
            "books" => \Model\Post::get_books(),
        ));
    }
}

class viewRequests {
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