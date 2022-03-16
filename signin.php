<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    <div class="container">
      
        <form action="signin_db.php" method="post">
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>

            
            <div class="input-group mb-3">
                <label for="teachEmail" class="form-label"></label>
                <input type="email" class="form-control" name="teachEmail" placeholder="Email address">
            </div>          
        
            <div class="input-group mb-3">
                <input type="password" name="password" placeholder="Password" class="form-control" >
                
            </div>
            
            <button type="submit" name="signin" class="btn btn-primary">Sign In</button>
            

        </form>

        <p class="member">ยังไม่เป็นสมาชิกใช่ไหม คลิกที่นี่เพื่อ <a href="signup.php">สมัครสมาชิก</a></p>
    </div>
    
</body>
</html>

<style>

    * {
        box-sizing: border-box;
    }

    body {
        background-image: url("img/cmu_signin.png");
        background-size: 100%;
    }

    .input-group {
        width: 266.5px;
        margin-left: 20%;
        margin-bottom: 30px;
        left: 257px;
        top: 320px;             
    }

    .btn {
        text-decoration: none;
        background-color: #1abc9c;
        color: white;
        width: 266.5px;
        margin-top: 330px;
        margin-left: 516px;
        border: none;
    }

    .member {
        color: white;
        margin-left: 505px;
        margin-top: 20px;
    }

    .alert {
        width: 50%;
        height: 50px;
        margin-left: 30%;
    }

</style>