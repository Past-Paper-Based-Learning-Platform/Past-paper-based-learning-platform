<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>View Past Paper</title>
    <link rel="stylesheet" href="../../libs/main.css" type="text/css">
</head>

<body>
    <div class="tab">
        <div class="col-3-item">
            <button id="defaulttab" class="tablinks" onclick="openTab(event, 'pastpaper')" >Past Paper</button>
        </div>

        <div class="col-3-item">
            <button class="tablinks" onclick="openTab(event, 'discussion')">Discussion</button>
        </div>
    </div>

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

            <div id="questionpaper" class="secondary_tabcontent" style="height: 400px; display: block;">
                <h3>Past Paper subject code</h3>
                <iframe class="paper_frame" src="../../pastpapers/SCS 2101 Part A.pdf"></iframe>
            </div>
            
            <div id="answersheet" class="secondary_tabcontent" style="height: 400px; display: block;">
                <h3>Answer sheet subject code</h3>
                <iframe class="paper_frame" src="../../pastpapers/SCS 2101 Part A.pdf"></iframe>
            </div>
        </div> 

        <div class="col-3-item bg-gray">
            <h3>New discussion</h3>

            <form>
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

                <button type="submit" class="bg-blue border-blue" style="width: 20%;">crop</button><br><!--js action function-->
                
                <laber for="lesson">Lesson: </laber>
                <input list="lesson" name="lesson">
                <datalist id="lesson">
                    <option value ="custom">custom</option>
                    <option value ="#string_matching">string matching</option>
                    <option value ="#KMP_algorith">KMP algorithm</option>
                    <option value="Boyer_Moore_algorithm">Boyer Moore algorithm</option>
                    <option value="Greedy_algorithm">Greedy Algorithm</option>
                </datalist><br>
                <!--add js-->

                <label for="message">Text: </label>
                <textarea name="message" rows="20" placeholder="type your text here" style="width:100%;"></textarea>

                <label for="type">Type: </label>
                <select id="type" name="type">
                    <option value ="question">Question</option>
                    <option value ="answer">Answer</option>
                </select><br>
                
                <button type="submit" class="bg-blue border-blue" style="width: 20%;">CREATE</button>
            </form>
        </div>    
    </div>

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
            <iframe class="paper_frame" src="../../view/registered user/discussionlist.php"></iframe>
        </div>
    </div>

    <script src="../../libs/main.js"></script>
</body>
</html>