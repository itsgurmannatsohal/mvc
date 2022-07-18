<?php

namespace Controller;

class Checkin {
    public function post() {
        \Utils\Auth::userAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $enrolment_number = $_SESSION["enrolment_number"];
        $book_id = $_POST["book_id"];
        $rows = \Model\Post::request_in_select($enrolment_number, $book_id);
        if ($rows) {
            echo "Already requested";
        } else {
            $rows = \Model\Post::request_in_insert($enrolment_number, $book_id);
            if ($rows){
             header("Location: /dashboard/list");
        }
    }
    }        
}