<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/admin" => "\Controller\AdminLogin",
    "/admin/books" => "\Controller\GetBooks",
    "/admin/books/add" => "\Controller\AddBooks",
    "/admin/books/plus" => "\Controller\PlusBooks",
    "/admin/books/minus" => "\Controller\MinusBooks",
    "/admin/books/remove" => "\Controller\RemoveBook",
    "/admin/requests" => "\Controller\GetRequests",
    "/admin/requests/accept" => "\Controller\AcceptRequests",
    "/admin/requests/deny" => "\Controller\DenyRequests",
    
    "/signin" => "\Controller\Login",
    "/signin/signup" => "\Controller\Signup",
    "/signin/logout" => "\Controller\Logout",

    "/dashboard" => "\Controller\Dashboard",
    "/dashboard/list" => "\Controller\ShowList",
    "/dashboard/requestOut" => "\Controller\Checkout",
    "/dashboard/requestIn" => "\Controller\Checkin",
));
