<?php
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", FALSE);
header("Pragma: no-cache");
$link = mysqli_connect("localhost", "root", "", "webdev");
$sql = "SELECT phone FROM Item WHERE id = '".$_GET["item_id"]."'";
$result = mysqli_query($link, $sql);
if ($result) {
if ($row = mysqli_fetch_assoc($result)) {
echo $row["phone"];
}
}
?>