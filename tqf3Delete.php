<?php 
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['teacher_login']))  {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }
?>

<?php  
    if (isset($_GET['delete'])) {
        $delete_no = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM tqf3 WHERE no = $delete_no");
        $deletestmt->execute();

        if ($deletestmt) {
            echo "<script>alert('Data has been deleted successfully');</script>";
            $_SESSION['success'] = "Data has been deleted succesfully";
            header("refresh:1; url=tqf3Delete.php");
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- sweet alert  -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <title>DVCSS</title>
</head>

<body>
    <?php include 'navbar.php' ?>
    <?php include 'tabbar.php' ?>

     <br>
    <h3 style="margin-left: 400px">มคอ.3</h3>

    <div class="content">

            <div class="col-md-10">
                <br>
        <h3 style="margin-left: 20px;">รายการเอกสาร </h3> <br>
            <table class="table table-striped  table-hover table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>กระบวนวิชา</th>
                        <th >ชื่อเอกสาร</th>
                        <th >เปิดดู</th>
                        <th >แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //คิวรี่ข้อมูลมาแสดงในตาราง
                        require_once 'config/db.php';
                        $crsNo = $_GET['crsNo'];
                        $stmt = $conn->prepare("SELECT * FROM tqf3 WHERE tqf3.crs_no=$crsNo");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $row) {
                    ?>
                    <tr>
                        <td><?= $row['crs_no'];?></td>
                        <td><?= $row['doc_name'];?></td>
                        <td><a href="docs/tqf3/<?php echo $row['doc_file'];?>" target="_blank" class="btn btn-info btn-sm"> เปิดดู </a></td>
                        <td>
                            <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $row['no']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <br>
        <a class="btn btn-primary" href="tqf3.php?crsNo=<?php echo $crsNo ?>" role="button" style="margin-left: 40%;">Back</a>
        
    </div>
 
    </div>

    <script src="js/bootstrap.min.js"></script>   
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

    .dropdown-toggle {
        margin: 0;
        padding: 0;
        margin-top: 10px;
        background-color: white;
        border-radius: 15px;
        margin-left: 80%;
    }

    .dropdown-menu {
        margin-left: 80%;
        border-left: 5px solid #AF4CEC;
        border-right: 5px solid #AF4CEC;
        border-bottom: 5px solid #AF4CEC;
        border-radius: 0 0 15px 15px;
    }

    .back-btn img {
        width: 40px; 
        margin-top: 10px;
        margin-left: 10px;
        
    }

    .table {
        margin-left: 20%;
        width: 70%;
    }



 
</style>


</html>