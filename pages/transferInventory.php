<form method="get" action="index.php" class="frm_dates">

	FROM:<input type="date" name="d1" />
	TO:<input type="date" name="d2" />
	<input type="hidden" name="vpo" value="1" />
	<input type="submit" value="SHOW" />


</form>
<?php
	
	include "../inc/functions.php";
	$db = new pb_functions();
	
		$db->viewPurchaseOrders();
	

	


?>

	<link rel="stylesheet" type="text/css" href="css/style.css">
