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
									
									$product_data = mysql_query("SELECT * FROM `product` WHERE holderId='$accountId'");
									$product = mysql_fetch_array($account);

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
	<title>EES超級後台-管理我的攤位</title>
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
<div >
      <legend align="center"><h2><i class="fa fa-pencil-square-o" aria-hidden="true"></i>EES超級後台-管理攤位</h2></legend>
	  <h4><p align="right"><a href="index.php"><i class="fa fa-home" aria-hidden="true">回到主頁面</i></a></p></h4>
	   
    <div name="mb_body" >       
	
	  
	  <?php
		for($i=0;$i<mysql_num_rows($booth_data);$i++)
		{
			$rs=mysql_fetch_assoc($booth_data);
			echo "<script>console.log( 'Debug Objects: " . $i . "' );</script>";

		    echo'<table class="table table-striped">
				<div>
				<thead class = "col-lg-12">
					<legend>攤位ID：';echo $rs['boothId'];echo'</legend>
				</thead>
				<tbody >
				<div class="col-md-6">
				<span>

				<form action="booth_finish.php" method="post">
				<fieldset id="field_';echo $rs['boothId'] ;echo'" disabled>
					  
						<div class="form-group">
							<div class="rows">
								<div class="col-lg-12">
										<label for="title">攤位名稱:</label>
										<input class="form-control input" id="displayName" name="displayName" placeholder="請輸入主題" type="text" required="required" value="';echo ($rs['displayName']);echo'">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">
								<div class="col-lg-12">
										<label for="title">攤位位置：</label>
										<input class="form-control input" id="boothPosition" name="boothPosition" placeholder="攤位位置" type="text" required="required" value="';echo ($rs['boothPosition']);echo'">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">
								<div class="col-lg-12">
										<label for="title">攤位描述：</label>
										<input class="form-control input" id="description" name="description" placeholder="攤位描述" type="text" required="required" value="';echo ($rs['description']);echo'">
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">								
									<div class="col-lg-12">
										<label for="title">攤位所屬展覽ID(無法變更)：</label>
										<input class="form-control input" id="exhibitionId" name="exhibitionId" placeholder="所屬展覽ID" type="text" required="required" value="';echo ($rs['exhibitionId']);echo'" disabled>
									</div>
							</div>
						</div>

						
						<div class="form-group">
							<div class="rows">
									<div class="col-lg-12">
										<input class="form-control input" id="delete_';echo $rs['boothId'];echo'" name="summit_type" type="hidden" value="0">
									</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="rows">
									<div class="col-lg-12">
										<input class="form-control input" id="boothId" name="boothId" type="hidden" value="';echo $rs['boothId'];echo'">
									</div>
							</div>
						</div>
							
						
					</fieldset>
					
					<div class="form-group">
						<div class="rows">
								<div class="col-lg-12">
									<button class="btn btn-success btn disabled" id="button_success_';echo $rs['boothId'];echo'" type="submit">修改攤位</button>
									<button class="btn btn-info btn active" onclick="Function_field_';echo $rs['boothId'];echo'();return false;">開啟/關閉資料保護功能</button>
									
							</div>
						</div>
					</div>

				</form>
				</span>
				</div>
				';
				$product_data = mysql_query("SELECT * FROM `product` WHERE boothId='$rs[boothId]'");
				for($j=0;$j<mysql_num_rows($product_data);$j++)
				{	
					
					$pd=mysql_fetch_assoc($product_data);
					if($pd['productId'] != NULL){		
					echo '
					<div class="col-md-6 pull-right" >
					<span>				
					<form action="booth_product.php" method="post">
					<fieldset id="product_field_';echo $pd['productId'] ;echo'" disabled>
							<div class="form-group">
								<div class="rows">
									<div class="col-lg-12">
											<label for="title">商品名稱:</label>
											<input class="form-control input" id="productName" name="productName" placeholder="商品名稱" type="text" required="required" value="';echo ($pd['productName']);echo'">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="rows">
									<div class="col-lg-12">
											<label for="title">商品描述</label>
											<input class="form-control input" id="description" name="description" placeholder="商品描述" type="text" required="required" value="';echo ($pd['description']);echo'">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="rows">								
										<div class="col-lg-12">
											<label for="title">商品價格：</label>
											<input class="form-control input" id="price" name="price" placeholder="商品價格" type="text" required="required" value="';echo ($pd['price']);echo'">
										</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="rows">								
										<div class="col-lg-12">
											<input class="form-control input" id="productId" name="productId"  type="hidden" required="required" value="';echo ($pd['productId']);echo'">
										</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="rows">								
										<div class="col-lg-12">
											<input class="form-control input" id="holderId" name="holderId" type="hidden" required="required" value="';echo$accountId;echo'">
										</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="rows">
										<div class="col-lg-12">
											<input class="form-control input" id="product_delete_';echo $pd['productId'];echo'" name="summit_type" type="hidden" value="0">
										</div>
								</div>
							</div>
								
							<div></div>
						</fieldset>
						
						<div class="form-group">
							<div class="rows">
									<div class="col-lg-12">
										<button class="btn btn-success btn disabled" id="product_button_success_';echo $pd['productId'];echo'" type="submit">修改商品</button>
										<button class="btn btn-info btn active" onclick="Function_product_field_';echo $pd['productId'];echo'();return false;">開啟/關閉資料保護功能</button>
										<button class="btn btn-danger btn disabled" id="product_button_danger_';echo $pd['productId'];echo'" onclick="Function_product_delete_';echo $pd['productId'];echo'();">刪除商品</button>
									
								</div>
							</div>
						</div>

					</form>
					</span>
					</div>
					
					</tbody>
					
					
						<script>
						function Function_product_field_';echo $pd['productId'];echo'() {
							if(document.getElementById("product_field_';echo $pd['productId'] ;echo'").disabled == false){
								document.getElementById("product_field_';echo $pd['productId'] ;echo'").disabled = true;
								$("#product_button_success_';echo $pd['productId'];echo'").addClass("disabled");
								$("#product_button_danger_';echo $pd['productId'];echo'").addClass("disabled");
							}
							else{
								document.getElementById("product_field_';echo $pd['productId'] ;echo'").disabled = false;
								$("#product_button_success_';echo $pd['productId'];echo'").removeClass("disabled");
								$("#product_button_danger_';echo $pd['productId'];echo'").removeClass("disabled");
							}	
						}
						
						function Function_product_delete_';echo $pd['productId'];echo'() {
								document.getElementById("product_delete_';echo $pd['productId'] ;echo'").value = "1";
						}
						
						</script>
			   </div> </table>';
					}
				}
				
				
				echo'<script>function Function_field_';echo $rs['boothId'];echo'() {
							if(document.getElementById("field_';echo $rs['boothId'] ;echo'").disabled == false){
								document.getElementById("field_';echo $rs['boothId'] ;echo'").disabled = true;
								$("#button_success_';echo $rs['boothId'];echo'").addClass("disabled");
								$("#button_danger_';echo $rs['boothId'];echo'").addClass("disabled");
							}
							else{
								document.getElementById("field_';echo $rs['boothId'] ;echo'").disabled = false;
								$("#button_success_';echo $rs['boothId'];echo'").removeClass("disabled");
								$("#button_danger_';echo $rs['boothId'];echo'").removeClass("disabled");
							}	
						}
						
						function Function_delete_';echo $rs['boothId'];echo'() {
								document.getElementById("delete_';echo $rs['boothId'] ;echo'").value = "1";
						}</script>';
						
	  }?>
	 
	</div>
	
	
	<div name="product_add" class="col-lg-12">
	
	<form action="booth_product.php"  class="form-horizontal"  method="post">
      
		<div class="form-group">
		<legend>新增商品</legend>
			<div class="rows">
				<div class="col-md-8">
                    <div class="col-lg-12">
						<label for="title">商品所屬攤位:</label>
						  <select class="form-control input-lg" id="boothId" name="boothId">
						  <?php
						  $booth_data = mysql_query("SELECT * FROM `booth` WHERE holderId='$accountId'");
						  for($i=0;$i<mysql_num_rows($booth_data);$i++)
								{
								$rs=mysql_fetch_assoc($booth_data);								
									echo'<option>';echo $rs['boothId'];echo'</option>';
								}
						  ?>
						  </select>
					</div>
                </div>
            </div>
        </div>
		
        <div class="form-group">
            <div class="rows">
                <div class="col-md-8">
                    <div class="col-lg-12">
						<label for="title">商品名稱:</label>
                        <input class="form-control input-lg" id="productName" name="productName" placeholder="請輸入商品名稱" type="text" required="required">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="rows">
                <div class="col-md-8">
                    <div class="col-lg-12">
						<label for="title">商品描述</label>
                        <input class="form-control input-lg" id="description"  name="description" placeholder="商品描述" type="text" required="required">
                    </div>
                </div>
            </div>
        </div>
		
        <div class="form-group">
            <div class="rows">
                <div class="col-md-8">
                    <div class="col-lg-12">
						<label for="title">商品價格</label>
                        <input class="form-control input-lg" id="price" name="price" placeholder="商品價格" type="text" required="required">
                    </div>
                </div>
            </div>
        </div>
		
		 <div class="form-group">
			<div class="rows">
				<div class="col-md-8">
					<div class="col-lg-12">
						<input class="form-control input" id="holderId" name="holderId" type="hidden" value="<?php echo $rs['accountId']?>">
					</div>
				</div>
			</div>
		</div>
		
       <div class="form-group">
			<div class="rows">
				<div class="col-md-8">
					<div class="col-lg-12">
						<input class="form-control input" id="delete_" name="summit_type" type="hidden" value="2">
					</div>
				</div>
			</div>
		</div>
							
        <div class="form-group">
            <div class="rows">
                <div class="col-md-8">
                    <div class="col-lg-12">
                        <button class="btn btn-success btn-lg" type="submit">新增商品</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
	
	<legend>
		<p align="right" class="col-lg-12">
			<a class="page-scroll" href="#page-top"><i class="fa fa-arrow-up" aria-hidden="true"></i> 回到最上面</i></a>
			<a href="index.php"><i class="fa fa-home" aria-hidden="true"> 回到主頁面</i></a>
		</p>
	</legend>
	</div>
	
</div>
</div><!-- /container -->
</body>
</html>