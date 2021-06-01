
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
    $sql="";
    include("connection.php");
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

<?php include("header.php"); ?>
<div class="container">
    <div><?php echo $error;?></div>
    <h1>Secret Diary!</h1>
    <form method="post" id="signUpForm">
        <p>Interested? Sign up now.</p>
        <fieldset class="form-group">
            <input class="form-control" type="email" name="email" placeholder="email">
        </fieldset>
        <fieldset class="form-group">
            <input class="form-control" type="password" name="password" placeholder="password">
        </fieldset>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
            </label>
        </div>
        <fieldset class="form-group">
            <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">
            <input class="form-control" type="hidden" name="signUp" value="0">
        </fieldset>
        <p><a class="toggleForms">Log in</a></p>
    </form>
    <form id="logInForm" method="post">
        <p>Log in using your username and password.</p>
        <fieldset class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Your Email">
        </fieldset>
        <fieldset class="form-group">
            <input class="form-control"type="password" name="password" placeholder="Password">
        </fieldset>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
            </label>
        </div>
        <fieldset class="form-group">
            <input type="hidden" name="signUp" value="0">
            <input class="btn btn-success" type="submit" name="submit" value="Log In!">
        </fieldset>
        <p><a class="toggleForms">Sign up</a></p>
    </form>
</div>

<?php include("footer.php"); ?>

