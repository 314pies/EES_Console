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
			public $type = "getSubscribe";
			public $status = "error";
			public $error = "1299";
		};
		
		$return_fail = new fail();
		
		//php class success
		class success {
			public $type = 'getSubscribe';
			public $status = 'ok';
			public $token;
			public $data;
		}
		
		//php class data
		class data {
			public $subscribers = array();
			public $subscribed = array();
		}
		
		class subscribers {
			public $accountId;
			public $displayName;
		}
		
		class subscribed {
			public $accountId;
			public $displayName;
		}
		
		$return_success = new success();
		$return_success -> data = new data();
		
		//json response的header
		header('Content-Type: application/json');
		
		//POST的資料轉換成object
		$input = json_decode($json_input);
		
		//取出POST的欄位
		$accountId = $input->{"accountId"};
		
		//搜尋資料庫資料
		//瀏覽subscribers
		$sql = "SELECT accountId, displayName FROM account WHERE accountId IN(SELECT subscribeAccountId FROM subscribe WHERE subscribedAccountId = '".$accountId."')";
		if($result = mysql_query($sql)) {
			while($row = @mysql_fetch_row($result)) {
				$data = new subscribers();
				
				$data -> accountId = $row[0];
				$data -> displayName = $row[1];
				
				array_push($return_success -> data -> subscribers, $data);
			}
		}
		else {
			echo json_encode($return_fail);
		}
		
		//瀏覽追蹤中
		$sql = "SELECT accountId, displayName FROM account WHERE accountId IN(SELECT subscribedAccountId FROM subscribe WHERE subscribeAccountId = '".$accountId."')";
		if($result = mysql_query($sql)) {
			while($row = @mysql_fetch_row($result)) {
				$data = new subscribed();
				
				$data -> accountId = $row[0];
				$data -> displayName = $row[1];
				
				array_push($return_success -> data -> subscribed, $data);
			} 
		}
		else {
			echo json_encode($return_fail);
		}
		echo json_encode($return_success);
	?>