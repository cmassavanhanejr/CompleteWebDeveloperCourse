<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$host = "localhost";
$username  = "root";
$password = "220321";
$dbname = "db_users";
   //Creating a connection
   $link = mysqli_connect($host, $username, $password, $dbname);
    if(mysqli_connect_error()){
        die ("there was an error connecting to the DB");
    }

    $query = "INSERT INTO `users` (`email`,`password`,`name`) VALUES ('Ana@luasiga.com', 'Teste', 'Joao');";
    //pega o erro da querry
    $result = $link->query($query) or exit("Error code ({$link->errno}): {$link->error}");
    //Mostra o resultado da query
    echo "Query result is".($result?" true ":" false ")."done" ;
    $query = "UPDATE `users` SET email='Joao@luasiga.com' WHERE id = 2 LIMIT 1";
    mysqli_query($link, $query);
    
    $query = "SELECT * FROM users";


    if ($result = mysqli_query($link, $query)){
        echo "Query was successful <br>";
        $row = mysqli_fetch_array($result);
        echo "<b> email is </b>".$row[1]."; <br> <b>Your password is </b>".$row[2];
        
    }
?>