<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to Spotify-Clone!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <div id="inputContainer">
        <form action="register.php" method="post" id="loginForm">
            <h2>Login to your account</h2>
            <p>
                <label for="loginUsername">Username</label>
                <input id="loginUsername" type="text" name="loginUsername" placeholder="e.g. Mohit Sharma" required>
            </p>
            <p>
                <label for="loginPassword">Password</label>
                <input id="loginPassword" type="password" name="loginPassword" required>
            </p>

            <button type="submit" name="loginButton">Log In</button>

        </form>

        <form id="rigisterForm" action="register.php" method="post">
            <h2>Create your free account</h2>
            <p>
                <label for="Username">Username</label>
                <input id="Username" type="text" name="Username" placeholder="e.g. Mohit Sharma" required>
            </p>

            <p>
                <label for="firstName">First Name</label>
                <input id="firstName" type="text" name="firstName" placeholder="e.g. Mohit" required>
            </p>

            <p>
                <label for="lastName">Last Name</label>
                <input id="lastName" type="text" name="lastName" placeholder="e.g. Sharma" required>
            </p>

            <p>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="e.g. mohit.sharma@gmail.com" required>
            </p>

            <p>
                <label for="email2">Confirm Email</label>
                <input id="email2" type="email" name="email2" placeholder="e.g. mohit.sharma@gmail.com" required>
            </p>

            <p>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Your password" required>
            </p>

            <p>
                <label for="password2">Confirm Password</label>
                <input id="password2" type="password" name="password2" placeholder="Your password" required>
            </p>

            <button type="submit" name="registerButton">SIGN UP</button>

        </form>
    </div>

</body>
</html>