<?php

    session_start();

    if (array_key_exists("content", $_POST)) {
        $sql="";
        include("connection.php");
        
        $query = "UPDATE `users` SET `diary` = '".mysqli_real_escape_string($sql, $_POST['content'])."' WHERE id = ".mysqli_real_escape_string($sql, $_SESSION['id'])." LIMIT 1";
        
        mysqli_query($sql, $query);
        
    }

?>
