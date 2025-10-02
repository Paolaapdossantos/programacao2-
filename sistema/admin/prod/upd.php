<?php

include("../config.inc.php");
include("../session.php");
validaSessao();

if (!isset($_GET["id"])) {
    header("Location: /programacao2-/sistema/admin/prod/");
    exit;
}

$link = mysqli_connect("localhost", "root", "", "sistema");
$sql = "SELECT * FROM prod WHERE id=" . $_GET["id"] . ";";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 0) {
    header("Location: /programacao2-/sistema/admin/prod/");
    exit;
}

$row = mysqli_fetch_assoc($result);

$error = "";
// Define o valor atual da categoria com base no POST (se existir) ou no valor do banco
$categoria_id_atual = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : $row['categoria_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    if (!$nome) {
        $error .= "Nome obrigatório! ";
    }
    if (!$preco) {
        $error .= "Preço obrigatório! ";
    }

    if (!$error) {
        $categoria_id_sql = ($categoria_id && is_numeric($categoria_id)) ? $categoria_id : "NULL";
        
        $sql = "UPDATE prod SET nome='" . mysqli_real_escape_string($link, $nome) . "', preco=" . floatval($preco) . ", categoria_id = " . $categoria_id_sql . " WHERE id=" . intval($id) . ";";
        mysqli_query($link, $sql);

        header("Location: /programacao2-/sistema/admin/prod/");
        exit;
    } else {
        // Se houver erro, mantém a seleção atual da categoria para mostrar no form
        $categoria_id_atual = $categoria_id;
    }
}

// Buscar categorias para popular o select
$sqlCategorias = "SELECT id, nome FROM categoria ORDER BY nome";
$resultCategorias = mysqli_query($link, $sqlCategorias);

include("../../header.php");
include("../menu.php");
?>

<h3>EDITAR PRODUTO</h3>

<?php
if ($error) {
    echo "<span style='color:red; font-style:italic;'>" . htmlspecialchars($error) . "</span>";
}
?>

<form method="POST">
    <input type="hidden" name="id" value="<?= isset($row['id']) ? intval($row['id']) : '' ?>">
    <table>
        <tr>
            <td style="text-align: right;">Nome:</td>
            <td>
                <input type="text" name="nome" value="<?= isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : htmlspecialchars($row['nome']) ?>">
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Preço:</td>
            <td>
                <input type="text" name="preco" value="<?= isset($_POST['preco']) ? htmlspecialchars($_POST['preco']) : htmlspecialchars($row['preco']) ?>">
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Categoria:</td>
            <td>
                <select name="categoria_id">
                    <option value="">-- Selecione --</option>
                    <?php
                    while ($cat = mysqli_fetch_assoc($resultCategorias)) {
                        $selected = ($categoria_id_atual == $cat['id']) ? "selected" : "";
                        echo "<option value='" . $cat['id'] . "' $selected>" . htmlspecialchars($cat['nome']) . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <br>
    <input type="submit" value="Salvar">
</form>

<?php
include("../../footer.php");
?>
