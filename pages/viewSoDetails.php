<?php
	include "../inc/functions.php";
	$db = new pb_functions();
	$oid = $_GET['oid'];
?>
<form method="post" action="index.php">
<table class ="tbl_order_det">

	<tr><!--edit-->
		<td>ORDER DATE: </td>
		<td><span id="odate"><?php print $db->getOrderDetail($oid,1); ?></span></td>
	</tr>
	<tr>
		<td>CUSTOMER: </td>
		<td><span id="cname"><?php print $db->getCustomerName($db->getOrderDetail($oid,2)); ?></span></td>
		<td>TOTAL: </td>
		<td><span id="totalcost"><?php print number_format($db->getOrderDetail($oid,7),2);?></span></td>
	</tr>
	<input type="hidden" name="d1" value=<?php print $db->getOrderDetail($oid,1); ?> />
	<input type="hidden" name="payee" value="<?php $db->getCustomerName($db->getOrderDetail($oid,2)); ?>" />
	<input type="hidden" name="tot" value=<?php print $db->getOrderDetail($oid,7); ?> />
	<input type="hidden" name="oid" value=<?php print $oid; ?> />
	<input type="hidden" name="paymentflag" value="1" />
</table>
<?php

	$db->showOrderItems($oid);
	if($db->getOrderDetail($oid,8)==1){

		print "<button name='recpayment'>Record Payment</button>";
	}else if($db->getOrderDetail($oid,8)==2){
		print "<button name='releaseorder'>Release Order</button>";
	}
?>
</form>