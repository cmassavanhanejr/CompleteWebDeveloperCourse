<?php


    /*For Loops*/
    echo "<h2>For Loops</h2>";
    $family=array("Carlos","Deolinda","Rosaria", "Luis", "Manuel", "Carlos Jr");

    foreach($family as $key => $value){

        $family[$key] = $value." Massavanhane";

        echo "Array item".$key."is ".$value."<br>";
    }


    for($i=0;$i<count($family);$i++){
        echo $family[$i]."<br>";
    }


    for($i=2;$i<=30;$i++){
        if($i%2==0)
            echo $i."<br>";
    }


    //Whlise Loops
    echo "<h2>While Loops</h2>";

    $i=5;
    while($i<=50){
        echo $i."<br>";
        $i=$i+5;
    }

    $languages=array("Portugese", "English","Spanish", "French");
    $i=0;
    while($i<sizeof($languages)){

        echo $languages[i]."<br>";
        $i++;
    }
        
?>