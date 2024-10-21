<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tuga's App</title>
    <link rel="stylesheet" href="login.css"> 
</head>
<body>
    <div class="container">
        <div class="login-section">
            <h1>Welcome back, buddy!</h1>
            <p>Bini Buddies Adoption Center is a warm and welcoming haven for pets in need of loving homes. 
               Dedicated to connecting animals with their forever families, Bini Buddies provides a safe,
               caring environment where animals can thrive while awaiting adoption.</p>
            <form action="login.php" method="POST">
                <input type="text" class="input" name="username" placeholder="Username" required><br>
                <input type="password" class="input" name="password" placeholder="Password" required><br>
                <button type="submit" class="button">Login</button>
                <button type="button" class="button secondary-button" onclick="window.location.href='signup.php'">Sign Up</button>
            </form>

            <div class="signup-link">
                <p>Not a member? <a href="signup.php">Register now</a></p>
            </div>
        </div>

        <div class="right-section">
            <img src="add image here" alt="bini's buddies Logo">
            <h2>Join us in giving these wonderful animals a forever home filled with love! </h2>
        </div>
    </div>
</body>
</html>
