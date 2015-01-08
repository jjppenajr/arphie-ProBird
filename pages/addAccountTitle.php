<div id="back_button">
<a href="javascript:backAcc();">BACK</a>
</div>
<script>
	function backAcc(){
		$("#dp_content").load("pages/accountingMenu.php");
	}
</script>
<h2>ADD ACCOUNT TITLE</h2>
<form method="post" action="index.php">

	<input type="text" name="account_name" placeholder="ACCOUNT NAME" />
	<input type="hidden" name="addAccountTitleFlag" />
	<input type="submit" value="ADD NEW ACCOUNT TITLE" />

</form>