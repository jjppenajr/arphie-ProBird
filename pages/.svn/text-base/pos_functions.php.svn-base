<?php

	include "../inc/functions.php";
	$db = new pb_functions();

	if(isset($_POST['pos_code'])){
		die(json_encode($db->getItemDetail($_POST['pos_code'],2)));
		
		//
	}if(isset($_POST['pos_code_cost'])){
		die(json_encode($db->getItemDetail($_POST['pos_code_cost'],5)));
		
		//
	}
?>