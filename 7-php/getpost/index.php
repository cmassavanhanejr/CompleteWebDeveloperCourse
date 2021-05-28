<?php
   // echo "Hi There ".$_GET['name']."!";
   /*Working with GET
   if($_GET){
        $i=2;
        $nr=$_GET['number'];
        $isPrime=true;

        while($i<$nr){
            if($nr%$i==0)
                $isPrime=false;
            $i++;
        }
        if($isPrime)
            echo "<p>".$nr." is a prime number!</p>";
        else
            echo "<p>".$nr." is not a prime number!</p>";
   }
   */
  $usernames=array("Carlos", "Joao", "Joaquim", "Lunecas", "Paulo", "Sebastiao", "Rosaria", "Yolanda", "Aninhas");
  $autenticado=false;

   if($_POST){
   $name=$_POST['name'];
   foreach($usernames as $username){
       if($username == $name){
           $autenticado =true;
       }
   }
   if($autenticado==true)
    echo "Bem-Vindo ".$name;
   else
    echo "O senhor nao esta autorizado a entrar!";
}
  // print_r($_POST);


?>

<!-- WORKING WITH POST -->
<p>Whats your name?</p>

<form method="POST">

    <input name="name" type="text"/>
    <input type="submit" value="Goo"/>
</form>
