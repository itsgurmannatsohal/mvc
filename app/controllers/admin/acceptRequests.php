<?php

namespace Controller;

class AcceptRequests {
    public function post() {
        \Utils\Auth::adminAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        $enrolment_number = $_POST["enrolment_number"];
        $available = $_POST["available"];
        $book_id = $_POST["book_id"];
        $request_type = $_POST["request_type"];

        if ($request_type==7){
        $rows = \Model\AdminPost::accept1A($available, $request_type, $enrolment_number, $book_id);
            if($rows){
                $rows = \Model\Post::accept1B($available, $request_type, $enrolment_number, $book_id);
                    if ($rows) {
                        $rows = \Model\AdminPost::accept1C($available, $request_type, $enrolment_number, $book_id);
                    }
            }
        } else {
        $rows = \Model\adminPost::accept2A($available, $request_type, $enrolment_number, $book_id);
            if($rows){{
                $rows = \Model\AdminPost::accept2B($available, $request_type, $enrolment_number, $book_id);
            }}
        }
    }        
}