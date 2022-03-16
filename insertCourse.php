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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    
    <?php if(isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>
    
    
        
        <div class="addCourse">
        <form class="row g-3" action="insertData.php" method="POST">
            <h2 style="margin-top: 60px;">เพิ่มกระบวนวิชา</h2>
           <div class="form-element">
               <label for="crsNo" class="form-label">รหัสกระบวนวิชา :</label>
               <input type="number" class="form-control" id="inputCrsNo" name="crsNo" placeholder="โปรดระบุเป็นตัวเลข 6 หลัก">
           </div> 
           <div class="form-element">
               <label for="crsName" class="form-label">ชื่อกระบวนวิชา :</label>
               <input type="text" class="form-control" id="inputCrsName" name="crsName" placeholder="ชื่อกระบวนวิชา">
           </div>
           <div class="form-element">
               <label for="semester" class="form-label">ปีการศึกษา :</label>
               <input type="number" class="form-control" id="inputsemester" name="semester" placeholder="ex. 164">
           </div>
           <br>
           <div class="form-element">
               <button type="submit" name="save" class="btn btn-success btn-lg" style="margin-left: 25%;">บันทึก</button>
               <button type="reset" class="btn btn-danger btn-lg">ยกเลิก</button>
               <a href="courseList.php" role="button" class="btn btn-primary btn-lg">กลับ</a>
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