<?php 
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['teacher_login']) ) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- sweet alert  -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>DVCSS</title>
</head>
<body>
    <?php include 'navbar.php' ?>
    <?php include 'tabbar.php' ?>

     <br>
    <h3 style="margin-left: 400px; color: black; font-size: 30px;">คะแนนเก็บ</h3>

    <div class="content">

        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="img/set.png" alt="setting" style="width: 40px;"></button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#fileModal">ADD</a></li> 
                <li><a class="dropdown-item disabled" href="#">EDIT</a></li>
                <li><a class="dropdown-item" href="scoreDelete.php?crsNo=<?php echo $row['crsNo']; ?>">DELETE</a></li>
            </ul>

            <a class="back-btn" href="courseList.php" role="button"><img src="img/home.png"></a>
        </div>

        <form action="" method="POST" enctype="multipart/form-data" name="uploadCsv">
        
            <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <div class="modal-header" >
                            <h5 class="modal-title" id="exampleModalLabel">เอกสาร คะแนนประเมิน</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label class="col-form-label">File</label>
                                    <input type="file" class="form-control" required name="file" accept=".csv"></input>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="import">Upload</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        
       
        <h3 style="margin-left: 20px;">รายการเอกสาร </h3> <br>
        <div class="div1">
        <table border="1px" width="550px" height="100px">
            <thead border="1px" align="center">
                <th>คะแนน</th>
                <th>รายละเอียด</th>
                <th>1.1</th> <th>1.2</th> <th>1.3</th> <th>1.4</th> <th>1.5</th> <th>1.6</th> <th>1.7</th>
                <th>2.1</th> <th>2.2</th> <th>2.3</th> <th>2.4</th> <th>2.5</th> <th>2.6</th> <th>2.7</th> <th>2.8</th>
                <th>3.1</th> <th>3.2</th> <th>3.3</th> <th>3.4</th>
                <th>4.1</th> <th>4.2</th> <th>4.3</th> <th>4.4</th> <th>4.5</th> <th>4.6</th>
                <th>5.1</th> <th>5.2</th> <th>5.3</th> <th>5.4</th>
                <th></th>
                
            </thead>
            <?php
                        require_once 'config/db.php';
                        
                        $stmt = $conn -> prepare("SELECT * FROM score_excel ");
                        $stmt -> execute();
                        $result = $stmt -> fetchAll();
                        foreach ($result as $row) {
                    ?>
            <tbody>
                <td id="tdcolors"><?php echo $row['score']; ?></td> 
                <td id="tdcolors"><?php echo $row['detail']; ?></td>
                <td><?php echo $row['tqf11']; ?></td> 
                <td><?php echo $row['tqf12']; ?></td> 
                <td><?php echo $row['tqf13']; ?></td> 
                <td><?php echo $row['tqf14']; ?></td> 
                <td><?php echo $row['tqf15']; ?></td> 
                <td><?php echo $row['tqf16']; ?></td> 
                <td><?php echo $row['tqf17']; ?></td>

                <td><?php echo $row['tqf21']; ?></td> 
                <td><?php echo $row['tqf22']; ?></td> 
                <td><?php echo $row['tqf23']; ?></td> 
                <td><?php echo $row['tqf24']; ?></td> 
                <td><?php echo $row['tqf25']; ?></td> 
                <td><?php echo $row['tqf26']; ?></td> 
                <td><?php echo $row['tqf27']; ?></td> 
                <td><?php echo $row['tqf28']; ?></td>

                <td><?php echo $row['tqf31']; ?></td> 
                <td><?php echo $row['tqf32']; ?></td> 
                <td><?php echo $row['tqf33']; ?></td> 
                <td><?php echo $row['tqf34']; ?></td> 

                <td><?php echo $row['tqf41']; ?></td> 
                <td><?php echo $row['tqf42']; ?></td> 
                <td><?php echo $row['tqf43']; ?></td> 
                <td><?php echo $row['tqf44']; ?></td> 
                <td><?php echo $row['tqf45']; ?></td> 
                <td><?php echo $row['tqf46']; ?></td>

                <td><?php echo $row['tqf51']; ?></td> 
                <td><?php echo $row['tqf52']; ?></td> 
                <td><?php echo $row['tqf53']; ?></td> 
                <td><?php echo $row['tqf54']; ?></td> 

                <td><?php echo $row['resultRow']; ?></td>

            </tbody>
            <?php } ?>
        </table>
        </div>


