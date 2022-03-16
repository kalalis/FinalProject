<?php 
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['teacher_login']) ) {
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
    <h3 style="margin-left: 400px">เกณฑ์การประเมินผล</h3>

    <div class="content">

        <a href="courseList.php" role="button" class="home-btn"><img src="img/home.png"></a>

     <br>
        <div class="container">
            
                <button class="critInsert " data-bs-toggle="modal" data-bs-target="#fileModal">
                    <img src="img/critInsert.png"><br>เพิ่มไฟล์</button>
                <a href="critTemplate.php"><button class="critTemplate">
                    <img src="img/critTemplate.png"><br>เทมเพลต</button></a>
        
        </div>
        <br>
        <a href="crit.php" role="button" class="btn btn-primary" style="margin-left: 550px;">ยกเลิก</a>

        <form action="" method="POST" enctype="multipart/form-data">
        
                <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
              
                            <div class="modal-header" >
                                <h5 class="modal-title" id="exampleModalLabel">เอกสาร เกณฑ์การประเมินผล</h5>
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
    $path="docs/";
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

    .home-btn img {
        width: 40px; 
        margin-top: 10px;
        margin-left: 85%;
        
    }

    .container{
        border-style: dashed;
        border-width: 10px;
        border-color: #AF4CEC;
        border-radius: 10px;
        margin-left: 200px;
        width: 800px;
        height: 300px;
    }

    .critInsert {
        margin-left: 120px;
        margin-top: 50px;
        margin-bottom: 20px;
        border: 5px solid #B56DE1;
        border-radius: 10px;
        background-color: white;
        padding: 10px;
    }

    .critInsert img {
        width: 170px;
        height: 150px;
        
    }
    .critTemplate {
        margin-left: 120px;
        margin-top: 50px;
        margin-bottom: 20px;
        border: 5px solid #B56DE1;
        border-radius: 10px;
        background-color: white;
        padding: 10px;
    }

    .critTemplate img {
        width: 170px;
        height: 150px;
        
    }

    

</style>

</html>

