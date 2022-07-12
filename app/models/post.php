<?php

namespace Model;

use Bcrypt\Bcrypt;

class Post {    

     public static function adminLogin($username, $pass)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        if ($rows) {
            if ($bcrypt->verify($pass, $rows[0]["pass"])) {
                session_start();
                $_SESSION["username"] = $username;
                //$_SESSION["role"] = $rows[0]["role"];
                return true;
            }
        }
        return false;
    }

    public static function get_books() {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public static function get_requests() {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public static function list($enrolmentNumber) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE enrolmentNumber = ?");
        $stmt->execute([$enrolmentNumber]);
        $row = $stmt->fetch();
        return $row;
    }

    // public static function create($caption) {
    //     $db = \DB::get_instance();
    //     $stmt = $db->prepare("INSERT INTO posts (caption) VALUES (?)");
    //     $stmt->execute([$caption]);
    // }


}
