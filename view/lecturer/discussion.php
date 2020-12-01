<?php
include "view/partials/pastpaper_header.php";
?>

    <div id="discussion" class="tabcontent" style="height: 600px; display: block;">
        <div class="col-3-item bg-gray" style="height: 100%;">
            <h3>View Discussion</h3>
            <label for="question">Select question: </label>
            <input list="question" name="path">
            <datalist id="question">
                <option value="custom">custom</option>
                <option value="1>b>i">1 -> b -> i</option>
                <option value="1>a">1 -> a</option> 
                <option value="1>b>ii">1 -> b -> ii</option>
                <option value="2>a>i">2 -> a -> i</option>
                <option value="2>a>i">2 -> a -> ii</option>
            </datalist><br>
            <!--add js-->
    
            <label for="discussion">Search discussion: </label>
            <input list="discussion" name="discussion">
            <datalist id="discussion">
                <option value="discussion 1">discussion 1</option>
                <option value="discussion 2">discussion 2</option> 
                <option value="discussion 3">discussion 3</option>
                <option value="discussion 4">discussion 4</option>
                <option value="discussion 5">discussion 5</option>
            </datalist><br>
            <!--add js-->
    
            <button type="submit" class="bg-blue border-blue" style="width: 20%;">View</button>
    
        </div> 
    
        <div class="col-3-item bg-gray"style="height: 100%;">
            <h3>Discussion id</h3>

            
           <?php
echo "hello";
           ?>
        </div>
    </div>

    <script src="libs/main.js"></script>
</body>
</html>