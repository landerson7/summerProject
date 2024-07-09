<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src="./script.js"></script>
    <title>Login</title>
</head>
<header>
    <a href="#" class="logo-holder">
            <div class="logo"></div>
            <div class="logo-text">Planner</div>
        </a>
        <nav>
            <ul id="menu">
                
            </ul>
            <a href="#" class="mobile-toggle" onClick="toggleMobileMenu();">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10"/>
                </svg>
                  
            </a>
        </nav>
    </header>
<body>
    <section class="login container">
        <div class="login">
            <h2 class="header">Login</h2>
            <form action="login.php" method="post" class="login-form">
            <p class="input-box">
                <label for="Username"></label>
                <input type="text" name="username" id="username" placeholder="Username">
            </p>
            <p class = "input-box">
                <label for="Password"></label>
                <input type="text" name="password" id="password" placeholder="Password">
            </p>
            <input type="submit" value="Submit" class="button black">
        </form>
        <a href="createAccount.php">Create Account</a>
        <br>
        <a href="forgotPassword.php">Forgot Password?</a>
        </div>
        
    </section>
</body>
</html>
