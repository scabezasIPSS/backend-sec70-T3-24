<?php
include_once '../version1.php';

echo $_method;
//echo es para mostrar un solo valor, o una concatenacion de valores
// echo $_partes;
print_r($_partes);
// var_dump($_partes);

echo "<p>Mi mantenedor es: {$_partes[5]}</p>";
echo "<p>Mi version es: {$_partes[4]}</p>";
echo "<p>es un api?: {$_partes[3]}</p>";
echo '<hr>';
echo "Cantidad de partes: " . count($_partes) - 2;

echo "<p>Mi mantenedor es: " . $_partes[count($_partes) - 2] . "</p>";
echo "<p>Mi version es: " . $_partes[count($_partes) - 3] . "</p>";
echo "<p>es un api?: ".$_partes[count($_partes) - 4]."</p>";
