<?php

    include "../database.php";
    session_start();

    $task = trim($_POST["inputTask"]);

    $connection = create_connection();
    
    $connection -> query("INSERT INTO tasks (user_id, category, description, favorite) 
        VALUES ('{$_SESSION['user_id']}', '{$_POST['taskCategory']}', '$task', 'no');");

    $connection -> close();

    header("Location: ../todoList.php");
?>