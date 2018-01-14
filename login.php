<!-- 設定網頁編碼為UTF-8 -->

<?php session_start(); ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>電子展冊系統-後台</title>

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


                </ul>
				<ul class="nav navbar-nav navbar-right">
					<li><p class="navbar-text">電子展冊系統-超級後台</p></li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
						<ul id="login-dp" class="dropdown-menu">
							<li>
								 <div class="row">
										<div class="col-md-12">
											
											 <form class="form" role="form" method="post" action="connect.php" accept-charset="UTF-8" id="login-nav">
													<div class="form-group">
														 <label class="sr-only" for="exampleInputEmail2">Email address</label>
														 <input type="email" class="form-control" name="email" id="exampleInputEmail2" placeholder="Email" required>
													</div>
													<div class="form-group">
														 <label class="sr-only" for="exampleInputPassword2">Password</label>
														 <input type="password" class="form-control" name="pw" id="exampleInputPassword2" placeholder="Password" required>
														 
													</div>
													<div class="form-group">
														 <button type="submit" class="btn btn-primary btn-block">Sign in</button>
													</div>
													<!--<div class="checkbox">
														 <label>
														 <input type="checkbox"> 保持登入
														 </label>
													</div>-->
											 </form>
										</div>
										<div class="bottom text-center">
											還沒有帳號嗎 ? <a href="#"><b>請聯絡管理員</b></a>
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
