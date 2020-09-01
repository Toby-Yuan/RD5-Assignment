<?php

session_start();

$insert1 = $_SESSION["insert1"];
$insert2 = $_SESSION["insert2"];
$update1 = $_SESSION["update1"];
$update2 = $_SESSION["update2"];

echo $insert1;
echo $insert2;
echo $update1;
echo $update2;

?>