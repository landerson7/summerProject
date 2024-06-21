<!DOCTYPE html>
<html>

<head>
    <title>Insert Page page</title>
</head>

<body>
    <center>
        <?php

        $connect = mysqli_connect(
            'db', # service name
            'php_docker', # username
            'password', # password
            'to_dos' # db table
        );

        $title =  $_REQUEST['title'];
        $body = $_REQUEST['body'];
        $date_of_to_do =  $_REQUEST['date_of_to_do'];

        $sql = "INSERT INTO to_dos VALUES ('$title', '$body', '$date_of_to_do')";

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
    </center>
</body>
</html>
