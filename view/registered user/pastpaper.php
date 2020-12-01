<?php
include "view/partials/pastpaper_header.php";
?>

    <div id="pastpaper" class="tabcontent" style="height: 600px; display: block;">
        <div class="col-3-item bg-gray">
            <div class="tab">
                <div class="col-3-item">
                    <button id="secondary_defaulttab" class="secondary_tablinks" onclick="secondary_openTab(event, 'questionpaper')" >Question Paper</button>
                </div>

                <div class="col-3-item">
                    <button class="secondary_tablinks" onclick="secondary_openTab(event, 'answersheet')">Answer Sheet</button>
                </div>
            </div>

            <div  id="questionpaper" class="secondary_tabcontent" style="height: 400px; display: block;">
                <h3>Past Paper subject code</h3>
                <iframe class="paper_frame" src="pastpapers/<?php echo $paper_result ?>"></iframe>
            </div>
            
            <div id="answersheet" class="secondary_tabcontent" style="height: 400px; display: block;">
                <h3>Answer sheet subject code</h3>
                <iframe class="paper_frame" src="<?php echo $answer_result ?>"></iframe>
            </div>
        </div> 

        <div class="col-3-item bg-gray">
            <h3>New discussion</h3>

            <?php
            
        echo" <div class='container'>
        

        <form action='http://localhost/Main/homeindex.php?page=discussion.php&paper_id='".$paper_id."' method='POST'>
            <input type='hidden' name=paper_id value='".$paper_id."'>
            <input type='hidden' name=user_id value='".$_SESSION['user_id']."'>
        <div class='part-selection'>
            <select name='part' class='part-select' required>
                <option disabled=''>PART</option>
                <option >A</option>
                <option >B</option>
                <option >Other</option>
            </select>

            <select name='main-question' class='part-select' required>
                <option disabled=''>Main Question</option>
                <option >01</option>
                <option >02</option>
                <option >03</option>
                <option >04</option>
            </select>

            <select name='sub-question' class='part-select' required>
                <option disabled=''>Sub Question</option>
                <option >01</option>
                <option >02</option>
                <option >03</option>
                <option >04</option>
            </select>

            <select name='question' class='part-select' required>
                <option disabled=''>Main Question</option>
                <option >a</option>
                <option >b</option>
                <option >c</option>
                <option >d</option>
            </select><br>
        </div>
        <div class='lesson-area'>
            <label >Lesson</label><br>
            <textarea class='lesson' name='lesson'></textarea><br>
        </div>
        <div class='content-area'>
            <label >Content</label><br>
            <textarea class='content' name='content'></textarea><br>
            
        </div>
        <div class='radio-btn'>
            <label>Question</label>
            <input type='radio' name='type' class='radio-type' value='Question'>
            <label>Answer</label>
            <input type='radio' name='type' class='radio-type' value='Answer'><br>
        </div>
        <div class='create-btn'>
        <input type='submit' name='create_discussion' value='Create'>
        </div>
        </form>
        </div>";

    ?>
        </div>    
    </div>


    <script src="libs/main.js"></script>
</body>
</html>