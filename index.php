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
   </body>
</html>
