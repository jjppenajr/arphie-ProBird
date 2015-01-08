<div id="back_button">
<a href="javascript:backAcc();">BACK</a>
</div>
<?php
	include "../inc/functions.php";
	$db = new pb_functions();
?>
<script>
	function backAcc(){
		$("#dp_content").load("pages/accountingMenu.php");
	}
</script>
<h2>ADD EXPENSE</h2>
<form method="post" action="index.php">

	<textarea name="particulars"></textarea>
	<input type="text" name="amount" placeholder="AMOUNT" />
	<input type="date" name="exp_date"  />
	<select name="acct_title"><option value="0">SELECT ACCOUNT TITLE</option><?php $db->ddl_acctTitles(); ?></select>

	<input type="hidden" name="addExpenseFlag" />
	<input type="submit" value="ADD NEW ACCOUNT TITLE" />

</form>