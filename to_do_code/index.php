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
    <a href="#" class="logo-holder">
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
                <li>
                    <a href="./logout.php" class="button blue">Log Out</a>
                </li>
                
                
            </ul>
            <a href="#" class="mobile-toggle" onClick="toggleMobileMenu();">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10"/>
                </svg>
                  
            </a>
        </nav>
    </header>
      <center>
      <h1>Welcome to the Planner!<br> <small>Please click the buttons above to get started or wait to be redirected to your current to-dos if you do not
            select a date below.</small></h1>
         
         <form action="./read.php" method="post">
                    <p>
                        <label for="date_of_to_do">Date:</label>
                        <input type="date" name="date_of_to_do" id="date_of_to_do" placeholder="YYYY-MM-DD">
                    </p>
                    <input type="submit" value="Submit" class="button black">
                </form>
         
         <?php
        // Get today's date
        date_default_timezone_set('America/New_York');
        $date = date('Y-m-d');

        // Prepare the HTML form with JavaScript to submit it automatically
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <meta http-equiv="refresh" content="10">
        </head>
        <body>
            <form id="redirectForm" action="./read.php" method="post">
                <input type="hidden" name="date_of_to_do" value="' . $date . '">
            </form>
            <script type="text/javascript">
                setTimeout(function(){
                    document.getElementById("redirectForm").submit();
                }, 30000);
            </script>
        </body>
        </html>';
        ?>
        
      </center>
    <div class="Displayed-to-dos">

    
        <h1>A List of all your entered To-Do's:</h1>
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
                    echo "<li>To-Do: " . htmlspecialchars($row['title']) . "</li> " .
                        "<li>Description: " . htmlspecialchars($row['body']) . "</li> " .
                        "<li>Date: " . htmlspecialchars($row['date_of_to_do']) . "</li> " .
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
      <br>
      <br>
      <br>
      <br>
      <br>
   </body>
</html>
