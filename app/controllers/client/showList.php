<?php

namespace Controller;

class ShowList {
    public function get() 
    {
        session_start();
        $username = $_SESSION["username"];
        \Utils\Auth::userAuth();
        echo \View\Loader::make()->render("templates/checkoutList.twig", array(
            "list" => \Model\Post::get_list($username),
        ));
    }
}