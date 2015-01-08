<div id="back_button">
<a href="javascript:backAcc();">BACK</a>
</div>

<br/>
<script>
	function backAcc(){
		$("#dp_content").load("pages/accountingMenu.php");
	}
</script>
<?php
	
	include "../inc/functions.php";
	$db = new pb_functions();
	
	

	

	if(isset($_GET['d1'])){
		$d1 = $_GET['d1'];
		$d2 = $_GET['d2'];
	}

?>

<script>
	function filterdate(){
		var d1 = document.getElementById('d1').value;
		var d2 = document.getElementById('d2').value;
		$('#dp_content').load('pages/fs.php?d1='+d1+'&d2='+d2);
	}
</script>

<input type="date" id="d1" />
<input type="date" id="d2" />
<input type="button" onclick="filterdate();" />

<table id="fstable" style="margin:10%;text-align:center;width:60%;">

		<tr>
			<td style="text-align:left;width:90%">SALES</td>
			
			
			<td width="100px"></td>
			<td width="100px"><?php $sales = $db->getFS_sales($d1,$d2); print number_format($sales,2); ?></td>
		</tr>
		<tr>
			<td style="text-align:left">LESS</td>
			
			
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="text-align:left">BEGINNING INVENTORY</td>
			<td><?php $bi = $db->getFS_bi('2001-01-01',$d1); print number_format($bi,2); ?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="text-align:left">PURCHASES</td>
			
			
			<td style="border-bottom:1px solid"><?php $purch = $db->getFS_purch($d1,$d2); print number_format($purch,2);  ?></td>
			<td></td>
		</tr>
		<tr>
			<td style="text-align:left">AVAILABLE FOR SALE</td>
			
			
			<td></td>

			<td><?php 
			$afs = $bi + $purch;
			print(number_format($afs,2));
			 ?></td>
		</tr>
		<tr>
			<td style="text-align:left">ENDING INVENTORY</td>
			
			
			<td></td>
			<td><?php $ei = $db->getFS_ei('2001-01-01',$d2); print number_format($ei,2); ?></td>
		</tr>
		<tr>
			<td style="text-align:left" style="color:red;">COST OF SALES</td>
			
			
			<td></td>
			<td style="color:red;border-bottom:1px solid;"><?php 
					//$cos = $afs - $ei; 
					$cos = $db->getFS_cos($d1,$d2);
					print(number_format($cos,2)); 
			?></td>
		</tr>
		<tr>
			<td style="text-align:left">GROSS PROFIT</td>
			
			
			<td></td>
			<td><?php print number_format($sales - $cos,2); ?></td>
		</tr>
		<tr>
			<td style="text-align:left">LESS</td>
			
			
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td style="text-align:left" style="color:red;">OPERATING EXPENSES</td>
			
			
			<td></td>
			<td style="color:red;"><?php $oe = $db->getFS_OE($d1,$d2); print number_format($oe,2);  ?></td>
		</tr>
			<?php $db->getFS_at($d1,$d2); ?>
		
		<tr>
			<td style="text-align:left">NET PROFIT</td>
			
			
			<td></td>
			<td><? print number_format((($sales-$cos) - $oe),2);?></td>
		</tr>

	</table>