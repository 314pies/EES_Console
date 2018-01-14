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
			

			$productName = $_POST['productName'];
			$description = $_POST['description'];
			$price=$_POST['price'];
			$summit_type = $_POST['summit_type'];//0=修改 1=刪除 2=新增
			$holderId = $_POST['holderId'];
			
			if($productName == null || $description == null ||$price ==null  || $summit_type == null)
			{
					echo '請取消資料保護功能! <a href="booth.php">點此</a>返回管理頁面<br>';
					echo '<meta http-equiv=REFRESH CONTENT=2;url=booth.php>';
			}
			
			if($summit_type == 1)//刪除 
			{
				$productId = $_POST['productId'];				
				$sql = "delete from product where productId = '$productId'";
				if(mysql_query($sql))
				{
						echo '刪除商品成功! <a href="booth.php">點此</a>返回管理頁面';
						echo '<meta http-equiv=REFRESH CONTENT=2;url=booth.php>';
				}
				else
				{
						echo '刪除商品失敗!';
						echo '<meta http-equiv=REFRESH CONTENT=2;url=booth.php>';
				}
			} 

			//判斷資料是否為空值
			else if($productName != null && $description != null && $price !=null &&$price !=null)
			{
				if($summit_type == 2){
					//新增商品
					$boothId = $_POST['boothId'];
					$sql = "insert into product (holderId,productName,description,price,boothId) values ('$holderId','$productName','$description','$price','$boothId')";
					if(mysql_query($sql))
					{
							echo '新增商品成功! <a href="booth.php">點此</a>返回管理頁面';
							echo '<meta http-equiv=REFRESH CONTENT=2;url=booth.php>';
					}
					else
					{
							echo '新增商品失敗!';
							echo '<meta http-equiv=REFRESH CONTENT=2;url=booth.php>';
					}
				}
				else if($summit_type == 0){
					$productId = $_POST['productId'];	
					$sql = "update product set productName='$productName',description='$description',price='$price' where productId = '$productId'";
					if(mysql_query($sql))
					{
							echo '修改商品成功! <a href="booth.php">點此</a>返回管理頁面';
							echo '<meta http-equiv=REFRESH CONTENT=2;url=booth.php>';
					}
					else
					{
							echo '修改商品失敗!';
							echo '<meta http-equiv=REFRESH CONTENT=2;url=booth.php>';
					}
					
				}
				
			}

			else
			{
					echo '資料更新發生錯誤!';
					echo '<meta http-equiv=REFRESH CONTENT=2;url=booth.php>';
			}

			?>
		</div>
	</div><!-- /container -->
	</body>
</html>



