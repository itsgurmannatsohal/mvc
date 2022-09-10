<?php

namespace Controller;

class GetBooks {
    public function get() 
    {
        \Utils\Auth::adminAuth();
        echo \View\Loader::make()->render("templates/adminBooks.twig", array(
            "books" => \Model\AdminPost::get_books(),
        ));
    }
}