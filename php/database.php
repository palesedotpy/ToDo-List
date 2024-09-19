<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "todolistusers";

    function create_connection () {
        $conn = new mysqli(
            $GLOBALS['db_server'],
            $GLOBALS['db_user'],
            $GLOBALS['db_password'],
            $GLOBALS['db_name']
        );

        if (mysqli_connect_errno()) {
            echo "You are not connected";
            return false;
        }
        return $conn;
    }

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
   }

?>