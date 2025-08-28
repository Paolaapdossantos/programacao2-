<?php
include("./function.php");
validaSessao();
include("./header.php");
include("./menu.php");
echo "<h1>Pag 01</h1>";
echo "Conta logada!<br>Conta: ".$_SESSION["CONTA_ID"]."";
include("./footer.php");
?>
