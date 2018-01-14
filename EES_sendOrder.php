<?php
// Cross-Origin Resource Sharing Header
header('Access-Control-Allow-Origin: *');
?>
<?php session_start();?>
	<?php
		//連接資料庫
		include("mysql_connect.inc.php");
			
		//取得POST資料
		$json_input = file_get_contents('php://input');
		
		//php class fail
		class fail {
			public $type = "sendOrder";
			public $status = "error";
			public $error = "999";
		};
		
		$return_fail = new fail();
		
		//php class success
		class success {
			public $type = 'sendOrder';
			public $status = 'ok';
			public $token;
			public $data;
		}
		
		//php class data
		class data {
			public $orderId;
			public $userId;
			public $productId;
			public $amount;
			public $price;
			public $orderTime;
		}
		
		$return_success = new success();
		$return_success -> data = new data();
		
		//json response的header
		header('Content-Type: application/json');
		
		//POST的資料轉換成object
		$input = json_decode($json_input);
		
		//取出POST的三個欄位
		$userId = $input -> {"userId"};
		$productId = $input -> {"productId"};
		$amount = $input -> {"amount"};
		
		//搜尋商品價錢
		$sql = "SELECT * FROM `product` WHERE `productID` = '".$productId."'";
		if($result = mysql_query($sql)) {
			$row = @mysql_fetch_row($result);
            $productprice = $row[4];
		}
		else {
			//無法取得商品單價
			$return_fail -> error = "901";
			echo json_encode($return_fail);
		}
		$price = $productprice * $amount;
		
		//產生token
		$token = md5 (uniqid (""));
		$return_success->token = $token;
		$sql = "INSERT INTO `eesorder`(userId, productId, amount, price) VALUES('".$userId."', '".$productId."', '".$amount."', '".$price."')";
		if(mysql_query($sql)) {
			$sql = "SELECT * FROM eesorder WHERE orderId = LAST_INSERT_ID()";
			if($result = mysql_query($sql)) {
				$row = @mysql_fetch_row($result);
				
				$return_success -> data -> orderId = $row[0];
				$return_success -> data -> userId = $row[1];
				$return_success -> data -> productId = $row[2];
				$return_success -> data -> amount = $row[3];
				$return_success -> data -> price = $row[4];
				$return_success -> data -> orderTime = $row[5];
			}
			else {
			//無法取得訂單資訊
			$return_fail -> error = "903";
			echo json_encode($return_fail);
			}
			echo json_encode($return_success);
		}
		else {
			//INSERT失敗
			$return_fail -> error = "902";
			echo json_encode($return_fail);
		}
	?>