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
    <center>
        <?php

        $connect = mysqli_connect(
            'localhost', # service name
            'myadmin', # username
            'rays0007', # password
            'to_dos' # db table
        );

        $title =  $_REQUEST['title'];
        $body = $_REQUEST['body'];
        $date_of_to_do =  $_REQUEST['date_of_to_do'];

        $sql = "INSERT INTO to_dos(title, body, date_of_to_do) VALUES ('$title', '$body', '$date_of_to_do')";

        if(mysqli_query($connect, $sql)){
            echo "<h3>data stored in a database successfully." 
                . " Please browse your localhost php my admin" 
                . " to view the updated data</h3>"; 

            echo nl2br("\n$title\n $body\n "
                . "$date_of_to_do\n");
        } else{
            echo "ERROR: Hush! Sorry $sql. " 
                . mysqli_error($connect);
        }

        // Close connection
        mysqli_close($connect);
        ?>
        <div class="call-to-action">
            <a href="delete.php" class="button black">Delete To-Do</a>
        </div>
    </center>
</body>
</html>
