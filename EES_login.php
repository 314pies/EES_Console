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
			public $type = "login";
			public $status = "error";
			public $error = "199";
		};
		
		$return_fail = new fail();
		
		//php class success
		class success {
			public $type = 'login';
			public $status = 'ok';
			public $token ;
			public $data ;
		}
		
		//php class data
		class data {
			public $accountId ;
			public $displayName;
			public $birthday ;
			public $isMale ;
		}
		
		$return_success=new success();
		$return_success -> data=new data();
		
		
		//json response的header
		header('Content-Type: application/json');
		
		//POST的資料轉換成object
		$input = json_decode($json_input);
		
		//取出POST的兩個欄位
		$email=$input->{"email"};
		$pw=$input->{"password"};
		
		//搜尋資料庫資料
		$sql = "SELECT * FROM account where email = '$email'";
		$result = mysql_query($sql);
		$row = @mysql_fetch_row($result);
		
		//判斷帳號與密碼是否為空白以及MySQL資料庫裡是否有這個會員
		if($email != null && $pw != null && $row[1] == $email && $row[2] == $pw)
		{
		//搜尋用戶是否為主辦或攤位(未完成)
		
			//寫入accountId,displayName,birthday,isMale
			$return_success ->data->accountId=$row[0];
			$return_success ->data->displayName=$row[3];
			$return_success ->data->birthday=$row[4];
			$return_success ->data->isMale=$row[5];
			
			//產生token寫入資料庫
			$token = md5 (uniqid (""));
			$return_success ->token = $token;
			$sql = "UPDATE `account` SET `token`='$token' WHERE `email`='$email'";
			mysql_query($sql);
			
			//登入成功
			echo json_encode($return_success);
			
		}
		else if($row[1] != $email)//登入失敗 無email
		{
			$return_fail ->error="101"; //更改error code
			echo json_encode($return_fail);

		}
		else if($row[2] != $pw)//登入失敗 無pw
		{
			$return_fail ->error="102"; //更改error code
			echo json_encode($return_fail);
		}
		else//登入失敗 其他狀況
		{
			echo json_encode($return_fail);
		}

	?>
