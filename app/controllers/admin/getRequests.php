<?php

namespace Controller;

class getRequests {
    public function get() {
        \Utils\Auth::adminAuth();
        echo \View\Loader::make()->render("templates/adminRequests.twig", array(
            "requests" => \Model\Post::get_requests(),
        ));
    }
}