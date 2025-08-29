<html>
<head>
<title>AJAX Index</title>
<style type="text/css" media="all">
.controlPhoneHide {
display: none;
}
.controlPhoneShow {
display: visible;
}
</style>
<script language="javascript" type="text/javascript">
<!--
function showPhone(itemid) {
try {
xmlhttp = new XMLHttpRequest();
} catch (exc) {
try {
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (ex) {
try {
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e) {
xmlhttp = false;
}
}
}
if (xmlhttp) {
xmlhttp.open("GET", './countphoneclick.php?item_id='+itemid, true);
xmlhttp.send(null);
}
document.getElementById("phoneLink"+itemid).className =
"controlPhoneHide";
document.getElementById("phoneNumber"+itemid).className =
"controlPhoneShow";
}
//-->
</script>
</head>
<body>
<?php
$link = mysqli_connect("localhost", "root", "", "webdev");
$sql = "SELECT * FROM Item ORDER BY name";
$result = mysqli_query($link, $sql);
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
?>
<?=$row["name"];?>
<span id="phoneLink<?=$row["id"];?>" class="controlPhoneShow">
<a href="javascript:showPhone('<?=$row["id"]?>');">phone</a>
</span>
<span id="phoneNumber<?=$row["id"];?>" class="controlPhoneHide">
<?=$row["phone"];?>
</span>
<br>
<?php
}
}
?>
</body>
</html>