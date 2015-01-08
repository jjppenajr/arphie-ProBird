<?php

	include "functions.php";
	$db = new pb_functions();


	if(isset($_POST['getdet'])){
		die(json_encode($db->getBankAccountDetails($_POST['getdet'],$_POST['key'])));
	}
	
?>