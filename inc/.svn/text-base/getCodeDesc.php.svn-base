<?php

	include "functions.php";
	$db = new pb_functions();


	if(isset($_POST['desc'])){
		die(json_encode($db->getItemDetail($_POST['desc'],2)));
	}
	if(isset($_POST['size'])){
		die(json_encode($db->getItemDetail($_POST['size'],8)));
	}
	if(isset($_POST['color'])){
		die(json_encode($db->getItemDetail($_POST['color'],3)));
	}
	if(isset($_POST['brand'])){
		die(json_encode($db->getItemDetail($_POST['brand'],6)));
	}
?>