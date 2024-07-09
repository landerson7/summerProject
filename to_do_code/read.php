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
    <section class="notebook-paper">
        <div class="notebook-paper">
            <h1 class="title">To-Dos for 
                <?php
                    
                    $date_of_to_do = $_REQUEST['date_of_to_do'];
                    
                    // Create a DateTime object from the provided date string
                    $date = new DateTime($date_of_to_do);
                    
                    // Format the date in 'm/d/Y' format
                    echo $date->format('m/d/Y');
                    
                ?>
            </h1>
            <div class="content">
            <?php
                session_start(); //have to do this to access browser session
                // Connect to the database
                $connect = mysqli_connect('localhost', 'myadmin', 'Spiderman12', 'to_dos');
                if (!$connect) {
                    die('Could not connect: ' . mysqli_connect_error());
                }

                // Get the date from the request
                $date_of_to_do = $_REQUEST['date_of_to_do'];
                $user_id = $_SESSION['user_id'];
                // Define the SQL query
                $sql = 'SELECT title, body, date_of_to_do FROM to_dos WHERE date_of_to_do = ? AND user_id=?';

                // Prepare the statement
                $stmt = mysqli_prepare($connect, $sql);

                if ($stmt) {
                    // Bind parameters
                    mysqli_stmt_bind_param($stmt, "ss", $date_of_to_do, $user_id);

                    // Execute the statement
                    if (mysqli_stmt_execute($stmt)) {
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $title, $body, $date_of_to_do);

                        // Fetch values
                        while (mysqli_stmt_fetch($stmt)) {
                            echo "<li>" . htmlspecialchars($title) . "</li>";
                            echo "<ul class='a'><li>" . htmlspecialchars($body) . "</li></ul><br>";
                        }
                    } else {
                        echo "ERROR: Could not execute query: $sql. " . mysqli_error($connect);
                    }

                    // Close the statement
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error: Could not prepare query: $sql. " . mysqli_error($connect);
                }

                // Close the connection
                mysqli_close($connect);
                ?>
                
                </div>
        </div>
    </section>
    
</body>
</html>
