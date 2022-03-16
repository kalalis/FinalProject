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
        $delete_no = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM tqf5 WHERE no = $delete_no");
        $deletestmt->execute();

        if ($deletestmt) {
            echo "<script>alert('Data has been deleted successfully');</script>";
            $_SESSION['success'] = "Data has been deleted succesfully";
            header("refresh:1; url=tqf5Delete.php");
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
    <h3 style="margin-left: 400px; ">มคอ.5</h3>

    <div class="content">

        <form action="" method="POST" enctype="multipart/form-data">
        
                <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
              
                            <div class="modal-header" >
                                <h5 class="modal-title" id="exampleModalLabel">Add File TQF5</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                <div class="mb-3">
                                    <label class="col-form-label">File Name</label>
                                    <input type="text" required class="form-control" name="doc_name" placeholder="ชื่อเอกสาร">
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">File</label>
                                    <input type="file" class="form-control" required name="doc_file" accept="application/pdf"></input>
                                </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
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
                        $stmt = $conn->prepare("SELECT * FROM tqf5 WHERE tqf5.crs_no=$crsNo");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $row) {
                    ?>
                    <tr>
                        <td><?= $row['doc_name'];?></td>
                        <td><a href="docs/tqf5/<?php echo $row['doc_file'];?>" target="_blank" class="btn btn-info btn-sm"> เปิดดู </a></td>
                        <td>
                            <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $row['no']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <br>
        <a class="btn btn-primary" href="tqf5.php?crsNo=<?php echo $crsNo ?>" role="button" style="margin-left: 40%;">Back</a>
        
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

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("btn dropdown-toggle");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}


</script>

</html>