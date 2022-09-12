<?php

namespace Controller;

class GetRequests {
    public function get() 
    {
        \Utils\Auth::auth();
        echo \View\Loader::make()->render("templates/adminRequests.twig", array(
            "requests" => \Model\AdminPost::get_requests(),
        ));
    }
}