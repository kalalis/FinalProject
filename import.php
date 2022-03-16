<?php
    require 'config/db.php';

    if (isset($_POST['import']))
    {
        $fileName = $_FILES['file']['tmp_name'];

        if ($_FILES['file']['size'] > 0)
        {
            $file = fopen($fileName, 'r');

            while(($column = fgetcsv($file, 10000, ",")) !== FALSE)
            {
                $sqlInsert = $conn -> prepare("INSERT INTO tbl_excel (name, email) VALUES ('". $column[0] ."', '". $column[1] ."')");
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