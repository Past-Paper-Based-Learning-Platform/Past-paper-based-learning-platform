<html>
<body onload="loadFunction()">
<?php include 'view/partials/login_header.php'; ?>
<section class="gridcontainer">
    <div class='signupform'>
            <h1 style="margin-left:16px;">Sign Up</h1>
            <hr style="width:90%;border: 1px solid #f1f1f1;">

    <form action="http://localhost/Main/index.php?page=signup.php" method="post" id="signupFormId">
        <div class="container">

        <!--Common details-->
        <div id="commonDataId">
                <br>
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Username" id="un_id" name="uname">
                <span style="color:red; display:none;" id="usernameValidId">Username required</span>
            
                <br>
                <label for="uname"><b>First Name</b></label>
                <input type="text" placeholder="First name" id="fnameId" name="first_name">
                <span style="color:red; display:none;" id="fnameValidId">First name required</span>

                <br>
                <label for="uname"><b>Middle Name</b></label>
                <input type="text" placeholder="Middle name" id="mnameId" name="middle_name">
                <span style="color:red; display:none;" id="mnameValidId">Middle name required</span>
                
                <br>
                <label for="uname"><b>Last Name</b></label>
                <input type="text" placeholder="Last name" id="lnameId" name="last_name">
                <span style="color:red; display:none;" id="lnameValidId">Last name required</span>
            
                <br>
                <label for="uname"><b>Email</b></label>
                <input type="text" placeholder="Email" id="email_id" name="email">
                <span style="color:red; display:none;" id="emailValidId">Invalid Email</span>

                <br>
                <label for="psw"><b>Password</b></label>
                <input class="password" type="password" style="password" placeholder="Password" id="pwId" name="pw">
                <span style="color:red; display:none;" id="passwordValidId">Password required</span>
            
                <br>
                <label for="psw"><b>Re-Enter Password</b></label>
                <input class="password" type="password" style="password" placeholder="Re-enter Password" id="confirmPWId" name="confirmPW">
                <span style="color:red; display:none;" id="confirmpasswordValidId">Re-enter Password required</span>

            
                <br>
                <button class="bg-dblue border-dblue" type="button" onclick="continueBtnFunc();" id="continueButtonId" name="continueBtn">Continue</button>
        </div>
        <!--lecturer details-->
        <div id="lecturerDataId">
          
                    <br><label for="designation"><b>Designation</b></label> 
                    <select name="designation" id="cars">
                        <option value="lecturer">Lecturer</option>
                        <option value="instructor">Instructor</option>
                    </select>
                
                
            
            
                
                    <br><label for="lecsubjects"><b>Subjects</b></label> 
                    <div class="custom-select" id="custom-select">Select Subjects..</div>
                    <div id="custom-select-option-box" style="height: 110px; overflow: auto;">
                        <?php 
                            foreach($subjects as $subject){
                                echo "<div class='custom-select-option'> <input onchange='toggleFillColor(this);'  class='custom-select-option-checkbox' type='checkbox' name='lecSubjcts[]' value='".$subject['subject_code']."'> ".$subject['subject_name']." </div>";  
                            }
                        ?>
                    </div>       
                
                    <br><button class="bg-dblue border-dblue" type="submit" id="lecSignUp" name="signUpBtnLec">Sign Up</button>
    
        </div>
        <!--student details-->
        <div id="stuDataId">
    
                    <br><label for="year"><b>Academic year</b></label>
                    <select name="year" id="cars">
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                    </select>
            
            
                    <br><label for="indexNum"><b>Index number</b></label>
                    <input type="text" placeholder="Index Number" id="indexNum_id" name="indexNum">
                    <span style="color:red; display:none;" id="indexNumValidId">Index Number required</span>
            
            
                
                    <br><label for="stuSubjects"><b>Subjects</b></label>
                    <div class="custom-select-stu" id="custom-select-stu">Select Subjects..</div>
                    <div id="custom-select-option-box-stu" style="height: 67px; overflow: auto;">
                        <?php 
                            foreach($subjects as $subject){
                                echo "<div class='custom-select-option-stu'> <input onchange='toggleFillColor(this);'  class='custom-select-option-checkbox-stu' type='checkbox' name='stuSubjcts[]' value='".$subject['subject_code']."'> ".$subject['subject_name']." </div>";  
                            }
                        ?>
                    </div>

                    <br><button class="bg-dblue border-dblue" type="submit" id="stuSignUpStu" name="signUpBtnStu">Sign Up</button>
               
        </div>

        </div>
    </form>

    <div class="container" style="background-color:#f1f1f1; color:midnightblue;">
                <button class='loginbtn' type="button" onclick="document.location='index.php?page=login.php'" >Login>></button>
            </div>
        </div>
    </section>

    <script>
    function loadFunction(){
        var unval = document.getElementById("usernameValidId");
        unval.style.display = "none";
        var fnameval = document.getElementById("fnameValidId");
        fnameval.style.display = "none";
        var mnameval = document.getElementById("mnameValidId");
        mnameval.style.display = "none";
        var lnameval = document.getElementById("lnameValidId");
        lnameval.style.display = "none";
        var emailval = document.getElementById("emailValidId");
        emailval.style.display = "none";
        var pwval = document.getElementById("passwordValidId");
        pwval.style.display = "none";
        var confirmpwval = document.getElementById("confirmpasswordValidId");
        confirmpwval.style.display = "none";
        var studentData = document.getElementById("stuDataId");
        studentData.style.display = "none";
        var lecturerData = document.getElementById("lecturerDataId");
        lecturerData.style.display = "none";
        var commonData = document.getElementById("commonDataId");
        commonData.style.display = "block";
        var unValidationId = document.getElementById("unValidationId");
        unValidationId.style.display = "none";
        var pwValidationId = document.getElementById("pwValidationId");
        pwValidationId.style.display = "none";
        var usernameValidId = document.getElementById("usernameValidId");
        usernameValidId.style.display = "none";
        var confirmpasswordValidId = document.getElementById("confirmpasswordValidId");
        confirmpasswordValidId.style.display = "none";
        var indexNumValidId = document.getElementById("indexNumValidId");
        indexNumValidId.style.display = "none";
    }

    function continueBtnFunc(){
            var studentData = document.getElementById("stuDataId");
            studentData.style.display = "none";
            var lecturerData = document.getElementById("lecturerDataId");
            lecturerData.style.display = "none";
            var username = document.getElementById("un_id").value;
            var password = document.getElementById("pwId").value;
            var reenterpw = document.getElementById("confirmPWId").value;
            var email = document.getElementById("email_id").value; 
            var fname = document.getElementById("fnameId").value;
            var mname = document.getElementById("mnameId").value;
            var lname = document.getElementById("lnameId").value;
            
            if(!email.includes("lec") && !email.includes("stu")){
                var emailValidId = document.getElementById("emailValidId");
                emailValidId.style.display = "block";
                return;
            }

            //check email valid
            if(!validateEmail(email)){
                var emailValidId = document.getElementById("emailValidId");
                emailValidId.style.display = "block";
                return;
            }

            //check username, password and re-enter password empty
            if(!username){
                var usernameValidId = document.getElementById("usernameValidId");
                usernameValidId.style.display = "block";
                return;
            }
            if(!fname){
                var fnameValidId = document.getElementById("fnameValidId");
                fnameValidId.style.display = "block";
                return;
            }
            if(!mname){
                var mnameValidId = document.getElementById("mnameValidId");
                mnameValidId.style.display = "block";
                return;
            }
            if(!lname){
                var lnameValidId = document.getElementById("lnameValidId");
                lnameValidId.style.display = "block";
                return;
            }
            if(!password){
                var passwordValidId = document.getElementById("passwordValidId");
                passwordValidId.style.display = "block";
                return;
            }
            if(!reenterpw){
                var confirmpasswordValidId = document.getElementById("confirmpasswordValidId");
                confirmpasswordValidId.style.display = "block";
                return;
            }

            //check password and re-enter password are similar
            if(password!=reenterpw){
                alert("password and re-enter password does not match");
                return;
            }
            
            var commonData = document.getElementById("commonDataId");
            commonData.style.display = "none";

            if(email.includes("lec")){
                var lecturerData = document.getElementById("lecturerDataId");
                lecturerData.style.display = "block";
            }else if(email.includes("stu")){
                var studentData = document.getElementById("stuDataId");
                studentData.style.display = "block";
            }

        }

        $(document).ready(function(){
            $("#email_un_id").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#email_un_id").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var unValidationId = document.getElementById("unValidationId");
                    unValidationId.style.display = "none";
                    var loginerr = document.getElementById("loginerrId");
                    loginerr.style.display = "none";
                }
            });

            $("#passwordId").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#passwordId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var pwValidationId = document.getElementById("pwValidationId");
                    pwValidationId.style.display = "none";
                    var loginerr = document.getElementById("loginerrId");
                    loginerr.style.display = "none";
                }
            });

            $("#un_id").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#passwordId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var usernameValidId = document.getElementById("usernameValidId");
                    usernameValidId.style.display = "none";
                }
            });
            
            $("#email_id").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#passwordId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var emailValidId = document.getElementById("emailValidId");
                    emailValidId.style.display = "none";
                }
            });
            
            $("#pwId").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#pwId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var passwordValidId = document.getElementById("passwordValidId");
                    passwordValidId.style.display = "none";
                }
            });
            
            $("#confirmPWId").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#passwordId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var confirmpasswordValidId = document.getElementById("confirmpasswordValidId");
                    confirmpasswordValidId.style.display = "none";
                }
            });

            $("#indexNum_id").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#indexNum_id").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var indexNumValidId = document.getElementById("indexNumValidId");
                    indexNumValidId.style.display = "none";
                }
            });

            $("#fnameId").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#fnameId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var indexNumValidId = document.getElementById("fnameValidId");
                    indexNumValidId.style.display = "none";
                }
            });

            $("#mnameId").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#mnameId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var indexNumValidId = document.getElementById("mnameValidId");
                    indexNumValidId.style.display = "none";
                }
            });

            $("#lnameId").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#lnameId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var indexNumValidId = document.getElementById("lnameValidId");
                    indexNumValidId.style.display = "none";
                }
            });
        });

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }

        $("#signupFormId").submit(function(e) {
            var index = document.getElementById("indexNum_id").value; 
            var email = document.getElementById("email_id").value; 
            if(!index && email.includes("stu")){
                var indexNumValidId = document.getElementById("indexNumValidId");
                indexNumValidId.style.display = "block";
                e.preventDefault();
                return;
            }

            toasFunction();
        });

        function toasFunction() {
            
            // Get the snackbar DIV
            var x = document.getElementById("snackbar");
        
            // Add the "show" class to DIV
            x.className = "show";
        
            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
            //location.reload(); 
        } 

        $("#custom-select").on("click", function() {
		$("#custom-select-option-box").toggle();
	});
	function toggleFillColor(obj) {
		$("#custom-select-option-box").show();
		if ($(obj).prop('checked') == true) {
			$(obj).parent().css("background", '#c6e7ed');
		} else {
			$(obj).parent().css("background", '#FFF');
		}
	}
	$(".custom-select-option").on("click", function(e) {
		var checkboxObj = $(this).children("input");
		if ($(e.target).attr("class") != "custom-select-option-checkbox") {
			if ($(checkboxObj).prop('checked') == true) {
				$(checkboxObj).prop('checked', false)
			} else {
				$(checkboxObj).prop("checked", true);
			}
		}
		toggleFillColor(checkboxObj);
	});

	$("body")
		.on("click",
        function(e) {
            if (e.target.id != "custom-select"
                    && $(e.target).attr("class") != "custom-select-option") {
                $("#custom-select-option-box").hide();
            }
        });

        //stu subject drop down
        $("#custom-select-stu").on("click", function() {
		$("#custom-select-option-box-stu").toggle();
	});
	function toggleFillColor(obj) {
		$("#custom-select-option-box-stu").show();
		if ($(obj).prop('checked') == true) {
			$(obj).parent().css("background", '#c6e7ed');
		} else {
			$(obj).parent().css("background", '#FFF');
		}
	}
	$(".custom-select-option-stu").on("click", function(e) {
		var checkboxObj = $(this).children("input");
		if ($(e.target).attr("class") != "custom-select-option-checkbox-stu") {
			if ($(checkboxObj).prop('checked') == true) {
				$(checkboxObj).prop('checked', false)
			} else {
				$(checkboxObj).prop("checked", true);
			}
		}
		toggleFillColor(checkboxObj);
	});

	$("body")
			.on(
					"click",
					function(e) {
						if (e.target.id != "custom-select-stu"
								&& $(e.target).attr("class") != "custom-select-option-stu") {
							$("#custom-select-option-box-stu").hide();
						}
					});
    </script>

    </body>
    </html>
<?php include 'view/partials/login_footer.php'; ?>