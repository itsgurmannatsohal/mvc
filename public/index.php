<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/admin" => "\Controller1\AdminLogin",
    "/admin/books" => "\Controller1\Books",
    "/admin/books/add" => "\Controller1\AddBooks",
    //"/admin/books/plus" => "\Controller\plusBooks",
    //"/admin/books/minus" => "\Controller\minusBooks",
    "/admin/requests" => "\Controller1\Requests",
    //"/admin/requests/accept" => "\Controller\acceptRequests",
    //"/admin/requests/deny" => "\Controller\denyRequests",
    
    "/signin" => "\Controller\Login",
    "/signin/signup" => "\Controller\Signup",
    "/signin/logout" => "\Controller\logout",

    "/dashboard" => "\Controller\Dashboard",
    "/dashboard/list" => "\Controller\showList",
    //"/dashboard/requestOut" => "\Controller\requestOut",
    //"/dashboard/requestIn" => "\Controller\requestIn",
));
