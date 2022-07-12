<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/admin" => "\Controller\viewAdminLogin",
    //"/admin/post" => "\Controller\postAdminLogin",
    "/admin/books" => "\Controller\viewBooks",
    "/admin/books/add" => "\Controller\viewAddBooks",
    //"/admin/books/add/post" => "\Controller\postAddBooks",
    //"/admin/books/plus" => "\Controller\plusBooks",
    //"/admin/books/minus" => "\Controller\minusBooks",
    "/admin/requests" => "\Controller\viewRequests",
    //"/admin/requests/accept" => "\Controller\acceptRequests",
    //"/admin/requests/deny" => "\Controller\denyRequests",
    
    "/signin" => "\Controller\viewLogin",
    //postLogin
    "/signin/signup" => "\Controller\viewSignup",
    //postSignup
    "/signin/logout" => "\Controller\logout",

    "/dashboard" => "\Controller\viewDashboard",
    "/dashboard/list" => "\Controller\viewList",
    //"/dashboard/requestOut" => "\Controller\requestOut",
    //"/dashboard/requestIn" => "\Controller\requestIn",
));
