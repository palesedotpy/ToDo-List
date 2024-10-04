
<?php
    session_start();
    include "../management/checkUserLog.php";
    include "../database.php";

    $name = "";
    $email = "";
    $errorMex = "";

    /* Filling user inputs with his data */
    $connection = create_connection();
    $result = $connection -> query("SELECT name, email FROM users WHERE user_id='{$_SESSION['user_id']}'");

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
                WHERE user_id='{$_SESSION['user_id']}'
                ");
            $name = $_POST['name'];
            $email = $_POST['email'];
            $_SESSION['name']  = $name;
            $_SESSION['email'] = $email;

            header("Location: ../todoList.php");
        }
        // If logout button is pressed
        else if (isset($_POST["logout"])) {
            session_destroy();
            header("Location: ../../index.html");
        }
        else if(isset($_POST["deleteAccount"])) {
            $connection -> query("DELETE FROM users WHERE user_id='{$_SESSION['user_id']}'");
            $connection -> query("DELETE FROM tasks WHERE user_id='{$_SESSION['user_id']}'");

            session_destroy();

            header("Location: ../../index.html");
        }
    }
    include "settings.php";

    $connection -> close();

?>