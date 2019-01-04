<?php 
	try{
		$handler = new PDO('mysql:host=127.0.0.1;dbname=nutriappitsa','root',''); //Localhost
		$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo $e->getMessage();
	}	

	include_once 'dashBoard.class.php';
	include_once 'dashBoardDieta.class.php';
	include_once 'dashBoardDietaSemana.class.php';
	$ObjectDashboard = new dashBoard($handler);
	$ObjectDashboardDieta = new dashBoardDieta($handler);
	$ObjectDashboardDietaSemana = new dashBoardDietaSemana($handler);
?>