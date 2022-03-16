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
                    '". $column[25] ."','". $column[26] ."', '". $column[27] ."', '". $column[28] ."', '". $column[29] ."')");
                $sqlInsert -> execute();
                $result = $sqlInsert -> fetchAll();

                if (!empty($result))
                {
                    echo "CSV Data Imported into the database";
                } else {
                    echo "Problem in importing CSV";
                }

                
            }
        }
    }
?>

<form action="" class="form-horizoontal" method="POST" name="uploadCsv" enctype="multipart/form-data">
    <div>
        <label for="">Choose CSV File</label>
        <input type="file" name="file" accept=".csv">
        <button type="submit" name="import">import</button>
    </div>
</form>