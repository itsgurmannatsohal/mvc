<?php

namespace Model;

use Bcrypt\Bcrypt;

class Post {    

    public static function loginA($enrolment_number, $password)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE enrolmentNumber = ?");
        $stmt->execute([$enrolment_number]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function loginB($enrolment_number, $password)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE enrolmentNumber = ?");
        $stmt->execute([$enrolment_number]);
        $rows = $stmt->fetchAll();
    
        $verify = $bcrypt->verify($password, $rows[0]["password"]);
        return $verify;
    }

    public static function signupA($enrolment_number, $password1, $password2)
    {   
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE enrolmentNumber = ?");
        $stmt->execute([$enrolment_number]);
        $row = $stmt->fetchAll();
        return $row;
    }

    public static function signupB($enrolment_number, $password1, $password2)
    {
        $db = \DB::get_instance();
        $bcrypt = new Bcrypt();
        $bcrypt_version = '2a';
        $hash = $bcrypt->encrypt($password1, $bcrypt_version);
        $stmt = $db->prepare("INSERT INTO users (enrolmentNumber, password) VALUES (?, ?)");
        $stmt->execute([$enrolment_number, $hash]);
        return true;  
    }

        public static function get_books() {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public static function get_list($enrolment_number) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT books.id, books.name, books.author FROM books INNER JOIN requests ON books.id= requests.id WHERE requests.status = 1 AND requests.enrolmentNumber= ? AND type = 9;");
        $stmt->execute([$enrolment_number]);
        $row = $stmt->fetchAll();
        return $row;
    }

   public static function request_inA($enrolment_number, $book_id) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE Id = ? AND enrolmentNumber = ? AND status = 2 AND type = 7;");
        $stmt->execute([$book_id, $enrolment_number]);
        $row = $stmt->fetchAll();        
        return $row;
    }

    public static function request_inB($enrolment_number, $book_id) {
 
            $db = \DB::get_instance();
            $stmt = $db->prepare("INSERT INTO requests (id, enrolmentNumber, type, status, req) VALUES (
                ?, ?, 7, 2, 'Check-in');");
            $stmt->execute([$book_id, $enrolment_number]);
            $row = $stmt->fetchAll();
            return $row;
    }

    public static function request_outA($enrolment_number, $book_id) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE Id = ? AND enrolmentNumber = ? AND status = 2 AND type = 9;");
        $stmt->execute([$book_id, $enrolment_number]);
        $row = $stmt->fetch();
    }

    public static function request_outB($enrolment_number, $book_id)
    {
            $db = \DB::get_instance();
            $stmt = $db->prepare("INSERT INTO requests (id, enrolmentNumber, type, status, req) VALUES (
                ?, ?, 9, 2, 'Check-out');");
            $stmt->execute([$book_id, $enrolment_number]);
            $row = $stmt->fetchAll();
            return $row; 
    }

 }
