<?php

namespace Controller;

class Dashboard {
    public function get() 
    {
        \Utils\Auth::auth();
        echo \View\Loader::make()->render("templates/dashboard.twig", array(
            "books" => \Model\Post::get_books(),
        ));
    }
}