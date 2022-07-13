<?php

namespace Controller;

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