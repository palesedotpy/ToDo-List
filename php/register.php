<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/form/form.css">
    </head>
    <body>
        <div class="container centerContainer containerDimension">

            <?php
                include "database.php";

               $errorMex = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $connection = create_connection();

                    $name = $_POST["signupInputName"];
                    $email = $_POST["signupInputEmail"];
                    $password = $_POST["signupInputPassword"];
                    $repeatPassword = $_POST["signupInputRepeatPassword"];

                    $connection -> query("SELECT * from users WHERE email='{$email}';");
                    if ($connection -> affected_rows >= 1) {
                        $errorMex = "Email already in use!";
                    }
                    else if ($password !== $repeatPassword) {
                        $errorMex = "Passwords must match!";
                    }
                    else {
                        $name = validate($name);
                        $email = validate($email);
                        $password = validate($password); 
                        $password = password_hash($password, PASSWORD_DEFAULT);

                        $_SESSION["name"] = $name;
                        $_SESSION["email"] = $email;
                        $_SESSION["password"] = $password;

                        

                        $connection -> query("INSERT INTO users (name, email, password) 
                                VALUES ('{$name}', '{$email}', '$password');");
                        $connection -> close();
                        header('Location: todoList.php');
                    }
                }
            ?>

            <div class="header">
                <h1>Register</h1>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> "method="post" class="form" id="signup-form">
                <div class="input-credentials">
                    <div class="input-group">
                        <input type="text" class="input <?php echo $nameError; ?>" id="signupInputName" name="signupInputName" required>
                        <label class="placeholder" for="signupInputName">Name</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="text" class="input <?php echo $emailError; ?>" id="signupInputEmail" name="signupInputEmail" required>
                        <label class="placeholder" for="signupInputEmail">Email</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="password" class="input <?php echo $passwordError; ?>" id="signupInputPassword" name="signupInputPassword" required>
                        <label class="placeholder" for="signupInputPassword">Password</label>
                    </div>

                    <div class="input-group">
                        <input type="password" class="input <?php echo $repeatPasswordError; ?>" id="signupInputRepeatPassword" name="signupInputRepeatPassword" required>
                        <label class="placeholder" for="signupInputRepeatPassword">Repeat password</label>
                    </div>

                </div>
                <div class="save-account">
                    <p class="errorColor"><?php echo $errorMex; ?></p>
                    <input type="submit" class="button submitButton" name="submitSignup" value="Signup">
                </div>
            </form>
        </div>

       
    </body>
</html>