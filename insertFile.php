<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data"></form>
    <label>File Upload</label>
    <input type="File" name="file">
    <input type="submit" name="submit">
</body>
</html>

<?php
require('dbconnect.php');

//Connection

if(isset($_POST["submit"])) {
    $title = $POST["name"];
    $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["Files"]["tmp_name"];

    $uploads_dir = '/Files';
    move_uploaded_file($tname, $uploads_dir.'/'.$pname);

    $sql = "INSERT INTO tqf(id, name, mime, data) VALUES('$title')";
}

?>