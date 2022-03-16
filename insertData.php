<?php
// เชื่อมต่อฐานข้อมูล
require 'config/db.php';


// รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
$crsNo = $_POST["crsNo"];
$crsName = $_POST["crsName"];
$stdYear = $_POST["semester"];


// บันทึกข้อมูล
$sql = $conn -> prepare("INSERT INTO course(crsNo, crsName, semester) VALUES('$crsNo','$crsName', '$semester')");
$sql -> execute();


?> 

<?php  
    session_start();
    require_once "config/db.php";

    if (isset($_POST['save'])) {
        
        $crsNo = $_POST['crsNo'];
        $crsName = $_POST['crsName'];
        $semester = $_POST['semester'];

        if (empty($crsNo)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสกระบวนวิชา';
            header("location: insertCourse.php");
        } elseif (empty($crsName)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อกระบวนวิชา';
            header("location: insertCourse.php");
        } elseif (empty($semester)) {
            $_SESSION['error'] = 'กรุณากรอกปีการศึกษา';
            header("location: insertCourse.php");
        } else {
            try {
                $check_crsNo = $conn -> prepare("SELECT crsNo FROM course WHERE crsNo = :crsNo");
                $check_crsNo -> bindParam(":crsNo", $crsNo);
                $check_crsNo -> execute();
                $row = $check_crsNo->fetch(PDO::FETCH_ASSOC);

                if ($row['crsNo'] == $crsNo) {
                    $_SESSION['warning'] = "มีกระบวนวิชานี้อยู่ในระบบแล้ว";
                    header("location: insertCourse.php");
                } elseif (!isset($_SESSION['error'])) {
                    $stmt = $conn -> prepare("INSERT INTO course(crsNo, crsName, semester) VALUES(:crsNo, :crsName, :semester)");
                    $stmt -> bindParam(":crsNo", $crsNo);
                    $stmt -> bindParam(":crsName", $crsName);
                    $stmt -> bindParam(":semester", $semester);
                    $stmt -> execute();
                    $_SESSION['success'] = "เพิ่มกระบวนวิชาเรียบร้อยแล้ว!";
                    header("location: insertCourse.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: insertCourse.php");
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

        }

    } 
?>