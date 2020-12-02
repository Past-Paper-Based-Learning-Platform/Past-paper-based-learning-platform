<?php include 'view/partials/lecturer_header.php';?>
    <form action="http://localhost/Main/lecturerindex.php?page=upload_answer.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="paper">Select Paper: </label>
            <input list="paper" name="paper">
                <datalist id="paper">
                    <?php
                    foreach($result_paper as $row)
                    { 
                        echo "<option value = ".$row['paper_id']." > ".$row['subject_code']. "-" .$row['subject_name']. "-".$row['year']. "-" .$row['semester']. "-" .$row['part']. "</option>";
                    }
                    ?>
                </datalist></br>
        </div>
        <div>
            <label for="answer_script">Select file: </label>
            <input type="file" id="answer_script" name="answer_script"><br>
        </div>
        <div class="element">
            <button class="bg-dblue" name= "upload_answers" type="submit" >UPLOAD</button>
        </div>
    </form>
<?php include 'view/partials/lecturer_footer.php';?>