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
		class fail{
			public $type = "signup";
			public $status = "error";
			public $error = "299";
		};
		
		$return_fail = new fail();
		
		//php class success
		class success {
			public $type = 'signup';
			public $status = 'ok';
			public $token;
			public $data;
		}
		
		//php class data
		class data {
			public $accountId;
		}
		
		$return_success = new success();
		$return_success -> data=new data();
		
		//json response的header
		header('Content-Type: application/json');
		
		//POST的資料轉換成object
		$input = json_decode($json_input);
		
		//取出POST的五個欄位
		$email = $input->{"email"};
		$pw = $input->{"password"};
		$displayName = $input->{"displayName"};
		$birthday = $input->{"birthday"};
		$isMale = $input->{"isMale"};
		
		//搜尋資料庫資料
		$sql = "SELECT * FROM account where email = '$email'";
		$result = mysql_query($sql);
		$row = @mysql_fetch_row($result);

		if($email == null || $pw == null || $displayName == null || $birthday == null ) {
			$return_fail -> error="202";//註冊資料輸入錯誤
			echo json_encode($return_fail);
		}
		else if($row[1] == $email) {
			$return_fail -> error="201";//emai已經存在
			echo json_encode($return_fail);
		}
		else {
			//產生token
			$token = md5 (uniqid (""));
			$return_success -> token = $token;
			$sql = "INSERT INTO account(email, passwordHash, displayName, birthday, isMale, token) VALUES('".$email."', '".$pw."', '".$displayName."', '".$birthday."', '".$isMale."', '".$token."')";
			if(mysql_query($sql)) {
				$result = mysql_query("SELECT accountId FROM account WHERE email = '".$email."'");
				$row = @mysql_fetch_row($result);
				$return_success -> data -> accountId = $row[0];
				
				echo json_encode($return_success);
			}
			else {
				echo json_encode($return_fail);
			}
		}
	?>