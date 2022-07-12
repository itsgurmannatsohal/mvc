<?php

namespace Controller;

class Signup {
    public function get()
    {
        echo \View\Loader::make()->render("signup.twig");
    }

        public function post() {
        $enrolmentNumber = $_POST["enrolmentNumber"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        $rows = \Model\Post::signup($enrolmentNumber, $password1, $password2);
        if ($rows) {
            session_start();
            $_SESSION["enrolmentNumber"] = $enrolmentNumber;
            echo \View\Loader::make()->render("templates/dashboard.twig", array(
            "books" => \Model\Post::get_books(),
        ));
        } else {
            echo "enrolmentNumber or password is wrong";   
        }
    }        
}

class Login {
    public function get()
    {
        echo \View\Loader::make()->render("login.twig");
    }

    public function post() 
    {
        $enrolmentNumber = $_POST["enrolmentNumber"];
        $password = $_POST["password"];
        $rows = \Model\Post::login($enrolmentNumber, $password);
        if ($rows) {
            session_start();
            $_SESSION["enrolmentNumber"] = $enrolmentNumber;
            echo \View\Loader::make()->render("templates/dashboard.twig", array(
            "books" => \Model\Post::get_books(),
        ));
        } else {
            echo "enrolmentNumber or password is wrong";   
        }
    }        
}

class Dashboard {
    public function get() {
        echo \View\Loader::make()->render("templates/dashboard.twig", array(
            "books" => \Model\Post::get_books(),
        ));
    }
}

class showList {
    public function get() {
        echo \View\Loader::make()->render("templates/checkoutList.twig", array(
            "list" => \Model\Post::get_list($enrolmentNumber),
        ));
    }
}

// class requestIn {
//     public function post() 
//     {
//         $enrolmentNumber = $_POST["enrolmentNumber"];
//         $bookID = $_POST["bookID"];
//         $rows = \Model\Post::requestIn($enrolmentNumber, $bookID);
//         if ($rows) {
//             session_start();
//             $_SESSION["enrolmentNumber"] = $enrolmentNumber;
//             echo \View\Loader::make()->render("templates/dashboard.twig", array(
//             "books" => \Model\Post::request_in(),
//         ));
//         } else {
//             echo "enrolmentNumber or password is wrong";   
//         }
//     }        
// }