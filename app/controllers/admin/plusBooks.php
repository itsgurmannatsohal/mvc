<?php

namespace Controller;

class PlusBooks {
    public function post() {
        \Utils\Auth::adminAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $copies = $_POST["copies"];
        $available = $_POST["available"];
        $book_id = $_POST["book_id"];
        $rows = \Model\AdminPost::plus_books($copies, $book_id, $available);
    }        
}