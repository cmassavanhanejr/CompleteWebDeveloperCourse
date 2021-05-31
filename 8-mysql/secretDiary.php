
<?php
    session_start();
$error="";
if (array_key_exists("logout", $_GET)) {
    unset($_SESSION);
    setcookie("id", "", time() - 60*60);
    $_COOKIE["id"] = "";

} else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {

    header("Location: loggedIn.php");

}

if (array_key_exists("submit", $_POST)){

    $sql = mysqli_connect("localhost","root","220321", "db_secretedi");
    if(mysqli_connect_error()){
        die("Database Connection Error");
    }
    //print_r($_POST);

    if(!$_POST['email']){
        $error.="An email address  is required";
    }
    if(!$_POST['password']){
        $error.="A password  is required";
    }
    if($error!=""){
        $error.="<p>There were error(s) in your fom: </p>".$error;
    }else{
        if($_POST['signUp'] == '1'){
            $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($sql, $_POST['email'])."' LIMIT 1";
            $result = mysqli_query($sql, $query);
            if (mysqli_num_rows($result) > 0) {
                $error = "That email address is taken.";
            }else
                $query = "INSERT INTO `users` (`email`,`password`) VALUES ('".mysqli_real_escape_string($sql, $_POST['email'])."',
            '".mysqli_real_escape_string($sql, $_POST['password'])."')";

            if(!mysqli_query($sql,$query)){
                $error ="<p> Could not sign you up - please try again later.</p>";
            }else{

                $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($sql)).$_POST['password'])."' WHERE id =".mysqli_insert_id($sql)." LIMIT 1";
                mysqli_query($sql,$query);
                $_SESSION['id']=mysqli_insert_id($sql);
                if($_POST['stayLoggedIn'] == '1'){
                    setcookie("id",mysqli_insert_id($sql),time() +60*60*24*365);
                }
                header("Location: loggedIn.php");
            }
        }else{
            $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($sql, $_POST['email'])."'";
            $result = mysqli_query($sql, $query);
            $row = mysqli_fetch_array($result);
            if (isset($row)) {
                $hashedPassword = md5(md5($row['id']).$_POST['password']);
                if ($hashedPassword == $row['password']) {
                    $_SESSION['id'] = $row['id'];
                    if ($_POST['stayLoggedIn'] == '1') {
                        setcookie("id", $row['id'], time() + 60*60*24*365);
                    }
                    header("Location: loggedIn.php");
                } else {
                    $error = "That email/password combination could not be found.";
                }

            } else {
                $error = "That email/password combination could not be found.";
            }
        }
            
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<div class="container">
    <div><?php echo $error;?></div>
    <h1>Secret Diary!</h1>
    <form method="post" id="signUpForm">
        <fieldset class="form-group">
            <input type="email" name="email" placeholder="email">
        </fieldset>
        <fieldset class="form-group">
            <input type="password" name="password" placeholder="password">
        </fieldset>
        <fieldset class="form-group">
            <input type="hidden" name="signUp" value="0">
            <input type="checkbox" name="stayLoggedIn" value=1>
        </fieldset>
        <fieldset class="form-group">
            <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">
        </fieldset>
    </form>
    <form id="logInForm" method="post">
        <input type="email" name="email" placeholder="Your Email">
        <input type="password" name="password" placeholder="Password">
        <input type="checkbox" name="stayLoggedIn" value=1>
        <input type="hidden" name="signUp" value="0">
        <input type="submit" name="submit" value="Log In!">
    </form>
</div>

<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
-->
</body>
</html>

