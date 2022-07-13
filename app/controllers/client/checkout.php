<?php

namespace Controller;

class checkout {
    public function post() {
        \Utils\Auth::userAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        session_start();
        $enrolmentNumber = $_SESSION["enrolmentNumber"];
        $bookID = $_POST["bookID"];
        $available = $_POST["available"];
        $rows = \Model\Post::request_outA($enrolmentNumber, $bookID);
        if ($rows) {
            echo "Already requested";
        } else {
            $rows = \Model\Post::request_outB($enrolmentNumber, $bookID);
            if ($rows){
            header("Location: /dashboard/list");
        }
    }
    }        
}