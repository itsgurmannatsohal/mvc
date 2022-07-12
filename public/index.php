<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/admin" => "\Controller\AdminLogin",
    "/admin/books" => "\Controller\Books",
    "/admin/books/add" => "\Controller\AddBooks",
    "/admin/books/plus" => "\Controller\plusBooks",
    "/admin/books/minus" => "\Controller\minusBooks",
    "/admin/requests" => "\Controller\Requests",
    "/admin/requests/accept" => "\Controller\accept",
    "/admin/requests/deny" => "\Controller\deny",
    
    "/signin" => "\Controller\Login",
    "/signin/signup" => "\Controller\Signup",
    "/signin/logout" => "\Controller\logout",

    "/dashboard" => "\Controller\Dashboard",
    "/dashboard/list" => "\Controller\showList",
    "/dashboard/requestOut" => "\Controller\out",
    "/dashboard/requestIn" => "\Controller\in",
));
