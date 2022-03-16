<?php 

    session_start();
    require_once "config/connect-db.php";

    require_once "css.php";

    if (isset($_GET['delete'])) {
        $delete_no = $_GET['delete'];
        $deletestmt = $conn->query("DELETE FROM tqf3 WHERE no = $delete_no");
        $deletestmt->execute();

        if ($deletestmt) {
            echo "<script>alert('Data has been deleted successfully');</script>";
            $_SESSION['success'] = "Data has been deleted succesfully";
            header("refresh:1; url=tqf3.php");
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TQF 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- sweet alert  -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<body>
    

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>ADD FILES</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fileModal">Add</button>
                <a href="../tqf3.php" >Back</a>
            </div>
                    
            <form action="" method="POST" enctype="multipart/form-data">
        
                <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
              
                            <div class="modal-header" >
                                <h5 class="modal-title" id="exampleModalLabel">Add File TQF3</h5>
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

        </div>
        <hr>
        <div class="col-md-10">
        <h3>รายการเอกสาร </h3>
            <table class="table table-striped  table-hover table-responsive table-bordered">
                <thead>
                    <tr>
                        <th width="5%">ลำดับ</th>
                        <th width="65%">ชื่อเอกสาร</th>
                        <th width="10%">เปิดดู</th>
                        <th width="20%">แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //คิวรี่ข้อมูลมาแสดงในตาราง
                        require_once 'config/connect-db.php';
                        $stmt = $conn->prepare("SELECT * FROM tqf3");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $row) {
                    ?>
                    <tr>
                        <td><?= $row['no'];?></td>
                        <td><?= $row['doc_name'];?></td>
                        <td><a href="docs/<?php echo $row['doc_file'];?>" target="_blank" class="btn btn-info btn-sm"> เปิดดู </a></td>
                        <td>
                            <a href="tqf3Edit.php" class="btn btn-warning btn-sm">Edit</a>
                            <a onclick="return confirm('Are you sure you want to delete?');" href="?delete=<?php echo $row['no']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<?php

if (isset($_POST['doc_name'])) {
    require_once 'config/connect-db.php';
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
    
    //sql insert
    $stmt = $conn->prepare("INSERT INTO tqf3 (doc_name, doc_file)
    VALUES (:doc_name, '$newname')");
    $stmt->bindParam(':doc_name', $doc_name, PDO::PARAM_STR);
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
                          window.location = "tqf3.php"; //หน้าที่ต้องการให้กระโดดไป
                          
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
                          window.location = "tqf3.php"; //หน้าที่ต้องการให้กระโดดไป
                         
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
                              window.location = "tqf3.php"; //หน้าที่ต้องการให้กระโดดไป
                              
                          });
                        }, 1000);
                    </script>';
            
        } //else ของเช็คนามสกุลไฟล์
   
    } // if($upload !='') {

    } //isset
?>


