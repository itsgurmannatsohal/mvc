<?php

namespace Controller;

class acceptRequests {
    public function post() {
        \Utils\Auth::adminAuth();
        $_POST = json_decode(file_get_contents("php://input"), true);
        $enrolmentNumber = $_POST["enrolmentNumber"];
        $available = $_POST["available"];
        $bookID = $_POST["bookID"];
        $requestType = $_POST["requestType"];

        if ($requestType==7){
        $rows = \Model\Post::accept1A($available, $requestType, $enrolmentNumber, $bookID);
            if($rows){
                $rows = \Model\Post::accept1B($available, $requestType, $enrolmentNumber, $bookID);
                    if ($rows) {
                        $rows = \Model\Post::accept1C($available, $requestType, $enrolmentNumber, $bookID);
                    }
            }
        } else {
        $rows = \Model\Post::accept2A($available, $requestType, $enrolmentNumber, $bookID);
            if($rows){{
                $rows = \Model\Post::accept2B($available, $requestType, $enrolmentNumber, $bookID);
            }}
        }
    }        
}