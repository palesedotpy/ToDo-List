<?php

    include "../database.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update favorite status in db
        $connection = create_connection();
        if (isset($_POST["favoriteButton"])) {
            $task_id = $_POST["task_id"];
            $current_favorite_status = $connection->query("SELECT favorite FROM tasks WHERE task_id='{$task_id}'")->fetch_array()["favorite"];
            $new_favorite_status = $current_favorite_status === 'yes' ? 'no' : 'yes';
            $connection->query("UPDATE tasks SET favorite='{$new_favorite_status}' WHERE task_id='{$task_id}'");
            $setFavoriteIcon = $new_favorite_status === 'yes' ? $favoriteIconPath : $noFavoriteIconPath;
            echo "<script>document.getElementById('heart" . $task_id . "').src = '" . $setFavoriteIcon . "';</script>";
        }
        // Remove task in db
        else if (isset($_POST["removeButton"])) {
            $task_id = $_POST["task_id"];
            $connection -> query("DELETE FROM tasks WHERE task_id='{$task_id}'");
        }
        $connection -> close();
        header("Location: ../todoList.php");
    }
?>