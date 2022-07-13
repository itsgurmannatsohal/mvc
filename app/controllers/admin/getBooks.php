<?php

namespace Controller;

class getBooks {
    public function get() {
        \Utils\Auth::adminAuth();
        echo \View\Loader::make()->render("templates/adminBooks.twig", array(
            "books" => \Model\Post::get_books(),
        ));
    }
}