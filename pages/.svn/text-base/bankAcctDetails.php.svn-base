<div id="back_button">
	<a href="javascript:backBank();">BACK</a>
</div>
<script>
	function backBank(){
		$("#dp_content").load("pages/bankingMenu.php");
	}
</script>
<br>

<?php
	include "../inc/functions.php";
	$db = new pb_functions();
?>

<h2>VIEW BANK ACCOUNT DETAILS</h2><!--EDIT-->
	<select name="bank_id" onchange="viewAccountDetails(this);"><option value="0">SELECT ACCOUNT</option><?php $db->ddl_bankaccounts(); ?></select>



<table id="bank_det">

	<tr>
		<td>
			ACCOUNT NUMBER: 
		</td>		
		<td>
			<input type="text" class="underline_input" id="anum" />
		</td>		
	</tr>
	<tr>
		<td>
			ACCOUNT NAME: 
		</td>		
		<td>
			<input type="text" class="underline_input" id="aname" />
		</td>		
	</tr>
	<tr>
		<td>
			BANK: 
		</td>		
		<td>
			<input type="text" class="underline_input" id="det_bank" />
		</td>		
	</tr>
	<tr>
		<td>
			BALANCE: 
		</td>		
		<td>
			<input type="text" class="underline_input" id="bank_bal" />
		</td>		
	</tr>

</table>