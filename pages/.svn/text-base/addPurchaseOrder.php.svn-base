<div id="back_button">
<a href="javascript:backPurch();">BACK</a>
</div>
<br />
<?php

	include "../inc/functions.php";

	$db = new pb_functions();
?>
<script>
//edit
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
			if (document.addPO.sup.value=="SELECT SUPPLIER"){
					alert("Please select supplier");
					document.addPO.sup.focus(); return false;}

			if(document.addPO.prod_no.value==""){
				alert("Item code is required.");
					document.addPO.prod_no.focus(); return false;
			}else if(document.addPO.item_desc.value=="Choose an Item..."){
				alert("Item description is required.")
				document.addPO.item_desc.focus();return false;
			}
		}
	}
	function checkInteger(){
		var qty = document.addPO.item_qty.value;
		var unit = document.addPO.unit_price.value;
		if (isFinite(qty)==false){
		 alert("Must input numbers"); 
		 document.addPO.item_qty.focus(); 
		 return false;
		}
		if (isFinite(unit)==false){
		 alert("Must input numbers"); 
		 document.addPO.unit_price.focus(); return false;
		}
		
		if(unit<=0){
		 alert("Unit price must be greater than 0."); 
		 document.addPO.unit_price.focus(); return false;
		}

		return(true);
	}
//
function newCategory(){
	var choice = $('.item_category').find(":selected").text();

	if(choice == "New Category"){
	document.getElementById('new_cat').style.display='block';document.getElementById('fade').style.display='block';
	
	}
}
function add_newsup(c){
	console.log('a');
	var choice = $('#sup').find(":selected").text();

	if(choice == "New Supplier"){
		document.getElementById('new_sup').style.display='block';document.getElementById('fade').style.display='block';
	
	}
}
function addSupplier(){
	var name = document.getElementById('sup_name').value;
	var num = document.getElementById('sup_num').value;//edit

	$.post( "inc/addCustomer.php?", { s1:name,s2:num})
		  .done(function( data ) {
		  	var x = document.getElementById("sup");
			var option = document.createElement("option");

		  	data = data.replace(/%/g,'/')
		  	data = data.replace("\"",'')
		  	data = data.replace('"','')
			option.text = data;
			$.post( "inc/addCustomer.php?", { Sgetmax:name})
				  .done(function( data ) {
				  	option.value = data;
				  	
			  });
			
			x.add(option);
			x.selectedIndex = x.options.length-1; 
		  	
	  });


	document.getElementById('new_sup').style.display='none';
	document.getElementById('fade').style.display='none'
	
}
function addCategory(){
	var name = document.getElementById('cat_name').value;

	$.post( "inc/addCustomer.php?", { c1:name})
		  .done(function( data ) {
		  	var x = document.getElementById("cat");
			var option = document.createElement("option");

		  	data = data.replace(/%/g,'/')
		  	data = data.replace("\"",'')
		  	data = data.replace('"','')
			option.text = data;
			$.post( "inc/addCustomer.php?", { Cgetmax:name})
				  .done(function( data ) {
				  	option.value = data;
				  	
			  });
			
			x.add(option);
			x.selectedIndex = x.options.length-1; 
		  	
	  });


document.getElementById('new_cat').style.display='none';
document.getElementById('fade').style.display='none';

}
function backPurch(){
	$("#dp_content").load("pages/purchasesMenu.php");
}
function xSupplier(){//edit
	document.getElementById('new_sup').style.display='none';
	document.getElementById('fade').style.display='none';
	$('#sup option[selected="selected"]').each(
	    function() {
	        $(this).removeAttr('selected');
	    }
	);
	$("#sup option:first").attr('selected','selected');
}
function xCategory(){//edit
	document.getElementById('new_cat').style.display='none';
	document.getElementById('fade').style.display='none'
	$('#cat option[selected="selected"]').each(
	    function() {
	        $(this).removeAttr('selected');
	    }
	);
	$("#cat option:first").attr('selected','selected');
}


	
	
