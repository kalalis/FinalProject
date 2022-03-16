<?php 
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['teacher_login'])) {
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>DVCSS</title>

    <script type="text/javascript">
        $(document).ready(function() {
            var html = '<tr><td><textarea name="cloInput[]" style="height: 150px; width: 100%;" required></textarea></td><td ><textarea name="learnInput[]" style="height: 150px; width: 100%;" required></textarea></td><td><textarea name="critInput[]" style="height: 150px; width: 100%;" required></textarea></td><td><textarea name="scoreInput[]" style="height: 150px; width: 100%" required></textarea></td><td><input type="button" class="btn btn-danger add_item_btn " name="remove" id="remove" value="remove"style="margin-top: 50px;"></input></td></tr>';

            var x = 1;
            $("#add").click(function() {
                $("#table_field").append(html);
            });
            $("#table_field").on('click', '#remove', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
    
</head>
<body>

    <div class="container">
        <h3 style="margin: 20px; padding: 20px;" class="text-center">แบบเอกสารเกณฑ์ประเมินผลสำหรับวิชาภาคสนาม</h3>
        <form action="" method="POST" id="add_template">                     
            <table class="table table-bordered border-primary" id="table_field">               
                    <tr>                  
                        <td width="400px">CLO</td>
                        <td width="400px">วิธีการจัดการเรียนรู้</td>
                        <td width="400px">วิธีการประเมินผลการเรียนรู้</td>
                        <td width="200px">คะแนนประเมิน</td>
                        <td width="100px">เพิ่ม/ลบ</td>                      
                    </tr>

                    <?php 
                        $conn = mysqli_connect("localhost", "root", "", "dvcss");
                        
                        if (isset($_POST['save']))
                        {
                            $cloInput = $_POST['cloInput'];
                            $learnInput = $_POST['learnInput'];
                            $critInput = $_POST['critInput'];
                            $scoreInput = $_POST['scoreInput'];

                            foreach ($cloInput as $key => $value)
                            {
                                $save = "INSERT INTO crit_template(cloInput, learnInput, critInput, scoreInput) 
                                VALUES('".$value."','".$learnInput[$key]."','".$critInput[$key]."','".$scoreInput[$key]."')";

                                $query = mysqli_query($conn, $save);
                            }
                        }
                    ?>

                    <tr>                                                                       
                    <td>
                        <textarea name="cloInput[]" style="height: 150px; width: 100%;" required></textarea>
                    </td>
                    <td >
                        <textarea name="learnInput[]" style="height: 150px; width: 100%;" required></textarea>
                    </td>
                
                    <td>
                        <textarea name="critInput[]" style="height: 150px; width: 100%;" required></textarea>
                    </td>
                    <td>
                        <textarea name="scoreInput[]" style="height: 150px; width: 100%" required></textarea>
                    </td>   
                    <td>
                        <input type="button" class="btn btn-warning add_item_btn " name="add" id="add" value="add"
                            style="margin-top: 50px;"></input>
                    </td> 
                    </tr>                                              
            </table>
            <center>
                <input type="submit" name="save" class="btn btn-success" id="save" name="save" value="บันทึกแบบเกณฑ์การประเมิน"></input>
                <a href="crit.php" role="button" class="btn btn-primary">กลับ</a>
            </center>
            </div>
        </form>
    </div>

                            
    
</body>
</html>


<style>

    .table {
        text-align: center;
        margin-left: -50px;
        width: 1400px;
        height: auto;
    }




</style>

