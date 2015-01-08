<div id="back_button">
<a href="javascript:backAcc();">BACK</a>
</div>

<br/>
<script>
	function backAcc(){
		$("#dp_content").load("pages/accountingMenu.php");
	}
</script>
<?php
	
	include "../inc/functions.php";
	$db = new pb_functions();
	
	

	


?>

<table id="tbl_cashflow" style="text-align:center;margin:auto;">

	<thead><th colspan="3" style="text-align:center;">CASH FLOW</th></thead>
	
	<tr ><thead style="text-align:left;">
		<th width="70%"  >DATE</th>
		<th width="">INFLOW</th>
		<th width="">OUTFLOW</th></thead>
	</tr>
		<?php $db->generateCashFlow(); ?>
	

</table>