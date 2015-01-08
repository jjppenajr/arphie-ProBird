<div id="back_button">
<a href="javascript:backBank();">BACK</a>
</div>

<br>
<script>
	function backBank(){
		$("#dp_content").load("pages/bankingMenu.php");
	}
</script>
<?php
	include "../inc/functions.php";
	$db = new pb_functions();
?>
<h2>DELETE BANK ACCOUNT</h2><!--EDIT-->
<form method="post" action="index.php">
<select name="bank_acct" size="4"><?php $db->ddl_bankaccounts(); ?></select>
<input type="submit" name="delete_bankaccount" value="DELETE BANK ACCOUNT" />
</form>