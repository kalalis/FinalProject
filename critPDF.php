
<?php
    require_once __DIR__ . '/vendor/autoload.php';
    require 'config/db.php';

    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];	

    $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8', 
                    'format' => 'A4',
                    'margin_left' => 15,
                    'margin_right' => 15,
                    'margin_top' => 16,
                    'margin_bottom' => 16,
                    'margin_header' => 9,
                    'margin_footer' => 9,
                    'mirrorMargins' => true,

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

    $tableh1 = '

        <h2 style="text-align: center; font-size: 20px;">เกณฑ์การประเมินสำหรับกระบวนวิชาภาคสนาม</h2>

        <table id="bg-table" style="border-collapse: collapse; margin-top:8px;">
            <thead>   
                <tr>
                    <td width="15%" style="text-align:center; border:1px solid #000; padding-top:5px; padding-bottom:4px;"><b>CLO</b></td>
                    <td width="15%" style="text-align:center; border:1px solid #000; padding-top:5px; padding-bottom:4px;"><b>วิธีการจัดการเรียนรู้</b></td>
                    <td width="15%" style="text-align:center; border:1px solid #000; padding-top:5px; padding-bottom:4px;"><b>วิธีการประเมินผลการเรียนรู้</b></td>
                    <td width="10%" style="text-align:center; border:1px solid #000; padding-top:5px; padding-bottom:4px;"><b>คะแนนประเมิน<b></td>
                </tr>
            </thead>
            <tbody>';

    $stmt = $conn -> prepare("SELECT * FROM crit_template");
    $stmt -> execute();
    $result = $stmt -> fetchAll();

    foreach ($result as $row)
    {
        $tablebody .= '
                <tr>
                    <td style="border:1px solid #000; padding:3px; font-size:16px;">'.$row['cloInput'].'</td>
                    <td style="border:1px solid #000; padding:3px; font-size:16px;">'.$row['learnInput'].'</td>
                    <td style="border:1px solid #000; padding:3px; font-size:16px;">'.$row['critInput'].'</td>
                    <td style="border:1px solid #000; padding:3px; font-size:16px;">'.$row['scoreInput'].'</td>
                </tr>';
    }

    $tableend1 = "</tbody></table>";

    $body_1 = '
        <style>
            body {
                font-family: "thsarabun";
            }

        </style>';


    $mpdf->WriteHTML($tableh1);    
    $mpdf->WriteHTML($tablebody);   
    $mpdf->WriteHTML($tableend1);
    $mpdf->WriteHTML($body_1);
    $mpdf->Output($output, 'I');
    $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::FILE);
?>