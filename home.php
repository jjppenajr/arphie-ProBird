<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script>

   		function bla(){
   			$("#display-panel").load("pages/addPurchaseOrder.php");
   		}

   </script>
</head>
<body onload="bla();">
	<div id="main-container">
		<div id ="header">
			
			<div id="h_main">
				PROBIRD
			</div>
			<div id="h_account">
				HELLO USER
			</div>
		</div>
		<div id="body">

			<div id='cssmenu'>
				<ul>
					<li class='active'><a href='home.php'><span>HOME</span></a></li>
				   <li><a href='#'><span>INVENTORY</span></a></li>
				   <li><a href='#'><span>SALES</span></a></li>
				   <li><a href='#'><span>PURCHASES</span></a></li>
				   <li><a href='#'><span>ADMIN</span></a></li>
				   <li><a href='#'><span>BANKING</span></a></li>
				   <li><a href='#'><span>ACCOUNTING</span></a></li>
				   <li class='last'><a href='#'><span>MONITORING</span></a></li>
				</ul>
			</div>
			<div id="display-panel">
			</div>

		</div>
		<div id="footer">

		</div>

	</div>


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
 	<script src="fittext/jquery.fittext.js"></script>
	<script type="text/javascript">
		$("#nav a").fitText(1.2, { minFontSize: '20px', maxFontSize: '40px' })
	</script>
</body>
</html>