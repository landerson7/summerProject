<!DOCTYPE html>
<html lang="en">
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connect = mysqli_connect('localhost', 'myadmin', 'Spiderman12', 'to_dos');
    if (!$connect) {
        die('Could not connect: ' . mysqli_connect_error());
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $connect->prepare("SELECT * FROM users WHERE username=?"); 
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $message = "Username already exists, try a different one.";
            $url = "usernameExists.html";
        } else {
            $stmt = $connect->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sss", $username, $email, $password_hash);
                if ($stmt->execute()) {
                    $message = "New account created successfully!";
                    $url = "createdSuccess.html";
                } else {
                    echo "Execute error: " . $stmt->error;
                    $message = "Failed to create account.";
                    $url = "register.php";
                }
            } else {
                echo "Prepare error: " . $connect->error;
            }
        }
        $stmt->close();
    } else {
        echo "Prepare error: " . $connect->error;
    }
    $connect->close();

}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Create Account</title>
</head>
<body>
<section class="login container">
    <div class="login">
        <h2 class="header">Create Account</h2>
        <form action="createAccount.php" method="post" class="login-form">
            <p class="input-box">
                <label for="username"></label>
                <input type="text" name="username" id="username" placeholder="Username">
            </p>
            <p class="input-box">
                <label for="email"></label>
                <input type="text" name="email" id="email" placeholder="Email">
            </p>
            <p class="input-box">
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Password">
            </p>
            <input type="submit" value="Submit" class="button black" name="submit">
        </form>
        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
            
        <?php endif; ?>
        <a href="createAccount.php">Create Account</a>
        <br>
        <a href="forgotPassword.php">Forgot Password?</a>
    </div>
</section>
</body>
</html>
