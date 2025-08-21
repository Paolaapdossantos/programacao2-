<?php
function validate_form($array, &$error) {
extract($array);
$error = "";
if (!$name) $error .= " Nome Vazio! ";
if (!$day) $error .= " Dia Vazio! ";
if (!$month) $error .= " Mes Vazio! ";
if (!$year) {
$error .= " Ano Vazio! ";
} elseif (strlen($year) != 4) {
$error .= " Ano Errado! ";
}
if ($error) {
$error = "Errors: ".$error." ";
return false;
} else {
    return true;
}
}
?>
