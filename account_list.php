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
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="description">
	<meta content="" name="author">
	<link href="" rel="shortcut icon">
	<title>EES超級後台-瀏覽所有主辦人與展覽</title>
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<!-- Font awesome icon -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>

	
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="js/jquery-ui.min.js"></script>

	<!--bs3不需要了<link href="css/bootstrap-responsive.css" rel="stylesheet">-->
	
	<style>
		body
		{
			background:url('img/register_bg.jpg');
			background-size: cover;
			background-attachment:fixed;
		}
		.well
		{
			opacity:0.95;
		}

	</style>

<body id="page-top">

<div class="container">
<div class="well">
    <fieldset>
      <legend align="center"><h2><i class="fa fa-pencil-square-o" aria-hidden="true"></i>EES超級後台-瀏覽所有主辦人與展覽</h2></legend>
	  <h4><p align="right">目前展覽數量：<?php $exhibition_count = mysql_query("SELECT COUNT(*) as total FROM exhibition;");$data_ex_count=mysql_fetch_assoc($exhibition_count);echo $data_ex_count['total']; ?> <a href="index.php"><i class="fa fa-home" aria-hidden="true">回到主頁面</i></a></p></h4>
	   
    <div name="mb_body">       
	
	  
	  <?php
	    $join_data = mysql_query("SELECT a.accountId,a.email,a.displayName as acountName,b.*
									FROM account as a
									INNER JOIN exhibition as b
									ON a.accountId=b.organizer_id;");
		
		for($i=0;$i<mysql_num_rows($join_data);$i++)
		{
			$rs=mysql_fetch_assoc($join_data);
			echo "<script>console.log( 'Debug Objects: " . $i . "' );</script>";
		

		
		    echo'<table class="table table-striped"><div>
				<thead>

				</thead>
				<tbody>
				<form action="#" class="form-horizontal well" method="post">
				<fieldset id="field_';echo $rs['exhibitionId'] ;echo'" disabled>
					  <legend>主辦人ID：';echo $rs['accountId'];echo'</legend>
						<div class="form-group">
							<div class="rows">
								
									<div class="col-lg-12">
										<label for="title">主辦人名稱:</label>
										<input class="form-control input" id="displayName" name="displayName" placeholder="請輸入主題" type="text" required="required" value="';echo ($rs['acountName']);echo'">
									</div>
								
							</div>
								<div class="rows">
								
									<div class="col-lg-12">
										<label for="title">展覽ID:</label>
										<input class="form-control input" id="displayName" name="displayName" placeholder="請輸入主題" type="text" required="required" value="';echo ($rs['exhibitionId']);echo'">
									</div>
								
							</div>
							<div class="rows">
								
									<div class="col-lg-12">
										<label for="title">展覽名稱:</label>
										<input class="form-control input" id="displayName" name="displayName" placeholder="請輸入主題" type="text" required="required" value="';echo ($rs['displayName']);echo'">
									</div>
								
							</div>
						</div>
						<div class="form-group">
							<div class="rows">
								
									<div class="col-lg-12">
										<label for="title">展覽開始日期</label>
										<input class="form-control input" id="startDate" name="startDate" placeholder="startDate" type="date" required="required" value="';echo ($rs['startDate']);echo'">
									</div>
								
							</div>
						</div>
								<div class="form-group">
							<div class="rows">
								
									<div class="col-lg-12">
										<label for="title">展覽結束日期</label>
										<input class="form-control input" id="endDate" name="endDate" placeholder="endDate" type="date" required="required" value="';echo ($rs['endDate']);echo'">
									</div>
								
							</div>
						</div>
						<div class="form-group">
							<div class="rows">
								
									<div class="col-lg-12">
										<label for="title">展覽地點</label>
										<input class="form-control input" id="location" name="location" placeholder="展覽地點" type="text" required="required" value="';echo ($rs['location']);echo'">
									</div>
								
							</div>
						</div>
						<div class="form-group">
							<div class="rows">
								
									<div class="col-lg-12">
										<label for="comment">展覽描述:</label>
										<textarea class="form-control input" rows="8" id="description" name="description" placeholder="展覽描述" required="required">';echo ($rs['description']);echo'</textarea>
									</div>
								
							</div>
						</div>

						<div class="form-group">
							<div class="rows">
								
									<div class="col-lg-12">
										<label for="title">展覽URL</label>
										<input class="form-control input" id="URL" name="URL" placeholder="URL" type="text" value="';echo ($rs['URL']);echo'">
									</div>
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">
								
									<div class="col-lg-12">
										<input class="form-control input" id="exhibitionId" name="exhibitionId" type="hidden" value="';echo ($rs['exhibitionId']);echo'">
									</div>
								
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">
								
									<div class="col-lg-12">
										<input class="form-control input" id="delete_';echo $rs['exhibitionId'];echo'" name="summit_type" type="hidden" value="0">
									</div>
								
							</div>
						</div>
							
						<div></div>
					</fieldset>
					
				</form>
				</tbody>
	 	   </div> </table>';
	  
	  }?>
	 
	</div>
	<hr>
	<div name="exhibition_add">
	
	<legend>
		<p align="right">
			<a class="page-scroll" href="#page-top"><i class="fa fa-arrow-up" aria-hidden="true"></i> 回到最上面</i></a>
			<a href="index.php"><i class="fa fa-home" aria-hidden="true"> 回到主頁面</i></a>
		</p>
	</legend>
	</div>
</div>
</div><!-- /container -->
</body>
</html>