<html>
<head>
<title>Formulario</title>
</head>
<body>
<script language="javascript" type="text/javascript">
<!--
function limpaFormulario(form) {
total = form.elements.length;
for (i=0;i<total;i++) {
if (form.elements[i].type == "text" || form.elements[i].type == "textarea") {
form.elements[i].value = "";
} else if (form.elements[i].type == "checkbox") {
form.elements[i].checked = false;
} else if (form.elements[i].type == "select-one") {
form.elements[i].selectedIndex = 0;
}
}
}
function enviaFormulario(form) {
    total = form.elements.length;
for (i=0;i<total;i++) {
campo = form.elements[i];
if (campo.type=="text"||campo.type=="textarea"||campo.type=="select-one") {
if (!campo.value) {
alert("Preencha o campo " + campo.name + "!");
campo.focus();
setTimeout("atencao(campo)", 250);
return false;
}
}
}
form.submit();
}
var controle = 0;
function atencao(campo) {
controle += 1;
if (controle % 2 == 0) campo.style.background = '#FFFFFF';
else campo.style.background = '#E95306';
if (controle != 6) setTimeout("atencao(campo)", 250);
else controle = 0;
}
//-->
</script>
<form name="formulario" action="./mensagem.php" method="GET">
<input type="hidden" name="cadastro" value="sim">
<table>
<th colspan="2">
Formulario de Cadastro
</th>
<tr>
<td style="text-align: right;">
Nome:
</td>
<td>
<input type="text" name="nome" value="" maxlength="20">
</td>
</tr>
<tr>
<td style="text-align: right;">
Sexo:
</td>
<td>
<input type="radio" name="sexo" value="masculino" checked>
Masculino
<input type="radio" name="sexo" value="feminino">
Feminino
</td>
</tr>
<tr>
<td style="text-align: right;">
Maior de Idade:
</td>
<td>
<input type="radio" name="maior" value="sim">
Sim
<input type="radio" name="maior" value="nao" checked>
Nao
</td>
</tr>
<tr>
<td style="text-align: right;">
Formacao:
</td>
<td>
<select name="formacao">
    <option value="">Selecione uma formacao</option>
<option value="graduacao">Graduacao</option>
<option value="mestrado">Mestrado</option>
<option value="doutorado">Doutorado</option>
</select>
</td>
</tr>
<tr>
<td style="text-align: right;">
Casado(a):
</td>
<td>
<input type="checkbox" name="casado" value="sim" checked>
Sim
</td>
</tr>
<tr>
<td style="text-align: right;">
Possui Carro:
</td>
<td>
<input type="checkbox" name="carro" value="sim">
Sim
</td>
</tr>
<tr>
<td style="text-align: right;">
Comentario:
</td>
<td>
<textarea name="comentario" rows="5"></textarea>
</td>
</tr>
