<?php

	include "../inc/functions.php";
	$db = new pb_functions();
?>

	<script src="../jquery/jquery-latest.min.js" type="text/javascript"></script>
<script>

	function initPOS(){
		document.getElementById('bar_code').focus();
	}
	function checkCode(c,q){
		var code = document.getElementById('bar_code');
		var item_desc_display = document.getElementById('item_desc');
		var code_display = document.getElementById('item_SKU');

			data = code.value;
		if(q.keyCode=='13'){

			code_display.innerHTML = data;
			data = c.value;
			var index;

			index = c.parentNode.parentNode.rowIndex-1;
			$.post( "pos_functions.php?", { pos_code: data})
				  .done(function( data ) {
				  	data = data.replace(/%/g,'/')
    			  	data = data.replace("\"",'')
    			  	data = data.replace('"','')
    			  	console.log(data);
				  	document.getElementById('item_desc').innerHTML = data;
			  });
			$.post( "pos_functions.php?", { pos_code_cost: data})
				  .done(function( data ) {
				  	data = data.replace(/%/g,'/')
    			  	data = data.replace("\"",'')
    			  	data = data.replace('"','')
    			  	console.log(data);
				  	document.getElementById('item_srp').innerHTML = data*2;
			  });
			//document.getElementById('item_qty').focus();

		}
	}
	function checkQty(q){
		var code = document.getElementById('bar_code');
		var code_display = document.getElementById('bar_code_display');
		if(q.keyCode=='13'){
			code_display.value=code.value;
			console.log(code_display.value);
		}
	}
	
</script>
<style>

	#container{
		width:100%;
		height:100%;
	}
	#left{
		width:45%;
		height:95%;
	}
	#right{
		width:52%;
		height:95%;
		position:absolute;
		top:5;
		right:10;
	}
	#price_show{
		height:30%;
		border:1px solid;
	}
	#item_details_div{
		margin-top:10px;
		height:70%;
		border:1px solid;
	}
	#item_list_div{
		height:100%;
		border:1px solid;


	}

</style>

<html>

	<head>
		<title></title>
	</head>
	<body onload="initPOS();">
		<div id="container" >

			<div id="left" >
				<div id="price_show">

				</div>
				<div id="item_details_div">
					<h2 id="item_SKU"></h2>
					<h2 id="item_desc"></h2>
					<h3 id="item_srp"></h3>
				</div>
			</div>

			<div id="right" >
				<div id="item_list_div">

				</div>
			</div>

		</div>
			<input type="text" id="bar_code" onkeyup="checkCode(this,event);" />
			<input type="number" id="item_qty" onkeyup="checkQty(event);" />
	</body>

</html>