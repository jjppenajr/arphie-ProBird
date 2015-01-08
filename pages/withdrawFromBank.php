<div id="back_button">
<a href="javascript:backBank();">BACK</a>
</div>
<?php
	include "../inc/functions.php";
	$db = new pb_functions();
?>
<script>
	function backBank(){
		$("#dp_content").load("pages/bankingMenu.php");
	}
</script>
<h2>WITHDRAW FROM BANK ACCOUNT</h2>
<form method="post" action="index.php">

	<select name="bank_id"><option value="0">SELECT BANK</option><?php $db->ddl_bankname(); ?></select>
	<select name="account_id"><option value="0">SELECT ACCOUNT</option><?php $db->ddl_bankaccounts(); ?></select>
	
	<input type="hidden" name="wBankFlag" />
	
	<input type="text" name="deposit_slip_no" placeholder="WITHDRAWAL SLIP NUMBER" />
	<input type="date" name="deposit_slip_date" placeholder="WITHDRAWAL SLIP DATE" />
	<input type="text" name="deposit_slip_amount" placeholder="AMOUNT" />
	
	
	<input type="submit" value="Withdraw" />

</form>