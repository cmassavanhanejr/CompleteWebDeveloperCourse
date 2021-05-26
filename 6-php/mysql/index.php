<?php
    
    $host = "localhost";
    $username  = "root";
    $password = "Carlos@310319#";
    $dbname = "webcourse";

   //Creating a connection
   $link = mysqli_connect($host, $username, $password, $dbname);
    if(mysqli_connect_error()){
        die ("there was an error connecting to the DB");
    }
    
    //$query = "INSERT INTO `users` (`email`,`password`) VALUES ('carlos@luasiga.com', 'Password');";
    $query = "UPDATE `users` SET email='camjr@camjr.com' WHERE id = 1 LIMIT 1"
    mysqli_query($link, $query);
    
    $query = "SELECT * FROM users";


    if ($result = mysqli_query($link, $query)){
        echo "Query was successful <br>";
        $row = mysqli_fetch_array($result);
        echo "<b> email is </b>".$row[1]."; <br> <b>Your password is </b>".$row[2];
        
    }
?>