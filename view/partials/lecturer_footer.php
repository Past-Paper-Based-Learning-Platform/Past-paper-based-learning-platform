</td>

<td style="width:20%;border: none;">
<div class="col-6-item bg-gray lefthometab" style="height: 100%">
    <div class="bg-gray" style="border-radius:0px;">
        <h4 style="text-align:center;">Notification</h4>
    <div>
    <p>Date: <input type="text" id="datepicker"></p>
    <div style="text-align:center;">
      <a href="#">complain</a><br/><br/>
    <div> 
</div>
</td>
</tr>
</table>

</div>
<script src="libs/dnd.js"></script>
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