<?php

namespace Controller;

class Checkout {
    public function post() {
        \Utils\Auth::userAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $enrolment_number = $_SESSION["enrolment_number"];
        $book_id = $_POST["book_id"];
        $available = $_POST["available"];
        if ($available > 0){
        $rows = \Model\Post::request_out_select($enrolment_number, $book_id);
        if ($rows) {
            echo "Already requested";
        } else {
            $rows = \Model\Post::request_out_insert($enrolment_number, $book_id);
            if ($rows){
            header("Location: /dashboard/list");
        }
    }
    } else {
        echo "No books to check-out";
    }
}        
}