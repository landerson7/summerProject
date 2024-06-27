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
                    <a href="./index.php">Create</a>
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
            'Spiderman12', # password
            'to_dos' # db table
        );

        
        $title =  $_REQUEST['title'];
        $body = $_REQUEST['body'];
        
        
        $sql = "UPDATE to_dos SET title=?, body=? WHERE title=?";
        $stmt = mysqli_prepare($connect, $sql);
        
        if($stmt){
            mysqli_stmt_bind_param($stmt, "sss", $title, $body, $title);

            if(mysqli_stmt_execute($stmt)){
                echo "<h3>To-do Updated.</h3>";
                
            }
            else{
                echo "ERROR: Could not execute query: $sql. ".mysqli_error($connect);
            }
            mysqli_stmt_close($stmt);
        }
        else{
            echo "Error: Could not prepare query: $sql. ".mysqli_error($connect);
        }


        // Close connection
        mysqli_close($connect);
        ?>
        <meta http-equiv="refresh" content="3;url=./index.php">
    </center>
    <main>
    
</body>
</html>
