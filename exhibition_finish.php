<!DOCTYPE html>

<?php session_start(); 

	include("mysql_connect.inc.php");
	//此判斷為判定觀看此頁有沒有權限
	//說不定是路人或不相關的使用者
	//因此要給予排除
	if($_SESSION['email'] != null&&$_SESSION['accountId'] != null)
	{
			$email=($_SESSION['email']);							
			$accountId=$_SESSION['accountId'];
			$account = mysql_query("SELECT * FROM `account` WHERE email='$email'");
			$user = mysql_fetch_array($account);
			
			$exhibition_data = mysql_query("SELECT * FROM `exhibition` WHERE organizer_id='$accountId'");
			$exhibition = mysql_fetch_array($account);
			
			$booth_data = mysql_query("SELECT * FROM `booth` WHERE holderId='$accountId'");
			$booth = mysql_fetch_array($account);

	}
	else
	{
			echo '您無權限觀看此頁面!';
			header("Location: login.php");
	}
?>
<html lang="zh-TW">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="description">
	<meta content="" name="author">
	<link href="" rel="shortcut icon">
	<title>EES超級後台-管理攤位</title><!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">

	<style>
		body
		{
			background:url('img/register_bg.jpg');
			background-size: cover;
		}
		.well
		{
			opacity:0.95;
		}

	</style>
	
</head>
<body>
	<div class="container">
		<div class="well">
			<?php
			include("mysql_connect.inc.php");//資料庫連接
			

			$displayName = $_POST['displayName'];
			$startDate = $_POST['startDate'];
			$endDate = $_POST['endDate'];
			$location = $_POST['location'];
			$description = $_POST['description'];
			$URL = $_POST['URL'];
			$exhibitionId = $_POST['exhibitionId'];
			$summit_type = $_POST['summit_type'];//0=修改 1=刪除 2=新增
			
			if($displayName == null || $startDate == null || $endDate ==null ||$location ==null  || $description == null)
			{
					echo '請取消資料保護功能! <a href="exhibition.php">點此</a>返回管理頁面<br>';
					echo '<meta http-equiv=REFRESH CONTENT=2;url=exhibition.php>';
			}
			
			if($summit_type == 1)//刪除 
			{ 
				$sql = "delete from exhibition where exhibitionId = '$exhibitionId'";
				if(mysql_query($sql))
				{
						echo '刪除展覽成功! <a href="exhibition.php">點此</a>返回管理頁面';
						echo '<meta http-equiv=REFRESH CONTENT=2;url=exhibition.php>';
				}
				else
				{
						echo '刪除展覽失敗!';
						echo '<meta http-equiv=REFRESH CONTENT=2;url=exhibition.php>';
				}
			} 

			//判斷資料是否為空值
			else if($displayName != null && $startDate != null && $endDate !=null &&$location !=null  && $description != null)
			{
				if($summit_type == 2){
					//新增展覽
					$sql = "insert into exhibition (displayName,startDate,endDate,location,description,URL,organizer_id) values ('$displayName','$startDate','$endDate','$location','$description','$URL','$accountId')";
					if(mysql_query($sql))
					{
							echo '新增展覽成功! <a href="exhibition.php">點此</a>返回管理頁面';
							echo '<meta http-equiv=REFRESH CONTENT=2;url=exhibition.php>';
					}
					else
					{
							echo '新增展覽失敗!';
							echo '<meta http-equiv=REFRESH CONTENT=2;url=exhibition.php>';
					}
				}
				else if($summit_type == 0){
					$sql = "update exhibition set displayName='$displayName',startDate='$startDate',endDate='$endDate',location='$location',description='$description',URL='$URL',organizer_id='$accountId' where exhibitionId = '$exhibitionId'";
					if(mysql_query($sql))
					{
							echo '修改展覽成功! <a href="exhibition.php">點此</a>返回管理頁面';
							echo '<meta http-equiv=REFRESH CONTENT=2;url=exhibition.php>';
					}
					else
					{
							echo '修改展覽失敗!';
							echo '<meta http-equiv=REFRESH CONTENT=2;url=exhibition.php>';
					}
					
				}
				
			}

			else
			{
					echo '資料更新發生錯誤!';
					echo '<meta http-equiv=REFRESH CONTENT=2;url=exhibition.php>';
			}

			?>
		</div>
	</div><!-- /container -->
	</body>
</html>



