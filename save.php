 <!-- Login Pop Up -->
 <div class="pop-up-account" id="pop-up-login">
            <div class="account-header">
                <h3 class="title">Login</h3>
                <button class="button" onclick="closePopUp()"><img src="img/remove-icon.svg"></button>
            </div>
            <form>                    
                <div class="input-credentials">
                    <div class="input-group">
                        <input type="text" class="input" id="loginInputEmail" name="loginInputEmail" required>
                        <label class="placeholder" for="loginInputEmail">Email</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="password" class="input" id="loginInputPassword" name="loginInputPassword" required>
                        <label class="placeholder" for="loginInputPassword">Password</label>
                    </div>
                </div>
            
                <div class="save-account">
                    <p class="warning-banner" id="warning-banner"></p>
                    <input type="submit" class="button loginButton" value="Login">
                </div>
            </form>  
        </div>

        <!-- Signup Pop Up -->
        <div class="pop-up-account" id="pop-up-signup">
            <div class="account-header">
                <h3 class="title">Sign up</h3>
                <button class="button" onclick="closePopUp()"><img src="img/remove-icon.svg" ></button>
            </div>

            <?php 
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo "Hi";
                }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="post" id="signup-form">
                <div class="input-credentials">
                    <div class="input-group">
                        <input type="text" class="input" id="signupInputName" name="signupInputName" required>
                        <label class="placeholder" for="signupInputName">Name</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="text" class="input" id="signupInputEmail" name="signupInputEmail" required>
                        <label class="placeholder" for="signupInputEmail">Email</label>
                    </div>
                    
                    <div class="input-group">
                        <input type="password" class="input" id="signupInputPassword" name="signupInputPassword" required>
                        <label class="placeholder" for="signupInputPassword">Password</label>
                    </div>
                </div>
                <div class="save-account">
                    <p class="warning-banner" id="warning-banner"></p>
                    <input type="submit" class="button signupButton" name="submitSignup" value="Signup">
                </div>
            </form>

            

            
            <p id="display"></p>
        </div>