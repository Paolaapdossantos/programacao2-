<?php
include("./config.inc.php");
include("../header.php");
?>

<h3>Produtos</h3>

<form method="get">
    Pesquisar
    <br>
    <input type="text" name="kw" value="<?= (isset($_GET["kw"]) && $_GET["kw"]) ? htmlspecialchars($_GET["kw"]) : ""; ?>">
    <br>
    <input type="submit" value="🔍">
</form>

<?php
$link = mysqli_connect("localhost","root","","sistema");

$sql = "SELECT 
            p.id, 
            p.nome AS produto, 
            p.preco, 
            c.nome AS categoria
        FROM prod p
        LEFT JOIN categoria c ON p.categoria_id = c.id";

// filtro da busca
if (isset($_GET["kw"]) && $_GET["kw"]) {
    $kw = mysqli_real_escape_string($link, $_GET["kw"]);
    $sql .= " WHERE p.nome LIKE '%$kw%' OR c.nome LIKE '%$kw%'";
}

$sql .= " ORDER BY p.nome";

$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr style="background-color: #ddd;">
            <th>ID</th>
            <th>Produto</th>
            <th>Preço</th>
            <th>Categoria</th>
            <th>Comprar</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row["id"]; ?></td>
                <td><?= htmlspecialchars($row["produto"]); ?></td>
                <td>R$ <?= number_format($row["preco"], 2, ',', '.'); ?></td>
                <td><?= $row["categoria"] ? htmlspecialchars($row["categoria"]) : "Sem categoria"; ?></td>
                <td align="center">
                    <a href="/programacao2-/sistema/user/carrinho.php?a=<?= $row["id"]; ?>" style="color:black;">(+)</a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php
} else {
    echo "<p> 👀 Nenhum produto encontrado.</p>";
}

mysqli_close($link);
?>

<br>
<a href="/programacao2-/sistema/user/carrinho.php" style="color: black;">🛒 Ver Carrinho</a>

<?php
include("../footer.php");
?>
