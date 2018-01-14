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
	<title>EES超級後台-管理我的展覽</title>
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

<div class="container well">
<div>
    <fieldset>
      <legend align="center"><h2><i class="fa fa-pencil-square-o" aria-hidden="true"></i>EES超級後台-管理展覽</h2></legend>
	  <h4><p align="right"><a href="index.php"><i class="fa fa-home" aria-hidden="true">回到主頁面</i></a></p></h4>
	   
	   
    <div name="mb_body" >       
	
	  
	  <?php
		for($i=0;$i<mysql_num_rows($exhibition_data);$i++)
		{
			$rs=mysql_fetch_assoc($exhibition_data);
			echo "<script>console.log( 'Debug Objects: " . $i . "' );</script>";

		    echo'<table class="table table-striped">
				<div>
				<thead class = "col-lg-12">
					<legend>展覽ID：';echo $rs['exhibitionId'];echo'</legend>
				</thead>
				<tbody >
				<div class="col-md-6">
				<span>

				<form action="exhibition_finish.php" method="post">
				<fieldset id="field_';echo $rs['exhibitionId'] ;echo'" disabled>
					  
						<div class="form-group">
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
										<input class="form-control input" id="startDate" name="startDate" placeholder="展覽開始日期" type="date" required="required" value="';echo ($rs['startDate']);echo'">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">
								<div class="col-lg-12">
										<label for="title">展覽結束日期</label>
										<input class="form-control input" id="endDate" name="endDate" placeholder="展覽結束日期" type="text" required="required" value="';echo ($rs['endDate']);echo'">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">								
									<div class="col-lg-12">
										<label for="title">展覽地點：</label>
										<input class="form-control input" id="location" name="location" placeholder="展覽地點" type="text" required="required" value="';echo ($rs['location']);echo'">
									</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">								
									<div class="col-lg-12">
										<label for="title">展覽描述</label>
										<input class="form-control input" id="description" name="description" placeholder="展覽描述" type="text" required="required" value="';echo ($rs['description']);echo'">
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
						
						
					</fieldset>
					
					<div class="form-group">
						<div class="rows">
								<div class="col-lg-12">
									<button class="btn btn-success btn disabled" id="button_success_';echo $rs['exhibitionId'];echo'" type="submit">修改展覽</button>
									<button class="btn btn-info btn active" onclick="Function_field_';echo $rs['exhibitionId'];echo'();return false;">開啟/關閉資料保護功能</button>
									<button class="btn btn-danger btn disabled" id="button_danger_';echo $rs['exhibitionId'];echo'" onclick="Function_delete_';echo $rs['exhibitionId'];echo'();">刪除展覽</button>
								</div>
						</div>
					</div>

				</form>
				</span>
				</div>
				';
				
				$booth_data = mysql_query("SELECT * FROM `booth` WHERE exhibitionId='$rs[exhibitionId]'");
				
				for($j=0;$j<mysql_num_rows($booth_data);$j++)
				{	
					if($j>=1&& $j%2==1)
					{
						echo'<table class="table table-striped"></table>';
					}
					$pd=mysql_fetch_assoc($booth_data);
					if($pd['boothId'] != NULL){		
					echo '
					<div class="col-md-6 pull-right" >
					<span>

				<form action="booth_finish.php" method="post">
				<fieldset id="booth_field_';echo $pd['boothId'] ;echo'" disabled>
					  
						<div class="form-group">
							<div class="rows">
								<div class="col-lg-12">
										<label for="title">攤位名稱:</label>
										<input class="form-control input" id="displayName" name="displayName" placeholder="請輸入主題" type="text" required="required" value="';echo ($pd['displayName']);echo'">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">
								<div class="col-lg-12">
										<label for="title">攤位位置：</label>
										<input class="form-control input" id="boothPosition" name="boothPosition" placeholder="攤位位置" type="text" required="required" value="';echo ($pd['boothPosition']);echo'">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">
								<div class="col-lg-12">
										<label for="title">攤位描述：</label>
										<input class="form-control input" id="description" name="description" placeholder="攤位描述" type="text" required="required" value="';echo ($pd['description']);echo'">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">								
									<div class="col-lg-12">
										<label for="title">攤位所屬展覽ID：</label>
										<input class="form-control input" id="exhibitionId" name="exhibitionId" placeholder="所屬展覽ID" type="text" required="required" value="';echo ($pd['exhibitionId']);echo'">
									</div>
							</div>
						</div>

						
						<div class="form-group">
							<div class="rows">
									<div class="col-lg-12">
										<input class="form-control input" id="booth_delete_';echo $pd['boothId'];echo'" name="summit_type" type="hidden" value="0">
									</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">
									<div class="col-lg-12">
										<input class="form-control input" id="boothId" name="boothId" type="hidden" value="';echo $pd['boothId'];echo'">
									</div>
							</div>
						</div>
							
						
					</fieldset>
						
						<div class="form-group">
						<div class="rows">
								<div class="col-lg-12">
									<button class="btn btn-success btn disabled" id="booth_button_success_';echo $pd['boothId'];echo'" type="submit">修改攤位</button>
									<button class="btn btn-info btn active" onclick="Function_booth_field_';echo $pd['boothId'];echo'();return false;">開啟/關閉資料保護功能</button>
									<button class="btn btn-danger btn disabled" id="booth_button_danger_';echo $pd['boothId'];echo'" onclick="Function_delete_';echo $pd['boothId'];echo'();">刪除攤位</button>
									
							</div>
						</div>
					</div>

					</form>
					</span>
					</div>
					
					</tbody>
					
					
						<script>
						function Function_booth_field_';echo $pd['boothId'];echo'() {
							if(document.getElementById("booth_field_';echo $pd['boothId'] ;echo'").disabled == false){
								document.getElementById("booth_field_';echo $pd['boothId'] ;echo'").disabled = true;
								$("#booth_button_success_';echo $pd['boothId'];echo'").addClass("disabled");
								$("#booth_button_danger_';echo $pd['boothId'];echo'").addClass("disabled");
							}
							else{
								document.getElementById("booth_field_';echo $pd['boothId'] ;echo'").disabled = false;
								$("#booth_button_success_';echo $pd['boothId'];echo'").removeClass("disabled");
								$("#booth_button_danger_';echo $pd['boothId'];echo'").removeClass("disabled");
							}	
						}
						
						function Function_booth_delete_';echo $pd['boothId'];echo'() {
								document.getElementById("product_delete_';echo $pd['boothId'] ;echo'").value = "1";
						}
						
						</script>
			   </div> </table>';
					}
				}
				
				
				echo'<script>function Function_field_';echo $rs['exhibitionId'];echo'() {
							if(document.getElementById("field_';echo $rs['exhibitionId'] ;echo'").disabled == false){
								document.getElementById("field_';echo $rs['exhibitionId'] ;echo'").disabled = true;
								$("#button_success_';echo $rs['exhibitionId'];echo'").addClass("disabled");
								$("#button_danger_';echo $rs['exhibitionId'];echo'").addClass("disabled");
							}
							else{
								document.getElementById("field_';echo $rs['exhibitionId'] ;echo'").disabled = false;
								$("#button_success_';echo $rs['exhibitionId'];echo'").removeClass("disabled");
								$("#button_danger_';echo $rs['exhibitionId'];echo'").removeClass("disabled");
							}	
						}
						
						function Function_delete_';echo $rs['exhibitionId'];echo'() {
								document.getElementById("delete_';echo $rs['exhibitionId'] ;echo'").value = "1";
						}</script>';
						
	  }?>
	 
	</div>
	<hr>
	<div name="exhibition_add" class="col-lg-12">
	<form action="exhibition_finish.php" class="form-horizontal" method="post">
      <legend>新增展覽</legend>
        <div class="form-group">
            <div class="rows">
                <div class="col-md-8">
                    <div class="col-lg-12">
						<label for="title">展覽名稱:</label>
                        <input class="form-control input-lg" id="displayName" name="displayName" placeholder="請輸入主題" type="text" required="required">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="rows">
                <div class="col-md-8">
                    <div class="col-lg-12">
						<label for="title">展覽開始日期</label>
                        <input class="form-control input-lg" id="startDate" name="startDate" placeholder="startDate" type="date" required="required">
                    </div>
                </div>
            </div>
        </div>
		        <div class="form-group">
            <div class="rows">
                <div class="col-md-8">
                    <div class="col-lg-12">
						<label for="title">展覽結束日期</label>
                        <input class="form-control input-lg" id="endDate" name="endDate" placeholder="endDate" type="date" required="required">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="rows">
                <div class="col-md-8">
                    <div class="col-lg-12">
						<label for="title">展覽地點</label>
                        <input class="form-control input-lg" id="location" name="location" placeholder="展覽地點" type="text" required="required">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="rows">
                <div class="col-md-8">
                    <div class="col-lg-12">
						<label for="comment">展覽描述:</label>
						<textarea class="form-control input-lg" rows="5" id="description" name="description" placeholder="展覽描述" required="required" ></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="rows">
                <div class="col-md-8">
                    <div class="col-lg-12">
						<label for="title">展覽URL</label>
                        <input class="form-control input-lg" id="URL" name="URL" placeholder="URL" type="text">
                    </div>
                </div>
            </div>
        </div>
		
		<div class="form-group">
			<div class="rows">
				<div class="col-md-8">
					<div class="col-lg-12">
						<input class="form-control input" id="exhibitionId" name="exhibitionId" type="hidden" value="<?echo ($rs['exhibitionId']); ?>">
					</div>
				</div>
			</div>
		</div>
						
		<div class="form-group">
			<div class="rows">
				<div class="col-md-8">
					<div class="col-lg-12">
						<input class="form-control input" id="delete" name="summit_type" type="hidden" value="2">
					</div>
				</div>
			</div>
		</div>
						
        <div class="form-group">
            <div class="rows">
                <div class="col-md-8">
                    <div class="col-lg-12">
                        <button class="btn btn-success btn-lg" type="submit">新增展覽</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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