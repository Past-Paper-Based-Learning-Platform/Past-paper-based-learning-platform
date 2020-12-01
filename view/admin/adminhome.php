<?php 
    session_unset();
    define('BASE_URL','http://localhost/Main/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrator Home</title>
    <link rel="stylesheet" href="../../libs/main.css" type="text/css">
</head>
<body>
    <div class="container">
        <div class="col-2-item page-title bg-lblue">
            Administrator
        </div>
        <div class="col-2-item">
            <input type="text" placeholder="e-mail / username" id="email">
        </div>
        <div class="col-1-item">
            <button class="bg-dblue border-dblue" type="submit">Search User Account</button>
        </div>
        <div class="col-1-item">
            <a href="<?php echo BASE_URL;?>view/admin/changepassword.php" style="text-decoration:none; color: white">change password</a>&nbsp;
        </div>
    </div>
    <div class="row container">
        <div class="col-5-item bg-lblue" style="height: 600px;">
            <div class="tab">
                <div class="col-3-item">
                    <button id="defaulttab" class="tablinks" onclick="openTab(event, 'deactivate')" >Deactivate Accounts</button>
                </div>
                <div class="col-3-item">
                    <button class="tablinks" onclick="openTab(event, 'removepost')">Remove Posts</button>
                </div>
            </div>

            <div id="deactivate" class="tabcontent" style="height: 500px;">
                <div class="col-3-item">
                    <div class="col-2-item strong text-white">Add Account to Deactivate:</div>
                    <div class="col-4-item"><input type="text" list="user" placeholder="e-mail / username" id="addemail"></div>
                    <datalist id="user">
                        <option value="User-I">
                        <option value="User-II">
                        <option value="User-III">
                        <option value="User-IV">
                        <option value="User-V">
                        <option value="User-VI">
                    </datalist>
                    <div class="col-2-item"><button class="bg-blue border-blue" type="submit">Add Account</button></div> 
                </div>
                <div class="col-3-item">
                    <div class="bg-lgray" style="height: 350px; overflow: auto; padding: 10px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td>User #1</td>
                                    <td><button class="bg-blue border-blue" type="submit">View Account</button></td>
                                    <td><button class="bg-red border-red" type="submit" onclick="addAccount()">-</button></td>  
                                </tr>
                                <tr>
                                    <td>User #2</td>
                                    <td><button class="bg-blue border-blue" type="submit">View Account</button></td>
                                    <td><button class="bg-red border-red" type="submit">-</button></td> 
                                </tr>
                                <tr>
                                    <td>User #3</td>
                                    <td><button class="bg-blue border-blue" type="submit">View Account</button></td>
                                    <td><button class="bg-red border-red" type="submit">-</button></td> 
                                </tr>
                                <tr>
                                    <td>User #4</td>
                                    <td><button class="bg-blue border-blue" type="submit">View Account</button></td>
                                    <td><button class="bg-red border-red" type="submit">-</button></td> 
                                </tr>
                                <tr>
                                    <td>User #5</td>
                                    <td><button class="bg-blue border-blue" type="submit">View Account</button></td>
                                    <td><button class="bg-red border-red" type="submit">-</button></td>
                                </tr>
                                <tr>
                                    <td>User #6</td>
                                    <td><button class="bg-blue border-blue" type="submit">View Account</button></td>
                                    <td><button class="bg-red border-red" type="submit">-</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-2-item" style="float: right;">
                        <button class="bg-red border-red" type="submit">Deactivate Accounts</button>
                    </div> 
                </div>
                
            </div>
            
            <div id="removepost" class="tabcontent" style="height: 500px;">
                <div class="col-5-item">
                    <div class="col-2-item strong text-white">Enter Post ID:</div>
                    <div class="col-4-item"><input type="text" placeholder="Post ID" id="postid"></div>
                    <div class="col-2-item strong text-white">Content:</div>
                    <div class="col-4-item bg-white text-gray" style="height: 300px;">&lt;Display Content Here&gt;</div>
                    <div class="col-4-item" style="float: right;">
                        <div class="col-3-item"><button class="bg-green border-green" type="submit">Ignore Repot & Keep the Post</button></div>
                        <div class="col-3-item"><button class="bg-red border-red" type="submit">Remove Post</button></div>
                    </div>
                </div>
                <div class="col-1-item">
                    <div class="col-4-item"><button class="bg-dblue border-dblue" type="submit">Search Post</button></div>
                    
                </div>
            </div>
        </div>
        <div class="col-1-item bg-gray" style="height: 600px;">
            <div class="container-fit-vertical bg-lgray strong">
                Notifications
            </div>
            <div class="container-fit-vertical bg-white text-gray auto-scroll" style="height: 520px;">
                &lt;Notification list&gt;
            </div>
        </div>
    </div>
    
    <script src="../../libs/main.js"></script>
    <script>
        function addAccount(){

        }
    </script>
</body>
</html>