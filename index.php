<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:login.php");
	}else{

	}
	include "inc/functions.php";

	$db = new pb_functions();
	if(isset($_POST['release_order_flag'])){
		//Remove from reserved inventory
		$oid = $_POST['oid'];
		$db->releaseOrder($oid,$_POST['d1']);
		$db->changeFlag($oid,3);
	}
	if(isset($_POST['addExpenseFlag'])){
		$particulars = $_POST['particulars'];
		$amount = $_POST['amount'];
		$exp_date = $_POST['exp_date'];
		$acct_title = $_POST['acct_title'];
		$db->addExpense($particulars,$amount,$exp_date,$acct_title);
	}
	if(isset($_POST['addAccountTitleFlag'])){
		$name = $_POST['account_name'];
		$db->addAccountTitle($name);
	}
	if(isset($_POST['sale_submit'])){
		$d1 = $_POST['sale_date'];
		$tot = $_POST['tot_sale'];
		$cid = $_POST['cid'];
		$arrlen = $_POST['len'];
		$si = $db->getMaxSalesId();
		$term = 1;
		for($i=0;$i<$arrlen;$i++){
			$ic = $_POST['prod_no'][$i];	
			$price= $_POST['unit_price'][$i];
			$qty= $_POST['item_qty'][$i];

				//$db->addSaleOrderItem($oid,$ic,$qty,$price);
				$db->addCashSaleItem($si,$ic,$qty,$price);
				$cost = $db->getItemDetail($ic,5);
				$db->addToInventory($ic,$d1,$qty*-1,$cost,2);
		}
	//	$db->addSaleOrder($oid,$d1,$cid,$tot);
		$db->addCashSale($si,$cid,$d1,$term,$tot);
	}
	if(isset($_POST['sales_order_submit'])){
		$d1 = $_POST['sale_date'];
		$tot = $_POST['tot_sale'];
		$cid = $_POST['cid'];
		$arrlen = $_POST['len'];
		$oid = $db->getMaxOrderId();
		$si = $db->getMaxSalesId();
		$term = 1;
		for($i=0;$i<$arrlen;$i++){
			$ic = $_POST['prod_no'][$i];	
			$price= $_POST['unit_price'][$i];
			$qty= $_POST['item_qty'][$i];
				$db->addSaleOrderItem($oid,$ic,$qty,$price);
				//$db->addCashSaleItem($ic,$qty,$price);
				$db->addSaleItem($si,$ic,$qty,$price);
				$cost = $db->getItemDetail($ic,5);
				$db->addToInventory($ic,$d1,$qty*-1,$cost,1);
				$db->addToInventory($ic,$d1,$qty,$cost,3);

		}
		$db->addSaleOrder($oid,$d1,$cid,$tot);
		$db->addSale($si,$cid,$d1,$term,$tot);
		//$db->addCashSale($cid,$d1,$term,$tot);
	}
	if(isset($_POST['depositToBankFlag'])){
		$bank = $_POST['bank_id'];
		$account = $_POST['account_id'];
		$num = $_POST['deposit_slip_no'];
		$d1 = $_POST['deposit_slip_date'];
		$amt = $_POST['deposit_slip_amount'];
		$db->addDeposit($bank,$account,$num,$d1,$amt);
	}
	if(isset($_POST['wBankFlag'])){
		$bank = $_POST['bank_id'];
		$account = $_POST['account_id'];
		$num = $_POST['deposit_slip_no'];
		$d1 = $_POST['deposit_slip_date'];
		$amt = $_POST['deposit_slip_amount'];
		$db->addWithdrawal($bank,$account,$num,$d1,$amt);
	}
	if(isset($_POST['receive_order_flag'])){
		$oid = $_POST['oid'];	
		$db->receiveOrder($oid,$_POST['d1']);
		$db->changeFlag($oid,3);
	}
	if(isset($_POST['po_submit'])){ //add purchase order
		$d1 = $_POST['po_date'];
		$sid = $_POST['sid'];
		$tot = $_POST['tot_po'];
		$arrlen = $_POST['len'];
		$oid = $db->getMaxOrderId();
		$pid = $db->getMaxPurchaseId();
		for($i=0;$i<$arrlen;$i++){
			$price= $_POST['unit_price'][$i];
			$qty= $_POST['item_qty'][$i];
			$color= $_POST['item_color'][$i];
			$brand= $_POST['item_brand'][$i];
			$category= $_POST['item_category'][$i];
			$size= $_POST['item_size'][$i];

			if(isset($_POST['itemIsNew'][$i])){
				$ic = $db->getNextItemId();
				$item_desc= $_POST['item_desc'][$i];
				$db->addNewItem($ic,$item_desc,$sid,$price,$color,$brand,$category,$size);
			}else{
				$ic = $_POST['prod_no'][$i];
			}
			
				$db->addPurchaseOrderItem($oid,$ic,$qty,$price);
				$db->addPurchaseItem($pid,$ic,$qty,$price);

			/*if($_POST['itemIsNew'][$i]==1){
				$item_id= $_POST['item_desc'][$i];
				$qty= $_POST['item_qty'][$i];
				$price= $_POST['unit_price'][$i];
			}*/
			

			//$ic = $db->getMaxItemCode();
			//$db->addPurchaseOrderItem($oid,$ic,$qty,$price);
		}
		$db->addPurchase($d1,$sid,$tot,1);
		$db->addPurchaseOrder($oid,$d1,$sid,$tot);
	}
	if(isset($_POST['addbank_flag'])){
		$bid = $_POST['bank_id'];
		$aname = $_POST['account_name'];
		$anum = $_POST['account_num'];
		$bal = $_POST['bal'];
		$db->addBankAccount($anum,$aname,$bid,$bal);
	}
	if(isset($_POST['delete_bankaccount'])){
		$db->deleteBankAccount($_POST['bank_acct']);
	}
	if(isset($_POST['paymentrecorded'])){
		if(isset($_POST['oid'])){
			$db->payOrder($_POST['oid']);
		}
		$payee = $_POST['payee'];
		$pdate = $_POST['d2'];
		$term = $_POST['group'];
		$amt = $_POST['tot'];
		$disc = $_POST['discount'];
		$total = $_POST['total'];
		$amount = $total - $amt;
		
		if($term == 1){
			$cno = null;
			$cdate =null; 
			$acct = null;
		}else if($term == 2){
			$cno = $_POST['checkno'];
			$cdate =$_POST['checkdate']; 
			$acct = $_POST['acct'];
		}
			
			$db->recpayment($payee,$pdate,$amt,$term,$cno,$cdate,$acct);
		//if($disc > 0){
			$db->addExpense("discount",$amount,$pdate,9);
		//}

	}
	//if(isset($_POST['record'])){
	//	echo '<script type="text/javascript">','displayPurch();',' </script>';
	//}
	if(isset($_POST['paymentrecorded2'])){
		if(isset($_POST['oid'])){
			$db->payOrder($_POST['oid']);
		}
		$payee = $_POST['payee'];
		$pdate = $_POST['d2'];
		$term = $_POST['group'];
		$amt = $_POST['tot'];
		$total = $_POST['total'];
		$amount = $total - $amt;
		if($term == 1){
			$cno = null;
			$cdate =null; 
			$acct = null;
		}else if($term == 2){
			$cno = $_POST['checkno'];
			$cdate =$_POST['checkdate']; 
			$acct = $_POST['acct'];
		}
			$db->recpayment2($payee,$pdate,$amt,$term,$cno,$cdate,$acct);
		if($disc > 0){
			$db->addExpense("discount",$amount,$pdate,9);
		}	
		
	}
