<?php
include("../config.inc.php");
include("../session.php");
validaSessao();
include("../../header.php");
include("../menu.php");
?>

<h3>PRODUTOS</h3>

<a href="/programacao2-/sistema/admin/prod/add.php" style="color: black;"> Adicionar</a>

<br><br>
<table border="1">
	<tr>
		<th>Nome</th>
		<th>Preço</th>
		<th>Editar</th>
		<th>Apagar</th>
		<th>Categoria</th>
	</tr>
	<?php
	$link = mysqli_connect("localhost", "root", "", "sistema");
	$sql = "SELECT * FROM prod ORDER BY nome;";
	$result = mysqli_query($link, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
		?>
		<tr>
			<td><?=$row["nome"];?></td>
			<td><?=$row["preco"];?></td>
			<td><a href="/programacao2-/sistema/admin/prod/upd.php?id=<?=$row["id"];?>" style="color: black;">editar</a></td>
			<td><a href="/programacao2-/sistema/admin/prod/del.php?id=<?=$row["id"];?>"style="color: black;">Apagar</a></td>
            <td><a href="/programacao2-/sistema/admin/categoria/index.php?id=<?=$row["id"];?>"style="color: black;">categoria</a></td>
		</tr>
		<?php
	}
	?>
</table>
<br><br>
<a href="/programacao2-/sistema/admin/prod/add.php" style="color: black;"> Adicionar</a>

<?php
include("../../footer.php");
?>