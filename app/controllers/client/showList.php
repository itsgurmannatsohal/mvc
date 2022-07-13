<?php

namespace Controller;

class showList {
    public function get() {
        session_start();
        $enrolmentNumber = $_SESSION["enrolmentNumber"];
        \Utils\Auth::userAuth();
        echo \View\Loader::make()->render("templates/checkoutList.twig", array(
            "list" => \Model\Post::get_list($enrolmentNumber),
        ));
    }
}