
<?php
    session_start();
    include "../database.php";

    $name = "";
    $email = "";
    $errorMex = "";

    /* Filling user inputs with his data */
    $connection = create_connection();
    $result = $connection -> query("SELECT name, email FROM users WHERE email='{$_SESSION['email']}'");

    $row = $result -> fetch_array();
    $name = $row['name'];
    $email = $row['email'];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // If save button is pressed
        if (isset($_POST["submitSettings"])) {
            // Update user info
            $connection -> query(
                "UPDATE users 
                SET name='{$_POST['name']}', email='{$_POST['email']}'
                WHERE email='{$_SESSION['email']}'
                ");
            // Update task email 
            $connection -> query(
                "UPDATE tasks 
                SET email='{$_POST['email']}'
                WHERE email='{$_SESSION['email']}'
                ");
            $name = $_POST['name'];
            $email = $_POST['email'];
            $_SESSION['name']  = $name;
            $_SESSION['email'] = $email;

            // header("Location: ../todoList.php");
        }
        // If logout button is pressed
        else if (isset($_POST["logout"])) {
            session_destroy();
            header("Location: ../../index.html");
        }
    }
    include "settings.php";

    $connection -> close();

?>