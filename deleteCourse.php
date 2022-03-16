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
    <title>DVCSS</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    
    <?php require_once 'database.php'; ?>

    <?php 
        if (isset($_SESSION['message'])):
    ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
    </div>

    <?php endif ?>

    <div class="content">
    <?php 
        $mysqli = new mysqli('localhost', 'root', '', 'dvcss') or die(mysqli_error($mysql));
        $result = $mysqli -> query("SELECT * FROM course") or die($mysqli -> error);
    ?>

    <div class="row justify-conyent-center">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Name</th>
                    <th>Year</th>

                </tr>
            </thead>

            <?php while ($row = $result -> fetch_assoc()): ?>

                <tr>
                    <td> <?php echo $row['crsNo'] ?> </td>
                    <td> <?php echo $row['crsName'] ?> </td>
                    <td> <?php echo $row['semester'] ?> </td>
                    <td>
                    <a href="database.php?delete=<?php echo $row['crsNo']; ?>" 
                    class="btn btn-danger">Delete</a>
                    </td>

                </tr>
                
            <?php endwhile; ?>

        </table>

    </div>

    <?php
        function pre_r($array) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>

    <br>

    <a href="courseList.php" class="btn btn-primary btn-lg" role="button" style="margin-left: 40%; ">Home</a>

</div>

</body>
<style>
    div.content {
        position: absolute;
        margin: 0;
		left: 20%;
        top: 6%;
		padding: 0;
		height: 90%;
		border-radius: 30px;
		width: 75%;
		background-color: white;
	}

     .table {
        table-layout: auto;
        width: 70%;
        left: 50%;
        font-size: 20px;
        margin-left: 15%;
        margin-top: 7%;
        
    }

</style>
</html>