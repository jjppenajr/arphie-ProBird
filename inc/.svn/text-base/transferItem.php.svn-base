<?php

	include "functions.php";
	$db = new pb_functions();


	if(isset($_POST['from'])){
		die(json_encode($db->transferItem($_POST['from'],$_POST['to'],$_POST['qty'],$_POST['prod'],$_POST['d1'])));
	}
?>