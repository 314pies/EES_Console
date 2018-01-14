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
			public $type = "subscribe";
			public $status = "error";
			public $error = "1099";
		};
		
		$return_fail = new fail();
		
		//php class success
		class success {
			public $type = 'subscribe';
			public $status = 'ok';
			public $token;
			public $data = array();
		}
		
		//php class data
		class data {
			public $accountId;
			public $displayName;
			public $birthday;
			public $isMale;
		}
		
		$return_success = new success();
		
		//json response的header
		header('Content-Type: application/json');
		
		//POST的資料轉換成object
		$input = json_decode($json_input);
		
		//取出POST的兩個欄位
		$subscribeAccountId = $input -> {"subscribeAccountId"};
		$subscribedAccountId = $input -> {"subscribedAccountId"};
		
		//產生token
		$token = md5(uniqid(""));
		$return_success -> token = $token;
		$sql = "INSERT INTO `subscribe`(subscribeAccountId, subscribedAccountId) VALUES('".$subscribeAccountId."', '".$subscribedAccountId."')";
		if(mysql_query($sql)) {
			$sql = "SELECT * FROM `account` WHERE `accountId` in (SELECT `subscribedAccountId` FROM `subscribe` WHERE subscribeAccountId = '".$subscribeAccountId."')";
			if($result = mysql_query($sql)) {
				while($row = @mysql_fetch_row($result)) {
					$data = new data();
					
					$data -> accountId = $row[0];
					$data -> displayName = $row[3];
					$data -> birthday = $row[4];
					$data -> isMale = $row[5];
					
					array_push($return_success -> data, $data);
				}
				echo json_encode($return_success);
			}
			else {
				//無法取得追蹤資訊
				$return_fail -> error = "1003";
				echo json_encode($return_fail);
			}
		}
		else {
			//INSERT失敗(追蹤過)
			$return_fail -> error = "1002";
			echo json_encode($return_fail);
		}
	?>