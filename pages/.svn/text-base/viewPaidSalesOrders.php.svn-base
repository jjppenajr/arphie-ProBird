<div id="back_button">
<a href="javascript:backSales();">BACK</a>
</div>
<script>
	function backSales(){
		$("#dp_content").load("pages/salesMenu.php");
	}
</script>
<h2>VIEW PAID SALES ORDERS</h2><!--EDIT-->
<form method="get" action="index.php" class="frm_dates">

<table id="view_tbl">
	<tr>
		<td>FROM:</td>
		<td colspan="3"><input type="date" name="d1" /></td>
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
	
		$db->viewPaidSalesOrders();
	

	


?>

	<link rel="stylesheet" type="text/css" href="css/style.css">
