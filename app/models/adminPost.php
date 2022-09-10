<?php

namespace Model;

use Bcrypt\Bcrypt;

class AdminPost {    

    public static function admin_ogin($username, $password)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function get_books() 
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public static function get_requests() 
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT books.id, books.name, books.author, requests.enrolmentNumber, requests.req, requests.type, requests.status, books.available FROM books INNER JOIN requests ON books.id= requests.id WHERE requests.status = 2;");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public static function accept_in_books($available, $requestType, $enrolment_number, $bookID) 
    {

        $available += 1;
            
        $db = \DB::get_instance();
        $stmt1 = $db->prepare("UPDATE books SET available = ? WHERE id = ? ;");
        $stmt1 ->execute([$available, $bookID]);
        return true;  
    }

    public static function accept_in_requests_1($available, $request_type, $enrolment_number, $book_id) 
    {
            
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("UPDATE requests SET status = 1 WHERE id = ? AND enrolmentNumber = ? AND type = ?;");
        $stmt2 ->execute([$book_id, $enrolment_number, $request_type]);
        return true;  
    }

    public static function accept_in_requests_2($available, $request_type, $enrolment_number, $book_id) 
    {
            
        $db = \DB::get_instance();
        $stmt3 = $db->prepare("UPDATE requests SET type = 7 WHERE status = 1 AND enrolmentNumber= ? AND type = 9;");
        $stmt3 ->execute([$enrolment_number]);
        return true;  
    }

    public static function accept_out_books($available, $request_type, $enrolment_number, $book_id) 
    {

        $available -= 1;

        $db = \DB::get_instance();
        $stmt1 = $db->prepare("UPDATE books SET enrolmentNumber= ?, available= ? WHERE id = ?;");
        $stmt1 ->execute([$enrolment_number, $available, $book_id]);
        return true;
     }

    public static function accept_out_requests($available, $request_type, $enrolment_number, $book_id) 
    {

        $db = \DB::get_instance();
        $stmt2 = $db->prepare("UPDATE requests SET status = 1 WHERE id = ? AND enrolmentNumber = ? AND type= ?;");
        $stmt2 ->execute([$book_id, $enrolment_number, $request_type]);
        return true;
     }

    public static function deny($enrolment_number, $book_id) 
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE requests SET status = 0 WHERE id = ? AND enrolmentNumber = ?;");
        $stmt->execute([$book_id, $enrolment_number]);
        $row = $stmt->fetchAll();
        return $row;
    }

    public static function add_books($book_name, $author_name, $copies) 
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO books (name, author, copies, available) VALUES (?, ?, ?, ?);");
        $stmt->execute([$book_name, $author_name, $copies, $copies]);
        return true;
    }

    public static function plus_books($copies, $book_id, $available) 
    {
        $copies += 1;
        $available += 1;
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE books SET copies = ?, available = ? WHERE id = ?;");
        $stmt->execute([$copies, $available, $book_id]);
        return true;
    }

    public static function minus_books($copies, $book_id, $available) 
    {
        $copies -= 1;
        $available -= 1;
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE books SET copies = ?, available = ? WHERE id = ?;");
        $stmt->execute([$copies, $available, $book_id]);
        $row = $stmt->fetchAll();
        return $row;
    }

    public static function remove_book($book_id) 
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE id = ? AND status = 1;");
        $stmt->execute([$book_id]);
        $row = $stmt->fetchAll();
        return $row;
    }

    public static function remove_book_del_req($book_id) 
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM requests WHERE id = ?;");
        $stmt->execute([$book_id]);
        $row = $stmt->fetchAll();
        return $row;
    }

    public static function remove_book_del_book($book_id) 
    {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM books WHERE id = ?;");
        $stmt->execute([$book_id]);
        $row = $stmt->fetchAll();
        return $row;
    }
}
