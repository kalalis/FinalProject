<?php 
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['teacher_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DVCSS</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <?php include 'tabbar.php' ?>

    <br>
    <h3 style="margin-left: 400px">ผลการประเมิน</h3>
    <div class="content">
        
    </div>
    
</body>

<style>
    div.content {
		margin-left: 400px;
		margin-right: 50px;		
		padding-right: 0;
		height: 900px;
		border-radius: 30px;
		width: 1200px;
		background-color: white;
	}
</style>
</html>