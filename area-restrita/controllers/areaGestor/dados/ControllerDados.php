<?php 

include_once __DIR__ . './Dados.php';



$id_user = $_POST['id_user'];
$id_hosp = $_POST['id_hosp'];

$dados = new Individual();
$dados->setIdUser($id_user);
$dados->setIdHosp($id_hosp);
$dados->setDadosIndividual();