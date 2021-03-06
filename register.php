<?php
    include("includes/config.php");
    include("includes/classes/Constants.php");
    include("includes/classes/Account.php");

    $account = new Account($con);

    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");

    function getInputValue($name) {
        //For checking the input in input tag
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to Spotify-Clone!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body id="background">
    <div id="loginContainer">

        <div id="inputContainer">
            <form action="register.php" method="post" id="loginForm">
                <h2>Login to your account</h2>
                <p class="loginPara">
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <label for="loginUserName">Username</label>
                    <input id="loginUserName" type="text" name="loginUserName" placeholder="e.g. Mohit Sharma" required value="<?php getInputValue('loginUserName'); ?>">
                </p>
                <p class="loginPara">
                    <label for="loginPassword">Password</label>
                    <input id="loginPassword" type="password" name="loginPassword" placeholder="Your password" required>
                </p>

                <button type="submit" name="loginButton">Log In</button>

                <div class="hasAccountText">
                    <span id="hideLogin">Don't have an account yet? Sign up here. </span>
                </div>
            </form>

            <form id="registerForm" action="register.php" method="post">
                <h2>Create your free account</h2>
                <p>
                    <?php echo $account->getError(Constants::$userNameCharacters); ?>
                    <?php echo $account->getError(Constants::$userNameTaken); ?>
                    <label for="userName">Username</label>
                    <input id="userName" type="text" name="userName" placeholder="e.g. Mohit Sharma" required value="<?php getInputValue('userName'); ?>">
                </p>

                <p>
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <label for="firstName">First Name</label>
                    <input id="firstName" type="text" name="firstName" placeholder="e.g. Mohit" required value="<?php getInputValue('firstName'); ?>">
                </p>

                <p>
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <label for="lastName">Last Name</label>
                    <input id="lastName" type="text" name="lastName" placeholder="e.g. Sharma" required value="<?php getInputValue('lastName'); ?>">
                </p>

                <p>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" placeholder="e.g. mohit.sharma@gmail.com" required value="<?php getInputValue('email'); ?>">
                </p>

                <p>
                    <label for="email2">Confirm Email</label>
                    <input id="email2" type="email" name="email2" placeholder="e.g. mohit.sharma@gmail.com" required value="<?php getInputValue('email2'); ?>">
                </p>

                <p>
                    <?php echo $account->getError(Constants::$passwordsCharacters); ?>
                    <?php echo $account->getError(Constants::$passwordsNotAlphaNumeric); ?>
                    <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Your password" required>
                </p>

                <p>
                    <label for="password2">Confirm Password</label>
                    <input id="password2" type="password" name="password2" placeholder="Your password" required>
                </p>

                <button type="submit" name="registerButton">SIGN UP</button>

                <div class="hasAccountText">
                    <span id="hideRegister">Already have an account? Log in here. </span>
                </div>
            </form>
        </div>

        <div id="loginText">
            <h1>Get great music, right now</h1>
            <h2>Listen to lots of songs for free.</h2>
            <ul>
                <li><i class="icon ion-md-checkmark"></i>Discover music you'll fall in love with</li>
                <li><i class="icon ion-md-checkmark"></i>Create your own playlist</li>
                <li><i class="icon ion-md-checkmark"></i>Follow artists to keep up to date</li>
            </ul>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
    <?php
    if(isset($_POST['registerButton'])) {
        echo '<script>
                $(document).ready(function() {
                    $("#loginForm").hide();
                    $("#registerForm").show();
                });
              </script>';
    } else {
        echo '<script>
                $(document).ready(function() {
                    $("#loginForm").show();
                    $("#registerForm").hide();
                });
              </script>';
    }
    ?>
</body>
</html>