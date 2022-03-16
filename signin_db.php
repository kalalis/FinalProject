<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signin'])) {
        $teachEmail = $_POST['teachEmail'];
        $password = $_POST['password'];

      
        if (empty($teachEmail)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: signin.php");
        } else if (!filter_var($teachEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: signin.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: signin.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: signin.php");
        } else {
            try { 
                $check_data = $conn->prepare("SELECT * FROM teacher WHERE teachEmail = :teachEmail");
                $check_data->bindParam(":teachEmail", $teachEmail);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($teachEmail == $row['teachEmail']) {
                        if (password_verify($password, $row['password'])) { //อาจารย์
                            if ($row['urole'] == 'teacher') {
                                $_SESSION['teacher_login'] = $row['teachID'];                                
                                $_SESSION['user'] = $row['teachID'];
                                
                                header("location: courseList.php");
                            } 
                            else if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['teachID']; //ธุรการ
                                $_SESSION['user'] = $row['teachID'];
                                header("location: admin.php");
                             }
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง';
                            header("location: signin.php");
                        }
                    } else {
                        $_SESSION['error'] = 'อีเมลผิด';
                        header("location: signin.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: signin.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>