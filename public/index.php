<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/admin" => "\Controller\adminLogin",
    "/admin/books" => "\Controller\getBooks",
    "/admin/books/add" => "\Controller\addBooks",
    "/admin/books/plus" => "\Controller\plusBooks",
    "/admin/books/minus" => "\Controller\minusBooks",
    "/admin/requests" => "\Controller\getRequests",
    "/admin/requests/accept" => "\Controller\acceptRequests",
    "/admin/requests/deny" => "\Controller\denyRequests",
    
    "/signin" => "\Controller\login",
    "/signin/signup" => "\Controller\signup",
    "/signin/logout" => "\Controller\logout",

    "/dashboard" => "\Controller\dashboard",
    "/dashboard/list" => "\Controller\showList",
    "/dashboard/requestOut" => "\Controller\checkout",
    "/dashboard/requestIn" => "\Controller\checkin",
));
