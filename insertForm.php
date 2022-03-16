<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกข้อมูลอาจารย์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php require_once 'process.php'; ?>

    <?php 
        if (isset($_SESSION['message'])):
    ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
    </div>

    <?php endif ?>

    <div class="container"> 

    <?php 
        $mysqli = new mysqli('localhost', 'root', '', 'test') or die(mysqli_error($mysql));
        $result = $mysqli -> query("SELECT * FROM crud") or die($mysqli -> error);
    ?>

    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Lastname</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

    <?php 
        while ($row = $result -> fetch_assoc()):
    ?>
            <tr>
                <td> <?php echo $row['id'] ?> </td>
                <td> <?php echo $row['name'] ?> </td>
                <td> <?php echo $row['lastname'] ?> </td>
                <td>
                    <a href="insertForm.php?edit=<?php echo $row['id']; ?>" 
                    class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id']; ?>" 
                    class="btn btn-danger">Delete</a>
                </td>
            </tr>

            <?php endwhile; ?>

        </table>
    </div>
    
    <?php
        function pre_r($array) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>

    <div class="container my-3">
        <h2 class="text-center">แบบฟอร์มบันทึกข้อมูล</h2>
        <form action="process.php" method="POST">
            <!-- <input type="hidden" name="id" value="<?php echo $id; ?>"> -->
            <div class="form-group">
                <label for="id">รหัสประจำตัว</label>
                <input type="number" name="id"  class="form-control" value="<?php echo $id; ?>">
            </div>
            <div class="form-group">
                <label for="name">ชื่อ</label>
                <input type="text" name="name"  class="form-control" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label for="lastname">นามสกุล</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
            </div>
            <br>
            <div class="form-group">
                <?php if($update == true): ?>
                    <button type="submit" name="update" class="btn btn-info">Update</button>
                <?php else: ?>
                    <button type="submit" name="save" class="btn btn-success">Save</button>
                <?php endif; ?>
                <button type="reset" name="cancle" class="btn btn-danger">Cancle</button>
                <a href="index.php" class="btn btn-primary">Home</a>
            </div>
        </form>       
    </div>
    </div>
    


</body>
</html>