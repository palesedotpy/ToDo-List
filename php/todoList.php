<?php
    session_start();
    include "management/checkUserLog.php";
    include "database.php";
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
        <link rel="stylesheet" href="../css/tasks/filters.css">
    </head>
    <body>
        <div class="container">
            <header class="header">
                <div class="logo">
                    <!-- Fai in modo che la checkbox sia responsive -->
                    <img src="../img/logo-icon.svg">
                    <h1>ToDoList</h1>
                </div>
                <div class="navbar">
                    <form class="settings" action="settings/management.php" method="get">
                        <button 
                            class="button submitButton">
                            <img src="../img/filters-icon.svg">
                            Settings
                        </button>
                    </form> 
                </div>
            </header>

            <div class="main">
                <div class="tasksContainer" id="tasks-container">
                    <div>
                        <form action="" method="GET" class="filtersContainer">
                            <div class="custom-select">
                                <select name="category" required>
                                    <option 
                                    value="no-filters"
                                        <?php echo isset($_GET['category']) ? ($_GET['category'] == 'no-filters' ? 'selected' : '') : '';?>
                                        >Filters
                                    </option>
                                    <option
                                        value="favorite" 
                                        <?php echo isset($_GET['category']) ? ($_GET['category'] == 'favorite' ? 'selected' : '') : '';?>
                                        >Favorite
                                    </option>
                                    <option 
                                        value="work"
                                        <?php echo isset($_GET['category']) ? ($_GET['category'] == 'work' ? 'selected' : '') : '';?>
                                        >Work
                                    </option>
                                    <option 
                                        value="study"
                                        <?php echo isset($_GET['category']) ? ($_GET['category'] == 'study' ? 'selected' : '') : '';?>
                                        >Study
                                    </option>
                                    <option 
                                        value="other"
                                        <?php echo isset($_GET['category']) ? ($_GET['category'] == 'other' ? 'selected' : '') : '';?>
                                        >Other
                                    </option>
                                </select>
                            </div>
                            <button class="button">Filter</button>
                        </form>

                        <div class="tasks">
                            <?php
                                $connection = create_connection();
                                $errorMex = "";

                                if (isset($_GET['category']) && ($_GET['category'] == 'no-filters')) {
                                    unset($_GET['category']);
                                }

                                if (isset($_GET['category']) && !(empty($_GET['category']))) {
                                    $category = $_GET['category'];
                                    $result_task = $connection -> query("SELECT task_id, category, description FROM tasks WHERE user_id='{$_SESSION['user_id']}' AND category='$category'");
                                    $errorMex = $connection -> affected_rows < 1 ? 'No tasks found with selected category' : '';
                                }
                                else {           
                                    $result_task = $connection -> query("SELECT task_id, category, description FROM tasks WHERE user_id='{$_SESSION['user_id']}'");
                                    $errorMex = $connection -> affected_rows < 1 ? 'Add your first task!' : '';
                                }


                                if ($connection -> affected_rows >= 1) {
                                    while ($row = $result_task -> fetch_array()) {
                                        $task_id = $row['task_id'];
                                        $noFavoriteIconPath = '../img/favorite-icon.svg';
                                        $favoriteIconPath = '../img/favorite-red-icon.svg';
                                        $setFavoriteIcon = $noFavoriteIconPath;
                                        $result = $connection -> query("SELECT favorite FROM tasks WHERE task_id='{$task_id}'");
                                        $favorite_result = $result -> fetch_array();
                                        $favorite_result = $favorite_result['favorite'];
                                        $setFavoriteIcon = $favorite_result === 'yes' ? $favoriteIconPath : $noFavoriteIconPath;
                        
                                        ?>
                                        <div class="task">
                                            <div class="textTask">
                                                <input type="checkbox" class="taskCheck" id="<?php echo $task_id ?>">
                                                <label
                                                    for="<?php echo $task_id ?>"
                                                    id="taskLabel<?php echo $task_id ?>"
                                                    class="taskLabel"> 
                                                    <?php echo $row['description']; ?>
                                                </label>
                                            </div>
                                            <form action="task/taskManagement.php" method="post">
                                                <div class="taskButtons">
                                                    <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                                                    <button
                                                        class="button favoriteTaskButton"
                                                        name="favoriteButton"
                                                        ><img id="heart<?php echo $task_id ?>" src="<?php echo $setFavoriteIcon ?>">
                                                    </button>
                                                    <button
                                                        class="button copyTaskButton"
                                                        onclick="copyToClipboard('taskLabel<?php echo $task_id ?>')">
                                                        <img id="" src="../img/copy-icon.svg">
                                                    </button>
                                                    <button
                                                        class="button removeTaskButton"
                                                        name="removeButton"
                                                        >
                                                        <img src="../img/remove-icon.svg">
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                   <?php }
                                }
                                else {
                                    echo "<h2>$errorMex</h2>";
                                }
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    // Update favorite status in db
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
                                }
                                $connection -> close();
                            ?>
                        </div>
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
                            <div class="custom-select">
                                <select class="" name="taskCategory" id="">
                                    <option value="work">Work</option>
                                    <option value="study">Study</option>
                                    <option value="other" selected>Other</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="button submitButton" id="add-task-button" disabled>
                            Add task
                            <img src="../img/plus-icon.svg">
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="../js/main.js"></script>        
        <script src="../js/tasks/copyTaskToClipBoard.js"></script>
        <script src="../js/tasks/addTaskButton.js"></script>
        <script src="../js/tasks/taskCheck.js"></script>        
        <script src="../js/tasks/addFavorite.js"></script>

    </body>
</html>