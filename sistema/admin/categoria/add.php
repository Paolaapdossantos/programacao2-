<?php

include("../config.inc.php");
include("../session.php");
validaSessao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	extract($_POST);
	$error = "";
	
	if (!$nome) {
		$error .= " Nome obrigatório! ";
	}
	if (!$error) {
        $link = mysqli_connect("localhost", "root", "", "sistema");
        $categoria_id_sql = ($categoria_id && is_numeric($categoria_id)) ? $categoria_id : "NULL";
        $sql = "";
        $sql .= " INSERT INTO prod ";
        $sql .= " (nome, preco, categoria_id) ";
        $sql .= " VALUES ";
        $sql .= " ('".$nome."', '".$preco."', ".$categoria_id_sql.")";
        $result = mysqli_query($link, $sql);
        header("Location: /programacao2-/sistema/admin/prod/upd.php");
        exit;
    }
}

include("../../header.php");
include("../menu.php");

?>

<h3>ADICIONAR CATEGORIA</h3>

<?php
if (isset($error)) {
	echo "<span style=\"color: red; font-style: italic;\">";
	echo $error;
	echo "</span>";
}
?>

<form method="POST">
	<table>
		<tr>
			<td style="text-align: right;">Nome:</td>
			<td>
				<input type="text" name="nome" value="<?= isset($nome) ? htmlspecialchars($nome) : ""; ?>">
			</td>
		</tr>

		<tr>
			<td colspan="2" style="text-align: center;">
				<input type="submit" name="submit" value="Cadastrar">
			</td>
		</tr>
		<tr>
		<td colspan="2" style="text-align: center;">
			<button style ="background-color: #f8c8dc;"><a href="/programacao2-/sistema/admin/categoria/" style="color: black;">Voltar</a></button>	
			</td>
		</tr>
	</table>
</form>

<?php
include("../../footer.php");
?>
