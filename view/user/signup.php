<html>
<body onload="loadFunction()">
<?php include 'view/partials/login_header.php'; ?>
    <form action="http://localhost/Main/index.php?page=signup.php" method="post" id="signupFormId">
        <!--Common details-->
        <div id="commonDataId">
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Username</div> 
                <div class="col-1-item"><input type="text" placeholder="Username" id="un_id" name="uname"></div>
                <div class="col-2-item"><span style="color:red" id="usernameValidId">Username required</span></div>
            </div>
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">First name</div> 
                <div class="col-1-item"><input type="text" placeholder="First name" id="fnameId" name="first_name"></div>
                <div class="col-2-item"><span style="color:red" id="fnameValidId">First name required</span></div>
            </div>
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Middle name</div> 
                <div class="col-1-item"><input type="text" placeholder="Middle name" id="mnameId" name="middle_name"></div>
                <div class="col-2-item"><span style="color:red" id="mnameValidId">Middle name required</span></div>
            </div>
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Last name</div> 
                <div class="col-1-item"><input type="text" placeholder="Last name" id="lnameId" name="last_name"></div>
                <div class="col-2-item"><span style="color:red" id="lnameValidId">Last name required</span></div>
            </div>
            <div class="col-6-item">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Email</div> 
                <div class="col-1-item"><input type="text" placeholder="Email" id="email_id" name="email"></div>
                <div class="col-2-item"><span style="color:red" id="emailValidId">Invalid Email</span></div>
            </div>
            <div class="col-6-item">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Password</div> 
                <div class="col-1-item"><input class="password" type="password" style="password" placeholder="Password" id="pwId" name="pw"></div>
                <div class="col-2-item"><span style="color:red" id="passwordValidId">Password required</span></div>
            </div>
            <div class="col-6-item">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Re-enter Password</div> 
                <div class="col-1-item"><input class="password" type="password" style="password" placeholder="Re-enter Password" id="confirmPWId" name="confirmPW"></div>
                <div class="col-2-item"><span style="color:red" id="confirmpasswordValidId">Re-enter Password required</span></div>
            </div>
            <div class="col-5-item">
                <div class="col-3-item"></div>
                <div class="col-1-item"><button class="bg-dblue border-dblue" type="button" onclick="continueBtnFunc();" id="continueButtonId" name="continueBtn">Continue</button></div>
            </div>
        </div>
        <!--lecturer details-->
        <div id="lecturerDataId">
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Designation</div> 
                <div class="col-1-item">
                    <select name="designation" id="cars">
                        <option value="lecturer">Lecturer</option>
                        <option value="instructor">Instructor</option>
                    </select>
                </div>
                <div class="col-2-item"></div>
            </div>
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Subjects</div> 
                <div class="col-2-item">
                    <div class="custom-select" id="custom-select">Select Subjects..</div>
                    <div id="custom-select-option-box" style="height: 110px; overflow: auto;">
                        <?php 
                            foreach($subjects as $subject){
                                echo "<div class='custom-select-option'> <input onchange='toggleFillColor(this);'  class='custom-select-option-checkbox' type='checkbox' name='lecSubjcts[]' value='".$subject['subject_code']."'> ".$subject['subject_name']." </div>";  
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-5-item">
                <div class="col-3-item"></div>
                <div class="col-1-item">
                    <button class="bg-dblue border-dblue" type="submit" id="lecSignUp" name="signUpBtnLec">Sign Up</button>
                </div>
            </div>
        </div>
        <!--student details-->
        <div id="stuDataId">
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Academic Year</div> 
                <div class="col-1-item">
                    <select name="year" id="cars">
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                    </select>
                </div>
                <div class="col-2-item"></div>
            </div>
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Index Number</div> 
                <div class="col-1-item"><input type="text" placeholder="Index Number" id="indexNum_id" name="indexNum"></div>
                <div class="col-2-item"><span style="color:red" id="indexNumValidId">Index Number required</span></div>
            </div>
            <div class="col-6-item" >
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Subjects</div> 
                <div class="col-2-item">
                    <div class="custom-select-stu" id="custom-select-stu">Select Subjects..</div>
                    <div id="custom-select-option-box-stu" style="height: 67px; overflow: auto;">
                        <?php 
                            foreach($subjects as $subject){
                                echo "<div class='custom-select-option-stu'> <input onchange='toggleFillColor(this);'  class='custom-select-option-checkbox-stu' type='checkbox' name='stuSubjcts[]' value='".$subject['subject_code']."'> ".$subject['subject_name']." </div>";  
                            }
                        ?>
                    </div>
                </div>
                <div class="col-2-item"></div>
            </div>
            <div class="col-5-item">
                <div class="col-3-item"></div>
                <div class="col-1-item">
                    <button class="bg-dblue border-dblue" type="submit" id="stuSignUpStu" name="signUpBtnStu">Sign Up</button>
                </div>
            </div>
        </div>
    </form>

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