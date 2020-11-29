    <!-- The actual snackbar -->
    <div id="snackbar">User Successfully Signed up...</div> 
    <script src="libs/main.js"></script>
    <script>
        function signupDisplay(){
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
            var emailValidId = document.getElementById("emailValidId");
            emailValidId.style.display = "none";
            var passwordValidId = document.getElementById("passwordValidId");
            passwordValidId.style.display = "none";
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