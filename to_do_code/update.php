<!DOCTYPE html>
<html>

<head>
    <title>To-Dos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src="./script.js"></script>
</head>

<body>
    <header>
    <a href="./index.php" class="logo-holder">
            <div class="logo"></div>
            <div class="logo-text">Planner</div>
        </a>
        <nav>
            <ul id="menu">
                <li>
                    <a href="./insert.php">Create</a>
                </li>
                <li>
                    <a href="./readRequest.php">Read</a>
                </li>
                <li>
                    <a href="./update.php">Update</a>
                </li>
                <li>
                    <a href="./delete.php">Delete</a>
                </li>
                
            </ul>
            <a href="#" class="mobile-toggle" onClick="toggleMobileMenu();">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10"/>
                </svg>
                  
            </a>
        </nav>
    </header>
    <section class="crud container">
        <div class="crud">
            <h1>Update To-Do <br>
                    <small>Current To-Dos:</small>
                </h1>
                <form action="updateInDb.php" method="post">
                    <p>
                        <label for="title">To-Do:</label>
                        <input type="text" name="title" id="title" placeholder="Walk the Dog">
                    </p>
                    <p>
                        <label for="body">Description:</label>
                        <input type="text" name="body" id="body" placeholder="Walk the dog around the block">
                    </p>
                    
                    <input type="submit" value="Submit" class="button black">
                </form>
                
                <?php
                    session_start();
                    // Connect to the database
                    $connect = mysqli_connect('localhost', 'myadmin', 'Spiderman12', 'to_dos');
                    if (!$connect) {
                        die('Could not connect: ' . mysqli_connect_error());
                    }

                    if (isset($_SESSION['user_id'])) { // Ensure session variable is set
                        $user_id = $_SESSION['user_id'];

                        // Define the SQL query
                        $sql = "SELECT title, body, date_of_to_do FROM to_dos WHERE user_id = ?";
                        $stmt = mysqli_prepare($connect, $sql);

                        if ($stmt === false) {
                            die('MySQL prepare error: ' . mysqli_error($connect));
                        }

                        // Bind the integer user ID to the parameter, use "i" for integers
                        mysqli_stmt_bind_param($stmt, "i", $user_id);

                        // Execute the prepared statement
                        if (mysqli_stmt_execute($stmt) === false) {
                            die('Execute error: ' . mysqli_stmt_error($stmt));
                        }

                        // Get the result set from the prepared statement
                        $result = mysqli_stmt_get_result($stmt);
                        if (!$result) {
                            die('Could not get data: ' . mysqli_error($connect));
                        }

                        // Fetch the data and display it
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "To-Do: " . htmlspecialchars($row['title']) . "<br> " .
                                "Description: " . htmlspecialchars($row['body']) . "<br> " .
                                "Date: " . htmlspecialchars($row['date_of_to_do']) . "<br> " .
                                "--------------------------------<br>";
                        }

                        // Free result set
                        mysqli_free_result($result);

                        // Close the prepared statement
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "User ID not set in session.";
                    }

                    // Close the connection
                    mysqli_close($connect);
                ?>

                
            
        </div>
    </section>
</body>
</html>
