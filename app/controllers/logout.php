<?php

namespace Controller;

class logout {
    public function get()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /signin");
        die();
    }
}