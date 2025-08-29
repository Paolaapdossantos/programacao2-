<?php
if (isset($_GET["a"])) {
if (isset($_COOKIE["favoritos"])) {
if (strpos($_COOKIE["favoritos"], "'".$_GET["a"]."'") === false) {
setcookie("favoritos",
$_COOKIE["favoritos"].",'".$_GET["a"]."'",
time()+60*60*24*30);
}
} else {
setcookie("favoritos", "'".$_GET["a"]."'", time()+60*60*24*30);
}
header("Location: ./favoritos.php");
exit;
} elseif (isset($_GET["r"])) {
if (isset($_COOKIE["favoritos"])) {
if (strpos($_COOKIE["favoritos"], "'".$_GET["r"]."'") !== false) {
$favoritos = $_COOKIE["favoritos"];
$favoritos = str_replace(",'".$_GET["r"]."'," , ",", $favoritos);
$favoritos = str_replace("'".$_GET["r"]."'," , "", $favoritos);
$favoritos = str_replace(",'".$_GET["r"]."'" , "", $favoritos);
$favoritos = str_replace("'".$_GET["r"]."'" , "", $favoritos);
setcookie("favoritos", $favoritos, time()+60*60*24*30);
}
}
header("Location: ./favoritos.php");
exit;
}
?>
<html>
<head>
<title>Favoritos</title>
</head>
<body>
<a href="./index.php">Index</a><br><br>
<?php
if (isset($_COOKIE["favoritos"])) {
$link = mysqli_connect("localhost", "root", "", "webdev");
$sql = "SELECT * FROM Item WHERE
id IN (".$_COOKIE["favoritos"].") ORDER BY name";
$result = mysqli_query($link, $sql);
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
echo $row["name"]." <a href=\"./favoritos.php?r=".$row["id"]."\">
REMOVA
</a><br>";
}
}
} else {
echo "Sem Favoritos!<br>";
}
?>
<br><a href="./index.php">Index</a>
</body>
</html>