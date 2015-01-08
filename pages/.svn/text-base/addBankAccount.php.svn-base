<div id="back_button">
	<a href="javascript:backBank();">BACK</a>
</div>
<script>
	function backBank(){
		$("#dp_content").load("pages/bankingMenu.php");
	}
</script>
<?php
	include "../inc/functions.php";
	$db = new pb_functions();
?>
<h2>ADD BANK ACCOUNT</h2>
<form method="post" action="index.php">

	<select name="bank_id"><option value="0">SELECT BANK</option><?php $db->ddl_bankname(); ?></select>
	<input type="text" name="account_name" placeholder="ACCOUNT NAME" />
	<input type="text" name="account_num" placeholder = "ACCOUNT NUMBER" />
	<input type="text" name="bal" placeholder = "INITIAL BALANCE" />
	<input type="hidden" name="addbank_flag" />
	<input type="submit" value="ADD NEW ACCOUNT" />

</form>