<?php

    include "../database.php";
    session_start();

    $task = trim($_POST["inputTask"]);

    $connection = create_connection();
    
    $connection -> query("INSERT INTO tasks (email, category, description) 
        VALUES ('{$_SESSION['email']}', '{$_POST['taskCategory']}', '$task');");


    $connection -> close();


    header("Location: ../todoList.php");

?>