<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../libs/main.css" type="text/css">
    <link rel="stylesheet" href="../libs/template.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#datepicker" ).datepicker();
    } );
    </script>
</head>
<body>
    <div class="row container">
        <div class="col-6-item bg-lblue">
            <div class="tab">
                    <div class="search-container">
                        <form action="/action_page.php">
                            <div class="col-6-item" style="width:100%;">
                                <div class="col-1-item" style="color:white;">
                                    <?php echo $_GET['username']; ?>
                                </div>
                                <div class="col-3-item">
                                    <a href=""><input type="text" placeholder="Search.." name="search"></a>
                                </div>
                                <div class="col-1-item">
                                    <a href="#" ><button type="submit"><i class="fa fa-search"></i></button></a>   
                                </div>
                                <div class="col-1-item" >
                                    <a href="#" style="color:white;">Settings</a>
                                    <i class="fa fa-cog fa-lg" style="color:white;"></i>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>

            <table class="table" style="width:100%;height:88%;table-layout: fixed">
                <tr>
                    <td style="width:20%;border: 1px solid black;text-align:center">
                      <img src="../pictures/thumbnail.PNG" alt="Trulli" width="70%" height="50%" style="text-align:center;">
                      <div style="text-align:center;">
                        <i class="fa fa-trophy"></i>
                        <i class="fa fa-heart"></i>
                        <i class="fa fa-diamond"></i>
                        <i class="fa fa-certificate"></i>
                      </div>
                      <label id="indexnum"xxxx></label>
                      <select name="subjects" id="subjectsId">
                        <option value="volvo">des1</option>
                        <option value="saab">des2</option>
                        <option value="opel">des3</option>
                        <option value="audi">des4</option>
                      </select><br/><br/>
                      <select name="years" id="yearsId">
                        <option value="volvo">2020</option>
                        <option value="saab">2019</option>
                        <option value="opel">2018</option>
                        <option value="audi">2017</option>
                       </select>
                       <div>
                           <button class="bg-dblue border-dblue" type="button" style="width:60%">View past paper</button>
                       </div>
                       <a href="#">complain</a><br/><br/>
                       <select name="subjects" id="subjectsId">
                        <option value="volvo">des1</option>
                        <option value="saab">des2</option>
                        <option value="opel">des3</option>
                        <option value="audi">des4</option>
                      </select><br/><br/>
                      <select name="years" id="yearsId">
                        <option value="volvo">2020</option>
                        <option value="saab">2019</option>
                        <option value="opel">2018</option>
                        <option value="audi">2017</option>
                       </select>
                       <div>
                           <button class="bg-dblue border-dblue" type="button" style="width:60%">View questions</button>
                       </div>
                    </td>

                    <td style="width:60%;border: 1px solid black">Content</td>

                    <td style="width:20%;border: 1px solid black;">
                        <div class="bg-gray">
                            <h4 style="text-align:center;">Interest List</h4>
                            <ul style="list-style-type: square;">
                                <li>Coffee</li>
                                <li>Tea</li>
                                <li>Coca Cola</li>
                            </ul>
                            <div style="text-align:center;">
                                <select name="subjects" id="subjectsId">
                                    <option value="volvo">des1</option>
                                    <option value="saab">des2</option>
                                    <option value="opel">des3</option>
                                    <option value="audi">des4</option>
                                </select>
                                <button class="bg-dblue border-dblue" type="button" style="width:30%">Add</button>
                            </div>
                        </div>
                        <div class="bg-gray">
                            <h4 style="text-align:center;">Notification</h4>
                        <div>
                        <p>Date: <input type="text" id="datepicker"></p>
                        <div style="text-align:center;">
                          <a href="#">complain</a><br/><br/>
                        <div>    
                    </td>
                </tr>
            </table>
        
        </div>
    </div>
</body>
</html>