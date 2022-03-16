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
    <meta name="viewport" content="width=, initial-scale=1.0">
    <!-- sweet alert  -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>DVCSS</title>
</head>

<body>
    <?php include 'navbar.php' ?>
    <?php include 'tabbar.php' ?>

     <br>
    <h3 style="margin-left: 400px; ">มคอ.5</h3>

    <div class="content">

        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="img/set.png" alt="setting" style="width: 40px;"></button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#fileModal">ADD</a></li> 
                <li><a class="dropdown-item disabled" href="#">EDIT</a></li>
                <li><a class="dropdown-item" href="tqf5Delete.php?crsNo=<?php echo $row['crsNo']; ?>">DELETE</a></li>
            </ul>

            <a class="back-btn" href="courseList.php" role="button"><img src="img/home.png"></a>
            <a href="cloInsert.php">CLO</a>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
        
                <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
              
                            <div class="modal-header" >
                                <h5 class="modal-title" id="exampleModalLabel">เอกสาร มคอ.5</h5>
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
                                <div class="mb-3">
                                    <label class="col-form-label">Course</label>
                                    <input type="number" class="form-control" required name="crs_no" placeholder="รหัสกระบวนวิชา"></input>
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
        <h3 style="margin-left: 20px;">รายการเอกสาร </h3> <br>
            <table class="table table-striped  table-hover table-responsive table-bordered">
                <tbody>
                    <?php
                        //คิวรี่ข้อมูลมาแสดง
                        require_once 'config/db.php';
                        $crsNo = $_GET['crsNo'];
                        $stmt = $conn->prepare("SELECT * FROM tqf5 WHERE tqf5.crs_no=$crsNo");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $row) {
                    ?>
                    <tr>
                        <div class="file-query">
                            <li><a href="docs/tqf5/<?php echo $row['doc_file'];?>" target="_blank" 
                             style="margin-left: 20px"> <?= $row['doc_name'];?> </a></li>
                             <br>
                        </div>
                        
                    <?php } ?>
    
                </tbody>
                
            </table>
        </div>
        
    </div>

    <script src="js/bootstrap.min.js"></script>   
</body>

<?php

if (isset($_POST['doc_name'])) {
    require_once 'config/db.php';
     //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $doc_file = (isset($_POST['doc_file']) ? $_POST['doc_file'] : '');
    $upload=$_FILES['doc_file']['name'];

    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['doc_file']['name'],".");

    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
    if($typefile =='.pdf'){

    //โฟลเดอร์ที่เก็บไฟล์ **สร้างไฟล์ index.php หรือ index.html (ไม่ต้องมี code) ไว้ในโฟลเดอร์ด้วยนะครับจะได้ป้องกันการเข้าถึงทุกไฟล์ในโฟลเดอร์
    $path="docs/tqf5/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = 'doc_'.$numrand.$date1.$typefile;
    $path_copy=$path.$newname;
    //คัดลอกไฟล์ไปยังโฟลเดอร์
    move_uploaded_file($_FILES['doc_file']['tmp_name'],$path_copy); 

     //ประกาศตัวแปรรับค่าจากฟอร์ม
    $doc_name = $_POST['doc_name'];
    $crs_no = $_POST['crs_no'];
    
    //sql insert
    $stmt = $conn->prepare("INSERT INTO tqf5 (doc_name, doc_file, crs_no)
    VALUES (:doc_name, '$newname', :crs_no)");
    $stmt->bindParam(':doc_name', $doc_name);
    $stmt->bindParam(':crs_no', $crs_no );
    $result = $stmt->execute();
    $conn = null; //close connect db
    //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
            if($result){
                echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "อัพโหลดไฟล์เอกสารสำเร็จ",
                          type: "success"
                      }, function() {
                          window.location = "tqf5.php"; //หน้าที่ต้องการให้กระโดดไป
                          
                      });
                    }, 1000);
                </script>';
            }else{
               echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เกิดข้อผิดพลาด",
                          type: "error"
                      }, function() {
                          window.location = "tqf5.php"; //หน้าที่ต้องการให้กระโดดไป
                         
                      });
                    }, 1000);
                </script>';
            } //else ของ if result
        
        }else{ //ถ้าไฟล์ที่อัพโหลดไม่ตรงตามที่กำหนด
            echo '<script>
                         setTimeout(function() {
                          swal({
                              title: "คุณอัพโหลดไฟล์ไม่ถูกต้อง",
                              type: "error"
                          }, function() {
                              window.location = "tqf5.php"; //หน้าที่ต้องการให้กระโดดไป
                              
                          });
                        }, 1000);
                    </script>';
            
        } //else ของเช็คนามสกุลไฟล์
   
    } // if($upload !='') {

    } //isset
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Mitr:wght@400&display=swap');
</style>
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

    .back-btn img {
        width: 40px; 
        margin-top: 10px;
        margin-left: 10px;
        
    }

    
    .file-query {
        margin: 20px;
        font-family: 'Mitr', sans-serif;
        font-size: 30px;
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

