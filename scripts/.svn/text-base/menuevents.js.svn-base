
$(document).ready(function(){
	$('#footer').load("inc/clock.html");
	$("#nav li").click(function(event) {
	   if(event.currentTarget.id == "menu_purch"){
	    	$("#dp_content").load("pages/purchasesMenu.php");
	    	
	    }else if(event.currentTarget.id == "menu_bank"){
	   
	    	$("#dp_content").load("pages/bankingMenu.php");
	    	
	    }else if(event.currentTarget.id == "menu_admin"){
	   
	    	$("#dp_content").load("pages/adminMenu.php");
	    	
	    }else if(event.currentTarget.id == "menu_inventory"){
	   
	    	$("#dp_content").load("pages/inventory.php");
	    	
	    }else if(event.currentTarget.id == "menu_print"){
	    	console.log('aaa');
	   		console.log(document.getElementById("dp_content").innerHTML);
	    	Popup(document.getElementById("dp_content").innerHTML);
	    	
	    }else if(event.currentTarget.id == "menu_accounting"){
	   
	    	$("#dp_content").load("pages/accountingMenu.php");
	    	
	    }else if(event.currentTarget.id == "menu_sales"){
	   
	    	$("#dp_content").load("pages/salesMenu.php");
	    	
	    }
	 });
});
function Popup(data) 
{
    var mywindow = window.open('', 'Printing', 'height=400,width=600');
    mywindow.document.write('<html><head><title></title>');
    /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.print();
    mywindow.close();

    return true;
}
/*-------------
	PURCHASES
---------------*/
function showAddOrder(){
	$("#dp_content").load("pages/addPurchaseOrder.php");
}

function showViewPurchaseOrder(){
	$("#dp_content").load("pages/viewPurchaseOrders.php");
}
function showViewPaidPurchaseOrder(){
	$("#dp_content").load("pages/viewPaidOrders.php");
}

/*-------------
	BANKING
---------------*/


function showAddBank(){
	$("#dp_content").load("pages/addBankAccount.php");
}
function showAllBankAccounts(){
	$("#dp_content").load("pages/delBankAccount.php");
}
function bankAcctDetails(){
	$("#dp_content").load("pages/bankAcctDetails.php");
}
function showAddDeposit(){
	$("#dp_content").load("pages/depositToBank.php");
}
function showAddWithdrawal(){
	$("#dp_content").load("pages/withdrawFromBank.php");
}
/*--------------
	ADMIN
---------------*/

/*--------------
	SALES
---------------*/

function showAddSale(){
	$("#dp_content").load("pages/addSale.php");
}
function showAddSalesOrder(){
	$("#dp_content").load("pages/addSalesOrder.php");
}
function showViewSalesOrder(){
	$("#dp_content").load("pages/viewSalesOrders.php");
}
function showPaidSalesOrder(){
	$("#dp_content").load("pages/viewPaidSalesOrders.php");
}

/*--------------
	INVENTORY
---------------*/
function showInventory(){
	$("#dp_content").load("pages/inventory.php");
}


/*--------------
	ACCOUNTING
--------------*/
function showAddAcctTitle(){
	$("#dp_content").load("pages/addAccountTitle.php");
}
function showAddExpense(){
	$("#dp_content").load("pages/addExpense.php");
}
function showViewCashFlow(){
	$("#dp_content").load("pages/cashflow.php");
}
function showViewFS(){
	$("#dp_content").load("pages/fs.php");
}