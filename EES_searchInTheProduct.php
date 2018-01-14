<?php
// Cross-Origin Resource Sharing Header
header('Access-Control-Allow-Origin: *');
?>
<?php session_start(); ?>
	<?php
		//連接資料庫
		include("mysql_connect.inc.php");
			
		//取得POST資料
		$json_input = file_get_contents('php://input');
		
		//php class fail
		class fail {
			public $type = "searchInTheProduct";
			public $status = "error";
			public $error = "699";
		};
		
		$return_fail = new fail();
		
		//php class success
		class success {
			public $type = 'searchInTheProduct';
			public $status = 'ok';
			public $data  = array();
		}
		
		//php class data
		class data {
			public $productId;
			public $holderId;
			public $holderName;
			public $productName;
			public $description;
			public $price;
		}
		
		$return_success=new success();
		
		//json response的header
		header('Content-Type: application/json');
		
		//POST的資料轉換成object
		$input = json_decode($json_input);
		
		//取出POST的一個欄位
		$keyword = $input -> {"productTagName"};
		
		//搜尋資料庫資料
		//搜尋商品Tag、關鍵字
		//$sql = "SELECT * FROM product WHERE displayName LIKE '%".$keyword."%' OR productId IN(SELECT productId FROM producttag WHERE productTagName = '%".$keyword."%')";
		$sql = "SELECT productId, holderId, displayName, productName, description, price FROM product, account WHERE productName LIKE '%".$keyword."%' OR productId IN(SELECT productId FROM producttag WHERE productTagName LIKE '%".$keyword."%') AND holderId = accountId";
		if($result = mysql_query($sql)) {
			while($row = @mysql_fetch_row($result)) {
				$data = new data();
				
				$data -> productId = $row[0];
				$data -> holderId = $row[1];
				$data -> holderName = $row[2];
				$data -> productName = $row[3];
				$data -> description = $row[4];
				$data -> price = $row[5];
				
				array_push($return_success -> data, $data);
			}
			echo json_encode($return_success);
		}
		else {
			echo json_encode($return_fail);
		}
	?>