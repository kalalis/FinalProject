<?php 

    $mysqli = new mysqli('localhost', 'root', '', 'dvcss') or die(mysqli_error($mysql));

    $crsNo = '';
    $crsName = '';
    $stdYear = '';
    // $update = false;

    if (isset($_GET['delete'])) {
        $crsNo = $_GET['delete'];
        $mysqli -> query("DELETE FROM course WHERE crsNo=$crsNo") or die($mysqli -> error);

        $_SESSION['message'] = 'Record has been deleyed!';
        $_SESSION['msg_type'] = 'danger';

        header("location: deleteCourse.php");
    }

  

?>

