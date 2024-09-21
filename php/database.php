<?php
    function create_connection () {
        $conn = new mysqli(
            "localhost",
            "root",
            "",
            "todolistusers"
            
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