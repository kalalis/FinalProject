<?php 
    session_start();
    require_once 'config/db.php';
    if ((!isset($_SESSION['teacher_login'])) || (!isset($_SESSION['admin_login'])) ) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }
?>

<?php  
    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM score_excel WHERE id = $delete_id");
        $deletestmt->execute();

        if ($deletestmt) {
            echo "<script>alert('Data has been deleted successfully');</script>";
            $_SESSION['success'] = "Data has been deleted succesfully";
            header("refresh:1; url=scoreDelete.php");
        }
        
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
    <h3 style="margin-left: 400px; color: black; font-size: 30px;">คะแนนเก็บ</h3>
    
    <div class="content">

    </div>

    <script src="js/bootstrap.min.js"></script>  
</body>
</html>