<?php
include("./config.inc.php");
include  ("../header.php");
?>

<h3>User</h3>
<form>
Palavra-Chave:
<br>
<input type="text" name="kw" value="<?= (isset($_GET["kw"]) && $_GET["kw"])?$_GET["kw"]:""; ?>">
<br>
<input type="submit" value="Buscar">
</form>

<?php
$link = mysqli_connect("localhost","root","","sistema");
$sql = "";
$sql .= "SELECT * FROM prod ";
if (isset($_GET["kw"]) && $_GET["kw"]){
    $sql .= "WHERE nome LIKE '%".$_GET["kw"]."%'";
}
$sql .= " ORDER BY nome ";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
?>

<br><br>
<table border="1">
	<tr>
		<th>Nome</th>
		<th>Preço</th>
        <th>COMPRAR</th>
	</tr>
	<?php
    while ($row = mysqli_fetch_assoc($result)) {
     ?>
		<tr>
			<td><?=$row["nome"];?></td>
			<td><?=$row["preco"];?></td>
            <td align ="center"><a href="/programacao2-/sistema/user/carrinho.php?a=<?=$row["id"];?>" style="color: black;">(+)</a></td>
        </tr>
            <?php
    }
    ?>
</table>
<?php
} else {
    echo "sem produtos";
}
?>
<br><a href="/programacao2-/sistema/user/carrinho.php" style="color: black;">CARRINHO</a>
<?php
include  ("../footer.php");
?>
