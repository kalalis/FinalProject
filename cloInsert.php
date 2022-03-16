<?php 
    session_start();
    require_once 'config/db.php';
    if ((!isset($_SESSION['teacher_login'])) || (!isset($_SESSION['admin_login'])) ) {
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
    
    
        
        <div class="addCLO">
            <form class="form-group row g-3" action="cloData.php" method="POST">
                <a href="courseList.php">Home</a>
                <h2 style="margin-top: 60px;">เพิ่มลายละเอียด CLO</h2>
            <div class="form-element">
                <label for="cloID" class="form-label">รหัส CLO :</label>
                <input type="number" class="form-control" id="inputcloID" name="cloID" >
            </div> 
            <div class="form-element">
                
            <label for="cloCrit" class="form-label">รายละเอียด CLO :</label>
                <textarea class="form-control" id="inputcloCrit" name="cloCrit" style="height: 300px;" ></textarea>
                <!-- <textarea class="form-control" id="inputcloCrit" style="height: 300px;" ></textarea> -->
            </div>
            <button type="submit" name="save" class="btn btn-primary btn-lg">บันทึก</button>
            </form>
                
            
        </div>
           
</body>

</html>


<style>
    	.addCLO {
        position: fixed;
        margin: 0;
		left: 5%;
        top: 6%;
		padding: 0;
		height: 90%;
		border-radius: 30px;
		width: 75%;
		background-color: white;
	}

    /* .addCourse {
        margin: 0;
        padding: 0;
        
        position: absolute;   
        margin-top: 150px;
        box-sizing: border-box;
    } */

    .addCLO .form-label {
        text-align: left;
        font-size: 26px;
        margin: 20px;

    }


    .addCLO h2 {
        text-align: center;
        
        
    }

    .addCLO .form-element {
       
        margin: 20px;
        right: 50px;
        margin-left: 15%;
    }

    .addCLO .btn {
        margin: 10px;
        
    }

    .alert {
        width: 50%;
        height: 30%;
        left: 30%;
        
    }

</style>


