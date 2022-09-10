<?php

namespace Controller;

class GetRequests {
    public function get() 
    {
        \Utils\Auth::adminAuth();
        echo \View\Loader::make()->render("templates/adminRequests.twig", array(
            "requests" => \Model\AdminPost::get_requests(),
        ));
    }
}