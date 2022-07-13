<?php

namespace Model;

use Bcrypt\Bcrypt;

class Post {    

    public static function adminLogin($username, $password)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
        $rows = $stmt->fetchAll();
        return $rows;
        
    }

    public static function loginA($enrolmentNumber, $password)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE enrolmentNumber = ?");
        $stmt->execute([$enrolmentNumber]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function loginB($enrolmentNumber, $password)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE enrolmentNumber = ?");
        $stmt->execute([$enrolmentNumber]);
        $rows = $stmt->fetchAll();
    
        $verify = $bcrypt->verify($password, $rows[0]["password"]);
        return $verify;
    }

    public static function signupA($enrolmentNumber, $password1, $password2)
    {   
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE enrolmentNumber = ?");
        $stmt->execute([$enrolmentNumber]);
        $row = $stmt->fetchAll();
        return $row;
    }

    public static function signupB($enrolmentNumber, $password1, $password2)
    {
        $db = \DB::get_instance();
        $bcrypt = new Bcrypt();
        $bcrypt_version = '2a';
        $hash = $bcrypt->encrypt($password1, $bcrypt_version);
        $stmt = $db->prepare("INSERT INTO users (enrolmentNumber, password) VALUES (?, ?)");
        $stmt->execute([$enrolmentNumber, $hash]);
        return true;  
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
        $stmt = $db->prepare("SELECT books.id, books.name, books.author, requests.enrolmentNumber, requests.req, requests.type, requests.status, books.available FROM books INNER JOIN requests ON books.id= requests.id WHERE requests.status = 2;");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public static function get_list($enrolmentNumber) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT books.id, books.name, books.author FROM books INNER JOIN requests ON books.id= requests.id WHERE requests.status = 1 AND requests.enrolmentNumber= ? AND type = 9;");
        $stmt->execute([$enrolmentNumber]);
        $row = $stmt->fetchAll();
        return $row;
    }

    public static function request_inA($enrolmentNumber, $bookID) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE Id = ? AND enrolmentNumber = ? AND status = 2 AND type = 7;");
        $stmt->execute([$bookID, $enrolmentNumber]);
        $row = $stmt->fetchAll();        
        return $row;
    }

    public static function request_inB($enrolmentNumber, $bookID) {
 
            $db = \DB::get_instance();
            $stmt = $db->prepare("INSERT INTO requests (id, enrolmentNumber, type, status, req) VALUES (
                ?, ?, 7, 2, 'Check-in');");
            $stmt->execute([$bookID, $enrolmentNumber]);
            $row = $stmt->fetchAll();
            return $row;
    }

    public static function request_outA($enrolmentNumber, $bookID) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE Id = ? AND enrolmentNumber = ? AND status = 2 AND type = 9;");
        $stmt->execute([$bookID, $enrolmentNumber]);
        $row = $stmt->fetch();
    }

    public static function request_outB($enrolmentNumber, $bookID)
    {
            $db = \DB::get_instance();
            $stmt = $db->prepare("INSERT INTO requests (id, enrolmentNumber, type, status, req) VALUES (
                ?, ?, 9, 2, 'Check-out');");
            $stmt->execute([$bookID, $enrolmentNumber]);
            $row = $stmt->fetchAll();
            return $row; 
    }

    public static function accept1A($available, $requestType, $enrolmentNumber, $bookID) {

        $available += 1;
            
        $db = \DB::get_instance();
        $stmt1 = $db->prepare("UPDATE books SET available = ? WHERE id = ? ;");
        $stmt1 ->execute([$available, $bookID]);
        return true;  
    }

    public static function accept1B($available, $requestType, $enrolmentNumber, $bookID) {
            
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("UPDATE requests SET status = 1 WHERE id = ? AND enrolmentNumber = ? AND type = ?;");
        $stmt2 ->execute([$bookID, $enrolmentNumber, $requestType]);
        return true;  
    }

    public static function accept1C($available, $requestType, $enrolmentNumber, $bookID) {
            
        $db = \DB::get_instance();
        $stmt3 = $db->prepare("UPDATE requests SET type = 7 WHERE status = 1 AND enrolmentNumber= ? AND type = 9;");
        $stmt3 ->execute([$enrolmentNumber]);
        return true;  
    }

    public static function accept2A($available, $requestType, $enrolmentNumber, $bookID) {

        $available -= 1;

        $db = \DB::get_instance();
        $stmt1 = $db->prepare("UPDATE books SET enrolmentNumber= ?, available= ? WHERE id = ?;");
        $stmt1 ->execute([$enrolmentNumber, $available, $bookID]);
        return true;
     }

    public static function accept2B($available, $requestType, $enrolmentNumber, $bookID) {

        $db = \DB::get_instance();
        $stmt2 = $db->prepare("UPDATE requests SET status = 1 WHERE id = ? AND enrolmentNumber = ? AND type= ?;");
        $stmt2 ->execute([$bookID, $enrolmentNumber, $requestType]);
        return true;
     }

    public static function deny($enrolmentNumber, $bookID) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE requests SET status = 0 WHERE id = ? AND enrolmentNumber = ?;");
        $stmt->execute([$bookID, $enrolmentNumber]);
        $row = $stmt->fetchAll();
        return $row;
    }

    public static function add_books($bookName, $authorName, $copies) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO books (name, author, copies, available) VALUES (?, ?, ?, ?);");
        $stmt->execute([$bookName, $authorName, $copies, $copies]);
        return true;
    }

    public static function plus_books($copies, $bookID, $available) {
            $copies += 1;
            $available += 1;
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE books SET copies = ?, available = ? WHERE id = ?;");
        $stmt->execute([$copies, $available, $bookID]);
        return true;
    }

    public static function minus_books($copies, $bookID, $available) {
            $copies -= 1;
            $available -= 1;
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE books SET copies = ?, available = ? WHERE id = ?;");
        $stmt->execute([$copies, $available, $bookID]);
        $row = $stmt->fetchAll();
        return $row;
    }
}
