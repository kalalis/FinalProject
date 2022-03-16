<!-- <?php
// เชื่อมต่อฐานข้อมูล
require('dbconnect.php');


// รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
$cloID = $_POST["cloID"];
$cloCrit = $_POST["cloCrit"];



// บันทึกข้อมูล
$sql = "INSERT INTO clo(cloID, cloCrit) VALUES('$cloID','$cloCrit')";

mysqli_query($connect, $sql);  //run คำสั่ง sql

?> -->

<?php  
    session_start();
    require_once "config/db.php";

    if (isset($_POST['save'])) {
        
        $cloID = $_POST['cloID'];
        $cloCrit = $_POST['cloCrit'];

        if (empty($cloID)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสกระบวนวิชา';
            header("location: cloInsert.php");
        } elseif (empty($cloCrit)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อรายละเอียด';
            header("location: cloInsert.php");
        } else {
            try {
                $check_cloID = $conn -> prepare("SELECT cloID FROM clo WHERE cloID = :cloID");
                $check_cloID -> bindParam(":cloID", $cloID);
                $check_cloID -> execute();
                $row = $check_cloID->fetch(PDO::FETCH_ASSOC);

                if ($row['cloID'] == $cloID) {
                    $_SESSION['warning'] = "มีกระบวนวิชานี้อยู่ในระบบแล้ว";
                    header("location: cloInsert.php");
                } elseif (!isset($_SESSION['error'])) {
                    $stmt = $conn -> prepare("INSERT INTO clo(cloID, cloCrit) VALUES(:cloID, :cloCrit)");
                    $stmt -> bindParam(":cloID", $cloID);
                    $stmt -> bindParam(":cloCrit", $cloCrit);
                    $stmt -> execute();
                    $_SESSION['success'] = "เพิ่มกระบวนวิชาเรียบร้อยแล้ว!";
                    header("location: cloInsert.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: cloInsert.php");
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

        }

    } 
?>