?>
<!DOCTYPE>
<html>
<head>
	<title></title>

	<link rel="stylesheet" href="inc/colorbox/example1/colorbox.css" />
	<script src="jquery/jquery.js"></script>
	<script src="jquery/jquery.colorbox.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="jquery/jquery-latest.min.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/jquery-1.7.2.js"></script>
	<script type="text/javascript">
	    $( document ).ready( function(){
	        $('.nav-bar').on('click','.step_box',function () {
	             $('.step_box').removeClass('selected');
	             $(this).addClass('selected')
	             $('#menu_home')[0].style.background = "rgb(76,70,)";
	        });

/*

	C = 12

	Ch

	0001 0010 B

	18D


*/

	    });
    </script>

	<script>
	/*function displayPurch(){
		$("#dp_content").load("pages/viewPurchaseOrders.php");
	}*/
	function add_newsup(c){
		var supplier = c.value;
		console.log(supplier);
		if (supplier == "New Supplier") {
			var newwin = window.open('pages/newSupplier.php #container');
			
			console.log(supplier);

		}
	}
	function proddet(c){
		$('#dp_content').load("pages/productDetail.php?code="+c);


	}
	function transfer(c,flag){
		/*var newwin = window.open('pages/transferInventory.php #container','width=200','height=300');*/

		/*etolang*/
		document.getElementById('trans').style.display='block';document.getElementById('fade').style.display='block';
		
		
	}
	function transferItem(){
		var f1 = document.getElementById('from').value;
		var t1 = document.getElementById('to').value;
		var d1 = document.getElementById('d1').value;
		var q1 = document.getElementById('qty_i').value;
		var prod = document.getElementById('prodcode').value;
		document.getElementById('trans').style.display='none';
		document.getElementById('fade').style.display='none';
		$.post( "inc/transferItem.php?", { from: f1, to: t1,qty: q1,prod:prod,d1:d1})
				  .done(function( data ) {
				  	
			  });

	}
	</script>
	<script src="scripts/menuevents.js" type="text/javascript"></script>

	<script>
		$(document).ready(function() {

			
		  $(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
			 
		      return false;
		    }
		  });


		 // $(".group1").colorbox({rel:'group1'});
		});
		
	</script>
	<script>
	
	function add_newsup(c){
		var supplier = c.value;
		console.log(supplier);
		if (supplier == "New Supplier") {
			var newwin = window.open('pages/newSupplier.php #container');
			
			console.log(supplier);

		}
	}
	function proddet(c){
		$('#dp_content').load("pages/productDetail.php?code="+c);


	}
	function transfer(c,flag){
		/*var newwin = window.open('pages/transferInventory.php #container','width=200','height=300');*/

		/*etolang*/
		document.getElementById('trans').style.display='block';document.getElementById('fade').style.display='block';
		
		
	}
	function transferItem(){
		var f1 = document.getElementById('from').value;
		var t1 = document.getElementById('to').value;
		var d1 = document.getElementById('d1').value;
		var q1 = document.getElementById('qty_i').value;
		var prod = document.getElementById('prodcode').value;
		document.getElementById('trans').style.display='none';
		document.getElementById('fade').style.display='none';
		$.post( "inc/transferItem.php?", { from: f1, to: t1,qty: q1,prod:prod,d1:d1})
				  .done(function( data ) {
				  	
			  });

	}
	</script>
	<script src="scripts/menuevents.js" type="text/javascript"></script>

	<script>
		$(document).ready(function() {

			
		  $(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
			 
		      return false;
		    }
		  });


		 // $(".group1").colorbox({rel:'group1'});
		});
		
	</script>
	<script>

		function additem(c){
			//console.log($(this).parent());
			tbl = document.getElementById('tbl_oi');
			// Create an empty <tr> element and add it to the 1st position of the table:
			var row = tbl.insertRow(-1);

			// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
			var cell = row.insertCell(0);
			var cell0 = row.insertCell(1);
			var cell1 = row.insertCell(2);
			var cell2 = row.insertCell(3);
			var cell3 = row.insertCell(4);
			var cell4 = row.insertCell(5);
			var cell5 = row.insertCell(6);
			var cell6 = row.insertCell(7);
			var cell7 = row.insertCell(8);
			var cell8 = row.insertCell(9);
			var cell9 = row.insertCell(10);

			// Add some text to the new cells:
			var i_index = document.getElementById('item_length').value;
			cell.innerHTML = "<input type=\"checkbox\" onclick='isNew(this);' class='cbox_po' name=\"itemIsNew["+i_index+"]\"   />";
			cell0.innerHTML = "<input type=\"text\" onkeyup=\"a_prodno(this,event)\" name=\"prod_no["+i_index+"]\" id=\"prod_no["+i_index+"]\"  class=\"prod_no\" />"
			cell1.innerHTML = "<textarea name=\"item_desc["+i_index+"]\" class=\"item_desc\" style='display:none;' ></textarea><select  data-placeholder=\"Choose an Item...\" class=\"chosen-select\" onclick=\"getCode(this);\" onchange=getCode(this); name=\"item_desc["+i_index+"]\"><option selected></option><?php $db->ddl_items(); ?></select>";
			cell2.innerHTML = "<input type='text' name='item_size[0]' class='item_size' />";
			cell3.innerHTML = "<input type='text' name='item_color[0]' class='item_color' />";
			cell4.innerHTML = "<input type='text' name='item_brand[0]' class='item_brand' />";
			cell5.innerHTML = "<input type=number name='item_qty["+i_index+"]' value='0' class=item_qty onkeyup='comp_amount(this)' onkeyup='comp_amount(this)' />";
			cell6.innerHTML = "<input type=text name='unit_price["+i_index+"]' value='0' class=unit_price onkeyup='comp_amount(this)' onkeyup='comp_amount(this)' />";
			cell7.innerHTML = "<input type=\"text\" name=item_amount["+i_index+"] class=item_amount disabled value='0'  />";
			cell9.innerHTML = "<input onclick=\"additem(this)\" type=\"button\" value=\"ADD\" id=\"myButton1\"></input>";
			cell8.innerHTML = "<select id='cat' name='item_category["+i_index+"]' onchange=\"newCategory();\" class='item_category' ><option value=0>Choose Category</option><option value=9999>New Category</option><?php $db->ddl_categories(); ?></select>";

			c.value = "X";
			c.onclick=function() {deleteitem(c);} 
			document.getElementById('item_length').value = parseInt(document.getElementById('item_length').value)+1; 
			var config = {
		      '.chosen-select'           : {},
					 '.s_select'  : {}
		    }
		    for (var selector in config) {
		      $(selector).chosen(config[selector]);
		    }

		}
		function addsaleitem(c){
			tbl = document.getElementById('tbl_oi');
			// Create an empty <tr> element and add it to the 1st position of the table:
			var row = tbl.insertRow(-1);

			// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
			var cell = row.insertCell(0);
			var cell0 = row.insertCell(1);
			var cell1 = row.insertCell(2);
			var cell2 = row.insertCell(3);
			var cell3 = row.insertCell(4);
			var cell4 = row.insertCell(5);
			var cell5 = row.insertCell(6);
			var cell6 = row.insertCell(7);
			

			// Add some text to the new cells:
			var i_index = document.getElementById('item_length').value;
			cell.innerHTML = '<input type="text" onkeyup="a_prodno(this,event)" name="prod_no['+i_index+']" id="prod_no['+i_index+']" class="prod_no" onchange="getItemDetails(this)" />';
			cell0.innerHTML = '<select class="item_desc2" name="item_desc['+i_index+']" onclick="getCode(this);" onchange="getCode(this);"><option selected></option>'+"<?php $db->ddl_items(); ?>"+'</select>'
			cell1.innerHTML = "<input type='text' name='item_size["+i_index+"]' class='item_size' />";
			cell2.innerHTML = "<input type='text' name='item_color["+i_index+"]' class='item_color' />";
			cell3.innerHTML = "<input type=\"number\" name=\"item_qty["+i_index+"]\" class=\"item_qty\" value='0' onkeyup='comp_amount(this)' onkeyup='comp_amount(this)'	 />";
			cell4.innerHTML = "<input type=\"text\" name=\"unit_price["+i_index+"]\" class=\"unit_price\" value='0' onkeyup='comp_amount(this)' onkeyup='comp_amount(this)' />";
			cell5.innerHTML = '<input type="text" name="item_amount['+i_index+']" class="item_amount" disabled value="0" />';
			cell6.innerHTML = "<input onclick=\"addsaleitem(this)\" type=\"button\" value=\"ADD\" id=\"myButton1\"></input>";


			c.value = "X";
			c.onclick=function() {deleteitem(c);} 
			document.getElementById('item_length').value = parseInt(document.getElementById('item_length').value)+1; 
			var config = {
		      '.item_desc3'           : {},
					 '.s_select'  : {}
		    }
		    for (var selector in config) {
		      $(selector).chosen(config[selector]);
		    }

		}
		function focusId(id){
			$('#'+id).focus();
			console.log(id);
		}
		function print_codes(c){
			var index = c.parentNode.parentNode.rowIndex-1;
			var code = document.getElementsByClassName('purch_codes')[index].value;

			var mywindow = window.open('inc/barcode/barcode_image.php?code=' + code);
			
			mywindow.window.document.location.reload(true);
			console.log(mywindow.window);
			//mywindow.close();
		  	mywindow.print();
			
		}
		function deleteitem(c){
			var index = c.parentNode.parentNode.rowIndex;
			tbl = document.getElementById('tbl_oi');
			tbl.deleteRow(index);
			document.getElementById('item_length').value = parseInt(document.getElementById('item_length').value)-1; 
		}
		function comp_amount(q){
			var index;
			index = q.parentNode.parentNode.rowIndex-1;
			var qty = document.getElementsByClassName('item_qty')[index].value;
			var price = document.getElementsByClassName('unit_price')[index].value;
			var amount = document.getElementsByClassName('item_amount')[index];
			totprice = qty * price;
			amount.value = totprice.toFixed(2);
			comp_tot()
		}
		function comp_tot(){
			var i;
			var tot=0;
			for(i=0;i<document.getElementById("item_length").value;i++){
				tot = tot + parseFloat(document.getElementsByClassName("item_amount")[i].value);
			}
			document.getElementById("tot_po").value = tot.toFixed(2);
		}
		function getCode(c){
			data = c.value;
			var index;
			index = c.parentNode.parentNode.rowIndex-1;
			$.post( "inc/getCodeDesc.php?", { size: data})
				  .done(function( data ) {
				  	data = data.replace(/%/g,'/')
    			  	data = data.replace("\"",'')
    			  	data = data.replace('"','')
				  	document.getElementsByClassName('item_size')[index].value = data;
			  });

			$.post( "inc/getCodeDesc.php?", { color: data})
				  .done(function( data ) {
				  	data = data.replace(/%/g,'/')
    			  	data = data.replace("\"",'')
    			  	data = data.replace('"','')
				  	document.getElementsByClassName('item_color')[index].value = data;
			  });


			$.post( "inc/getCodeDesc.php?", { brand: data})
				  .done(function( data ) {
				  	data = data.replace(/%/g,'/')
    			  	data = data.replace("\"",'')
    			  	data = data.replace('"','')
				  	document.getElementsByClassName('item_brand')[index].value = data;
			  });

		  	document.getElementsByClassName('prod_no')[index].value = data;
		}
		function getItemDetails(c){
			data = c.value.substring(0, c.value.length-1);
			var index;
			index = c.parentNode.parentNode.rowIndex-1;
			$.post( "inc/getCodeDesc.php?", { size: data})
				  .done(function( data ) {
				  	data = data.replace(/%/g,'/')
    			  	data = data.replace("\"",'')
    			  	data = data.replace('"','')
				  	document.getElementsByClassName('item_size')[index].value = data;
			  });

			$.post( "inc/getCodeDesc.php?", { color: data})
				  .done(function( data ) {
				  	data = data.replace(/%/g,'/')
    			  	data = data.replace("\"",'')
    			  	data = data.replace('"','')
				  	document.getElementsByClassName('item_color')[index].value = data;
			  });


			console.log(document.getElementsByClassName('item_desc2')[index].value);
		  	document.getElementsByClassName('item_desc2')[index].value = data;
		  	console.log(document.getElementsByClassName('item_desc2')[index].value)
		}

		function a_prodno(c,q){
			var index;
			index = c.parentNode.parentNode.rowIndex-1;
			var qty = document.getElementsByClassName('item_size')[index];
			if(q.keyCode=='13'){
				qty.focus();	
			}
			
		}
		function a_prodno2(c,q){
			var index;
			index = c.parentNode.parentNode.rowIndex-1;
			var qty = document.getElementsByClassName('item_qty')[index];
			if(q.keyCode=='13'){
				qty.focus();	
				qty.value="";	
			}
			document.getElementById('right_pane').style.display='block';
			
		}
		function hide(one) {
		    document.getElementById(one).style.display = 'none';
		    
		}
		function show(two){
			document.getElementById(two).style.display = 'block';
		}
		function isNew(c){
			var index;
			index = c.parentNode.parentNode.rowIndex-1;
			var desc = document.getElementsByClassName('item_desc')[index];
			var desc2 = document.getElementsByClassName('chosen-select')[index];
			var desc3 = document.getElementsByClassName('chosen-container')[index];
			console.log(desc3.style.display);
			var pc = document.getElementsByClassName('prod_no')[index];
			if(c.checked == true){
				pc.disabled = true;
				desc.style.display = "";
				desc3.style.display = "none";
			}else{
				pc.disabled = false;
				desc.style.display = "none";
				desc3.style.display = "";
			}
		}
		function viewpodetail(oid){
			$("#dp_content").load("pages/viewPoDetails.php?oid="+oid);
		}
		function viewsodetail(oid){
			$("#dp_content").load("pages/viewSoDetails.php?oid="+oid);
		}
		function viewAccountDetails(anum){
			data = anum.value;
			i=0;
			$.post( "inc/getacctdet.php?", { getdet: data,key:i})
				  .done(function( data ) {
				  	console.log(data);
				  	data = data.replace(/"/g, "");
				  	document.getElementById('anum').value = data;
			  });
				  
			
			$.post( "inc/getacctdet.php?", { getdet: data,key:1})
				  .done(function( data ) {
				  	console.log(data);
				  	data = data.replace(/"/g, "");
				  	 document.getElementById('aname').value = data;
			  });
				 
			
			$.post( "inc/getacctdet.php?", { getdet: data,key:2})
				  .done(function( data ) {
				  	console.log(data);
				  	data = data.replace(/"/g, "");
				  	 document.getElementById('det_bank').value = data
			  });
				 
			
			$.post( "inc/getacctdet.php?", { getdet: data,key:3})
				  .done(function( data ) {
				  	console.log(data);
				  	data = data.replace(/"/g, "");
				  	 document.getElementById('bank_bal').value = data
			  });
				 
			
		}
		
	</script>

</head>
<body>
	<div class="main-container">
		<div id="upper">
			<div id="header">
				<div id="img_hdr">
					<img src="css/images/header.png" width="60%">
				</div>
				<div id="logout">
					<br>
						<?php
							if(isset($_SESSION['username'])){
							  echo '<strong>'."WELCOME! ".'</strong>' .$_SESSION['username']. " |";
							}
						?>
						<a href="logout.php">Logout</a>
				</div>

			</div>
		</div>
		<div id="lower">
			<div id="left_part">
			
				<div id="body">
				<?php

					if(isset($_SESSION['username'])){
						$al = $db->getUserAcess($_SESSION['username']);
						if($al==1){
							print '

								<div id="nav-bar" class="nav-bar">
										<ul id="nav">
											<li class="step_box" id="menu_home" style="background-color: #e3f9ed color:black"><a href="index.php">HOME</a></li>
											<li class="step_box" id="menu_inventory"><a href="#">INVENTORY</a></li>
											<li class="step_box" id="menu_sales"><a href="#">SALES</a></li>
											<li class="step_box" id="menu_purch"><a href="#">PURCHASES</a></li>
											<li class="step_box" id="menu_bank"><a href="#">BANKING</a></li>
											<li class="step_box" id="menu_accounting"><a href="#">ACCOUNTING</a></li>
											<li class="step_box" id="menu_admin2"><a href="#">ADMIN</a></li>
											<li class="step_box" id="menu_print"><a href="#">PRINT</a></li>
											
										</ul>
									
								</div>

							';
						}else{
							print '

								<div id="nav-bar" class="nav-bar">
										<ul id="nav">
											<li class="step_box" id="menu_home"><a href="index.php">HOME</a></li>
											<li class="step_box" id="menu_inventory"><a href="#">INVENTORY</a></li>
											<li class="step_box" id="menu_sales"><a href="#">SALES</a></li>
											<li class="step_box" id="menu_purch1"><a href="#">PURCHASES</a></li>
											<li class="step_box" id="menu_bank1"><a href="#">BANKING</a></li>
											<li class="step_box" id="menu_accounting1"><a href="#">ACCOUNTING</a></li>
											<li class="step_box" id="menu_admin2"><a href="#">ADMIN</a></li>
											<li class="step_box" id="menu_print"><a href="#">PRINT</a></li>
											
										</ul>
									
								</div>

							';
						}
					}else{
						
					}

				?>
							
					
					

				</div>
			</div>
			<div id="right_part">

				<div id="display-panel">
					<div id="dp_content">
						
					</div>
				</div>
			</div>
		</div>
		
	</div>


	<script src="jquery/jquery.min.js"></script>
 	<script src="fittext/jquery.fittext.js"></script>
	<script type="text/javascript">
		$("#nav a").fitText(1.2, { minFontSize: '20px', maxFontSize: '40px' });
	</script>
</body>
<?php
	if(isset($_GET['vpo'])){ //view unpaid purchase orders
		echo "<script>$(\"#display-panel\").load(\"pages/viewPurchaseOrders.php\");</script>";
	}
	if(isset($_POST['recpayment'])){
		$new = str_replace(' ', '%20', $_POST["payee"]);
		echo '<script>$("#dp_content").load("pages/recordpayment.php?oid='.$_POST["oid"].'&d1='.$_POST["d1"].'&payee='.$new.'&tot='.$_POST["tot"].'&paymentflag='.$_POST["paymentflag"].'");</script>';
	}if(isset($_POST['receorder'])){
		$new = str_replace(' ', '%20', $_POST["payee"]);
		echo '<script>$("#dp_content").load("pages/receiveorder.php?oid='.$_POST["oid"].'");</script>';
	}if(isset($_POST['releaseorder'])){
		$new = str_replace(' ', '%20', $_POST["payee"]);
		echo '<script>$("#dp_content").load("pages/releaseorder.php?oid='.$_POST["oid"].'");</script>';
	}

?>
</html>