<?php

include("../config.inc.php");
include("../session.php");
validaSessao();

if (!$_GET["id"]) {
    header("Location:/programacao2-/sistema/admin/prod/");
    exit;
}

$link = mysqli_connect("localhost", "root", "", "sistema");
$id_produto = (int) $_GET["id"]; // força a ser número
$id_usuario_logado = $_SESSION["CONTA_ID"]; // o id do usuário logado

// 👇 ADICIONA O CAMPO id NO SELECT
$sql = "SELECT id, id_usuario, nome FROM prod WHERE id = $id_produto";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) == 0) {
    header("Location:/programacao2-/sistema/admin/prod/");
    exit;
}

$row = mysqli_fetch_assoc($result);

// 🔒 Verifica se o produto pertence ao usuário logado

if ($row["id_usuario"] != $id_usuario_logado) {
    echo "❌ Você não tem permissão para excluir este produto!<br><br>";
    echo '<button style="background-color: #f8c8dc;">
            <a href="/programacao2-/sistema/admin/prod/" style="color: black; text-decoration: none;">Voltar</a>
          </button>';
    exit;
}


// 🗑️ Excluir o produto
if (isset($_GET["del"]) && $_GET["del"] == "yes") {
    $sql = "DELETE FROM prod WHERE id = $id_produto";
    mysqli_query($link, $sql);
    header("Location:/programacao2-/sistema/admin/prod/");
    exit;
}

include("../../header.php");
include("../menu.php");
?>

<h3 style="text-align:center;">APAGAR PRODUTO</h3>

<table border="1" cellpadding="10" cellspacing="0" align="center">
    <tr>
        <td colspan="2" align="center">
            Tem certeza que realmente quer apagar o produto<br>
            <b>"<?php echo htmlspecialchars($row["nome"]); ?>"</b>?
        </td>
    </tr>
    <tr>
        <td align="center">
            <a href="/programacao2-/sistema/admin/prod/del.php?id=<?php echo $row['id']; ?>&del=yes">
                <input type="button" value="SIM">
            </a>
        </td>
        <td align="center">
            <a href="/programacao2-/sistema/admin/prod/">
                <input type="button" value="NÃO">
            </a>
        </td>
    </tr>
</table>

<?php include("../../footer.php"); ?>
