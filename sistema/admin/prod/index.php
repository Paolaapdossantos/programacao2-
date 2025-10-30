<?php
include("../config.inc.php");
include("../session.php");
validaSessao();
include("../../header.php");
include("../menu.php");
?>

<h3 style="text-align: center;"> PRODUTOS</h3>

<a href="/programacao2-/sistema/admin/prod/add.php" style="color: black;"> Adicionar</a>

<br><br>
 <table border="2" cellpadding="5" cellspacing="0" style="margin: 0 auto; border-collapse: collapse;">
        <tr style="background-color: #616353;">
		<th>Nome</th>
		<th>Preço</th>
		<th>Categoria</th>
		<th>Editar</th>
		<th>Apagar</th>
	</tr>

	<?php
	$link = mysqli_connect("localhost", "root", "", "sistema");
		$sql = "
		SELECT p.id, p.nome AS produto, p.preco, c.nome AS categoria
		FROM prod p
		LEFT JOIN categoria c ON p.categoria_id = c.id
		ORDER BY p.nome;";
		$result = mysqli_query($link, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
	?>
		<tr>
		<td><?=$row["produto"];?></td>
		<td><?=$row["preco"];?></td>
		<td><?=$row["categoria"];?></td>
		<td><a href="/programacao2-/sistema/admin/prod/upd.php?id=<?=$row["id"];?>" style="color: black;">editar</a></td>
		<td><a href="/programacao2-/sistema/admin/prod/del.php?id=<?=$row["id"];?>"style="color: black;">Apagar</a></td>
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