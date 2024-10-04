<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Settings</title>
        <link rel="stylesheet" href="../../css/main.css">
        <link rel="stylesheet" href="../../css/form/form.css">
        <link rel="stylesheet" href="../../css/settings/settings.css">
    </head>
    <body>
        <div class="container containerDimension centerContainer">
            <div class="header">
                <h1>Settings</h1>
            </div>
            <form action="management.php" method="post" class="form" id="signup-form">
                <div class="input-credentials">
                    <div class="input-group">
                        <input type="text" class="input" id="name-field" name="name" value="<?php echo $name; ?>" required>
                        <label class="placeholder" for="name-field">Name</label>
                    </div>
                    <div class="input-group">
                        <input type="text" class="input" id="email-field" name="email" value="<?php echo $email; ?>" required>
                        <label class="placeholder" for="email-field">Email</label>
                    </div>                    
                </div>
                
                <div class="save-account">
                    <p class="errorColor"><?php echo $errorMex; ?></p>
                    <form action="management.php" method="post">
                        <div class="buttonsContainer">
                            <input type="submit" class="button submitButton" name="submitSettings" value="Save">                    
                            <button type="submit" class="button submitButton" name="logout">Logout <img src="../../img/logout-icon.svg"></button>
                            <button class="button submitButton" name="deleteAccount"><img src="../../img/remove-icon.svg">Delete account</button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </body>
</html>