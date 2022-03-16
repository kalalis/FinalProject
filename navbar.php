<?
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">

    <title>DVCSS</title>
    
    
</head>

<body>

<?php require_once 'config/db.php' ?>

<div class="grid-container">
<div class="sidebar">
	<img src="img/human.png" alt="" width="120" height="120" style="margin-left: 70px; margin-bottom: 10%; margin-top: 10%; background-color: none">
		
	<?php 
		require_once 'config/db.php';
		$row['teachID'] = $_SESSION['user'];
		$status = $row['teachID'];
		// if (isset($_SESSION['teacher_login'])) {
		// 	$teacher_id = $_SESSION['teacher_login'];
		// 	$stmt = $conn->query("SELECT teachName, teachSurname, teachEmail FROM teacher WHERE teachID = $row['teachID]");
		// 	$stmt->execute();
		// 	$row = $stmt->fetch(PDO::FETCH_ASSOC);
		// } else {
		// 	$admin_id = $_SESSION['admin_login'];
		// 	$stmt = $conn->query("SELECT teachName, teachSurname, teachEmail FROM teacher WHERE teachID = $admin_id");
		// 	$stmt->execute();
		// 	$row = $stmt->fetch(PDO::FETCH_ASSOC);
		// }
		$stmt = $conn -> prepare("SELECT teachName, teachSurname, teachEmail FROM teacher WHERE teachID = $status");
		$stmt -> execute();
		$result = $stmt -> fetchAll();
		foreach ($result as $user) {
	?>
	<h3 style="font-size: 24px; color: white; margin-left: 6%;"><?php echo $user['teachName'].' '.$user['teachSurname']  ?></h3> 
	<h5 style="font-size: 18px; color: white; margin-left: 15%;"><?php echo $user['teachEmail'] ?></h5>		
	<?php } ?>
	
	<a class="dropdown-btn" ><img src="img/book.png" alt="" width="40" height="40"> กระบวนวิชา <i class="fa fa-caret-down"></i></a>
	<div class="dropdown-container">
		<a href="insertCourse.php"><img src="img/insert.png" alt="" width="30" height="30" id="insertCrs"> เพิ่มกระบวนวิชา</a>
		<a href="editCourse.php"><img src="img/edit.png" alt="" width="30" height="30"> แก้ไขกระบวนวิชา</a>
		<a href="deleteCourse.php"><img src="img/bin.png" alt="" width="30" height="30"> ลบกระบวนวิชา</a>
	</div>
	<a href="#"><img src="img/books.png" alt="" width="40" height="40"> ประเมินหลักสูตร</a>
	<a href="logout.php"><img src="img/login.png" alt="" width="40" height="40"> ออกจากระบบ</a>
  
</div>

</div>

	
	<script src="js/bootstrap.min.js"></script>
</body>
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap');
</style>
<style>
	
	body {
		margin: 0;
		font-family: 'Noto Sans Thai', sans-serif;
		font-size: 20px;
		background-color: #F4E7FD;
		
	}

	.grid-container {
		display: grid;
		grid: 281px;
	}

	.sidebar {
		margin: 0;
		padding: 0;
		width: 280px;
		background-color: #AF4CEC;
		position: fixed;
		height: 100%;
		overflow: auto;
		border-radius: 0px 35px 35px 0px;
		
	}

	.sidebar a, .dropdown-btn {
		display: block;
		color: black;
		padding: 16px;
		text-decoration: none;
		width: auto;
		cursor: pointer;
				
	}
	
	.sidebar a:hover {
		background-color: #F4E7FD;
		color: black;
		
	}

	.sidenav a:hover, .dropdown-btn:hover {
  		color: black;
		
	}

	.active {
		background-color: #F4E7FD;
		color: black;
	}

	.fa-caret-down {
		float: right;
		padding-right: 8px;
	}


	.dropdown-container {
		display: none;
		background-color: #F4E7FD;
		padding-left: 8px;
		color: black;
	}

	.top-sidebar {
		background-color: white;
		margin: 0;
		padding: 0;
		width: 280px;
		height: 50%;
		position: fixed;
		overflow: auto;
		border-radius: 0px 35px 0px 0px;
	}


	@media screen and (max-width: 700px) {
	.sidebar {
		width: 100%;
		height: auto;
		position: relative;
	}
	.sidenav {padding-top: 15px;}
	.sidenav a {font-size: 18px;}
	.sidebar a {float: left;}
	div.content {margin-left: 0;}
	}

	@media screen and (max-width: 400px) {
	.sidebar a {
		text-align: center;
		float: none;
	}
	}
</style>
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;

	for (i = 0; i < dropdown.length; i++) {
		dropdown[i].addEventListener("click", function() {
		this.classList.toggle("active");

		var dropdownContent = this.nextElementSibling;
			if (dropdownContent.style.display === "block") {
				dropdownContent.style.display = "none";
			} else {
				dropdownContent.style.display = "block";
			}
		});
	}


</script>


</html>