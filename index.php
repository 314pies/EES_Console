<!-- 設定網頁編碼為UTF-8 -->

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
									
									$account = mysql_query("SELECT * FROM `exhibition` WHERE organizer_id='$accountId'");
									$exhibition = mysql_fetch_array($account);
									
									$account = mysql_query("SELECT * FROM `booth` WHERE holderId='$accountId'");
									$booth = mysql_fetch_array($account);

							}
							else
							{
									echo '您無權限觀看此頁面!';
									header("Location: login.php");
							}
						?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>電子展冊系統</title>

	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Font awesome icon -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/signin.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>

	
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script src="js/jquery-ui.min.js"></script>

	
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">網程專案</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Electronic Exhibition System</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a target="_blank" href="exhibition.php">管理展覽</a>
                    </li>
					<li>
                        <a target="_blank" href="booth.php">管理攤位</a>
                    </li>
					<li>
                        <a target="_blank" href="account_list.php">顯示目前展覽列表</a>
                    </li>

                </ul>
				<ul class="nav navbar-nav navbar-right">
					<li><p class="navbar-text">Welcome to Electronic Exhibition System - 超級後台.</p></li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><span id="username"><?php echo $email ?></span></b> <span class="caret"></span></a>
						<ul id="login-dp" class="dropdown-menu">
							<li>
								 <div class="row">
										<div class="col-md-12">
											
											 
													<label>個人資訊</label>
													<div class="form-group">
														 
														 <?php echo"Email:  ".$user[1]."<br>";
															   echo"Name:  ".$user[3]."<br>";
															   echo"生日:  ".$user[4]."<br>";
															   if($user[5]==1)echo"性別:  男<br>";
															   else echo"性別:  女<br>"
														 ?>
													</div>
													
													
							
											<form class="form" role="form" method="post" action="logout.php" accept-charset="UTF-8" id="login-nav">
													<div class="form-group">
														 <button type="submit" class="btn btn-primary btn-block">Sign out</button>
													</div>

											 </form>
										</div>
										<div class="bottom text-center">
											Any question ? <a target="_blank" href="#"><b>Contact Us</b></a>
										</div>
								 </div>
							</li>
						</ul>
					</li>
				</ul>
            </div>

            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
			

	
    <script>


    </script>
</head>
	
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Intro Section -->
    <section id="intro" class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Wellcome</h1>

                </div>
            </div>
        </div>
    </section>

	
	<!-- Bottom Section -->
	<section id="bottom" class="bottom-section">
                   Electronic Exhibition System project 2018
	</section>
</body>
