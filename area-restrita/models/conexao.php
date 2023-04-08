<?php

// define('HOST', 'localhost');
// define('USER', 'u883305113_hub');
// define('PASS', 'Me34we1*90wsd');
// define('DBNAME', 'u883305113_medhub');

// $conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);

$conn= new PDO('mysql:host=localhost;dbname=medhub', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));

?>
