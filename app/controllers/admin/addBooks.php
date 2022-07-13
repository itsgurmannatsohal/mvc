<?php

namespace Controller;

class addBooks {
    public function get() {
        \Utils\Auth::adminAuth();
        echo \View\Loader::make()->render("addBooks.twig");
    }

    public function post() {
        \Utils\Auth::adminAuth();
        $bookName = $_POST["bookName"];
        $authorName = $_POST["authorName"];
        $copies = $_POST["copies"];

        $rows = \Model\Post::add_books($bookName, $authorName, $copies);
        if ($rows) {
            header("Location: /admin/books");
        }
    } 
}