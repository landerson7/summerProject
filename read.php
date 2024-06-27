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
                    <a href="./read.php">Read</a>
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
                    echo date("m/d/Y");
                    
                ?>
            </h1>
            <div class="content">
                <?php
                // Connect to the database
                
                $connect = mysqli_connect('localhost', 'myadmin', 'Spiderman12', 'to_dos');
                if (!$connect) {
                    die('Could not connect: ' . mysqli_connect_error());
                }

                // Define the SQL query
                $sql = 'SELECT title, body, date_of_to_do FROM to_dos';

                // Execute the query
                $result = mysqli_query($connect, $sql);

                if (!$result) {
                    die('Could not get data: ' . mysqli_error($connect));
                }

                // Fetch the data and display it
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>" . htmlspecialchars($row['title']) . "</li> " .
                        "<ul class = a><li> " . htmlspecialchars($row['body']) . "</ul></li><br> ";
                }

                // Close the connection
                mysqli_close($connect);
                ?>
                
                </div>
        </div>
    </section>
    
</body>
</html>
