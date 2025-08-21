<?php
include("./conf/config.inc.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {extract($_POST);
if (validate_form($_POST, $error)) {
$dbObj = new mysql();
$sql = "";
$sql .= " INSERT INTO client ";
$sql .= " (name, date, entered) ";
$sql .= " VALUES ";
$sql .= " ('".$name."', '".$year."-".$month."-".$day."', NOW())";
$result = $dbObj->query($sql);
header("Location: ".SITE_URL."/success.php");
exit;
}
}
include(SITE_ROOT."/layout/header.php");
?>
<h1>Novo Cliente</h1>
<?php
if (isset($error)) {
echo "<span style=\"color: red; font-style: italic;\">";
echo $error;
echo "</span>";
}
?>
<form action="<?=SITE_URL?>/index.php" method="POST">
<?php include(SITE_ROOT."/includes/formnewclient.php"); ?>
</form>
<?php
include(SITE_ROOT."/layout/footer.php");
?>