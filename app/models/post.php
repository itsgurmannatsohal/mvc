<?php

namespace Model;

use Bcrypt\Bcrypt;

class Post {    

     public static function adminLogin($username, $password)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        if ($rows) {
            if ($bcrypt->verify($password, $rows[0]["password"])) {
                return $rows;
            }
        }
        return false;
    }

      public static function login($enrolmentNumber, $password)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE enrolmentNumber = ?");
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        if ($rows) {
            if ($bcrypt->verify($password, $rows[0]["password"])) {
            }
        }
        return false;
    }

       public static function signup($enrolmentNumber, $password1, $password2)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO users (enrolmentNumber, password) VALUES (?, ?)");
        $stmt->execute([$enrolmentNumber, $password]);
        $rows = $stmt->fetchAll();
        if ($rows) {
            if ($bcrypt->verify($password, $rows[0]["password"])) {
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
    
    public static function get_list($enrolmentNumber) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE enrolmentNumber = ?");
        $stmt->execute([$enrolmentNumber]);
        $row = $stmt->fetch();
        return $row;
    }

}
