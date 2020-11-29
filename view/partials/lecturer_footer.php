</td>

<td style="width:20%;border: 1px solid black;">
    <div class="bg-gray">
        <h4 style="text-align:center;">Interest List</h4>
        <ul style="list-style-type: square;">
            <?php
                while($row = mysqli_fetch_assoc($subjects)) {
                    echo "<li>". $row['subject_name']. "</li>";
                }
            ?>
        </ul> 
        <div style="text-align:center;">
            <form action="http://localhost/Main/lecturerindex.php" method="post" id="addSubjectsForm">
                <div class="custom-select-stu" id="custom-select-stu" style="color:black">Select More..</div>
                <div id="custom-select-option-box-stu" style="height: 67px; overflow: auto;">
                    <?php 
                        foreach($allSubjects as $subject){
                           echo "<div class='custom-select-option'> <input onchange='toggleFillColor(this);'  class='custom-select-option-checkbox' type='checkbox' name='addSubjcts[]' value='".$subject['subject_code']."'> ".$subject['subject_name']." </div>";  
                        }
                    ?>
                </div>
                <button class="bg-dblue border-dblue" type="submit" style="width:30%" name='updtintlst'>Add</button>
            </form>            
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
<script src="libs/main.js"></script>
<script>

//drop down button
function dropdownpaper() {
document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
var input, filter, ul, li, a, i;
input = document.getElementById("myInput");
filter = input.value.toUpperCase();
div = document.getElementById("myDropdown");
a = div.getElementsByTagName("a");
for (i = 0; i < a.length; i++) {
txtValue = a[i].textContent || a[i].innerText;
if (txtValue.toUpperCase().indexOf(filter) > -1) {
a[i].style.display = "";
} else {
a[i].style.display = "none";
}
}
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

</script>
</div>
</body>
</html>