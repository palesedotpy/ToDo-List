<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/tasks/task-container.css">
    </head>
    <body>

        <?php 
        
            include "database.php";

            $connection = create_connection();
            $connection -> query("SELECT tasks_id from users WHERE email='{$email}'");

            $anyTaskInDb = false;

            if ($connection -> affected_rows >= 1) {
                /* Se non ci sono task scrivi "Nessuna task salvata, se ci sono mostrale, sviluppa la funzione per salvarle nel preferiti, per aggiungerle e per eliminarle. */
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
                    <div class="profile">
                        <button class="button"><img src="../img/person-icon.svg">Profile</button>
                    </div>
                </div>
            </header>

            <div class="main">
                <div class="tasksContainer" id="tasks-container">
                    <div class="tasks">
                        <!-- <div class="task">
                            <div class="textTask">
                                <input type="checkbox" class="taskCheck" id="completeTaks">
                                <label for="completeTaks" class="taskLabel">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, officiis?</label>
                            </div>
                            <div class="taskButtons">
                                <button class="button favoriteTaskButton"><img src="../img/favorite-icon.svg"></button>
                                <button class="button removeTaskButton"><img src="../img/remove-icon.svg"></button>
                            </div>
                        </div> -->
                    </div>
                    
                    <form class="taskFooter">
                        <button type="submit" class="button">Add task<img src="../img/plus-icon.svg"></button>
                        <button type="submit" class="button">Remove all<img src="../img/delete-icon.svg"></button>
                    </form>
                </div>
            </div>
            
        </div>
    </body>

    <script src="js/main.js"></script>
</html>