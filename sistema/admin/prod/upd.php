<?php

include("../config.inc.php");
include("../session.php");
validaSessao();

$id = "";
if ($_GET["id"]) $id = $_GET["id"];
elseif ($_POST["id"]) $id = $_POST["id"];
if (!$id) {
    header("Location: /programacao2-/sistema/admin/prod/");
    exit;
}

$link = mysqli_connect("localhost", "root", "", "sistema");

// 🔹 Pega o ID do usuário logado
$id_usuario_logado = $_SESSION["CONTA_ID"];

// 🔹 Corrigido: usa $id (não $id_produto)
$sql = "SELECT id, id_usuario, nome, preco, categoria_id FROM prod WHERE id = $id";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 0) {
    header("Location: /programacao2-/sistema/admin/prod/");
    exit;
}

$row = mysqli_fetch_assoc($result);
extract($row);

// 🔹 Verifica se o produto pertence ao usuário logado
if ($row["id_usuario"] != $id_usuario_logado) {
    echo "❌ Você não tem permissão para editar este produto!<br><br>";
    echo '<button style="background-color: #f8c8dc; border: none; padding: 8px 16px; border-radius: 6px;">
            <a href="/programacao2-/sistema/admin/prod/" style="color: black; text-decoration: none;">Voltar</a>
          </button>';
    exit;
}

// 🔹 Processa o envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    $error = "";

    if (!$nome) {
        $error .= " Nome obrigatório! ";
    }
    if (!$preco) {
        $error .= " Preço obrigatório! ";
    }

    if (!$error) {
        $categoria_id = $_POST['categoria_id'] ?? null;
        $sql = "UPDATE prod 
                SET nome = '$nome', preco = '$preco', categoria_id = '$categoria_id' 
                WHERE id = '$id'";
        $result = mysqli_query($link, $sql);
        header("Location: /programacao2-/sistema/admin/prod/");
        exit;
    }
}

include("../../header.php");
include("../menu.php");
?>

<h3>EDITAR PRODUTO</h3>

<?php
if (isset($error) && $error) {
    echo "<span style=\"color: red; font-style: italic;\">$error</span>";
}
?>

<?php
$sqlCategorias = "SELECT id, nome FROM categoria ORDER BY nome";
$resultCategorias = mysqli_query($link, $sqlCategorias);
?>

<form method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
    <table>
        <tr>
            <td style="text-align: right;">Nome:</td>
            <td><input type="text" name="nome" value="<?= htmlspecialchars($nome) ?>"></td>
        </tr>
        <tr>
            <td style="text-align: right;">Preço:</td>
            <td><input type="text" name="preco" value="<?= htmlspecialchars($preco) ?>"></td>
        </tr>
        <tr>
            <td style="text-align: right;">Categoria:</td>
            <td>
                <select name="categoria_id">
                    <option value="">-- Selecione --</option>
                    <?php
                    while ($cat = mysqli_fetch_assoc($resultCategorias)) {
                        $selected = ((string)$categoria_id === (string)$cat['id']) ? "selected" : "";
                        echo "<option value='" . $cat['id'] . "' $selected>" . htmlspecialchars($cat['nome']) . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <button style="background-color: #f8c8dc; border: none; padding: 8px 16px; border-radius: 6px;">
                    <a href="/programacao2-/sistema/admin/prod/" style="color: black; text-decoration: none;">Voltar</a>
                </button>
                <input type="submit" name="submit" value="Atualizar">
            </td>
        </tr>
    </table>
</form>

<?php
include("../../footer.php");
?>

