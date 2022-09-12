<?php

namespace Controller;

class OneBooks {
    public function post() 
    {
        \Utils\Auth::auth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $copies = $_POST["copies"];
        $available = $_POST["available"];
        $book_id = $_POST["book_id"];
        $bool = $_POST["bool"];

        if ($bool){
        $rows = \Model\AdminPost::plus_books($copies, $book_id, $available);
        } else {
        $rows = \Model\AdminPost::minus_books($copies, $book_id, $available);
        }
    }        
}