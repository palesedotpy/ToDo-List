<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/form/form.css">
    </head>
    <body>
        <div class="container centerContainer containerDimension containerPosition">

            <?php
                include "database.php";

               $errorMex = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $connection = create_connection();

                    $email = $_POST["signupInputEmail"];
                    $password = $_POST["signupInputPassword"];

                    $result = $connection -> query("SELECT * from users WHERE email='{$email}';");
                    if ($connection -> affected_rows >= 1) {
                        $email = validate($email);
                        $password = validate($password); /* TODO: password_hash */

                        $errorMex = "Email exists";
                        $account = $result -> fetch_array();

                        if (password_verify($password, $account['password'])) {
                            $_SESSION["email"] = $email;
                            $_SESSION["password"] = $password;

                            header('Location: todoList.php');
                        }
                        else {
                            $errorMex = "Invalid credentials";
                        }
                        
                    }
                    else {
                        $errorMex = "Invalid credentials";                        
                    }

                    $connection -> close();
                }
            ?>

            <div class="header">
                <h1>Login</h1>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="post" class="form" id="signup-form">
                <div class="input-credentials">
                    
                    <div class="input-group">
                        <input type="text" class="input <?php echo $emailError; ?>" id="signupInputEmail" name="signupInputEmail" required>
                        <label class="placeholder" for="signupInputEmail">Email</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="password" class="input <?php echo $passwordError; ?>" id="signupInputPassword" name="signupInputPassword" required>
                        <label class="placeholder" for="signupInputPassword">Password</label>
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