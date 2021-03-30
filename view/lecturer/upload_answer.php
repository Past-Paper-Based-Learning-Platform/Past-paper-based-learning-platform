<?php include 'view/partials/lecturer_header.php';?>
    <form action="http://localhost/Main/lecturerindex.php?page=upload_answer.php" method="POST" enctype="multipart/form-data">
        <div class="lecturerSelectPaper">
            <label for="paper">Select Paper: </label>
            <input list="paper" name="paper" class="selectscript">
                <datalist id="paper" >
                    <?php
                    foreach($result_paper as $row)
                    { 
                        echo "<option value = ".$row['paper_id']."> ".$row['subject_code']. "-" .$row['subject_name']. "-".$row['year']. "-" .$row['semester']. "-" .$row['part']. "</option>";
                    }
                    ?>
                </datalist></br>
        </div>
        <div class="drop-zone">
            <span class="dzone-prompt">Drop file here or click to upload</span>
            <input type="file" name="answer_script" id="answer_script" class="dzone-input">   
        </div>

            <button class="verticlebtn" style="width:20%" name= "upload_answers" type="submit" >UPLOAD</button>
    </form>

    <div class="alert alert0" style="display:none;" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        File has Successfully Uploaded!
    </div>
    <div class="alert alert1" style="display:none;" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Please select a pastpaper!
    </div>
    <div class="alert alert2" style="display:none;" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        You have not selected a file!
    </div>
    <div class="alert alert3" style="display:none;" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Please select a PDF file.!
    </div>
    <div class="alert alert4" style="display:none;" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Failed to upload the file!
    </div>
    <?php if(isset($_GET['error'])){
        if ($_GET['error']==0){
            echo '<script>var alert=document.querySelector(".alert0"); alert.style.display="block";</script>';
        }elseif($_GET['error']==1){
            echo '<script>var alert=document.querySelector(".alert1"); alert.style.display="block";</script>';
        }elseif($_GET['error']==2){
            echo '<script>var alert=document.querySelector(".alert2"); alert.style.display="block";</script>';
        }elseif($_GET['error']==3){
            echo '<script>var alert=document.querySelector(".alert3"); alert.style.display="block";</script>';
        }elseif($_GET['error']==4){
            echo '<script>var alert=document.querySelector(".alert4"); alert.style.display="block";</script>';
        }
    }?>
<?php include 'view/partials/lecturer_footer.php';?>