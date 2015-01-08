<?php
	require_once('dbinfo.inc');
	class pb_functions{

		private function connect()
	    {
			$link = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE)
			    or die('Could not connect: ' . mysqli_error());
			mysqli_select_db($link,DATABASE) or die('Could not select database' . mysql_error());
			return $link;
	    }
	    /*----------------
	    GET FUNCTIONS
	    -----------------*/
	    public function getUserAcess($u){
	    	$link = $this->connect();
        
	        $query=sprintf("SELECT access_level
	                        FROM user
	                        WHERE username = '".$u."'");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	              
	             return $row[0];
	            }
	    }
	     public function getAccountTitle($id){
			$link = $this->connect();
			        
	        $query=sprintf("SELECT ACCOUNT_TITLE
	                        FROM ACCOUNT_TITLES 
	                        WHERE ID = '".$id."'");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	              
	             return $row[$key];
 	            }
 	    }
	    public function getBankAccountDetails($anum,$key){
	    	$link = $this->connect();
        
	        $query=sprintf("SELECT BA.ACCOUNT_NO,
	                                BA.ACCOUNT_NAME,
	                                B.BANK_NAME,
	                                BA.BALANCE
	                        FROM BANK_ACCOUNTS BA
	                        INNER JOIN BANKLIST B
	                        ON B.BANK_NO = BA.BANK_ID
	                        WHERE BA.ACCOUNT_NO = '".$anum."'");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	              
	             return $row[$key];
	            }
	    }
	    public function getBrowser() 
		{ 
		    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
		    $bname = 'Unknown';
		    $platform = 'Unknown';
		    $version= "";

		    //First get the platform?
		    if (preg_match('/linux/i', $u_agent)) {
		        $platform = 'linux';
		    }
		    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		        $platform = 'mac';
		    }
		    elseif (preg_match('/windows|win32/i', $u_agent)) {
		        $platform = 'windows';
		    }
		    
		    // Next get the name of the useragent yes seperately and for good reason
		    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
		    { 
		        $bname = 'Internet Explorer'; 
		        $ub = "MSIE"; 
		    } 
		    elseif(preg_match('/Firefox/i',$u_agent)) 
		    { 
		        $bname = 'Mozilla Firefox'; 
		        $ub = "Firefox"; 
		    } 
		    elseif(preg_match('/Chrome/i',$u_agent)) 
		    { 
		        $bname = 'Google Chrome'; 
		        $ub = "Chrome"; 
		    } 
		    elseif(preg_match('/Safari/i',$u_agent)) 
		    { 
		        $bname = 'Apple Safari'; 
		        $ub = "Safari"; 
		    } 
		    elseif(preg_match('/Opera/i',$u_agent)) 
		    { 
		        $bname = 'Opera'; 
		        $ub = "Opera"; 
		    } 
		    elseif(preg_match('/Netscape/i',$u_agent)) 
		    { 
		        $bname = 'Netscape'; 
		        $ub = "Netscape"; 
		    } 
		    
		    // finally get the correct version number
		    $known = array('Version', $ub, 'other');
		    $pattern = '#(?<browser>' . join('|', $known) .
		    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		    if (!preg_match_all($pattern, $u_agent, $matches)) {
		        // we have no matching number just continue
		    }
		    
		    // see how many we have
		    $i = count($matches['browser']);
		    if ($i != 1) {
		        //we will have two since we are not using 'other' argument yet
		        //see if version is before or after the name
		        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
		            $version= $matches['version'][0];
		        }
		        else {
		            $version= $matches['version'][1];
		        }
		    }
		    else {
		        $version= $matches['version'][0];
		    }
		    
		    // check if we have a number
		    if ($version==null || $version=="") {$version="?";}
		    
		    return array(
		        'userAgent' => $u_agent,
		        'name'      => $bname,
		        'version'   => $version,
		        'platform'  => $platform,
		        'pattern'    => $pattern
		    );
		} 

		public function getBrowserName(){

			$me = getBrowser();
			return $me['name'];

		}
		public function getIP(){

			return $_SERVER['REMOTE_ADDR'];

		}
		public function getOS(){

			$me = getBrowser();
			return $me['platform'];

		}
		public function getMaxCustomerId(){
			$link = $this->connect();
        
	        $query=sprintf("SELECT MAX(CUSTOMER_ID)
	                        FROM CUSTOMERS");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               return $row[0];
	            }
		}

		public function getMaxCategoryId(){
			$link = $this->connect();
        
	        $query=sprintf("SELECT MAX(ID)
	                        FROM ITEM_CATEGORIES");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               return $row[0];
	            }
		}
		public function getMaxSupplierId(){
			$link = $this->connect();
        
	        $query=sprintf("SELECT MAX(SUPPLIER_ID)
	                        FROM SUPPLIERS");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               return $row[0];
	            }
		}
		public function getMaxOrderId(){
			$link = $this->connect();
        
	        $query=sprintf("SELECT MAX(ORDER_ID)
	                        FROM ORDERS");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               return $row[0]+1;
	            }
		}
		public function getMaxSalesId(){
			$link = $this->connect();
        
	        $query=sprintf("SELECT MAX(SALES_INVOICE)
	                        FROM SALES");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               return $row[0]+1;
	            }
		}
		public function getMaxPurchaseId(){
			$link = $this->connect();
        
	        $query=sprintf("SELECT MAX(PURCH_ID)
	                        FROM PURCHASES");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               return $row[0]+1;
	            }
		}
		public function getNextItemId(){
			$link = $this->connect();
        
	        $query=sprintf("SELECT MAX(ITEM_CODE)
	                        FROM ITEMS");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               return $row[0]+1;
	            }
		}
		public function getOrderDetail($oid,$i){
			$link = $this->connect();
        
	        $query=sprintf("SELECT ORDER_ID, 
	        						ORDER_DATE, 
	        						CUSTOMER_ID, 
	        						CUSTOMER_DUE_DATE, 
	        						SUPPLIER_ID,  
	        						ORDER_TYPE,
	        						SELLING_METHOD,
	        						TOTAL,
	        						FLAG
	                        FROM ORDERS
	                        WHERE ORDER_ID = '$oid'");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               return $row[$i];
	            }
		}
		public function getOrderItemDetail($oid,$i){
			$link = $this->connect();
        
	        $query=sprintf("SELECT  ITEM_CODE,
	        						QTY,
	        						PRICE
	                        FROM ORDER_ITEMS
	                        WHERE ORDER_ID = '$oid'");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               return $row[$i];
	            }
		}

		public function getItemDetail($oid,$i){
			$link = $this->connect();
        
	        $query=sprintf("SELECT ITEM_CODE,
	        						FILENAME,
	                                ITEM_DESC,
	                                COLOR,
	                                SUPPLIER_ID,
	                                ITEM_COST,
	                                BRAND,
	                                CATEGORY,
	                                SIZE
	                        FROM ITEMS
	                        WHERE ITEM_CODE = '$oid'");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               return $row[$i];
	            }
		}
		public function getSupplierName($sid){
			$link = $this->connect();
        
	        $query=sprintf("SELECT S.SUPPLIER_NAME
	                        FROM SUPPLIERS S
	                        WHERE S.SUPPLIER_ID = '".$sid."'");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               print $row[0];
	            }
		}
		public function getSupplierId($name){
					$link = $this->connect();
		        
			        $query=sprintf("SELECT S.SUPPLIER_ID
			                        FROM SUPPLIERS S
			                        WHERE S.SUPPLIER_NAME = '".$name."'");
			        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
			        
			        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
			            {
			               print $row[0];
			            }
				}
		public function getCustomerName($sid){
			$link = $this->connect();
        
	        $query=sprintf("SELECT S.CUSTOMER_NAME
	                        FROM CUSTOMERS S
	                        WHERE S.CUSTOMER_ID = '".$sid."'");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               print $row[0];
	            }
		}

		public function getCustomerId($name){
			$link = $this->connect();
        
	        $query=sprintf("SELECT S.CUSTOMER_ID
	                        FROM CUSTOMERS S
	                        WHERE S.CUSTOMER_NAME = '".$name."'");
	        $result2 = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));
	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               print $row[0];
	            }
		}
		/*------------
		DELETE FUNCTIONS
		-------------*/

		public function deleteBankAccount($anum){
			$link = $this->connect();
            $query=sprintf("DELETE FROM BANK_ACCOUNTS
            				WHERE ACCOUNT_NO = '".$anum."'");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    
			}
		}
		/*---------------
		CHANGE FUNCTIONS
		----------------*/
		public function changeFlag($oid,$flag){
			$link = $this->connect();
            $query=sprintf("UPDATE ORDERS
            				SET FLAG='".$flag."'
            				WHERE ORDER_ID = '".$oid."'");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}
		
		public function payOrder($oid){
			$link = $this->connect();
            $query=sprintf("UPDATE ORDERS
            				SET FLAG=2
            				WHERE ORDER_ID = '".$oid."'");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}
		/*------------
		ADD FUNCTIONS
		-------------*/
		public function transferItem($from,$to,$qty,$prod,$d1){
			$cost = $this->getItemDetail($prod,5);
			$this->addToInventory($prod,$d1,$qty*-1,$cost,$from);
			$this->addToInventory($prod,$d1,$qty,$cost,$to);
		}
		public function addExpense($particulars,$amount,$exp_date,$a){
			$link = $this->connect();
	            $query2=sprintf("INSERT INTO EXPENSES(ID,PARTICULARS,PRICE,EXP_DATE,ACCOUNT_TITLE)
	                            VALUES('','".$particulars."','".$amount."','".$exp_date."','".$a."')");
	       

	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	        $at = $a;
	        $atype = 3;
	        $eid = 999;
	        $val = $amount;
	        $this->addDebit($at,$atype,$eid,$val,$exp_date);
	        $at = 10;
	        $atype=3;
	        $eid = 999;
	        $val = $amount;
	        $this->addCredit($at,$atype,$eid,$val*-1,$exp_date);

		}
		public function addCashFlow($date,$amount,$category){
	        //category 1 = inflow, 2 = outflow
	        $link = $this->connect();
	            $query2=sprintf("INSERT INTO CASHFLOW(ID,C_DATE,AMOUNT,FLAG)
	                            VALUES('','".$date."','".$amount."','".$category."')");
	       

	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	    }
	    public function addDebit($at,$atype,$eid,$val,$d1){
	        $link = $this->connect();
	            $query2=sprintf("INSERT INTO ACCOUNTS(ID, ACCOUNT_TITLE, ACCOUNT_TYPE, ENTITY_ID, VALUE, A_DATE)
	                            VALUES('','".$at."','".$atype."','".$eid."','".$val."','".$d1."')");
	       

	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	    }
	    public function addCredit($at,$atype,$eid,$val,$d1){
	        $link = $this->connect();
	            $query2=sprintf("INSERT INTO ACCOUNTS(ID, ACCOUNT_TITLE, ACCOUNT_TYPE, ENTITY_ID, VALUE, A_DATE)
	                            VALUES('','".$at."','".$atype."','".$eid."','".$val."','".$d1."')");
	       

	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	    }
	    public function addDeposit($bank,$account,$num,$d1,$amt){
			$link = $this->connect();
	            $query2=sprintf("INSERT INTO DEPOSITS(ID,ACCOUNT_NO,DEP_SLIP_NO,DEP_DATE,DEP_AMOUNT,BANK_ID)
	                            VALUES('','".$account."','".$num."','".$d1."','".$amt."','".$bank."')");
	       

	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));	    	
	    	if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			    $this->addBankBal($account,$amt);
			    $at = 10;
		        $atype = 3;
		        $eid = 999;
		        $val = $amt;
		        $this->addCredit($at,$atype,$eid,$val*-1,$d1);
		        $at = 11;
		        $atype=4;
		        $eid = $account;
		        $val = $amt;
		        $this->addDebit($at,$atype,$eid,$val,$d1);
			}
	    }
	     public function addAccountTitle($name,$type){
	    	$link = $this->connect();
	            $query2=sprintf("INSERT INTO ACCOUNT_TITLES(ID,ACCOUNT_TITLE,ATYPE)
	                            VALUES('','".$name."','".$type."')");
	       

	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));	    	
	    	if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			   
			}
	    }
	     public function addWithdrawal($bank,$account,$num,$d1,$amt){
			$link = $this->connect();
	            $query2=sprintf("INSERT INTO WITHDRAWALS(ID,ACCOUNT_NO,DEP_SLIP_NO,DEP_DATE,DEP_AMOUNT,BANK_ID)
	                            VALUES('','".$account."','".$num."','".$d1."','".$amt."','".$bank."')");
	       

	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));	    	
	    	if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			    $this->addBankBal($account,$amt*-1);

			    $at = 10;
		        $atype = 3;
		        $eid = 999;
		        $val = $amt;
		        $this->addDebit($at,$atype,$eid,$val,$d1);
		        $at = 11;
		        $atype=4;
		        $eid = $account;
		        $val = $amt;
		        $this->addCredit($at,$atype,$eid,$val*-1,$d1);
			}
	    }
		public function recpayment($payee,$pdate,$amt,$term,$checkno,$checkdate,$acct){
			$link = $this->connect();
            $query=sprintf("INSERT INTO PAYMENTS(ID,PAYEE,PAYMENT_DATE,AMT,TERMS,CHECKNO,CHECKDATE,ACCT)
                            VALUES('','".$payee."','".$pdate."','".$amt."','".$term."','".$checkno."','".$checkdate."','".$acct."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
			   	$this->addCashFlow($pdate,$amt,'2');

			    $at = 12;
			    $atype = 1;
			    $payee = $this->getSupplierId($payee);
			    $eid = $payee;
			    $val = $amt;
			    $d1 = $pdate;
			    $this->addDebit($at,$atype,$eid,$val,$d1);
			    $at = 10;
			    $atype = 3;
			    $eid = 999;
			    $val = $amt*-1;
			    $this->addCredit($at,$atype,$eid,$val,$d1);
       		}
			else{
			    //success
			    
				

			}
		}
		public function recpayment2($payee,$pdate,$amt,$term,$checkno,$checkdate,$acct){
			$link = $this->connect();
            $query=sprintf("INSERT INTO PAYMENTS(ID,PAYEE,PAYMENT_DATE,AMT,TERMS,CHECKNO,CHECKDATE,ACCT)
                            VALUES('','".$payee."','".$pdate."','".$amt."','".$term."','".$checkno."','".$checkdate."','".$acct."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
			   	$this->addCashFlow($pdate,$amt,'1');
			    $at = 10;
			    $atype = 3;
			    $eid = 99;
			    $val = $amt;
			    $d1 = $pdate;
			    $this->addDebit($at,$atype,$eid,$val,$d1);
			    $at = 13;
			    $atype = 2;
			    $payee = $this->getCustomerId($payee);
			    $eid = $payee;
			    $this->addCredit($at,$atype,$eid,$amt,$d1);

       		}
			else{
			    //success
			    
			}
		}
		public function addBankBal($id,$amt){

			$link = $this->connect();
            
            $ebal = $this->getBankAccountDetails($id,3);
            $amt = $ebal + $amt;
            $query=sprintf("UPDATE BANK_ACCOUNTS
            				SET BALANCE = '".$amt."'
            				WHERE ACCOUNT_NO = '".$id."'");
       

       		$result = mysqli_query($link,$query);
		}
		public function addBankAccount($anum,$aname,$bid,$bal,$opendate){
			$link = $this->connect();
            $query=sprintf("INSERT INTO BANK_ACCOUNTS(ACCOUNT_NO,ACCOUNT_NAME,BANK_ID,BALANCE)
                            VALUES('".$anum."','".$aname."','".$bid."','".$bal."')");
       

       		$result = mysqli_query($link,$query);
       		$bn = $aname . " - " . $anum;
       		$at = 11;
			    $atype = 4;
			    $eid = $anum;
			    $val = $bal;
			    $d1 = $opendate;
			    $this->addDebit($at,$atype,$eid,$val,$d1);
			    $at = 10;
			    $atype = 3;
			    $eid = 999;
			    $val = $bal*-1;
			    $this->addCredit($at,$atype,$eid,$val,$d1);
       		if(mysqli_num_rows($result)==0){
       			
       		}
			else{
			    
			}
		}
		public function addPurchaseOrder($oid,$d1,$sid,$tot){
			$link = $this->connect();

            $query=sprintf("INSERT INTO ORDERS(ORDER_ID,ORDER_DATE,SUPPLIER_ID,ORDER_TYPE,TOTAL)
                            VALUES('".$oid."','".$d1."','".$sid."',1,'".$tot."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}
		

		public function addPurchaseOrderItem($oid,$ic,$qty,$price){
			$link = $this->connect();
            $query=sprintf("INSERT INTO ORDER_ITEMS(ID,ORDER_ID,ITEM_CODE,QTY,PRICE)
                            VALUES('','".$oid."','".$ic."','".$qty."','".$price."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}
		public function addSaleOrder($oid,$d1,$cid,$tot){
			$link = $this->connect();
            $query=sprintf("INSERT INTO ORDERS(ORDER_ID,ORDER_DATE,CUSTOMER_ID,ORDER_TYPE,TOTAL)
                            VALUES('".$oid."','".$d1."','".$cid."',2,'".$tot."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}
		

		public function addSaleOrderItem($oid,$ic,$qty,$price){
			$link = $this->connect();
			
            $query=sprintf("INSERT INTO ORDER_ITEMS(ID,ORDER_ID,ITEM_CODE,QTY,PRICE)
                            VALUES('','".$oid."','".$ic."','".$qty."','".$price."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}
		public function addNewItem($item_id,$item_desc,$sid,$cost,$color,$brand,$category,$size){
			$link = $this->connect();
            $query=sprintf("INSERT INTO ITEMS(ITEM_CODE,FILENAME,ITEM_DESC,COLOR,SUPPLIER_ID,ITEM_COST,BRAND,CATEGORY,SIZE)
                            VALUES('".$item_id."','','".$item_desc."','".$color."','".$sid."','".$cost."','".$brand."','".$category."','".$size."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}

		public function addCashSale($si,$cid,$d1,$term,$total){
			$link = $this->connect();
            $query=sprintf("INSERT INTO SALES(SALES_INVOICE,CUSTOMER_ID,SALE_DATE,TERM,TOTAL,BALANCE)
                            VALUES('".$si."','".$cid."','".$d1."','".$term."','".$total."','0')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success

			    $this->addCashFlow($d1,$total,'1');
			}
		}

		public function addCashSaleItem($ic,$qty,$price){
			$link = $this->connect();
            $query=sprintf("INSERT INTO SALES_ITEMS(ID,ITEM_CODE,QTY,PRICE)
                            VALUES('','".$ic."','".$qty."','".$price."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}

		public function addPurchase($oid,$d1,$sid,$total,$status){
			$link = $this->connect();
            $query=sprintf("INSERT INTO PURCHASES(PURCH_ID,PURCH_DATE,SUPPLIER_ID,PURCH_TOTAL,PURCH_STATUS)
                            VALUES('".$oid."','".$d1."','".$sid."','".$total."','".$status."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}
		public function addPurchaseItem($pid,$ic,$qty,$cost){
			$link = $this->connect();
            $query=sprintf("INSERT INTO PURCHASE_ITEMS(ID,PURCH_ID,ITEM_CODE,QTY,COST)
                            VALUES('','".$pid."','".$ic."','".$qty."','".$cost."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}

		public function addSale($si,$cid,$d1,$term,$total){
			$link = $this->connect();
            $query=sprintf("INSERT INTO SALES(ID,SALES_INVOICE,CUSTOMER_ID,SALE_DATE,TERM,TOTAL,BALANCE)
                            VALUES('','".$si."','".$cid."','".$d1."','".$term."','".$total."','".$total."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}
		public function addSaleItem($sid,$ic,$qty,$price){
			$link = $this->connect();
            $query=sprintf("INSERT INTO SALES_ITEMS(ID,SALES_ID,ITEM_CODE,QTY,PRICE)
                            VALUES('','".$sid."','".$ic."','".$qty."','".$price."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}
		public function addToInventory($ic,$sd,$qty,$cost,$type){
			$link = $this->connect();
            $query=sprintf("INSERT INTO INVENTORY(ID,ITEM_ID,SELLING_DATE,QUANTITY,COST,TYPE)
                            VALUES('','".$ic."','".$sd."','".$qty."','".$cost."','".$type."')");
       

       		$result = mysqli_query($link,$query);
       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			}
		}
		public function addCustomer($cname,$cnum){
			$link = $this->connect();
			$query=sprintf("INSERT INTO CUSTOMERS(CUSTOMER_ID,CUSTOMER_NAME,CONTACT_NUMBER)
                            VALUES('','".$cname."','".$cnum."')");
       

       		$result = mysqli_query($link,$query);

       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			    return $cname;
			}
		}

		public function addSupplier($cname,$cnum){
			$link = $this->connect();
			$query=sprintf("INSERT INTO SUPPLIERS(SUPPLIER_ID,SUPPLIER_NAME,CONTACT_NUMBER)
                            VALUES('','".$cname."','".$cnum."')");
       

       		$result = mysqli_query($link,$query);

       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			    return $cname;
			}
		}
		public function addCategory($cname){
			$link = $this->connect();
			$query=sprintf("INSERT INTO ITEM_CATEGORIES(ID,CATEGORY)
                            VALUES('','".$cname."')");
       

       		$result = mysqli_query($link,$query);

       		if(mysqli_num_rows($result)==0){
			   	//fail
       		}
			else{
			    //success
			    return $cname;
			}
		}


		/*--------
		POPULATORS
		---------*/
		public function ddl_acctTitles(){
			$link = $this->connect();
	        $query = sprintf("SELECT ID,
	                                ACCOUNT_TITLE
	                        FROM ACCOUNT_TITLES
	                        ORDER BY ACCOUNT_TITLE ASC
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	             print("<option value='$row[0]' style=color:black;>$row[1]</option>");
	               
	        }
		}
		public function ddl_customers(){
			$link = $this->connect();
	        $query = sprintf("SELECT CUSTOMER_ID,
	                                CUSTOMER_NAME
	                        FROM CUSTOMERS
	                        ORDER BY CUSTOMER_NAME ASC
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	             print("<option value='$row[0]' style=color:black;>$row[1]</option>");
	               
	        }
		}
		public function ddl_suppliers(){
	        $link = $this->connect();
	        $query = sprintf("SELECT SUPPLIER_ID,
	                                SUPPLIER_NAME
	                        FROM SUPPLIERS
	                        ORDER BY SUPPLIER_NAME ASC
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	             print("<option value='$row[0]' style=color:black;>$row[1]</option>");
	               
	        }
		}
		public function ddl_items(){
	        $link = $this->connect();
	        $query = sprintf("SELECT ITEM_CODE,
	                                ITEM_DESC,
	                                COLOR,
	                                SIZE
	                        FROM ITEMS

	                        ORDER BY ITEM_DESC ASC
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	        	if(is_null($row[2]))
	        		$row[2] = "";
	        	else{
	        		$row[2] = "- ".$row[2];
	        	}
	        	if(is_null($row[3]))
	        		$row[3] = "";
	        	else{
	        		$row[3] = "- ".$row[3];
	        	}

	             print("<option value=$row[0] style=color:black;>$row[1] $row[2] $row[3]</option>");
	               
	        }
		}
		public function ddl_itemsExisting(){
	        $link = $this->connect();
	        $query = sprintf("SELECT I.ITEM_ID,
	                                IT.ITEM_DESC,
	                                IT.COLOR,
	                                IT.SIZE,
	                                SUM(I.QUANTITY)
	                        FROM INVENTORY I
	                        INNER JOIN ITEMS IT
	                        ON IT.ITEM_CODE = I.ITEM_ID
	                        GROUP BY I.ITEM_ID
	                        HAVING SUM(I.QUANTITY)>0
	                        ORDER BY IT.ITEM_DESC ASC

	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	        	if(is_null($row[2]))
	        		$row[2] = "";
	        	else{
	        		$row[2] = "- ".$row[2];
	        	}
	        	if(is_null($row[3]))
	        		$row[3] = "";
	        	else{
	        		$row[3] = "- ".$row[3];
	        	}

	             print("<option value=$row[0] style=color:black;>$row[1] $row[2] $row[3] "."(".$row[4].")</option>");
	               
	        }
		}
		public function ddl_bankname(){
			$link = $this->connect();
	        $query = sprintf("SELECT BANK_NO,
	                                BANK_NAME
	                        FROM BANKLIST
	                        ORDER BY BANK_NAME ASC
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	             print("<option value='$row[0]' style=color:black;>$row[1]</option>");
	               
	        }
		}
		public function ddl_categories(){
			$link = $this->connect();
	        $query = sprintf("SELECT ID,
	                                CATEGORY
	                        FROM ITEM_CATEGORIES
	                        ORDER BY CATEGORY ASC
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	             print("<option value='$row[0]' style=color:black;>$row[1]</option>");
	               
	        }
		}
		public function ddl_bankaccounts(){
			$link = $this->connect();
	        $query = sprintf("SELECT BA.ACCOUNT_NO,
	                                BA.ACCOUNT_NAME,
	                                B.BANK_NAME
	                        FROM BANK_ACCOUNTS BA
	                        INNER JOIN BANKLIST B
	                        ON B.BANK_NO = BA.BANK_ID
	                        ORDER BY BA.ACCOUNT_NO ASC
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	             print("<option value=$row[0] style=color:black;>".$row[0] . " - " . $row[1]. " - " . $row[2] ."</option>");
	               
	        }
		}

		/*-------------
		VIEW FUNCTIONS
		---------------*/
		public function generateCashFlow(){
        $tot1 = 0;
        $tot2 = 0;
        $link = $this->connect();
        $query2=sprintf("SELECT DISTINCT C_DATE
                        FROM CASHFLOW");

        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
            {
                $query=sprintf("SELECT sum(c1.AMOUNT),
                                        (SELECT sum(c2.amount) 
                                            FROM CASHFLOW c2
                                            WHERE c2.FLAG = 2
                                            AND c2.C_DATE = '".$row[0]."')
                                FROM CASHFLOW c1
                                WHERE c1.FLAG = 1
                                AND c1.C_DATE = '".$row[0]."'");
                $d = $row[0];
                $result = mysqli_query($link,$query) or die('Query failed: ' . mysqli_error($link));

                while($row= mysqli_fetch_array($result, MYSQL_NUM))
                    {
                        if(is_null($row[0])){
                            $inflow = 0;
                        }else{
                            $inflow = $row[0];
                        }
                        if(is_null($row[1])){
                            $outflow = 0;
                        }else{
                            $outflow = $row[1];
                        }
                        print "<tr onclick=showCashFlow('".$d."');>";

                        print "<td style=text-align:left;height:50px>".$d."</td>";
                        print "<td>".number_format($inflow,2)."</td>";
                        print "<td>".number_format($outflow,2)."</td>";

                        print "</tr>";
                        $tot1 = $tot1 + $inflow;
                        $tot2 = $tot2 + $outflow;
                    }

            }
            $initial = 30000;
            $bal = $initial + $tot1 - $tot2;
            print "<td></td><td style='border-top:1px solid;'>".number_format($tot1,2)."</td><td style='border-top:1px solid;'>".number_format($tot2,2)."</td>";

            print "<tr><td style=text-align:left;><b>Beginning: </b></td><td style=color:red;>".number_format($initial,2)."</td></tr>";
            print "<td style=text-align:left;><b>Ending: </b></td><td style=color:red;>".number_format($bal,2)."</td></tr>";
    }
		public function viewPaidSalesOrders(){
			$link = $this->connect();
	        $query = sprintf("SELECT O.ORDER_ID, 
	        						O.ORDER_DATE,
	        						C.CUSTOMER_NAME,
	        						O.TOTAL
	                        FROM ORDERS O
	                        INNER JOIN CUSTOMERS C
	                        ON C.CUSTOMER_ID = O.CUSTOMER_ID
	                        WHERE O.FLAG = 2
	                        AND O.ORDER_TYPE = 2
	                        ORDER BY ORDER_DATE DESC
	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table class='tbl_populator'>
	        		<thead>
	        			<th>ORDER DATE</th>
	        			<th>SUPPLIER NAME</th>
	        			<th>TOTAL</th>
	        		</thead>
	        		<tbody>

	        ";
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	             print("<tr onclick='viewsodetail($row[0]);' style='cursor:pointer'><td>$row[1]</td>");
	             print("<td> $row[2]</td>");
	             print("<td> $row[3]</td></tr>");
	               
	        }
	        print "</tbody>
	        		</table>
	        ";
		}
		public function viewPaidPurchaseOrders(){
			$link = $this->connect();
	        $query = sprintf("SELECT O.ORDER_ID, 
	        						O.ORDER_DATE,
	        						S.SUPPLIER_NAME,
	        						O.TOTAL
	                        FROM ORDERS O
	                        INNER JOIN SUPPLIERS S
	                        ON S.SUPPLIER_ID = O.SUPPLIER_ID
	                        WHERE O.FLAG = 2
	                        AND O.ORDER_TYPE = 1
	                        ORDER BY ORDER_DATE DESC
	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table class='tbl_populator'>
	        		<thead>
	        			<th>ORDER DATE</th>
	        			<th>SUPPLIER NAME</th>
	        			<th>TOTAL</th>
	        		</thead>
	        		<tbody>

	        ";
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	             print("<tr onclick='viewpodetail($row[0]);' style='cursor:pointer'><td>$row[1]</td>");
	             print("<td> $row[2]</td>");
	             print("<td> $row[3]</td></tr>");
	               
	        }
	        print "</tbody>
	        		</table>
	        ";
		}
		public function viewPurchaseOrders(){
			$link = $this->connect();
	        $query = sprintf("SELECT O.ORDER_ID, 
	        						O.ORDER_DATE,
	        						S.SUPPLIER_NAME,
	        						O.TOTAL
	                        FROM ORDERS O
	                        INNER JOIN SUPPLIERS S
	                        ON S.SUPPLIER_ID = O.SUPPLIER_ID
	                        WHERE O.FLAG = 1
	                        AND O.ORDER_TYPE = 1
	                        ORDER BY ORDER_DATE DESC
	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table class='tbl_populator'>
	        		<thead>
	        			<th>ORDER DATE</th>
	        			<th>SUPPLIER NAME</th>
	        			<th>TOTAL</th>
	        		</thead>
	        		<tbody>

	        ";
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	             print("<tr onclick='viewpodetail($row[0]);' style='cursor:pointer'><td>$row[1]</td>");
	             print("<td> $row[2]</td>");
	             print("<td> $row[3]</td></tr>");
	               
	        }
	        print "</tbody>
	        		</table>
	        ";
		}
		public function viewSalesOrders(){
			$link = $this->connect();
	        $query = sprintf("SELECT O.ORDER_ID, 
	        						O.ORDER_DATE,
	        						C.CUSTOMER_NAME,
	        						O.TOTAL
	                        FROM ORDERS O
	                        INNER JOIN CUSTOMERS C
	                        ON C.CUSTOMER_ID = O.CUSTOMER_ID
	                        WHERE O.FLAG = 1
	                        AND O.ORDER_TYPE = 2
	                        ORDER BY ORDER_DATE DESC
	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table class='tbl_populator'>
	        		<thead>
	        			<th>ORDER DATE</th>
	        			<th>CUSTOMER NAME</th>
	        			<th>TOTAL</th>
	        		</thead>
	        		<tbody>

	        ";
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	             print("<tr onclick='viewsodetail($row[0]);' style='cursor:pointer'><td>$row[1]</td>");//change
	             print("<td> $row[2]</td>");
	             print("<td> $row[3]</td></tr>");
	               
	        }
	        print "</tbody>
	        		</table>
	        ";
		}
		public function showProdPlace($c){
			$link = $this->connect();
	        $query = sprintf("SELECT SUM(QUANTITY)
	        					FROM INVENTORY
	        					WHERE ITEM_ID = '".$c."'
	        					AND TYPE = 1
	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table>";
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	        	print "<tr><td>WAREHOUSE: </td>";
	        	print "<td>$row[0]</td></tr>";
	        }
	        $query = sprintf("SELECT SUM(QUANTITY)
	        					FROM INVENTORY
	        					WHERE ITEM_ID = '".$c."'
	        					AND TYPE = 2
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	        	print "<tr><td>SHOP: </td>";
	        	print "<td>$row[0]</td>";
	        	print "<td><button onclick='transfer($c,2);'>TRANSFER</button></td></tr>";
	        }
	        $query = sprintf("SELECT SUM(QUANTITY)
	        					FROM INVENTORY
	        					WHERE ITEM_ID = '".$c."'
	        					AND TYPE = 3
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	        	print "<tr><td>RESERVED: </td>";
	        	print "<td>$row[0]</td></tr>";
	        }$query = sprintf("SELECT SUM(QUANTITY)
	        					FROM INVENTORY
	        					WHERE ITEM_ID = '".$c."'
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	        	print "<tr><td>TOTAL: </td>";
	        	print "<td>$row[0]</td></tr>";
	        }
	        print "</table>";//edit
			print"<div id='trans' class='white_content'>
			<input type='button' style='float:right;width:50px;' value='X' id='close_btn' onclick = \"document.getElementById('trans').style.display='none';document.getElementById('fade').style.display='none';\"/><br>
					<table>

						<tr>
							<td>FROM:</td>
							<td><select id='from'><option value=1>WAREHOUSE</option><option value=2>SHOP</option><option value=3>RESERVED</option></select></td>
						<tr>
							<td>TO:</td>
							<td><select id='to'><option value=1>WAREHOUSE</option><option value=2>SHOP</option><option value=3>RESERVED</option></select></td>
						</tr>
						<tr>
							<td>QUANTITY:</td>
							<td><input type='number' id='qty_i' /></td>
						</tr>
							<td>DATE:</td>
							<td><input type='date' id='d1' /></td>
						</tr>
					<input type='hidden' value='".$c."' id='prodcode' />
						<tr>
							<td><input type='submit' style='width:100%;' value='TRANSFER' name='trans_sub' class='posub' onclick = 'transferItem();'/></td>
						</tr>
					</table>

				";
			print"
				
			</div>
			<div id='fade' class='black_overlay'></div>

			</div>";
		}
		public function showProdDetail($c){
			$link = $this->connect();
	        $query = sprintf("SELECT I.FILENAME,
	        						I.ITEM_DESC,
	        						I.COLOR,
	        						S.SUPPLIER_NAME,
	        						I.ITEM_COST,
	        						I.BRAND,
	        						C.CATEGORY,
	        						I.SIZE
	        					FROM ITEMS I
		                        INNER JOIN SUPPLIERS S
		                        ON S.SUPPLIER_ID = I.SUPPLIER_ID
		                        INNER JOIN ITEM_CATEGORIES C
		                        ON C.ID = I.CATEGORY
	        					WHERE I.ITEM_CODE = $c

	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
		        /*edit*/print "
		        	<div id='proddetail_cont' height='100%' width='100%'>
		        		<div id='proddetail_upper'>
			        		<div id='proddetail_image'>
			        			<img src='images/products/$row[0]' width='200px' height='200px' />

			        		</div>
			        		<div id='proddetail_details'>
			        			<h3>$row[1]</h3>
			        			<table>
			        				<tr>
			        					<td>COLOR: </td>
			        					<td>$row[2]</td>
			        				</tr>
			        				<tr>
			        					<td>COST: </td>
			        					<td>$row[4]</td>
			        				</tr>
			        				<tr>
			        					<td>SIZE: </td>
			        					<td>$row[7]</td>
			        				</tr>
			        				<tr>
			        					<td>BRAND: </td>
			        					<td>$row[5]</td>
			        				</tr>
			        				<tr>
			        					<td>SUPPLIER: </td>
			        					<td>$row[3]</td>
			        				</tr>
			        				<tr>
			        					<td>CATEGORY: </td>
			        					<td>$row[6]</td>
			        				</tr>
			        			</table>
			        		</div>
		        		</div>
						<div id='proddetail_lower'>
			        		<div id='proddetail_invplace'>
			        				";$this->showProdPlace($c);print"
			        		</div>
		        		</div>
		        	</div>

		        ";
	    	}
		}
		public function showInventory(){
			$link = $this->connect();
			$i=0;
			$count = 0;
	        $query = sprintf("SELECT SUM(I.QUANTITY),
	        						IT.FILENAME,
	        						IT.ITEM_DESC,
	        						IT.COLOR,
	        						IT.SIZE,
	        						IT.BRAND,
	        						S.SUPPLIER_NAME,
	        						C.CATEGORY,
	        						IT.ITEM_CODE
	                        FROM INVENTORY I
	                        INNER JOIN ITEMS IT
	                        ON IT.ITEM_CODE = I.ITEM_ID
	                        INNER JOIN SUPPLIERS S
	                        ON S.SUPPLIER_ID = IT.SUPPLIER_ID
	                        INNER JOIN ITEM_CATEGORIES C
	                        ON C.ID = IT.CATEGORY
	                        GROUP BY I.ITEM_ID
	                        HAVING SUM(I.QUANTITY)>0
	                        ORDER BY IT.ITEM_DESC

	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table class='tbl_inv' border=1px solid>
	        		
	        		<tbody>
	        		<tr>
	        ";
		        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
		        	
		        	if($count==0){
		        		print "<tr>";
		        	}
		             print("<td>
		             	<table id='det_tbl'>
		             		<tr rowspan='2'>
		             			<td><img  width=190px height=190px src='images/products/".$row[1]."' onclick=proddet($row[8]);></td>
		             		</tr>
		             		<tr>
		             			<td><b>Description:</b>&nbsp".$row[2]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Color:</b>&nbsp".$row[3]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Size:</b> &nbsp ".$row[4]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Brand:</b>&nbsp".$row[5]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Quantity:</b>&nbsp".$row[0]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Supplier:</b>&nbsp".$row[6]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Category:</b>&nbsp".$row[7]."</td>
		             		</tr>
		             	</table>
		             	</td>");
		        	$count++;
		             if($count==5){
		        		print "</tr>";
		        		$count = 0;
		        	}
		        }

	        
	        
	        print "
	        		</tbody>
	        		</table>
	        ";
		}
		public function showInventoryW(){
			$link = $this->connect();
			$i=0;
			$count = 0;
	        $query = sprintf("SELECT SUM(I.QUANTITY),
	        						IT.FILENAME,
	        						IT.ITEM_DESC,
	        						IT.COLOR,
	        						IT.SIZE,
	        						IT.BRAND,
	        						S.SUPPLIER_NAME,
	        						C.CATEGORY,
	        						IT.ITEM_CODE
	                        FROM INVENTORY I
	                        INNER JOIN ITEMS IT
	                        ON IT.ITEM_CODE = I.ITEM_ID
	                        INNER JOIN SUPPLIERS S
	                        ON S.SUPPLIER_ID = IT.SUPPLIER_ID
	                        INNER JOIN ITEM_CATEGORIES C
	                        ON C.ID = IT.CATEGORY
	                        WHERE I.TYPE = 1
	                        GROUP BY I.ITEM_ID
	                        HAVING SUM(I.QUANTITY)>0
	                        ORDER BY IT.ITEM_DESC
	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table class='tbl_inv' border=1px solid>
	        		
	        		<tbody>
	        		<tr>
	        ";
		        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
		        	
		        	if($count==0){
		        		print "<tr>";
		        	}
		             print("<td>
		             	<div id='img_inv'><img src='images/products/".$row[1]."' onclick=proddet($row[8]);></div>
		             	<table id='det_tbl'>
		             		<tr>
		             			<td><b>Description:</b>&nbsp".$row[2]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Color:</b>&nbsp".$row[3]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Size:</b> &nbsp ".$row[4]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Brand:</b>&nbsp".$row[5]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Quantity:</b>&nbsp".$row[0]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Supplier:</b>&nbsp".$row[6]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Category:</b>&nbsp".$row[7]."</td>
		             		</tr>
		             	</table>
		             	</td>");
		        	$count++;
		             if($count==5){
		        		print "</tr>";
		        		$count = 0;
		        	}
		        }

	        
	        
	        print "
	        		</tbody>
	        		</table>
	        ";
		}
		public function showInventoryS(){
			$link = $this->connect();
			$i=0;
			$count = 0;
	        $query = sprintf("SELECT SUM(I.QUANTITY),
	        						IT.FILENAME,
	        						IT.ITEM_DESC,
	        						IT.COLOR,
	        						IT.SIZE,
	        						IT.BRAND,
	        						S.SUPPLIER_NAME,
	        						C.CATEGORY,
	        						IT.ITEM_CODE
	                        FROM INVENTORY I
	                        INNER JOIN ITEMS IT
	                        ON IT.ITEM_CODE = I.ITEM_ID
	                        INNER JOIN SUPPLIERS S
	                        ON S.SUPPLIER_ID = IT.SUPPLIER_ID
	                        INNER JOIN ITEM_CATEGORIES C
	                        ON C.ID = IT.CATEGORY
	                        WHERE I.TYPE = 2
	                        GROUP BY I.ITEM_ID
	                        HAVING SUM(I.QUANTITY)>0
	                        ORDER BY IT.ITEM_DESC
	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table class='tbl_inv' border=1px solid>
	        		
	        		<tbody>
	        		<tr>
	        ";
		        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
		        	
		        	if($count==0){
		        		print "<tr>";
		        	}
		             print("<td>
		             	<div id='img_inv'><img src='images/products/".$row[1]."' onclick=proddet($row[8]);></div>
		             	<table id='det_tbl'>
		             		<tr>
		             			<td><b>Description:</b>&nbsp".$row[2]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Color:</b>&nbsp".$row[3]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Size:</b> &nbsp ".$row[4]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Brand:</b>&nbsp".$row[5]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Quantity:</b>&nbsp".$row[0]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Supplier:</b>&nbsp".$row[6]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Category:</b>&nbsp".$row[7]."</td>
		             		</tr>
		             	</table>
		             	</td>");
		        	$count++;
		             if($count==5){
		        		print "</tr>";
		        		$count = 0;
		        	}
		        }

	        
	        
	        print "
	        		</tbody>
	        		</table>
	        ";
		}
		public function showInventoryR(){
			$link = $this->connect();
			$i=0;
			$count = 0;
	        $query = sprintf("SELECT SUM(I.QUANTITY),
	        						IT.FILENAME,
	        						IT.ITEM_DESC,
	        						IT.COLOR,
	        						IT.SIZE,
	        						IT.BRAND,
	        						S.SUPPLIER_NAME,
	        						C.CATEGORY,
	        						IT.ITEM_CODE
	                        FROM INVENTORY I
	                        INNER JOIN ITEMS IT
	                        ON IT.ITEM_CODE = I.ITEM_ID
	                        INNER JOIN SUPPLIERS S
	                        ON S.SUPPLIER_ID = IT.SUPPLIER_ID
	                        INNER JOIN ITEM_CATEGORIES C
	                        ON C.ID = IT.CATEGORY
	                        WHERE I.TYPE = 3
	                        GROUP BY I.ITEM_ID
	                        HAVING SUM(I.QUANTITY)>0
	                        ORDER BY IT.ITEM_DESC
	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table class='tbl_inv' border=1px solid>
	        		
	        		<tbody>
	        		<tr>
	        ";
		        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
		        	
		        	if($count==0){
		        		print "<tr>";
		        	}
		             print("<td>
		             	<div id='img_inv'><img src='images/products/".$row[1]."' onclick=proddet($row[8]);></div>
		             	<table id='det_tbl'>
		             		<tr>
		             			<td><b>Description:</b>&nbsp".$row[2]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Color:</b>&nbsp".$row[3]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Size:</b> &nbsp ".$row[4]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Brand:</b>&nbsp".$row[5]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Quantity:</b>&nbsp".$row[0]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Supplier:</b>&nbsp".$row[6]."</td>
		             		</tr>
		             		<tr>
		             			<td><b>Category:</b>&nbsp".$row[7]."</td>
		             		</tr>
		             	</table>
		             	</td>");
		        	$count++;
		             if($count==5){
		        		print "</tr>";
		        		$count = 0;
		        	}
		        }

	        
	        
	        print "
	        		</tbody>
	        		</table>
	        ";
		}
		public function showOrderItems($oid){
			$tot=0;
			$link = $this->connect();
	        $query = sprintf("SELECT I.ITEM_DESC, 
	        						OI.QTY,
	        						OI.PRICE
	                        FROM ORDER_ITEMS OI
	                        INNER JOIN ITEMS I
	                        ON I.ITEM_CODE = OI.ITEM_CODE
	                        WHERE OI.ORDER_ID = '".$oid."'
	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table class='tbl_populator'>
	        		<thead>
	        			<th>DESCRIPTION</th>
	        			<th>QTY</th>
	        			<th>PRICE</th>
	        			<th>AMOUNT</th>
	        		</thead>
	        		<tbody>

	        ";
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	             print("<tr><td>$row[0]</td>");
	             print("<td> ".$row[1]."</td>");
	             print("<td>".number_format($row[2],2)."</td>");
	             print("<td>".number_format($row[2]*$row[1],2)."</td></tr>");
	              $tot = $tot + $row[2]*$row[1];
	        }

	        print "<tr><td></td><td></td><td>Total</td><td>".number_format($tot,2)."</td></tr>
	        		</tbody>
	        		</table>
	        ";
		}
		public function showChecklist($oid){
			$tot=0;
			$m=0;
			$link = $this->connect();
	        $query = sprintf("SELECT I.ITEM_DESC, 
	        						OI.QTY,
	        						OI.PRICE,
	        						I.ITEM_CODE
	                        FROM ORDER_ITEMS OI
	                        INNER JOIN ITEMS I
	                        ON I.ITEM_CODE = OI.ITEM_CODE
	                        WHERE OI.ORDER_ID = '".$oid."'
	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table class='tbl_populator'>
	        		<thead>
	        			<th>OK</th>
	        			<th>PRODUCT CODE</th>
	        			<th>DESCRIPTION</th>
	        			<th>QTY</th>
	        			<th>RECEIVED QUANTITY</th>
	        			<th>BARCODE</th>
	        			<th>ACTION</th>
	        		</thead>
	        		<tbody>

	        ";
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	        	 print("<tr><td><input type='checkbox' name='verified' class='checklist_chk' onclick='showAlert(this);'/></td>");
	             print("<td><input type=text class='purch_codes[".$m."]' name='purch_codes[".$m."]' value=$row[3] style='background:none;border:none;color:#333;'></td>");/*edit*/
	             print("<td>$row[0]</td>");
	             print("<td> ".$row[1]."</td>");
	             print("<td><input type=number name='newqty[".$m."]' /></td>");
	             print('<td><div class="barcode_image"><img src="inc/barcode/barcode.php?code='.$row[3].'&scale=1.7" /></div></td>');
	             print("<td><input type=button value=PRINT onclick=print_codes(this); /></td>");
	              $tot = $tot + $row[2]*$row[1];
	              $m++;
	        }

	        print "
	        		<input type=hidden value=".$m." name='itemslength' />
	        		</tbody>
	        		</table>
	        ";
		}

		public function showSaleList($oid){
			$tot=0;
			$link = $this->connect();
	        $query = sprintf("SELECT I.ITEM_DESC, 
	        						OI.QTY,
	        						OI.PRICE,
	        						I.ITEM_CODE
	                        FROM ORDER_ITEMS OI
	                        INNER JOIN ITEMS I
	                        ON I.ITEM_CODE = OI.ITEM_CODE
	                        WHERE OI.ORDER_ID = '".$oid."'
	                        ");
	        $result = mysqli_query($link,$query);
	        print "<table class='tbl_populator'>
	        		<thead>
	        			<th>OK</th>
	        			<th>PRODUCT CODE</th>
	        			<th>DESCRIPTION</th>
	        			<th>QUANTITY</th>
	        			<th>BARCODE</th>
	        		</thead>
	        		<tbody>

	        ";
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	        	 print("<tr><td><input type='checkbox' name='verified' class='checklist_chk' onclick='showAlert(this);'/></td>");
	             print("<td><input type=text class='purch_codes' value=$row[3] style='background:none;border:none;color:#fff;'></td>");
	             print("<td>$row[0]</td>");
	             print("<td> ".$row[1]."</td>");
	             print('<td><div class="barcode_image"><img src="inc/barcode/barcode.php?code='.$row[3].'&scale=1.7" /></div></td>');
	            
	              $tot = $tot + $row[2]*$row[1];
	        }

	        print "
	        		</tbody>
	        		</table>
	        ";
		}

		public function releaseOrder($oid,$d1){
			$link = $this->connect();
	        $query = sprintf("SELECT OI.QTY,
	        						OI.ITEM_CODE,
	        						I.ITEM_COST
	                        FROM ORDER_ITEMS OI
	                        INNER JOIN ITEMS I
	                        ON I.ITEM_CODE = OI.ITEM_CODE
	                        WHERE OI.ORDER_ID = '".$oid."'
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	        	 $this->addToInventory($row[1],$d1,$row[0]*-1,$row[2],3);
	        }
	        $at = 13;
	        $atype = 2;
	        $eid = $this->getOrderDetail($oid,2);
	        $val = $this->getOrderDetail($oid,7);
	        $this->addDebit($at,$atype,$eid,$val*-1,$d1);
	        $at = 14;
	        $atype=3;
	        $eid = 999;
	        $val = $this->getOrderDetail($oid,7);
	        $this->addCredit($at,$atype,$eid,$val*-1,$d1);
		}
		public function receiveOrder($oid,$d1){
			$link = $this->connect();
	        $query = sprintf("SELECT OI.QTY,
	        						OI.ITEM_CODE,
	        						I.ITEM_COST
	                        FROM ORDER_ITEMS OI
	                        INNER JOIN ITEMS I
	                        ON I.ITEM_CODE = OI.ITEM_CODE
	                        WHERE OI.ORDER_ID = '".$oid."'
	                        ");
	        $result = mysqli_query($link,$query);
	        while($row = mysqli_fetch_array($result,MYSQL_NUM)){
	        	 $this->addToInventory($row[1],$d1,$row[0],$row[2],1);
	        }
	        $at = 12;
	        $atype = 1;
	        $eid = $this->getOrderDetail($oid,4);
	        $val = $this->getOrderDetail($oid,7);
	        $this->addCredit($at,$atype,$eid,$val*-1,$d1);
	        $at = 14;
	        $atype=3;
	        $eid = 999;
	        $val = $this->getOrderDetail($oid,7);
	        $this->addDebit($at,$atype,$eid,$val,$d1);
		}
/*-------------------------
		  BALANCESHEET FUNCTIONS
		-------------------------*/

		public function getBS_assets($d1,$d2){
			$link = $this->connect();
	        $query2=sprintf("SELECT SUM(A.VALUE)
	                FROM ACCOUNTS A
	                INNER JOIN ACCOUNT_TITLES AT
	                ON AT.ID = A.ACCOUNT_TITLE
	                WHERE AT.ATYPE = 1
	                AND A.A_DATE BETWEEN '".$d1."' AND '".$d2."'");
	       
	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	                return $row[0];
	            }
		}

		public function getBS_cashinbanksdet($d1,$d2){
			$link = $this->connect();
	        $query2=sprintf("SELECT BA.ACCOUNT_NO,
	        						BA.ACCOUNT_NAME,
	        						SUM(A.VALUE)
			                FROM ACCOUNTS A
			                INNER JOIN BANK_ACCOUNTS BA
			                ON BA.ACCOUNT_NO = A.ENTITY_ID
			                WHERE A.ACCOUNT_TITLE = 11
			                AND A.A_DATE BETWEEN '".$d1."' AND '".$d2."'
			                GROUP BY BA.ACCOUNT_NO");
	       
	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               print"
	               		<tr style='font-size:11px;'>
	               		<td></td>
	               		<td>".$row[1] . "-" .$row[0]."</td>
	               		<td>".number_format($row[2],2)."</td>
	               		</tr>
	               ";
	            }
		}
		public function getBS_assets_details($d1,$d2,$index){
			$link = $this->connect();
	        $query2=sprintf("SELECT AT.ACCOUNT_TITLE,
	        						SUM(A.VALUE),
	        						A.ID
			                FROM ACCOUNTS A
			                INNER JOIN ACCOUNT_TITLES AT
			                ON AT.ID = A.ACCOUNT_TITLE
			                WHERE A.ACCOUNT_TITLE = '".$index."'
			                AND A.A_DATE BETWEEN '".$d1."' AND '".$d2."'
			                GROUP BY AT.ACCOUNT_TITLE");
	       
	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               print"
	               		<tr style='font-size:14px;'>
	               		<td></td>
	               		<td>$row[0]</td>
	               		<td>".number_format($row[1],2)."</td>
	               		</tr>
	               ";
	            }
		}

		public function getBS_liabilities($d1,$d2){
			$link = $this->connect();
	        $query2=sprintf("SELECT SUM(A.VALUE)
	                FROM ACCOUNTS A
	                INNER JOIN ACCOUNT_TITLES AT
	                ON AT.ID = A.ACCOUNT_TITLE
	                WHERE AT.ATYPE = 2
	                AND A.A_DATE BETWEEN '".$d1."' AND '".$d2."'");
	       
	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	                return $row[0];
	            }
		}

		public function getBS_liabilities_details($d1,$d2){
			$link = $this->connect();
	        $query2=sprintf("SELECT AT.ACCOUNT_TITLE,
	        						SUM(A.VALUE)
			                FROM ACCOUNTS A
			                INNER JOIN ACCOUNT_TITLES AT
			                ON AT.ID = A.ACCOUNT_TITLE
			                WHERE AT.ATYPE = 2
			                AND A.A_DATE BETWEEN '".$d1."' AND '".$d2."'
			                GROUP BY AT.ACCOUNT_TITLE");
	       
	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               print"
	               		<tr style='font-size:14px;'>
	               		<td></td>
	               		<td>$row[0]</td>
	               		<td>".number_format($row[1],2)."</td>
	               		</tr>
	               ";
	            }
		}
		public function getBS_equity($d1,$d2){
			$link = $this->connect();
	        $query2=sprintf("SELECT SUM(A.VALUE)
	                FROM ACCOUNTS A
	                INNER JOIN ACCOUNT_TITLES AT
	                ON AT.ID = A.ACCOUNT_TITLE
	                WHERE AT.ATYPE = 3
	                AND A.A_DATE BETWEEN '".$d1."' AND '".$d2."'");
	       
	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	                return $row[0];
	            }
		}

		public function getBS_equity_details($d1,$d2){
			$link = $this->connect();
	        $query2=sprintf("SELECT AT.ACCOUNT_TITLE,
	        						SUM(A.VALUE)
			                FROM ACCOUNTS A
			                INNER JOIN ACCOUNT_TITLES AT
			                ON AT.ID = A.ACCOUNT_TITLE
			                WHERE AT.ATYPE = 3
			                AND A.A_DATE BETWEEN '".$d1."' AND '".$d2."'
			                GROUP BY AT.ACCOUNT_TITLE");
	       
	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	               print"

	               		<td></td>
	               		<td style='font-size:14px;'>$row[0]</td>
	               		<td style='font-size:14px;'>".number_format($row[1],2)."</td>

	               ";
	            }
		}

		public function getBS_net($d1,$d2){
			$sales = $this->getFS_sales($d1,$d2);
			$bi = $this->getFS_bi('2001-01-01',$d1);
			$purch = $this->getFS_purch($d1,$d2);
			$ei = $this->getFS_ei($d1,$d2);
			$oe = $this->getFS_oe($d1,$d2);
			return ($sales-(($bi+$purch)-$ei))-$oe;
		}

		/*---------------
		  FS FUNCTIONS
		---------------*/

		public function getFS_sales($d1,$d2){
			$link = $this->connect();
	        $query2=sprintf("SELECT SUM(SI.QTY * SI.PRICE)
	                FROM SALES S
	                INNER JOIN SALES_ITEMS SI
	                ON SI.SALES_ID = S.SALES_INVOICE
	                WHERE S.SALE_DATE BETWEEN '".$d1."' AND '".$d2."'");
	        /*
	                SELECT SUM(cii.invoice_item_qty * cii.invoice_item_price)
	                FROM company_invoice ci
	                INNER JOIN company_invoice_item cii
	                ON cii.invoice_no = ci.invoice_no
	                WHERE ci.invoice_date BETWEEN ".$d1." AND ".$d2."
	        */

	        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

	        
	        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
	            {
	                return $row[0];
	            }
		}

		public function getFS_bi($d1,$d2){
		        $link = $this->connect();
		        //$d2 = date('Y-m-d', strtotime('-1 day', strtotime($d2)));
		       // $d2n = str_replace('-', '-', $d2);
		        $query2=sprintf("SELECT sum(i.QUANTITY),
		                                i.COST
		                         FROM inventory i
		                         WHERE cast(i.SELLING_DATE as DATE) BETWEEN '2001-01-01' AND '".$d2."'
		                         GROUP BY i.ITEM_ID
		                    ");

		        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));
		        $tot=0;
		        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
		            {
		              $tot = $tot + ($row[1] * $row[0]);
		            }
		            return $tot;
		    }

		    public function getFS_purch($d1,$d2){
		        $link = $this->connect();
		        $d1n = str_replace('-', '-', $d1);
		        $yesterday = date('Y-m-d',strtotime($d1n . "+1 days"));
		        $query2=sprintf("SELECT SUM(PI.QTY),
		        						PI.COST

		                         FROM PURCHASES P
		                         INNER JOIN PURCHASE_ITEMS PI
		                         ON PI.PURCH_ID = P.PURCH_ID
		                         WHERE  P.PURCH_DATE BETWEEN '".$d1."' AND '".$d2."'
		                         GROUP BY PI.ITEM_CODE
		                    ");

		        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));
		        $tot=0;
		        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
		            {
		              $tot = $tot + ($row[1] * $row[0]);
		            }
		            return $tot;
		    }
		   public function getFS_ei($d1,$d2){
		        $link = $this->connect();
		        $query2=sprintf("SELECT sum(i.QUANTITY),
		                                i.COST
		                         FROM inventory i
		                         WHERE i.SELLING_DATE BETWEEN '2001-01-01' AND '".$d2."'
		                         GROUP BY i.ITEM_ID
		                    ");

		        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));
		        $tot=0;
		        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
		            {
		              $tot = $tot + ($row[1] * $row[0]);
		            }
		            return $tot;
		    }
		    public function getFS_cos($d1,$d2){
		        $link = $this->connect();
		        $d1n = str_replace('-', '-', $d1);
		        $yesterday = date('Y-m-d',strtotime($d1n . "+1 days"));
		        $query2=sprintf("SELECT sum(i.QUANTITY*-1),
		                                i.COST
		                         FROM inventory i
		                         WHERE i.SELLING_DATE BETWEEN '".$d1."' AND '".$d2."'
		                         AND i.TYPE = 2
		                         GROUP BY i.ITEM_ID
		                    ");

		        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));
		        $tot=0;
		        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
		            {
		              $tot = $tot + ($row[1] * $row[0]);
		            }
		            return $tot;
		    }
		    public function getFS_OE($d1,$d2){
		        $link = $this->connect();
		        $query2=sprintf("SELECT SUM(E.PRICE)
		                FROM EXPENSES E
		                WHERE cast(E.EXP_DATE as DATE) BETWEEN '".$d1."' AND '".$d2."'
		                AND E.ACCOUNT_TITLE > 0
		            ");
		        /* WHERE cast(E.EXP_DATE as DATE) BETWEEN '".$d1."' AND '".$d2."'*/
		        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

		        
		        while($row= mysqli_fetch_array($result2, MYSQL_NUM))
		            {
		               return $row[0];
		            }
		    }
		    public function getFS_at($d1,$d2){
			    $link = $this->connect();
			    $query2=sprintf("SELECT at.ACCOUNT_TITLE,
			                            SUM(E.PRICE)
			                    FROM EXPENSES E
			                    INNER JOIN ACCOUNT_TITLES at
			                    ON at.id = E.ACCOUNT_TITLE	
			                    WHERE CAST(E.EXP_DATE as DATE) BETWEEN '".$d1."' AND '".$d2."'
			                    AND E.account_title > 0 
			                    GROUP BY E.account_title
			        ");

			    $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

			    
			    while($row= mysqli_fetch_array($result2, MYSQL_NUM))
			        {
			          print "<tr><td style=text-align:left;font-size:12px>".$row[0]."</td>";
			          print "<td></td>";
			          print "<td style=text-align:right;font-size:12px>".number_format($row[1],2)."</td></tr>";
			        }
			}
			public function login($username,$password){
		         $link = $this->connect();
		        $query2=sprintf("SELECT access_level
		                        FROM user
		                        WHERE username = '".$username."'
		                        AND password = '".$password."'
		                ");

		        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

		        if($row= mysqli_fetch_array($result2, MYSQL_NUM)>0){
		            $_SESSION['username'] = $username;
		            $_SESSION['password'] = md5($password);
		            $_SESSION['accesslevel'] = $row[0];
		            header("location:index.php");
		        }else{
		            print "INVALID";
		        }
		        
		    }




		    /**ADDED DEC 21**/
		    public function updateOrderQty($code,$qty){
		    	 $link = $this->connect();
		        $query2=sprintf("UPDATE ORDER_ITEMS
		                        SET QTY = '".$qty."'
		                        WHERE ITEM_CODE = '".$code."'
		                ");

		        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

		        $query3=sprintf("UPDATE PURCHASE_ITEMS
		                        SET QTY = '".$qty."'
		                        WHERE ITEM_CODE = '".$code."'
		                ");

		        $result3 = mysqli_query($link,$query3) or die('Query failed: ' . mysqli_error($link));
		    }
		 public function updateOrderCost($code,$tot){
		    	 $link = $this->connect();
		        $query2=sprintf("UPDATE ORDERS
		                        SET TOTAL = '".$tot."'
		                        WHERE ORDER_ID = '".$code."'
		                ");

		        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

		        $query3=sprintf("UPDATE PURCHASES
		                        SET PURCH_TOTAL = '".$tot."'
		                        WHERE PURCH_ID = '".$code."'
		                ");

		        $result3 = mysqli_query($link,$query3) or die('Query failed: ' . mysqli_error($link));
		    }

		    public function updateOrderTotal($code,$tot){
		    	 $link = $this->connect();
		        $query2=sprintf("UPDATE ORDERS
		                        SET TOTAL = '".$tot."'
		                        WHERE ORDER_ID = '".$code."'
		                ");

		        $result2 = mysqli_query($link,$query2) or die('Query failed: ' . mysqli_error($link));

		         $query3=sprintf("UPDATE SALES
		                        SET BALANCE = '".$tot."'
		                        WHERE SALES_ID = '".$code."'
		                ");

		        $result3 = mysqli_query($link,$query3) or die('Query failed: ' . mysqli_error($link));
		    }  
		/*---------------
		UI FUNCTIONS
		---------------*/



			
	}
?>