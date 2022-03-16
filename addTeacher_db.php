<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['t-signup'])) {
        $teachID = $_POST['teachID'];
        $teachName = $_POST['teachName'];
        $teachSurname = $_POST['teachSurname'];
        $teachEmail = $_POST['teachEmail'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];

        if (empty($teachID)) {
            $_SESSION['error'] = 'กรุณากรอกหมายเลขไอดี';
            header("location: addTeacher.php");
        } elseif (empty($teachName)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: addTeacher.php");
        } else if (empty($teachSurname)) {
            $_SESSION['error'] = 'กรุณากรอกนามสกุล';
            header("location: addTeacher.php");
        } else if (empty($teachEmail)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: addTeacher.php");
        } else if (!filter_var($teachEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: addTeacher.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: addTeacher.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: addTeacher.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: addTeacher.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: addTeacher.php");
        } else {
            try {

                $check_email = $conn->prepare("SELECT teachEmail FROM teacher WHERE teachEmail = :teachEmail");
                $check_email->bindParam(":teachEmail", $teachEmail);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['teachEmail'] == $teachEmail) {
                    $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='signin.php'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: addTeacher.php");
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO teacher(teachID, teachName, teachSurname, teachEmail, password) 
                                            VALUES(:teachID, :teachName, :teachSurname, :teachEmail, :password)");
                    $stmt->bindParam(":teachID", $teachID);
                    $stmt->bindParam(":teachName", $teachName);
                    $stmt->bindParam(":teachSurname", $teachSurname);
                    $stmt->bindParam(":teachEmail", $teachEmail);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->execute();
                    $_SESSION['success'] = "เพิ่มข้อมูลอาจารย์เรียบร้อยแล้ว! <a href='signin.php' class='alert-link'>คลิกที่นี่</a> เพื่อเข้าสู่ระบบ";
                    header("location: addTeacher.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: addTeacher.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>