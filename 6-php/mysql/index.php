<?php
    $link = mysqli_connect("localhost", "root", "Carlos@310319#", "webcourse");
    if(mysqli_connect_error()){
        die ("there was an error connecting to the DB");
    }
    
    $query = "SELECT * FROM users";

    if ($result = mysqli_query($link, $query)){
        echo "Query was successful <br>";
        $row = mysqli_fetch_array($result);
        echo "<b>your email is </b>".$row[1]."; <br> <b>Your password is </b>".$row[2];
        
    }
?>