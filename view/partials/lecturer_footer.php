</td>

<td style="width:20%;border: none;">
<div class="col-6-item bg-gray lefthometab" style="height: 100%">
<div class="bg-gray" style="border-radius:0px;">
<?php
if($notification == 1){
    echo '<h3 style="margin-left:20px">You have Turned off Notification</h3>';
}else{
    echo '<h3 style="margin-left:20px">Upcomming Meetings</h3>';
        $flag=0;
        if(!empty($meetingdetails)){
            foreach($meetingdetails as $day){
                echo '<ul>';
                if(!empty($day['meeting_time'])){
                    $flag=1;
                    echo  '<li><p>You have a meeting with lecturer '.$day['first_name'].' '.$day['last_name'].' on '.$day['meeting_date'].' at '.$day['meeting_time'].' </li>';
                }
                echo '</ul>';
            }
        }

        if($flag==0){
            echo '<h3 style="margin-left:20px">No upcomming Meetings</h3>';
        }
}
?>
</div>
<hr>
<div class="bg-gray" style="border-radius:0px;">
    <h3 style="margin-left:20px">Interest List</h3>
    <ul style="list-style-type: square;">
    <?php
        while($row = mysqli_fetch_assoc($subjects)) {
        echo "<li>". $row['subject_name']. "</li>";
        }
    ?>
    </ul> 
</div>
</div>
</td>
</tr>
</table>

</div>
<script src="libs/js/dnd.js"></script>
<script src="libs/main.js"></script>
<script>

//drop down button
function dropdownpaper() {
document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
var input, filter, ul, li, a, i,b;
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
b=document.getElementById('complian');
b.style.display="";
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