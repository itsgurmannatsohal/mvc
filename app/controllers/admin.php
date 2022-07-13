<?php

namespace Controller;

class AdminLogin {
    public function get()
    {
        echo \View\Loader::make()->render("adminLogin.twig");
    }

    public function post() {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $rows = \Model\Post::adminLogin($username, $password);
        if ($rows) {
            session_start();
            $_SESSION["username"] = $username;
            header("Location: /admin/books");
        } else {
            echo "username or password is wrong";   
        }
    }        
}


class Books {
    public function get() {
        \Utils\Auth::adminAuth();
        echo \View\Loader::make()->render("templates/adminBooks.twig", array(
            "books" => \Model\Post::get_books(),
        ));
    }
}

class Requests {
    public function get() {
        \Utils\Auth::adminAuth();
        echo \View\Loader::make()->render("templates/adminRequests.twig", array(
            "requests" => \Model\Post::get_requests(),
        ));
    }
}

class AddBooks {
    public function get() {
        \Utils\Auth::adminAuth();
        echo \View\Loader::make()->render("addBooks.twig");
    }

    public function post() {
        \Utils\Auth::adminAuth();
        $bookName = $_POST["bookName"];
        $authorName = $_POST["authorName"];
        $copies = $_POST["copies"];

        $rows = \Model\Post::add_books($bookName, $authorName, $copies);
        if ($rows) {
            header("Location: /admin/books");
        }
    } 
}

class accept {
    public function post() {
        \Utils\Auth::adminAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        $enrolmentNumber = $_POST["enrolmentNumber"];
        $available = $_POST["available"];
        $bookID = $_POST["bookID"];
        $requestType = $_POST["requestType"];

        $rows = \Model\Post::accept($available, $requestType, $enrolmentNumber, $bookID);
    }        
}

class deny {
    public function post() {
        \Utils\Auth::adminAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        $enrolmentNumber = $_POST["enrolmentNumber"];
        $bookID = $_POST["bookID"];

        $rows = \Model\Post::deny($enrolmentNumber, $bookID);
    }        
}

class plusBooks {
    public function post() {
        \Utils\Auth::adminAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $copies = $_POST["copies"];
        $available = $_POST["available"];
        $bookID = $_POST["bookID"];
        $rows = \Model\Post::plus_books($copies, $bookID, $available);
    }        
}

class minusBooks {
    public function post() {
        \Utils\Auth::adminAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $copies = $_POST["copies"];
        $available = $_POST["available"];
        $bookID = $_POST["bookID"];
        $rows = \Model\Post::minus_books($copies, $bookID, $available);
    }        
}