<?php

namespace Controller;

class RemoveBook {
    public function post() {
        \Utils\Auth::adminAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        $book_id = $_POST["book_id"];
        $rows = \Model\AdminPost::remove_book($book_id);
        if ($rows){
            echo "The book is checked out";
        } else {
            $rows_a = \Model\AdminPost::remove_book_del_req($book_id);
            if (true){
                $rows_b = \Model\AdminPost::remove_book_del_book($book_id);
            }
        }
    }        
}