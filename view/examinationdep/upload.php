<?php
    define('BASE_URL','http://localhost/Main/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Examination Department Home</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/libs/main.css" type="text/css">
</head>
<body>
    <div></div>
    <div class="container">
            <?php
            session_start();
            $_SESSION['files']=$files;
            $_SESSION['year']=$_POST['year'];
            echo "<form action='".BASE_URL."examindex.php?count=".$fileCount."' method='post'>";
                echo "<table>";
                for ($i = 0; $i < $fileCount; $i++){
                    echo "<tr>";
                        echo "<td>" . ($i+1) . "</td>";
                        echo "<td>" . basename($files[$i]) . "</td>";                                        
                        echo "<td><select name='subject[]'>";
                        while($row = mysqli_fetch_array($ressub)){
                            echo "<option value='".$row['subject_code']."'>".$row['subject_code']." ".$row['subject_name']."</option>";
                        }
                        mysqli_data_seek($ressub,0);
                        echo "</select></td>";
                        echo "<td><select name='part[]'>";
                            echo "<option value='A'>Part A</option>";
                            echo "<option value='B'>Part B</option>";
                            echo "<option value='C'>Part C</option>";
                            echo "<option value='F' selected='selected'>Full Paper</option>";
                        echo "</select></td>";
                    echo "</tr>";                     
                }
                echo "</table>";
                echo "<div class='col-1-item'><button class='bg-green border-green' name='submitDetails' type='submit'>Insert Detials</button></div>";
            echo "</form>";
            ?>
        
    </div>
</body>
</html>