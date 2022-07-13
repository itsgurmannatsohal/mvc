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
        if ($rows) {
            return $rows;
        }
        return false;
    }

      public static function login($enrolmentNumber, $password)
    {
        $bcrypt = new Bcrypt();
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE enrolmentNumber = ?");
        $stmt->execute([$enrolmentNumber]);
        $rows = $stmt->fetchAll();
        if ($rows) {
            if ($bcrypt->verify($password, $rows[0]["password"])) {
                return true;
            }
        } else {
        return false;
        }
    }

       public static function signup($enrolmentNumber, $password1, $password2)
    {
        if ($password1 == $password2) {
            $bcrypt = new Bcrypt();
            $bcrypt_version = '2a';
            $hash = $bcrypt->encrypt($password1, $bcrypt_version);
            $db = \DB::get_instance();
            $stmt = $db->prepare("SELECT * FROM users WHERE enrolmentNumber = ?");
            $stmt->execute([$username]);
            $row = $stmt->fetchAll();
            if ($row) {
                echo "User already exists";
                return false;
            } else {
                $stmt = $db->prepare("INSERT INTO users (enrolmentNumber, password) VALUES (?, ?)");
                $stmt->execute([$enrolmentNumber, $hash]);
                return true;
            }
        } else {
            echo "Passwords don't match";
        }
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
        $row = $stmt->fetch();
        return $row;
    }

      public static function request_in($enrolmentNumber, $bookID) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE Id = ? AND enrolmentNumber = ? AND status = 2 AND type = 7;");
        $stmt->execute([$bookID, $enrolmentNumber]);
        $row = $stmt->fetch();
        if ($rows) {
            echo "Already requested";
        } else {
            $db = \DB::get_instance();
            $stmt = $db->prepare("INSERT INTO requests (id, enrolmentNumber, type, status, req) VALUES (
                ?, ?, 7, 2, 'Check-in');");
            $stmt->execute([$bookID, $enrolmentNumber]);
            $row = $stmt->fetch();
            return $row;
        }
    }

        public static function request_out($enrolmentNumber, $bookID) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE Id = ? AND enrolmentNumber = ? AND status = 2 AND type = 9;");
        $stmt->execute([$bookID, $enrolmentNumber]);
        $row = $stmt->fetch();
        if ($rows) {
            echo "Already requested";
        } else {
            $db = \DB::get_instance();
            $stmt = $db->prepare("INSERT INTO requests (id, enrolmentNumber, type, status, req) VALUES (
                ?, ?, 9, 2, 'Check-out');");
            $stmt->execute([$bookID, $enrolmentNumber]);
            $row = $stmt->fetch();
            return $row;
        }
    }

        public static function accept($enrolmentNumber, $bookID, $available, $requestType) {
            $y = $available + 1;
            $x = $available - 1;
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests;");
        $stmt->execute();
        $row = $stmt->fetch();

        if ($requestType = 7) {
            $stmt = $db->prepare("UPDATE books SET available= ? WHERE id = ?;");
            $stmt->execute($y, $bookID);
            $row = $stmt->fetch();
                if ($row) {
                    $stmt = $db->prepare("UPDATE requests SET status = 1 WHERE id = ? AND enrolmentNumber = ? AND type = ?;");
                    $stmt->execute($bookID, $enrolmentNumber, $requestType);
                    $row = $stmt->fetch();
                        if ($row){
                            $stmt = $db->prepare("UPDATE requests SET type = 7 WHERE status = 1 AND enrolmentNumber= ? AND type = 9;");
                            $stmt->execute($enrolmentNumber);
                            $row = $stmt->fetch();
                        }
                }
        } else {
            $db = \DB::get_instance();
            $stmt = $db->prepare("UPDATE books SET enrolmentNumber= ?, available= ? WHERE id = ?;");
            $stmt->execute([$enrolmentNumber, $available, $bookID]);
            $row = $stmt->fetch();
            return $row;
                if ($row) {
                    $stmt = $db->prepare("UPDATE requests SET status = 1 WHERE id = ? AND enrolmentNumber = ? AND type= ?;");
                    $stmt->execute($bookID, $enrolmentNumber, $requestType);
                    $row = $stmt->fetch();
                }
        }
    }

        public static function deny($enrolmentNumber, $bookID) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE requests SET status = 0 WHERE id = ? AND enrolmentNumber = ?;");
        $stmt->execute([$bookID, $enrolmentNumber]);
        $row = $stmt->fetch();
        return $row;
    }

    public static function add_books($bookName, $authorName, $copies) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO books (name, author, copies, available) VALUES (?, ?, ?, ?);");
        $stmt->execute([$bookName, $authorName, $copies, $copies]);
        $row = $stmt->fetch();
        return $row;
    }

     public static function plus_books($bookID, $copies, $available) {
            $x = $copies + 1;
            $y = $available + 1;
        $db = \DB::get_instance();
        $stmt = $db->prepare("UPDATE books SET copies = ?, available = ? WHERE id = ?;");
        $stmt->execute([$x, $y, $bookID]);
        $row = $stmt->fetch();
        return $row;
    }

     public static function minus_books($bookID, $copies, $available) {
            $x = $copies - 1;
            $y = $available - 1;
        $db = \DB::get_instance();
        if ($available > 0) {
        $stmt = $db->prepare("UPDATE books SET copies = ?, available = ? WHERE id = ?;");
        $stmt->execute([$x, $y, $bookID]);
        $row = $stmt->fetch();
        } else {
            echo "No books available to subtract";
        }
        return $row;
    }
}
