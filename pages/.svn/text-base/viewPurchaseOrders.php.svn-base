<?php

?>
<div id="back_button">
<a href="javascript:backPurch();">BACK</a>
</div>
<script>
	function backPurch(){
	$("#dp_content").load("pages/purchasesMenu.php");
}
</script>
<h2>VIEW UNPAID ORDERS</h2>
<form method="get" action="index.php" class="frm_dates">

	<table id="view_tbl">
	<tr>
		<td>FROM:</td>
		<td><input type="date" name="d1" /></td>
	</tr>
	<tr>
		<td>TO:</td>
		<td><input type="date" name="d2" /></td>
	</tr>
	<tr>
		<td><input type="hidden" name="vpo" value="1" /></td>
	</tr>
</table>
	<input type="submit" value="SHOW" />


</form>
<?php
	
	include "../inc/functions.php";
	$db = new pb_functions();
	
		$db->viewPurchaseOrders();
	

	


?>

	<link rel="stylesheet" type="text/css" href="css/style.css">
