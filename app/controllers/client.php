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
        //$_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $enrolmentNumber = $_POST["enrolmentNumber"];
        $password = $_POST["password"];
        $rows = \Model\Post::login($enrolmentNumber, $password);
        if (true) {
            session_start();
            $_SESSION["enrolmentNumber"] = $enrolmentNumber;
            echo \View\Loader::make()->render("templates/dashboard.twig", array(
            "books" => \Model\Post::get_books(),
        ));
        } else {
            echo "Enrolment number or password is wrong";   
        }
    }        
}

class Dashboard {
    public function get() {
        \Utils\Auth::userAuth();
        echo \View\Loader::make()->render("templates/dashboard.twig", array(
            "books" => \Model\Post::get_books(),
        ));
    }
}

class showList {
    public function get() {
        session_start();
        $enrolmentNumber = $_GET["enrolmentNumber"];
        \Utils\Auth::userAuth();
        echo \View\Loader::make()->render("templates/checkoutList.twig", array(
            "list" => \Model\Post::get_list($enrolmentNumber),
        ));
    }
}

class in {
    public function post() {
        \Utils\Auth::userAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $enrolmentNumber = $_SESSION["enrolmentNumber"];
        $bookID = $_POST["bookID"];
        $rows = \Model\Post::request_in($enrolmentNumber, $bookID);
        if ($rows) {
            echo \View\Loader::make()->render("templates/checkoutList.twig", array(
            "list" => \Model\Post::get_list($enrolmentNumber),
        ));
        } 
    }        
}

class out {
    public function post() {
        \Utils\Auth::userAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $enrolmentNumber = $_SESSION["enrolmentNumber"];
        $bookID = $_POST["bookID"];
        $rows = \Model\Post::request_out($enrolmentNumber, $bookID);
        if ($rows) {
            echo \View\Loader::make()->render("templates/checkoutList.twig", array(
            "list" => \Model\Post::get_list($enrolmentNumber),
        ));
        } 
    }        
}

class logout {
    public function get()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /signin");
        die();
    }
}
