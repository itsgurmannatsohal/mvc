<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/admin/books" => "\Controller\GetBooks",
    "/admin/books/add" => "\Controller\AddBooks",
    "/admin/books/one" => "\Controller\OneBooks",
    "/admin/books/remove" => "\Controller\RemoveBook",
    "/admin/requests" => "\Controller\GetRequests",
    "/admin/requests/resolve" => "\Controller\ResolveRequests",
    
    "/signin" => "\Controller\Login",
    "/signin/signup" => "\Controller\Signup",
    "/signin/logout" => "\Controller\Logout",

    "/dashboard" => "\Controller\Dashboard",
    "/dashboard/list" => "\Controller\ShowList",
    "/dashboard/request" => "\Controller\Request",
));
