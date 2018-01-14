<?php
// Cross-Origin Resource Sharing Header
header('Access-Control-Allow-Origin: *');
?>
<?php session_start();?>
	<?php
		//連接資料庫
		include("mysql_connect.inc.php");
			
		//取得POST資料
		//$json_input = file_get_contents('php://input');
		
		//php class fail
		class fail {
			public $type = "getExhibtion";
			public $status = "error";
			public $error = "399";
		};
		
		$return_fail = new fail();
		
 		//php class success
		class success {
			public $type = 'getExhibtion';
			public $status = 'ok';
			public $token;
			public $data = array();
		}
		
		//php class data
		class data {
			public $exhibitionId;
			public $displayName;
			public $startDate;
			public $endDate;
			public $location;
			public $organizer_id;
			public $description;
			public $popularity;
			public $URL;
		}
		
		$return_success = new success();
		
		//json response的header
		//header('Content-Type: application/json');
		
		//POST的資料轉換成object
		//$input = json_decode($json_input);
		
		//取出POST的欄位
		//$accountId = $input->{"accountId"};
		
		//搜尋資料庫資料
		//還沒結束的exhibition
		$sql = "SELECT * FROM exhibition where endDate >= NOW()";
 		if($result = mysql_query($sql)) {
			while($row = @mysql_fetch_row($result)) {
				$data = new data();
				
				$data -> exhibitionId = $row[0];
				$data -> displayName = $row[1];
				$data -> startDate = $row[2];
				$data -> endDate = $row[3];
				$data -> location = $row[4];
				$data -> organizer_id = $row[5];
				$data -> description = $row[6];
				$data -> popularity = $row[7];
				$data -> URL = $row[6];
				
				array_push($return_success -> data, $data);
			}
			echo json_encode($return_success);
		}
		else {
			echo json_encode($return_fail);
		}
	?>