<?php 
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['teacher_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }
?>

<?php 

require_once "config/db.php";

if (isset($_POST['update'])) {
    $crsNo = $_POST['crsNo'];
    $crsName = $_POST['crsName'];
    $semester = $_POST['semester'];

    $sql = $conn->prepare("UPDATE course SET crsName = :crsName, semester = :semester WHERE crsNo = :crsNo");
    $sql->bindParam(":crsNo", $crsNo);
    $sql->bindParam(":crsName", $crsName);
    $sql->bindParam(":semester", $semester);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "Data has been updated successfully";
        header("location: editCourse.php");
    } else {
        $_SESSION['error'] = "Data has not been updated successfully";
        header("location: editCourse.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include 'navbar.php' ?>
          
        <div class="addCourse">
        <form class="row g-3" action="edit.php" method="POST">
            <?php
                    if (isset($_GET['crsNo'])) {
                            $crsNo = $_GET['crsNo'];
                            $stmt = $conn->query("SELECT * FROM course WHERE crsNo = $crsNo");
                            $stmt->execute();
                            $data = $stmt->fetch();
                    }
                ?>
            <h2 style="margin-top: 60px;">แก้ไขกระบวนวิชา</h2>
           <div class="form-element">
                <label for="crsNo" class="col-form-label">รหัสกระบวนวิชา :</label>
                <input type="text" readonly value="<?php echo $data['crsNo']; ?>" required class="form-control" name="crsNo" >
           </div> 
           <div class="form-element">
               <label for="crsName" class="form-label">ชื่อกระบวนวิชา :</label>
               <input type="text" value="<?php echo $data['crsName']; ?>" required class="form-control" name="crsName">
           </div>
           <div class="form-element">
               <label for="semester" class="form-label">ปีการศึกษา :</label>
               <input type="number" value="<?php echo $data['semester'] ?>" required class="form-control" name="semester" >
           </div>
           <br>
           <div class="form-element">
               <button type="submit" name="update" class="btn btn-success btn-lg" style="margin-left: 25%;">บันทึก</button>
               <a href="editCourse.php" role="button" class="btn btn-danger btn-lg">ยกเลิก</a>
               
           </div>
        </form>
        </div>
        
   
  

</body>


<style>
    	.addCourse {
        position: fixed;
        margin: 0;
		left: 20%;
        top: 6%;
		padding: 0;
		height: 90%;
		border-radius: 30px;
		width: 75%;
		background-color: white;

        position: absolute;   
        box-sizing: border-box;
	}

    /* .addCourse {
        margin: 0;
        padding: 0;
        
        position: absolute;   
        margin-top: 150px;
        box-sizing: border-box;
    } */

    .addCourse .form-label {
        text-align: left;
        font-size: 26px;
        margin: 20px;

    }

    .addCourse .form-element input[type="number"], 
    .addCourse .form-element input[type="text"] {
        
        position: absolute;
        font-size: 20px;
        width: 70%;
        
    }

    .addCourse h2 {
        text-align: center;
        
        
    }

    .addCourse .form-element {
       
        margin: 20px;
        right: 50px;
        margin-left: 15%;
    }

    .addCourse .btn {
        margin: 10px;
        
    }

    .alert {
        width: 50%;
        height: 30%;
        left: 30%;
        
    }

</style>

</html>