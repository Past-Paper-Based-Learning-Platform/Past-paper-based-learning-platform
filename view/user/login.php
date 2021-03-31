<html>
<body onload="loadFunction()">
<?php include 'view/partials/login_header.php';?>
<section>
        <div class='loginform'>
            <h1 style="margin-left:16px;">Login</h1>
            <hr style="width:90%;border: 1px solid #f1f1f1;">
            <form action="http://localhost/Main/index.php?page=login.php" method="post" id="loginFormId">
                <div class="container">
                    <br><label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Email/Username" id="email_un_id" name="email_un">
                    <span style="color:red; display:none;" id="unValidationId">Email/Username required</span>

                    <br><label for="psw"><b>Password</b></label>
                    <input class="password" type="password" style="password" placeholder="Password" id="passwordId" name="password">
                    <span style="color:red; display:none;" id="pwValidationId">Password required</span>
        
                    <br><button class="bg-dblue border-dblue" type="submit" name="loginBtn" id="loginBtn">Login</button>
        
                    <input style="background: transparent; border: none;color:red;width:100%; display:none" type="text" name="loginerr" id="loginerrId" value = "<?php echo (isset($loginerr))?$loginerr:'';?>">

        
            </form>
            <div class="container" style="background-color:#f1f1f1; color:midnightblue;">
                <button class='signupbtn' type="button" onclick="document.location='index.php?page=signup.php'" >Sign Up>></button>
                <span class="psw">Forgot <a href="http://localhost/Main/index.php?page=forgotPassword.php">password?</a></span>
            </div>
        </div>
        </section>

        <div class="alert alert1" style="display:none;" id="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            Invalid Username or Password!
        </div>
<script>
function loadFunction(){  
    var emailUnId = document.getElementById("unValidationId");
    emailUnId.style.display = "none";
    var pwId = document.getElementById("pwValidationId");
    pwId.style.display = "none";
}

$("#loginFormId").submit(function(e) {
        var email = document.getElementById("email_un_id").value; 
        var pw =document.getElementById("passwordId").value;
            if(!email){
            var unValidationId = document.getElementById("unValidationId");
            unValidationId.style.display = "block";
            var pwValidationId = document.getElementById("pwValidationId");
            pwValidationId.style.display = "none";
            e.preventDefault();
            return;
        }
        if(!pw){
                var unValidationId = document.getElementById("unValidationId");
                unValidationId.style.display = "none";
                var pwValidationId = document.getElementById("pwValidationId");
                pwValidationId.style.display = "block";
                e.preventDefault();
                return;
            }
        });
</script>

</body>
</html>    
<?php include 'view/partials/login_footer.php';
