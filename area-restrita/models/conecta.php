<?php
	try{
		$conexao = new PDO('mysql:host=localhost;dbname=medh_u883305113', 'medh_u883305113', 'Me34we1*90wsd', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));;
		$conexao ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo 'Error:' . $e->getMessage();
	}
?>
