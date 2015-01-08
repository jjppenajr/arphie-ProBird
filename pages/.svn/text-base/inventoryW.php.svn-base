<h2 style="text-align:center;">INVENTORY</h2>
<select id="filter_inv">
	<option value="0">ALL</option>
	<option value="1" selected>WAREHOUSE </option>
	<option value="2">SHOP</option>
	<option value="3">RESERVED</option>
</select>
<input type="submit" name="invFilterFlag" value="FILTER" onclick="filterInv();" />
<?php
	include "../inc/functions.php";
	$db = new pb_functions();
	$db->showInventoryW();
?>
<script>
	function filterInv(){
		var flag = document.getElementById('filter_inv').value;
		if(flag==0){
			$('#dp_content').load("pages/inventory.php");	
		}else if(flag==1){
			$('#dp_content').load("pages/inventoryW.php");	
		}else if(flag==2){
			$('#dp_content').load("pages/inventoryS.php");	
		}else if(flag==3){
			$('#dp_content').load("pages/inventoryR.php");	
		}
		
	}
</script>

