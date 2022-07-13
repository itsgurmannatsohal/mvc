<?php

namespace Controller;

class dashboard {
    public function get() {
        \Utils\Auth::userAuth();
        echo \View\Loader::make()->render("templates/dashboard.twig", array(
            "books" => \Model\Post::get_books(),
        ));
    }
}