<?php

include("../config.inc.php");
include("../session.php");
validaSessao();
$id_usuario_logado = $_SESSION["CONTA_ID"]; 


if ($_SERVER["REQUEST_METHOD"] == "POST") { // Isso verifica se o formulário foi enviado via método POST, ou seja, se o usuário clicou em “Salvar”, “Enviar”, etc.//
	extract($_POST);
	$error = "";
	if (!$nome) {
		$error .= " Nome obrigatório! ";
	}
	if (!$preco) {
		$error .= " Preço obrigatório! ";
	}
	if (!$error) {
        $link = mysqli_connect("localhost", "root", "", "sistema");
        $categoria_id_sql = ($categoria_id && is_numeric($categoria_id)) ? $categoria_id : "NULL";
        $sql = "";
        $sql .= " INSERT INTO prod ";
        $sql .= " (nome, preco, categoria_id,id_usuario) ";
        $sql .= " VALUES ";
        $sql .= " ('".$nome."', '".$preco."', ".$categoria_id_sql.", ".$id_usuario_logado.")";
        $result = mysqli_query($link, $sql);
        header("Location: /programacao2-/sistema/admin/prod/add.php");
        exit;
    }
}

include("../../header.php");
include("../menu.php");

?>

<h3>ADICIONAR PRODUTO</h3>

<?php
if (isset($error)) {
	echo "<span style=\"color: red; font-style: italic;\">";
	echo $error;
	echo "</span>";
}
?>

<?php
$link = mysqli_connect("localhost", "root", "", "sistema");
$sqlCategorias = "SELECT id, nome FROM categoria ORDER BY nome";
$resultCategorias = mysqli_query($link, $sqlCategorias);
?>

<form method="POST">
	<table>
		<tr>
			<td style="text-align: right;">Nome:</td>
			<td>
				<input type="text" name="nome" value="<?=isset($nome) ? htmlspecialchars($nome) : "";?>">
			</td>
		</tr>
		<tr>
			<td style="text-align: right;">Preço:</td>
			<td>
				<input type="text" name="preco" value="<?=isset($preco) ? htmlspecialchars($preco) : "";?>">
			</td>
		</tr>
		<tr>
			<td style="text-align: right;">Categoria:</td>
			<td>
				<select name="categoria_id">
					<option value="">-- Selecione --</option>
					<?php
					while ($cat = mysqli_fetch_assoc($resultCategorias)) {
						$selected = (isset($categoria_id) && (string)$categoria_id === (string)$cat['id']) ? "selected" : "";
						echo "<option value='" . $cat['id'] . "' $selected>" . htmlspecialchars($cat['nome']) . "</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<input type="submit" name="submit" value="Cadastrar">
			</td>
		</tr>
	</table>
</form>

<?php
include("../../footer.php");
?>
