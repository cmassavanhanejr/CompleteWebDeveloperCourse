<?php

$nomes= array("Carlos", "Alberto", "Manuel", "Joao");
$nomes[]="Luis";

print_r($nomes);

echo "<br>".$nomes[1];

$foods[0]="pizza";
$foods[4]="yougurte";
$foods[2]="meet";

echo "<br>";

echo "<p> array de comidas: ";
print_r($foods);
echo "</p>";

$linguas=array("Franca" => "Frances", "Portugal" => "Portugues",  "Inglatera" => "Ingles");

echo "<p> Paises e respectivas linguas";
print_r($linguas);
echo "</p>";

unset($linguas["Portugal"]);
print_r($linguas);

echo sizeof($linguas);



?>
