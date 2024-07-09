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
                }, 1);
            </script>
        </body>
        </html>';
        ?>