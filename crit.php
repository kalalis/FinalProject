<?php 
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['teacher_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }
    
    // $check_role = $conn -> prepare("SELECT * FROM teacher WHERE urole = :urole");
    // $check_role -> bindParam(":urole", $urole);
    // $check_role -> execute();
    // $row = $check_role -> fetch(PDO::FETCH_ASSOC);

    //     if ($urole == $row['urole']) {
    //         if ($row['urole'] == 'admin') {
    //             $_SESSION['warning'] = "ขออภัย คุณไม่มีสิทธิ์เข้าถึงหน้านี้";
    //             header('location: courseList.php');
    //         }
    //     }
        
    
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
    <h3 style="margin-left: 400px">เกณฑ์การประเมินผล</h3>

    <div class="content">

        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="img/set.png" alt="setting" style="width: 40px;"></button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <!-- <li><a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#fileModal">ADD</a></li>  -->
                <li><a class="dropdown-item" href="critAdd.php">ADD</a></li>
                <li><a class="dropdown-item " href="critPDF.php">REPORT</a></li>
                <li><a class="dropdown-item" href="critDelete.php">DELETE</a></li>
            </ul>

            <a class="back-btn" href="courseList.php" role="button"><img src="img/home.png"></a>
        </div>

            <div class="col-md-10">
        <h3 style="margin-left: 20px;">รายการเอกสาร </h3> <br>
            <table class="table table-striped  table-hover table-responsive table-bordered">
                <tbody>
                    <?php
                        //คิวรี่ข้อมูลมาแสดง
                        require_once 'config/db.php';
                     
                        $stmt = $conn->prepare("SELECT * FROM crit ");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $row) {
                    ?>
                    <tr>
                        <div class="file-query">
                            <li><a href="docs/crit/<?php echo $row['doc_file'];?>" target="_blank" 
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
    $path="docs/crit/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = 'doc_'.$numrand.$date1.$typefile;
    $path_copy=$path.$newname;
    //คัดลอกไฟล์ไปยังโฟลเดอร์
    move_uploaded_file($_FILES['doc_file']['tmp_name'],$path_copy); 

     //ประกาศตัวแปรรับค่าจากฟอร์ม
    $doc_name = $_POST['doc_name'];
    $crs_no = $_POST['crs_no'];
    
    //sql insert
    $stmt = $conn->prepare("INSERT INTO crit (doc_name, doc_file, crs_no)
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
                    window.location = "crit.php"; //หน้าที่ต้องการให้กระโดดไป
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
                        window.location = "crit.php"; //หน้าที่ต้องการให้กระโดดไป
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
                        window.location = "crit.php"; //หน้าที่ต้องการให้กระโดดไป
                    });
                    }, 1000);
                </script>';
    }
   
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