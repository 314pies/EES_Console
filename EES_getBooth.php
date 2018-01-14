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
			public $type = "getBooth";
			public $status = "error";
			public $error = "499";
		};
		
		$return_fail = new fail();
		
		//php class success
		class success {
			public $type = 'getBooth';
			public $status = 'ok';
			public $token;
			public $data = array();
		}
		
		//php class data
		class data {
			public $boothId;
			public $boothPosition;
			public $exhibitionId;
			public $holderId;
			public $holderName;
			public $displayName;
			public $popularity;
			public $description;
		}
		
		$return_success = new success();
		
		//json response的header
		header('Content-Type: application/json');
		
		//POST的資料轉換成object
		$input = json_decode($json_input);
		
		//取出POST的欄位
		$exhibitionId = $input->{"exhibitionId"};
		
		//exhibition瀏覽人次+1
		mysql_query("UPDATE exhibition SET popularity = popularity + 1 WHERE exhibitionId = '".$exhibitionId."'");
		
		//搜尋資料庫資料
		//瀏覽特定展覽攤位
		$sql = "SELECT boothId, boothPosition, exhibitionId, holderId, account.displayName, booth.displayName, popularity, description FROM booth, account WHERE exhibitionId = '".$exhibitionId."' AND holderId = accountId";
		if($result = mysql_query($sql)) {
			while($row = @mysql_fetch_row($result)) {
				$data = new data();
				
				$data -> boothId = $row[0];
				$data -> boothPosition = $row[1];
				$data -> exhibitionId = $row[2];
				$data -> holderId = $row[3];
				$data -> holderName = $row[4];
				$data -> displayName = $row[5];
				$data -> popularity = $row[6];
				$data -> description = $row[7];
				
				array_push($return_success -> data, $data);
			}
			echo json_encode($return_success);
		}
		else {
			echo json_encode($return_fail);
		}
	?>