<?php

include("../config.inc.php");
include("../session.php");
validaSessao();
if (!isset($_GET["id"])) {
    header("Location: /programacao2-/sistema/admin/categoria/");
    exit;
}
 
$link = mysqli_connect("localhost", "root", "", "sistema");
$sql = "SELECT * FROM categoria WHERE id=" . $_GET["id"] . ";";
$result = mysqli_query($link, $sql);
 
if (mysqli_num_rows($result) == 0) {
    header("Location: /programacao2-/sistema/admin/categoria/");
    exit;
}

$row = mysqli_fetch_assoc($result);
extract($row);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    $error = "";
 
    if (!$nome) {
        $error .= "Nome obrigatório! ";
    }
 
    if (!$error) {
        $link = mysqli_connect("localhost", "root", "", "sistema");
       $sql = "UPDATE categoria SET nome = '" . $nome . "' WHERE id = " . $id . ";";
        $result = mysqli_query($link, $sql);

        header("Location: /programacao2-/sistema/admin/categoria/");
        exit;
    }
}
 
include("../../header.php");
include("../menu.php");
?>
 
<h3>EDITAR CATEGORIA</h3>
 
<?php
if (isset($error) && $error) {
    echo "<span style='color:red; font-style:italic;'>" . $error . "</span>";
}
?>
 
<form method="POST">
    <input type="hidden" name="id" value="<?= isset($id) ? $id : "" ?>">
    <table>
        <tr>
            <td style="text-align: right;">Nome:</td>
            <td>
                <input type="text" name="nome" value="<?= isset($nome) ? $nome : "" ?>">
            </td>
        </tr>
    </table>
    <br>
    <input type="submit" value="Salvar">
</form>
<?
