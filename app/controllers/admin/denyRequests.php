<?php

namespace Controller;

class denyRequests {
    public function post() {
        \Utils\Auth::adminAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        $enrolmentNumber = $_POST["enrolmentNumber"];
        $bookID = $_POST["bookID"];

        $rows = \Model\Post::deny($enrolmentNumber, $bookID);
    }        
}