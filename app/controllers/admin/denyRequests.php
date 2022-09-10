<?php

namespace Controller;

class DenyRequests {
    public function post() 
    {
        \Utils\Auth::adminAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        $enrolment_number = $_POST["enrolment_number"];
        $book_id = $_POST["book_id"];

        $rows = \Model\AdminPost::deny($enrolment_number, $book_id);
    }        
}