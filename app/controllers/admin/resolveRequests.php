<?php

namespace Controller;

class ResolveRequests {
    public function post() 
    {
        \Utils\Auth::adminAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        $username = $_POST["username"];
        $available = $_POST["available"];
        $book_id = $_POST["book_id"];
        $request_type = $_POST["request_type"];
        $bool = $_POST["bool"];

        if ($bool){

        if ($request_type==7) {
        $rows = \Model\AdminPost::accept_in_books($available, $request_type, $username, $book_id);
            if($rows){
                $rows = \Model\AdminPost::accept_in_requests_1($available, $request_type, $username, $book_id);
                    if ($rows) {
                        $rows = \Model\AdminPost::accept_in_requests_2($available, $request_type, $username, $book_id);
                    }
            }
        } else {
        $rows = \Model\AdminPost::accept_out_books($available, $request_type, $username, $book_id);
            if ($rows) {
                $rows = \Model\AdminPost::accept_out_requests($available, $request_type, $username, $book_id);
            }
        }
    } else {
        $rows = \Model\AdminPost::deny($username, $book_id);
    }
    }        
}