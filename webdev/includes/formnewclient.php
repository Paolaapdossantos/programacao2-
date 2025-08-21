<table>
<tr>
<td style="text-align: right;">Nome:</td>
<td>
<input type="text" name="name" size="60"
value="<?=isset($name)?$name:"";?>">
</td>
</tr>
<tr>
<td style="text-align: right;">Data Nascimento</td>
<td>
<select name="day">
<option value=""></option>
<?php
for ($i=1; $i<=31; $i++) {
echo "<option value=".$i." ";
if (isset($day) && $day == $i) echo "selected";
echo ">".$i."</option>";
}
?>
</select>
/
<select name="month">
<option value=""></option>
<?php
for ($i=1; $i<=12; $i++) {
echo "<option value=".$i." ";
if (isset($month) && $month == $i) echo "selected";
echo ">".$i."</option>";
}
?>
</select>
/
<input type="text" name="year"
value="<?=isset($year)?$year:"";?>">
(dd/mm/aaaa)
</td>
</tr>
<tr>
<td colspan="2" style="text-align: center;">
<input type="submit" name="submit" value="Cadastrar">
</td>
</tr>
</table>