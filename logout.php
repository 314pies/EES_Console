<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//將session清空
unset($_SESSION['email']);
header("Location: login.php"); //執行完後跳回(A)
?>