<script src="js/bootstrap.min.js"></script>   
</body>

<?php 
    require 'config/db.php';
    if (isset($_POST['import']))
    {
        $fileName = $_FILES['file']['tmp_name'];

        if ($_FILES['file']['size'] > 0)
        {
            $file = fopen($fileName, 'r');

            while(($column = fgetcsv($file, 100000, ",")) !== FALSE)
            {
                $sqlInsert = $conn -> prepare("INSERT INTO score_excel (
                    score, detail, tqf11, tqf12, tqf13, tqf14, tqf15, tqf16, tqf17, tqf21, tqf22, tqf23, tqf24, tqf25, tqf26, tqf27, tqf28, tqf31, tqf32, tqf33, tqf34, tqf41, tqf42, tqf43, tqf44, tqf45, tqf46, tqf51, tqf52, tqf53, tqf54, resultRow) 
                    VALUES ('". $column[0] ."', '". $column[1] ."', '". $column[2] ."', '". $column[3] ."', '". $column[4] ."', '". $column[5] ."', '". $column[6] ."','". $column[7] ."', '". $column[8] ."',
                    '". $column[9] ."', '". $column[10] ."','". $column[11] ."', '". $column[12] ."', '". $column[13] ."','". $column[14] ."', '". $column[15] ."', '". $column[16] ."',
                    '". $column[17] ."', '". $column[18] ."', '". $column[19] ."', '". $column[20] ."',
                    '". $column[21] ."', '". $column[22] ."', '". $column[23] ."', '". $column[24] ."', '". $column[23] ."', '". $column[24] ."',
                    '". $column[25] ."', '". $column[26] ."', '". $column[27] ."', '". $column[28] ."', '". $column[29] ."')");
                $sqlInsert -> execute();
                $result = $sqlInsert -> fetchAll();

                if (!empty($result))
                {
                    echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "อัพโหลดไฟล์เอกสารสำเร็จ",
                          type: "success"
                      }, function() {
                          window.location = "score.php"; //หน้าที่ต้องการให้กระโดดไป
                          
                      });
                    }, 1000);
                </script>';
                } else {
                    echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เกิดข้อผิดพลาด",
                          type: "error"
                      }, function() {
                          window.location = "score.php"; //หน้าที่ต้องการให้กระโดดไป
                         
                      });
                    }, 1000);
                </script>';
                }

                
            }
        }
    }
?>


<style>
@import url('https://fonts.googleapis.com/css2?family=Mitr:wght@400&display=swap');
</style>
<style>
    
    div.content {
		margin-left: 400px;
		margin-right: 50px;		
		padding-right: 0;
        padding-bottom: 50px;
		height: auto;
		border-radius: 30px;
		width: 1200px;
		background-color: white;
        
	}

    .dropdown-toggle {
        margin: 0;
        padding: 0;
        margin-top: 10px;
        background-color: white;
        border-radius: 15px;
        margin-left: 80%;
    }

    .dropdown-menu {
        margin-left: 80%;
        border-left: 5px solid #AF4CEC;
        border-right: 5px solid #AF4CEC;
        border-bottom: 5px solid #AF4CEC;
        border-radius: 0 0 15px 15px;
    }

    .back-btn img {
        width: 40px; 
        margin-top: 10px;
        margin-left: 10px;
        
    }

    .div1 table, th, td {
        min-width: 60px;
        font-size: 16px;        
        text-align: center;
        border: 1px solid black;
        
    }

    .div1 th {
        background-color:#66b3ff;
        position: sticky;
        top: 0;
    }

    .div1 th:nth-child(1),
    .div1 td:nth-child(1) {
        position: sticky;
        left: 0;
    }

    .div1 th:nth-child(2),
    .div1 td:nth-child(2) {
        position: sticky;
        left: 60px;       
    }

    .div1 td:nth-child(1),
    .div1 td:nth-child(2) {
        background: #ffffb3;
    }

    .div1 th:nth-child(1),
    .div1 th:nth-child(2) {
        z-index: 2;
    }

    #tdcolors {
        background-color: #ffffb3;
    }

    .div1 {
        width: calc(70vw - 35px);
        height: calc(70vh - 35px);
        overflow: scroll;
        border: 1px solid black;
        margin-left: 30px;
    }


    




 
</style>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("btn dropdown-toggle");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}


</script>
</html>