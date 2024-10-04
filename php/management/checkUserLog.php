<?php
    if (!(isset($_SESSION['user_id'])) || !(isset($_SESSION['email'])) || !(isset($_SESSION['name']))) {
        echo isset($_SESSION['user_id']);
        echo isset($_SESSION['email']);
        echo isset($_SESSION['name']);
        header("Location: ../index.html");
    }
?>