<?php
	include "../inc/functions.php";
	$db = new pb_functions();
?>
<script type="text/javascript">
function amount_paid(){
	var disc = document.getElementById("discount").value;	
	var tot = document.getElementById("total").value; 
	ap = tot-((disc/100)*tot);
	document.getElementById("ap").value = ap;
}
</script>
<script type="text/javascript">
function discount_value(){
	var amnt = document.getElementById("ap").value;
	var tot = document.getElementById("total").value;
	console.log(amnt);
	dc = 100-((amnt/tot)*100);
	document.getElementById("discount").value = dc;

}
	

</script>
<form method="post" action="index.php" >

	<table>

		<tr>
			<td>
				ORDER DATE: 
			</td>
			<td>
				<span><?php print $_GET['d1']; ?></span> 
				<input type="hidden" name="d1" value=<?php print $_GET['d1']; ?> />
				<input type="hidden" name="oid" value=<?php print $_GET['oid']; ?> />
			</td>
		</tr>
		<tr>
			<td>
				SUPPLIER/CUSTOMER: 
			</td>
			<td>
				<?php print $_GET['payee']; ?>
				<input type="hidden" name="payee" value="<?php print $_GET['payee']; ?> "/>
			</td>
		</tr>
		<tr>
			<td>
				TOTAL: 
			</td>
			<td>
				<span><?php print $_GET['tot']; ?></span> 
				<input type="hidden"  id="total" name="total" value="<?php print $_GET['tot']; ?> "/>
			</td>
		</tr>
		<tr>
			<td>
				DISCOUNT: (%)
			</td>
			<td>
				<input type="text" id="discount" name="discount" onkeyup="amount_paid()">
			</td>
		</tr>
		<tr>
			<td>
				AMOUNT PAID:
			</td>
			<td>
				<input type="text" id="ap" name="tot" onkeyup="discount_value()">	
			</td>
		</tr>	
		<tr>
			
			<td>
				PAYMENT DATE: 
			</td>
			<td>
				<input type="date" name="d2" />
			</td>
		</tr>
		<tr>
			<td>
				<input type='radio' name='group' id="bt-1" value=1 onclick="hide('checkdets');" checked > CASH
				<?php 
					if($_GET['paymentflag']==1){

					}else{
						print "<input type='radio' name='group' id=\"bt-2\" value=2 onclick=\"show('checkdets');\" >CHECK	";	
					}
				?>
				
			</td>
			<td id="checkdets" style="display:none;">
				<input type="text" name="checkno" placeholder="CHECK NUMBER" />
				<input type="date" name="checkdate" placeholder="CHECK DATE" />
				<select name="acct"><?php $db->ddl_bankaccounts(); ?></select>
			</td>
		</tr>
		<tr>
			<td>
				<?php
					if($_GET['paymentflag']==1){
						print '<input type="hidden" name="paymentrecorded2" />';
					}else{
						print '<input type="hidden" name="paymentrecorded" />';
					}
				?>
				
				
			</td>
		</tr>

	</table>
	<input type="submit" name="record" value="RECORD PAYMENT"/>
</form>