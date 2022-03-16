<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test popup</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@500&display=swap" rel="stylesheet">
    
</head>
<body>

    <div class="center">
        <button id="show-login">Log in</button>
    </div>
    <div class="popup">
        <div class="close-btn">&times;</div>
        <div class="form">
            <h2>LOG IN</h2>
            <div class="form-element">
                <label for="email">Email</label>
                <input type="text" id="email" placeholder="Email address">
            </div>
            <div class="form-element">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password">
            </div>
            <div class="form-element">
                <input type="checkbox" id="remember-me">
                <label for="remember-me">Remember me</label>
            </div>
            <div class="form-element">
                <button>Sign in</button>
            </div>
        </div>
    </div>
    
</body>
</html>

<style>

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: burlywood;
        height: 100vh;
    }

    .center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .center button {
        padding: 10px 20px;
        font-size: 15px;
        font-weight: 600;
        color: #222;
        background: #f5f5f5;
        border: none;
        outline: none;
        cursor: pointer;
        border-radius: 5px;
        cursor: pointer;
    }

    .popup {
        position: absolute;
        top: 50%;
        left: 50%;
        opacity: 0;
        transform: translate(-50%, -50%) scale(1.25);
        width: 380px;
        padding: 20px 30px;
        background: #fff;
        box-shadow: 2px 2px 5px 5px;
        border-radius: 10px;
        transition: top 0ms ease-in-out 200ms,
                    opacity 200ms ease-in-out 0ms,
                    transform 20ms ease-in-out 0ms,;
    }

    .popup .active {
        top: 50%;
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
        transition: top 0ms ease-in-out 0ms,
                    opacity 200ms ease-in-out 0ms,
                    transform 20ms ease-in-out 0ms,;
    }

    .popup .close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        width: 15px;
        height: 15px;
        background: #888;
        color: #eee;
        text-align: center;
        line-height: 15px;
        cursor: pointer;
    }


</style>

<script>
    document.querySelector("#show-login").addEventListener("click", function() {
	document.querySelector(".popup").classList.add("active");
});
document.querySelector(".popup .close-btn").addEventListener("click", function() {
	document.querySelector(".popup").classList.remove("active");
});

</script>