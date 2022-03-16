
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
     <?php include 'navbar.php' ?>
    <?php 
        $mysqli = new mysqli('localhost', 'root', '', 'dvcss') or die(mysqli_error($mysql));
        $result = $mysqli -> query("SELECT * FROM course") or die($mysqli -> error);
     ?>
      <?php $row = $result -> fetch_assoc() ?>  

    <?php 
        
		if (isset($_SESSION['course_link'])) {
			$course_id = $_SESSION['course_link'];
            $crsNo = $_GET['crsNo'];
			$stmt = $conn->query("SELECT crsNo, crsName FROM course WHERE crsNo = $crsNo");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);}
	?>

    <div class="crsname">
        <?php echo $row['crsNo']." ".$row['crsName'] ?>
    </div> <br>
    <div class="tabbar">
        <div class="row"> 
            <div class="btn-tab">  
                <!-- ใช้ a และ role="button" -->
                
                <a href="tqf3.php?crsNo=<?php echo $row['crsNo']; ?>" role="button" class="btn">มคอ.3</a>
            
                <a href="tqf4.php?crsNo=<?php echo $row['crsNo']; ?>" role="button" class="btn">มคอ.4</a>

                <a href="tqf5.php?crsNo=<?php echo $row['crsNo']; ?>" role="button" class="btn">มคอ.5</a>
                
                <a href="tqf6.php?crsNo=<?php echo $row['crsNo']; ?>" role="button" class="btn">มคอ.6</a>
             
                <a href="crit.php?crsNo=<?php echo $row['crsNo']; ?>" class="btn" role="button">เกณฑ์การประเมิน</a>
                
                <a href="score.php" class="btn" role="button">คะแนนเก็บ</a>
                
                <a href="result.php?crsNo=<?php echo $row['crsNo']; ?>" class="btn" role="button">สรุปผล</a>
            </div>
        </div>
        
    </div>
</body>

<style>
@import url('https://fonts.googleapis.com/css2?family=Mitr:wght@400&display=swap');
</style>

<style>
    .crsname {
        padding: 5px 20px;
        margin-top: 20px;
        margin-left: 400px;
		margin-right: 50px;
        height: 50px;
        width: auto;
        background-color: white;
        border-radius: 10px;
        font-family: 'Mitr', sans-serif;
        font-size: 30px;
    }

    div.tabbar {
        margin-left: 400px;
        margin-right: 50px;
        height: 80px;
        width: 1200px;
        background-color: white;
        border-radius: 10px;

    }

     .btn-tab .btn {
        margin: 10px;
        margin-left: 50px;
        margin-top: 20px;
        padding-top: 5px;
        font-size: 20px;
        cursor: pointer;
        text-align: center;
        opacity: 1;
        transition: 0.3s;
        border-radius: 20px; 
        color: white;
        background-color:#AF4CEC;
    } 

    .btn-tab .btn:hover {
        /* opacity: 0.7;        */
        background-color: yellow;
        color: black;
    }

    

 

</style>
</html>