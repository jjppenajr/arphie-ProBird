
<?php
	if(isset($_GET['code'])){
		$prodcode = $_GET['code'];
	}
	include "../inc/functions.php";
	$db = new pb_functions();
	
	
?>
<link rel="stylesheet" type="text/css" href="css/style.css">

	<?php $db->showProdDetail($prodcode); ?>

