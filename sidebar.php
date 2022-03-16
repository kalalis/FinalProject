<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
</head>

<body>

<div class="sidebar">
<img src="img/human.png" alt="" width="60" height="60" style="margin-left: 30%; margin-bottom: 10%; margin-top: 10%;">
	<h3 style="color: white">TEACHER NAME</h3> 
	<h5 style="color: white">teacher.name@cmu.ac.th</h5>
	<a class="dropdown-btn"><img src="img/book.png" alt="" width="40" height="40"> กระบวนวิชา
    <i class="fa fa-caret-down"></i>
  </a>
  <div class="dropdown-container">
    <a href="insertCourse.php"><img src="img/insert.png" alt="" width="30" height="30" id="insertCrs"> เพิ่มกระบวนวิชา</a>
    <a href="#"><img src="img/edit.png" alt="" width="30" height="30"> แก้ไขกระบวนวิชา</a>
    <a href="#"><img src="img/bin.png" alt="" width="30" height="30"> ลบกระบวนวิชา</a>
  </div>
  <a href="#"><img src="img/books.png" alt="" width="40" height="40"> ประเมินหลักสูตร</a>
  <a href="signin.php"><img src="img/login.png" alt="" width="40" height="40"> เข้าสู่ระบบ</a>
  
</div>

</body>

<style>
	
	body {
		margin: 0;
		font-family: 'Noto Sans Thai', sans-serif;
		background-color: #F4E7FD;
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
		font-size: 20px;
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