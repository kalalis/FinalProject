<?php 

    session_start();

    require_once "config/connect-db.php";

    if (isset($_POST['update'])) {
        $no = $_POST['no'];
        $doc_name = $_POST['doc_name'];
        $doc_file = $_FILES['doc_file'];

        $doc_file2 = $_POST['doc_file2'];
        $upload = $_FILES['doc_file']['name'];

        if ($upload != '') {
            $allow = array('pdf');
            $extension = explode('.', $doc_file['name']);
            $fileActExt = strtolower(end($extension));
            $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
            $filePath = 'docs/'.$fileNew;

            if (in_array($fileActExt, $allow)) {
                if ($doc_file['size'] > 0 && $doc_file['error'] == 0) {
                   move_uploaded_file($doc_file['tmp_name'], $filePath);
                }
            }

        } else {
            $fileNew = $doc_file2;
        }

        $sql = $conn->prepare("UPDATE tqf3 SET doc_name = :doc_name, doc_file = :doc_file WHERE no = :no");
        $sql->bindParam(":no", $no);
        $sql->bindParam(":doc_name", $doc_name);
        $sql->bindParam(":doc_file", $fileNew);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "Data has been updated successfully";
            header("location: tqf3.php");
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
            header("location: tqf3.php");
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- sweet alert  -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
        .container {
            max-width: 550px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Data</h1>
        <hr>
        <form method="POST" enctype="multipart/form-data">
            <?php
                if (isset($_GET['no'])) {
                        $no = $_GET['no'];
                        $stmt = $conn->query("SELECT * FROM tqf3 WHERE no = $no");
                        $stmt->execute();
                        $result = $stmt->fetch();
            
                }
            ?>
                <form>
                    <div class="mb-3">
                        <input type="text" readonly value="<?php echo $result['no']; ?>" required class="form-control" name="no" >
                        <label class="col-form-label">File Name</label>
                        <input type="text" value="<?php echo $result['doc_name']; ?>" required class="form-control" name="doc_name" placeholder="ชื่อเอกสาร">
                        <input type="hidden" value="<?php echo $result['doc_file']; ?>" required class="form-control" name="doc_file2">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">File</label>
                        <input type="file" value="<?php echo $result['doc_file']; ?>" class="form-control" name="doc_file" accept="application/pdf"></input>
                    </div>
                </form>
                <hr>
                <a href="tqf3.php" class="btn btn-secondary">Go Back</a>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
    </div>


</body>
</html>

