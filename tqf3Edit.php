<?php 
    session_start();
    require_once 'config/db.php';
    if ((!isset($_SESSION['teacher_login'])) || (!isset($_SESSION['admin_login'])) ) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }
?>
<?php 
    require_once 'config/db.php';

    if (isset($_POST['update'])) {
        $crs_no = $_POST['crs_no'];
        $doc_name = $_POST['doc_name'];
        $doc_file = $_POST['doc_file'];
    
        $sql = $conn->prepare("UPDATE tqf3 SET doc_name = :doc_name, doc_file = :doc_file WHERE crs_no = :crs_no");
        $sql->bindParam(":crs_no", $crs_no);
        $sql->bindParam(":doc_name", $doc_name);
        $sql->bindParam(":doc_file", $doc_file);
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

    <form action="tqf3Edit.php" method="POST" enctype="multipart/form-data">
            <?php 
                if (isset($_GET['crs_no'])) {
                    $crs_no = $_GET['crs_no'];
                    $stmt = $conn->query("SELECT * FROM tqf3 WHERE crs_no = $crs_no");
                    $stmt->execute();
                    $row = $stmt->fetch();
                }
            ?>         
                <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
              
                            <div class="modal-header" >
                                <h5 class="modal-title" id="exampleModalLabel">Update File TQF3</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                <div class="mb-3">
                                    <label class="col-form-label">File Name</label>
                                    <input type="text" value="<?php echo $row['doc_name']; ?>" required class="form-control" name="doc_name" >
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">File</label>
                                    <input type="file" class="form-control" value="<?php echo $row['doc_file']; ?>" required name="doc_file" ></input>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Course</label>
                                    <input type="number" readonly value="<?php echo $row['crs_no']; ?>" class="form-control" required name="crs_no" ></input>
                                </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="update">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                
            </form>


            <div class="col-md-10">
                <br>
        <h3 style="margin-left: 20px;">รายการเอกสาร </h3> <br>
            <table class="table table-striped  table-hover table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>กระบวนวิชา</th>
                        <th >ชื่อเอกสาร</th>
                        <th >เอกสาร</th>
                        <th >แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        //คิวรี่ข้อมูลมาแสดง
                        require_once 'config/db.php';
                        $crsNo = $_GET['crsNo'];
                        $stmt = $conn->prepare("SELECT * FROM tqf3 WHERE tqf3.crs_no=$crsNo");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $row) {
                    ?>
                    <tr>
                        <td><?= $row['crs_no']; ?></td>
                        <td><?= $row['doc_name'];?></td>
                        <td><a href="docs/tqf3/<?php echo $row['doc_file'];?>" target="_blank" class="btn btn-info btn-sm"> เปิดดู </a></td>
                        <td>
                            <a data-bs-toggle="modal" data-bs-target="#fileModal" class="btn btn-warning btn-sm">Update</a>
                        </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <br>
        <a class="btn btn-primary" href="tqf3.php" role="button" style="margin-left: 40%; margin-bottom: 20px;">Back</a>
        
    </div>
 
    </div>

    <script src="js/bootstrap.min.js"></script>   
</body>


</html>
<style>
    
    div.content {
		margin-left: 400px;
		margin-right: 50px;		
		padding-right: 0;
		height: auto;
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

    .table {
        margin-left: 20%;
        width: 70%;
    }



 
</style>
