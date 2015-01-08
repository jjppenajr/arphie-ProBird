<?php

	include "functions.php";
	$db = new pb_functions();


	if(isset($_POST['n1'])){
		die(json_encode($db->addCustomer($_POST['n1'],$_POST['n2'])));
	}
	if(isset($_POST['getmax'])){
		die(json_encode($db->getMaxCustomerId()));
	}
	if(isset($_POST['s1'])){
		die(json_encode($db->addSupplier($_POST['s1'],$_POST['s2'])));
	}
	if(isset($_POST['Sgetmax'])){
		die(json_encode($db->getMaxSupplierId()));
	}
	if(isset($_POST['c1'])){
		die(json_encode($db->addCategory($_POST['c1'])));
	}
	if(isset($_POST['Cgetmax'])){
		die(json_encode($db->getMaxCategoryId()));
	}
?>	