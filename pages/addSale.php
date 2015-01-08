<link rel="stylesheet" type="text/css" href="css/style.css">

<div id="back_button">
<a href="javascript:backSales();">BACK</a>
</div>

<?php
	include "../inc/functions.php";
	$db = new pb_functions();
?>
<script>
	function backSales(){
		$("#dp_content").load("pages/salesMenu.php");
	}

</script>
<body>
<h2>ADD SALE</h2>
<form method="post" action="index.php" onsubmit = "return validate_form(this)">
		<div id="order_main">
			<table id="om_table">
				<tr>
					<td><b>DATE:</b> </td>
					<td>
						<input type="date" name="sale_date" value=<?php print date("Y-m-d H:i:s"); ?> />
					</td>
				</tr>
				<tr>
					<td>
						<b>TOTAL:  </b>
					</td>
					<td>
						<input type="text" id="tot_po" name="tot_sale" />
					</td>
				</tr>
			</table>
		</div>
		<div id="s_order_items">
			<table id="tbl_oi" >
				<th>ITEM CODE</th>
				<th>ITEM DESCRIPTION</th>
				<th>ITEM SIZE</th>
				<th>ITEM COLOR</th>
				<th>QUANTITY</th>
				<th>PRICE</th>
				<th>AMOUNT</th>
				<th>ACTION</th>
				<tr>
					<td>
						<input type="text" onkeyup="a_prodno2(this,event)" name="prod_no[0]" id="prod_no" class="prod_no" onchange="getItemDetails(this)" />
						
					</td>
					<td>
						<select  data-placeholder="Choose an Item..." class="item_desc2" name="item_desc2[0]" onclick="getCode(this);" onchange="getCode(this);"><option selected></option><?php $db->ddl_itemsExisting(); ?></select>
					</td>
					<td><input type='text' name='item_size[0]' class='item_size' /></td>
					<td><input type='text' name='item_color[0]' class='item_color' /></td>
					<td><input type="number" name="item_qty[0]" class="item_qty" value='0' onkeyup='comp_amount(this)' onkeyup='comp_amount(this)'	 /></td>
					<td><input type="text" name="unit_price[0]" class="unit_price" value='0' onkeyup='comp_amount(this)' onkeyup='comp_amount(this)' /></td>
					<td><input type="text" name="item_amount[0]" class="item_amount" disabled value="0" /></td>
					<td><input onclick="addsaleitem(this)" type="button" value="ADD" id="myButton1"></input></td>
					
				</tr>
				<input type="hidden" name='len' id="item_length" value="1" />
			
				
			
			</table>
			<input type="submit" value="ADD SALE" name="sale_submit" class="posub" />
		</div>
			
				
			

</form>
<script src="jquery/jquery-latest.min.js" type="text/javascript"></script>
	<script src="jquery/jquery.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="scripts/chosen_v1.1.0/chosen.css">   
  <script src="scripts/chosen_v1.1.0/chosen.jquery.js" type="text/javascript"></script>
  <script type="text/javascript">
    var config = {
      '.item_desc3'           : {},
			 '.s_select'  : {}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }

    function validate_required(field,alerttxt){
	with (field){
	if (value==null||value==""){
		alert(alerttxt);return false;
	}
	else{
		return true;
	}}
	}
	function validate_form(thisform){
		
	with (thisform){
	if (document.salesForm.tot_sale.value==""){
			alert("Total amount is required.");
			document.salesForm.tot_sale.focus(); return false;}

	if(document.salesForm.prod_no.value==""){
		alert("Item code is required.");
			document.salesForm.prod_no.focus(); return false;
	}	

	}}
	function checkInteger(){
		var number = document.salesForm.tot_sale.value;
		
		if (isFinite(number)==false){
		 alert("Total must be an amount."); 
		 document.salesForm.tot_sale.focus() ; return false;
		}
		
		if(number_val<=0 ||  number_val == 0){
		 alert("Total amount must be greater than 0."); 
		 document.salesForm.tot_sale.focus() ; return false;
		}

		return(true);

	}

  </script>
</body>