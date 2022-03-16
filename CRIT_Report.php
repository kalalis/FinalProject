<?php

require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];	

$mpdf = new \Mpdf\Mpdf([
                'fontDir' => array_merge($fontDirs, [
                    __DIR__ . 'vendor/mpdf/mpdf/custom/font/directory',
                ]),
                'fontdata' => $fontData + [
                    'thsarabun' => [
                        'R' => 'THSarabunNew.ttf',
                        'I' => 'THSarabunNew Italic.ttf',
                        'B' => 'THSarabunNew Bold.ttf',
                        'U' => 'THSarabunNew BoldItalic.ttf'
                    ]
                ],
                'default_font' => 'thsarabun',
                'defaultPageNumStyle' => 1
]);

ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เกณฑ์การประเมินสำหรับวิชาภาคสนาม</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mitr:wght@400;500&family=Sarabun:wght@200;300&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container">
        <?php
            require 'config/db.php';
            $stmt = $conn -> prepare("SELECT * FROM crit_template");
            $stmt -> execute();
            $result = $stmt -> fetchAll();
        ?>
        <h2 style="text-align: center; font-size: 20px"><b>เกณฑ์การประเมินสำหรับวิชาภาคสนาม</b></h2>
        <br>
        <table class="table table-bordered">
               
                <tr style="text-align: center;">
                    <td>CLO</td>
                    <td>วิธีการจัดการเรียนรู้</td>
                    <td>วิธีการประเมินผลการเรียนรู้</td>
                    <td>คะแนนประเมิน</td>
                </tr>
            
            <tbody>
                <?php
                    foreach ($result as $row) {
                ?>
                <tr>
                    <td><?php echo $row['cloInput']; ?></td>
                    <td><?php echo $row['learnInput']; ?></td>
                    <td><?php echo $row['critInput']; ?></td>
                    <td><?php echo $row['scoreInput']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php 
            $html = ob_get_contents();  //เก็บข้อมูลหน้าเว็บทั้งหมด
            $mpdf -> WriteHTML($html);
            $mpdf -> Output("CRIT_Report.pdf");
            ob_end_flush();
        ?>
        <a href="CRIT_Report.pdf">Download</a>
        <a href="#" role="button" class="btn btm-primary">กลับ</a>
    </div>
</body>
</html>
<style>
    .container {
        font-family: 'Sarabun', sans-serif;
        margin-top: 50px;
    }

</style>