<?php

namespace Controller;

class AddBooks {
    public function get() 
    {
        \Utils\Auth::auth();
        echo \View\Loader::make()->render("addBooks.twig");
    }

    public function post() 
    {
        \Utils\Auth::auth();
        $book_name = $_POST["book_name"];
        $author_name = $_POST["author_name"];
        $copies = $_POST["copies"];

        $rows = \Model\AdminPost::add_books($book_name, $author_name, $copies);
        if ($rows) {
            header("Location: /admin/books");
        }
    } 
}