<?php 
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['teacher_login']))  {
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <title>DVCSS</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <div class="content">
    <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>
    

    <div class="container-fluid">
    <div class="row justify-conyent-center">
        <table class="table">
            <?php
                require 'config/db.php';

                    $stmt = $conn -> prepare("SELECT course.crsNo, course.crsName FROM course WHERE course.teach_id = '100001' ");
                    $stmt -> execute();
                    $result = $stmt -> fetchAll();
                    foreach ($result as $row) {
            ?>
                <tr>

                    <td> <a href="tqf3.php?crsNo=<?php echo $row['crsNo'] ?>"> <?php echo $row['crsNo']." ".$row['crsName'] ?> <hr> </td>
                                    
                </tr>
            <?php }  ?>

        </table>
    </div>
    </div>

    <?php
        function pre_r($array) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>

</div>

<script src="js/bootstrap.min.js"></script>
</body>
<style>
@import url('https://fonts.googleapis.com/css2?family=Mitr:wght@400&display=swap');
</style>
<style>
    div.content {
        position: absolute;
        margin: 0;
		left: 20%;
        top: 6%;
		padding: 0;
		height: 90%;
		border-radius: 30px;
		width: 70%;
		background-color: white;
	}

     .row .table {     
        width: 75%;
        font-size: 40px;
        margin-left: 10%;
        margin-top: 5%;
    }

    td {
        border: none;
    }

    hr {
        border: 2px solid #AF4CEC;
    }

    a {
        text-decoration: none;
        font-family: 'Mitr', sans-serif;
        color: black;
    }




</style>
</html>