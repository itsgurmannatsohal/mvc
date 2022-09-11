<?php

namespace Controller;

class Request {
    public function post() 
    {
        \Utils\Auth::userAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $username = $_SESSION["username"];
        $book_id = $_POST["book_id"];
        $available = $_POST["available"];
        $bool = $_POST["bool"];

        if ($bool){
        $rows = \Model\Post::request_in_select($username, $book_id);
        if ($rows) {
            echo "Already requested";
        } else {
            $rows = \Model\Post::request_in_insert($username, $book_id);
            if ($rows){
            header("Location: /dashboard/list");
            }
        }
    } else {
        if ($available > 0) {
        $rows = \Model\Post::request_out_select($username, $book_id);
        if ($rows) {
            echo "Already requested";
        } else {
            $rows = \Model\Post::request_out_insert($username, $book_id);
            if ($rows) {
            header("Location: /dashboard/list");
            }
        }
    } else {
        echo "No books to check-out";
    }
    }
    }        
}