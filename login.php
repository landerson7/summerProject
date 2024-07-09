<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $connect = mysqli_connect('localhost', 'myadmin', 'Spiderman12', 'to_dos');
        if (!$connect) {
            die('Could not connect: ' . mysqli_connect_error());
        }
    
        $username = $_POST['username'];
        $entered_password = $_POST['password'];
        //echo "<h1>Hello World</h1>";
        $stmt = $connect->prepare("SELECT id, username, email, password FROM users WHERE username=?");
        if (!$stmt) {
            //echo "<h1>Execute error: " . htmlspecialchars($stmt->error) . "</h1>";
            die('MySQL prepare error: ' . mysqli_error($connect));
        }
        //echo "<h1>Hello World</h1>";
        $stmt->bind_param("s", $username);
        $executed = $stmt->execute();
        if (!$executed) {
            echo "<h1>Execute error: " . htmlspecialchars($stmt->error) . "</h1>";
            die('Execute error: ' . $stmt->error);
            
        }
        
        //$stmt->store_result();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            
            // Fetch associative array
            $row = $result->fetch_assoc();
            $hashed_password_from_db = $row['password']; // This is the hashed password stored in the database
            
            
            // Verify the password
            if (password_verify($entered_password, $hashed_password_from_db)) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                //echo "<h1>Hello World</h1>";
                // Redirect user to the dashboard or another page
                header("Location: ./to_do_code/index.php");
                exit();
            } else {
                $message = "Invalid username or password.";
                echo "<h1> Invalid username or password.</h1>";
            }
        } else {
            //echo "<h1>User does not exist.  Please try again.</h1>";
            $message = "User not found.";
        }
        $stmt->close();
        $connect->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
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
    <div class="notFound">
        <h1>Username not found.  Please try again.</h1><br>
        <center><a href="index.php">Home</a></center><br>
        <meta http-equiv="refresh" content="10;url=./index.php">
    </div>
</body>
</html>