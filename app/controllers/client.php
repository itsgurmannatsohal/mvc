<?php

namespace Controller;

class viewLogin {
    public function get()
    {
        echo \View\Loader::make()->render("login.twig");
    }
}

class viewDashboard {
    public function get() {
        echo \View\Loader::make()->render("templates/dashboard.twig", array(
            "books" => \Model\Post::get_books(),
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

class viewList {
    public function get() {
        echo \View\Loader::make()->render("templates/checkoutList.twig", array(
            "list" => \Model\Post::list($enrolmentNumber),
        ));
    }
}