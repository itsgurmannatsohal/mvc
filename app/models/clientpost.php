<?php

namespace Model;

use Bcrypt\Bcrypt;

class Post {    

    public static function login_enrolment_number($username, $password)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM creds WHERE username = ?");
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function login_password($username, $password)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM creds WHERE username = ?");
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
    
        $verify = $bcrypt->verify($password, $rows[0]["password"]);
        return $verify;
    }

    public static function signup_username($username, $password1, $password2)
    {   
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM creds WHERE username = ?");
        $stmt->execute([$username]);
        $row = $stmt->fetchAll();
        return $row;
    }

    public static function signup_password($username, $password1, $password2)
    {
        $db = \DB::get_instance();
        $bcrypt = new Bcrypt();
        $bcrypt_version = '2a';
        $hash = $bcrypt->encrypt($password1, $bcrypt_version);
        $stmt = $db->prepare("INSERT INTO creds (username, password, role) VALUES (?, ?, 0)");
        $stmt->execute([$username, $hash]);
        return true;  
    }

        public static function get_books() 
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public static function get_list($username) 
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT books.id, books.name, books.author FROM books INNER JOIN requests ON books.id= requests.id WHERE requests.status = 1 AND requests.username= ? AND type = 9;");
        $stmt->execute([$username]);
        $row = $stmt->fetchAll();
        return $row;
    }

   public static function request_in_select($username, $book_id) 
   {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE Id = ? AND username = ? AND status = 2 AND type = 7;");
        $stmt->execute([$book_id, $username]);
        $row = $stmt->fetchAll();        
        return $row;
    }

    public static function request_in_insert($username, $book_id) 
    {
 
            $db = \DB::get_instance();
            $stmt = $db->prepare("INSERT INTO requests (id, username, type, status, req) VALUES (
                ?, ?, 7, 2, 'Check-in');");
            $stmt->execute([$book_id, $username]);
            $row = $stmt->fetchAll();
            return $row;
    }

    public static function request_out_select($username, $book_id) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE Id = ? AND username = ? AND status = 2 AND type = 9;");
        $stmt->execute([$book_id, $username]);
        $row = $stmt->fetch();
        return $row;
    }

    public static function request_out_insert($username, $book_id)
    {
            $db = \DB::get_instance();
            $stmt = $db->prepare("INSERT INTO requests (id, username, type, status, req) VALUES (
                ?, ?, 9, 2, 'Check-out');");
            $stmt->execute([$book_id, $username]);
            $row = $stmt->fetchAll();
            return $row; 
    }

 }
