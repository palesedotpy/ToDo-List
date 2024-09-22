<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ToDoList</title>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/tasks/task-container.css">
        <link rel="stylesheet" href="../css/tasks/popUp.css">
    </head>
    <body>
        <?php
            include "database.php";

            $connection = create_connection();
            $result_task = $connection -> query("SELECT task_id, category, description FROM tasks WHERE email='{$_SESSION['email']}'");

            $tasksAvaible = false;

            if ($connection -> affected_rows >= 1) {
                $tasksAvaible = true;
            }
        ?>

        <div class="container">
            <header class="header">
                <div class="logo">
                    <!-- Fai in modo che la checkbox sia responsive -->
                    <img src="../img/logo-icon.svg">
                    <h1>ToDoList</h1>
                </div>
                <div class="navbar">
                    <form class="filters" action="settings/management.php" method="get">
                        <button class="button"><img src="../img/filters-icon.svg">Settings</button>
                    </form>
                </div>
            </header>

            <div class="main">
                <div class="tasksContainer" id="tasks-container">
                    <div class="tasks">                        
                        <?php 
                            
                            if ($tasksAvaible) {
                                while ($row = $result_task -> fetch_array()) { ?>

                                     <div class="task">
                                        <div class="textTask">
                                            <input type="checkbox" class="taskCheck" id="<?php echo $row['task_id'] ?>">
                                            <label for="<?php echo $row['task_id'] ?>" class="taskLabel"> <?php echo $row['description']; ?> </label>
                                        </div>
                                        <div class="taskButtons">
                                            <button class="button favoriteTaskButton"><img src="../img/favorite-icon.svg"></button>
                                            <button class="button copyTaskButton"><img src="../img/copy-icon.svg"></button>
                                            <button class="button removeTaskButton"><img src="../img/remove-icon.svg"></button>
                                        </div>
                                    </div> 
                               <?php }
                            }                    
                            else {
                                echo "<h2>Add your first task!</h2>";
                            }    
                        
                        ?>
                    </div>
                    
                    <form action="task/addTask.php" method="post" class="taskFooter">
                        <div>
                            <p style="color:red;" id="errorMex"></p>
                        </div>
                        <div class="taskInputContainer">                            
                            <div class="input-group">
                                <input type="text" class="input" id="input-task" name="inputTask" required>
                                <label class="placeholder" for="signupInputPassword">New task</label>
                            </div>
                            <select class="categorySelection" name="taskCategory" id="">
                                <option value="work">Work</option>
                                <option value="study">Study</option>
                                <option value="other" selected>Other</option>
                            </select>
                        </div>
                        <button type="submit" class="button" id="add-task-button" disabled>
                            Add task
                            <img src="../img/plus-icon.svg">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        
        
        <script src="../js/main.js"></script>
        <script src="../js/tasks/addTaskButton.js"></script>
        <script src="../js/tasks/taskCheck.js"></script>
    </body>

    
</html>