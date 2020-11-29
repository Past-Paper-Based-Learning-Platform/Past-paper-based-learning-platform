<?php include 'view/partials/login_header.php';?>
    <form action="http://localhost/Main/index.php?page=login.php" method="post" id="loginFormId">
        <div class="col-6-item">
            <div class="col-2-item"></div>
            <div class="col-1-item strong text-white">Email/Username</div> 
            <div class="col-1-item"><input type="text" placeholder="Email/Username" id="email_un_id" name="email_un"></div>
            <div class="col-2-item"><span style="color:red" id="unValidationId">Email/Username required</span></div>
        </div>
        <div class="col-6-item">
            <div class="col-2-item"></div>
            <div class="col-1-item strong text-white">Password</div> 
            <div class="col-1-item"><input class="password" type="password" style="password" placeholder="Password" id="passwordId" name="password"></div>
            <div class="col-2-item"><span style="color:red" id="pwValidationId">Password required</span></div>
        </div>
        <div class="col-5-item">
            <div class="col-3-item"></div>
            <div class="col-1-item">
                <button class="bg-dblue border-dblue" type="submit" name="loginBtn" id="loginBtn">Login</button>
            </div>
            <div class="col-1-item"></div>
        </div>
        <div class="col-5-item">
            <div class="col-3-item"></div>
            <div class="col-2-item">
                <input style="background: transparent; border: none;color:red;width:100%" type="text" name="loginerr" id="loginerrId" value = "<?php echo (isset($loginerr))?$loginerr:'';?>">
            </div>
        </div>
    </form>
    <div class="col-6-item">
        <div class="col-2-item"></div>
        <div class="col-2-item">
            <a href="http://localhost/Main/index.php?page=forgotPassword.php">Forgot Password</a>
        </div>
        <div class="col-1-item">
            <a href="http://localhost/Main/index.php?page=signup.php">Sign up</a>   
        </div>
    </div>           
<?php include 'view/partials/login_footer.php';