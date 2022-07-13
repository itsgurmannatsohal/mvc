<?php

namespace Controller;

class checkin {
    public function post() {
        \Utils\Auth::userAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $enrolmentNumber = $_SESSION["enrolmentNumber"];
        $bookID = $_POST["bookID"];
        $rows = \Model\Post::request_inA($enrolmentNumber, $bookID);
        if ($rows) {
            echo "Already requested";
        } else {
            $rows = \Model\Post::request_inB($enrolmentNumber, $bookID);
            if ($rows){
             header("Location: /dashboard/list");
        }
    }
    }        
}