<?php
include("../config.inc.php");
include("../session.php");
validaSessao();
include("../../header.php");
include("../menu.php");
?>
<h3>CATEGORIA</h3>

<a href="/programacao2-/sistema/admin/categoria/add.php" style="color: black;">Adicionar</a>

<br><br>
<table border="1">
    <tr>
        <th>Nome</th>
        <th>Editar</th>
        <th>Apagar</th>
    </tr>
    <?php
    $link = mysqli_connect("localhost", "root", "", "sistema");
    $sql = "SELECT * FROM categoria ORDER BY nome;";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?= htmlspecialchars($row["nome"]); ?></td>
            <td><a href="/programacao2-/sistema/admin/categoria/edit.php?id=<?= $row["id"]; ?>" style="color: black;">Editar</a></td>
            <td><a href="/programacao2-/sistema/admin/categoria/del.php?id=<?= $row["id"]; ?>" style="color: black;">Apagar</a></td>
        </tr>
        <?php
    }
    ?>
</table>

<br><br>
<a href="/programacao2-/sistema/admin/categoria/add.php" style="color: black;">Adicionar</a>

<?php
include("../../footer.php");
?>