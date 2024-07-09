<?php
session_start();
?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <title>Username Taken</title>
    </head>
    <body>
        <h1>You have been logged out.  Click below if not redirected back to the login screen.</h1>
        <a href="../index.php">Login</a><br>
        <meta http-equiv="refresh" content="5;url=../index.php">
        <?php
            // remove all session variables
            session_unset();

            // destroy the session
            session_destroy();
        ?>
    </body>

</html>
