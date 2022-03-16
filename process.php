<?php 

    session_start();

    $mysqli = new mysqli('localhost', 'root', '', 'test') or die(mysqli_error($mysql));

    $id = '';
    $name = '';
    $lastname = '';
    $update = false;


    if (isset($_POST['save'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];

        $_SESSION['message'] = 'Record has been saved!';
        $_SESSION['msg_type'] = 'success';

        header("location: insertForm.php");

        $mysqli -> query("INSERT INTO crud (id, name, lastname) VALUES ('$id','$name', '$lastname')")
        or die($mysqli -> error);
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli -> query("DELETE FROM crud WHERE id=$id") or die($mysqli -> error);

        $_SESSION['message'] = 'Record has been deleyed!';
        $_SESSION['msg_type'] = 'danger';

        header("location: insertForm.php");
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $result = $mysqli -> query("SELECT * FROM crud WHERE id=$id") or die($mysqli -> error);
        if (is_countable($result) && count($result) > 0) {
            if (count($result) == 1) {
                $row = $result -> fetch_array();
                $id = $row['id'];
                $name = $row['name'];
                $lastname = $row['lastname'];
            }
        }
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];

        $mysqli -> query("UPDATE crud SET id='$id', name='$name', lastname='$lastname' WHERE id=$id") or die($mysqli -> error);

        $_SESSION['message'] = "Record has been updated";
        $_SESSION['msg_type'] = "warning";

        header('location: insertForm.php');
    }

    

?>