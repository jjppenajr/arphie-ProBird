<?php
	include "../inc/functions.php";
	$db = new pb_functions();
?>
<h1>CHECKLIST</h1>
<form id="form_relorder" method="post" action="index.php">
<input type="date" name="d1" required />
<?php
$db->showChecklist($_GET['oid']);


?>
<input type="hidden" name="receive_order_flag" value="1" />
<input type="hidden" name="oid" value=<?php print $_GET['oid'];?> />
<input type="submit"  value="CONFIRM PURCHASE" id="csale" disabled/>
</form>


<script>
    function showAlert(t){
    	var form = document.getElementById('form_relorder');
		var inputs = form.getElementsByTagName('input');
		var is_checked = true;
		for(var x = 0; x < inputs.length; x++) {
		    if(inputs[x].type == 'checkbox' && inputs[x].name == 'verified') {
		        is_checked = inputs[x].checked;
		        if(!is_checked) break;
		    }
		}
		if(is_checked == true){
			document.getElementById('csale').disabled = false;
		}else{
			document.getElementById('csale').disabled = true;
		}
		// is_checked will be boolean 'true' if any are checked at this point.
    }  
  </script>