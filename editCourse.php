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
        $stdYear = $_POST['semester'];

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
    <title>DVCSS</title>
</head>
<body>
    <?php include 'navbar.php' ?>

    <div class="content">

    <div class="row justify-conyent-center">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Name</th>
                    <th>Semester</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            
                    $stmt = $conn->query("SELECT * FROM course ");
                    $stmt->execute();
                    $data = $stmt->fetchAll();

                    if (!$data) {
                        echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                    } else {
                    foreach($data as $row)  {  
                ?>
                    <tr>
                    <th scope="row"><?php echo $row['crsNo']; ?></th>
                        <td><?php echo $row['crsName']; ?></td>
                        <td><?php echo $row['semester']; ?></td>
                        <td>
                        <a href="edit.php?crsNo=<?php echo $row['crsNo']; ?>" class="btn btn-warning">Edit</a>
                        </td>
                    <?php } } ?>
                </tbody>

        </table>
    </div>

    <?php
        function pre_r($array) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>
    <form action="editCourse.php" method="POST" enctype="multipart/form-data">
    <?php
                        
                        if (isset($_GET['crsNO'])) {
                                $crsNO = $_GET['crsNo'];
                                $stmt = $conn->query("SELECT * FROM course WHERE crsNo = $crsNo");
                                $stmt->execute();
                                $data = $stmt->fetch();
                        }
                        ?>
        <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header" >
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['crsNo']." ".$row['crsName'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <form>
                            <div class="mb-3">
                                <label for="crsNo" class="form-label">รหัสกระบวนวิชา :</label>
                                <input type="number" readonly value="<?php echo $data['crsNo']; ?>" required class="form-control" name="crsNo" >
                                
                            </div>
                            <div class="mb-3">
                                <label for="crsName" class="form-label">ชื่อกระบวนวิชา :</label>
                                <input type="text" value="<?php echo $data['crsName']; ?>" required class="form-control" name="crsName" >
                            </div>
                            <div class="mb-3">
                                <label for="semester" class="form-label">ปีการศึกษา :</label>
                                <input type="number" value="<?php echo $data['semester']; ?>" required class="form-control" name="semester">
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <br>
    <a href="courseList.php" role="button" class="btn btn-primary btn-lg" style="margin-left: 40%;">Home</a>

</div>


<script src="js/bootstrap.min.js"></script> 
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
        margin-top: 5%;
        
    }
</style>
</html>