<?php

namespace Controller;

class ShowList {
    public function get() 
    {
        session_start();
        $enrolment_number = $_SESSION["enrolment_number"];
        \Utils\Auth::userAuth();
        echo \View\Loader::make()->render("templates/checkoutList.twig", array(
            "list" => \Model\Post::get_list($enrolment_number),
        ));
    }
}