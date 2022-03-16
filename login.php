<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>DVCSS</title>
</head>

<body>
่้่
    <div class="login">
        
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email address" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="teachEmail">@cmu.ac.th</span>
        </div>          
        
        <div class="input-group mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" style="margin-top: -2px;">
        </div>

        <div class="input-group mb-3">
            <a href="courseList.php" role="button" class="btn" >Sign in</a>
    
        </div> 

    </div>
 
</body>
</html>

<style>
 
    * {        
        box-sizing: border-box;		
    }

    body {
        background-image: url("img/cmu_acc.png");
        background-size: 100%;
    }

     .login {
        margin: 0;
        margin-top: -2px;
        position: absolute;
        width: 266.5px;
       
        top: 40%;
        left: 42.3%;
        border: none;
    }
    
    .login .btn {
        text-decoration: none;
        background-color: #1abc9c;
        color: white;
        margin: 0;
        margin-top: -3px;
        position: absolute;
        width: 266.5px;
        top: 40%;
        border: none;
    }



</style>