</script>
<form method="post" action="index.php" name="addPO" onsubmit="return validate_form(this)" ><!--edit-->


	<div id="order_main">
		<table id="om_table">
			<tr>
				<td><b>DATE:</b> </td>
				<td>
					<input type="date" name="po_date" required value=<?php print date("Y-m-d H:i:s"); ?> />
				</td>
			</tr>
			<tr>
				<td><b>SUPPLIER: </b> </td>
				<td>
					<select id="sup" onchange="add_newsup(this)" name="sid" required>
						<option name="sel">SELECT SUPPLIER</option>
						<option value="2">New Supplier</option>
						<?php $db->ddl_suppliers(); ?>
					</select>
				</td>
			</tr><tr>
				<td>
					<b>TOTAL:  </b>
				</td>
				<td>
					<input type="text" id="tot_po" name="tot_po" required/>
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
		<div id="new_sup" class="white_content">
				<input type="button" style="float:right;width:50px;" value="X" id="close_btn" onclick="xSupplier()"/><br><br><br><!--edit-->
				<table>
					<tr>
						<td>Supplier Name:</td>
						<td><input type="text" id="sup_name"/></td>
					</tr>
					<tr>
						<td>Contact Number:</td>
						<td><input type="number" id="sup_num"/></td>
					</tr>
					<tr>
						
						<td colspan="2"><input type="button" style="width:100%;" value="ADD SUPPLIER" name="new_sup_submit" class="posub" onclick = "addSupplier();"/></td>
					</tr>
				</table>
				

		</div>
		<div id="fade" class="black_overlay"></div>
	</div>
	<div id="order_items">
		<table id="tbl_oi">
			<th>NEW?</th>
			<th>ITEM CODE</th>
			<th>ITEM DESCRIPTION</th>
			<th>ITEM SIZE</th>
			<th>ITEM COLOR</th>
			<th>BRAND</th>
			<th>QUANTITY</th>
			<th>UNIT PRICE</th>
			<th>AMOUNT</th>
			<th>CATEGORY</th>
			<th>ACTION</th>
			<tr>
				<td><input type="checkbox" onclick='isNew(this);' class='cbox_po' name="itemIsNew[0]" /></td>
				<td>
					<input type="text" onkeyup="a_prodno(this,event)" name="prod_no[0]" id="prod_no" class="prod_no"  />
					
				</td>
				<td>
					<textarea name="item_desc[0]" class="item_desc" style="display:none"; ></textarea>
					<select  data-placeholder="Choose an Item..." class="chosen-select" name="item_desc2[0]" value="" onclick="getCode(this);" onchange="getCode(this);"><option selected></option><?php $db->ddl_items(); ?></select>
				</td>
				<td><input type='text' name='item_size[0]' class='item_size' /></td>
				<td><input type='text' name='item_color[0]' class='item_color' /></td>
				<td><input type='text' name='item_brand[0]' class='item_brand' /></td>
				<td><input type="number" name="item_qty[0]" class="item_qty" value='0' onkeyup='comp_amount(this)' onkeyup='comp_amount(this)'	min = "0" onblur='checkInteger()'/></td>
				<td><input type="text" name="unit_price[0]" class="unit_price" value='0' onkeyup='comp_amount(this)' onkeyup='comp_amount(this)' onblur='checkInteger()'/></td>
				<td><input type="text" name="item_amount[0]" class="item_amount" disabled value="0" /></td>
				<td>
					<select id='cat' name='item_category[0]' onchange="newCategory();" class='item_category' >
						<option value="0">Choose Category</option>
						<option value="9999">New Category</option>
						<?php $db->ddl_categories(); ?>
					</select>
				</td>
				<td><input onclick="additem(this)" type="button" value="ADD" id="myButton1"></input></td>
			</tr>
		</table>
		<input type="submit" value="ADD PURCHASE" name="po_submit" class="posub" />
			<input type="hidden" name='len' id="item_length" value="1" />
		<div id="new_cat" class="white_content">
				<input type="button" style="float:right;width:50px;" value="X" id="close_btn" onclick="xCategory()"/><br><br><br>
				<table>
					<tr>
						<td>Category Name:</td>
						<td><input type="text" id="cat_name"/></td>
					</tr>
					
					<tr>
						<td colspan="2"><input type="button" style="width:100%;" value="ADD CATEGORY" name="new_cat_submit" class="posub" onclick = "addCategory();"/></td>
					</tr>
				</table>
					
		</div>
		<div id="fade" class="black_overlay"></div>
	</div>
	

</form>
	<script src="jquery/jquery-latest.min.js" type="text/javascript"></script>
	<script src="jquery/jquery.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="scripts/chosen_v1.1.0/chosen.css">   
  <script src="scripts/chosen_v1.1.0/chosen.jquery.js" type="text/javascript"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
			 '.s_select'  : {}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>