<?php



// This file is part of Calculator https://github.com/Yabala/calculator
//
// Calculator is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Calculator is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Calculator.  If not, see <http://www.gnu.org/licenses/>.



?>



<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body>

<?php

include_once("../yabala/iyabala.php");

//Cargar la variable $YABALA
$nombre = $_POST["nombre"];
$s = file_get_contents('work/'.$nombre);
$YABALA = new yabala();
$YABALA = unserialize($s);

?>


<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- INICIO ENCABEZADO ------------------------------------------------------------------------------------------------>
<!-- ------------------------------------------------------------------------------------------------------------------>

<h1><i class="fa fa-calculator"></i> CALCULATOR</h1>
<h2><?php echo "Administración del conjunto de materiales &lt;&lt;".$nombre."&gt;&gt;" ?></h2>

<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- FIN ENCABEZADO --------------------------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>








<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- INICIO FORMULARIO AGREGAR MATERIAL ----------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>
<form name='ocADD' method='post' action='add.php' class='admin'>

<div class='admin'>
Si quiere agregar un material al conjunto, indique: Formato, Keywords, Autor, Url, la licencia del material a agregar, indique si el material será usado en su forma original o modificado y luego haga clic en el botón "AGREGAR MATERIAL". 
</div>
<br />
<table>

<tr>
<td>
T&Iacute;TULO:
</td>
<td>
<input type='text' name='title' value=''>
</td>
</tr>

<tr>
<td>
TIPO: 
</td>
<td>
<select name='format'>
	<?php
		//Toma la lista de formatos definidos por YABALA
		$formats = $YABALA->getFormats(); 

		//Imprime opciones de la lista despegable por cada formato definido por YABALA
		foreach ($formats as $format) {
		    echo "<option value='$format'>$format</option>\n";
		}
	?>
</select>
</td>
</tr>

<tr>
<td>
KEYWORDS:
</td>
<td>
<input type='text' name='keywords' value=''>
</td>
</tr>

<tr>
<td>
AUTOR:
</td>
<td>
<input type='text' name='autor' value=''>
</td>
</tr>

<tr>
<td>
URL:
</td>
<td>
<input type='url' name='url' value=''>
</td>
</tr>

<tr>
<td>
LICENCIA:
</td>
<td>
<select name='cc'>

	<?php
		//Toma la lista de licencias definidas por YABALA
		$licenses = $YABALA->getLicenses(); 

		//Imprime opciones de la lista despegable por cada licencia definida por YABALA
		foreach ($licenses as $license) {
		    echo "<option value='$license'>$license</option>\n";
		}
	?>

</select>
</td>
</tr>

<tr>
<td>
MODIFICADO?: 
</td>
<td>
<select name='modify'>
	<option value="TRUE">SI</option>
	<option value="FALSE">NO</option>
</select>
</td>
</tr>

</table>

<input name='nombre' value='<?php echo $nombre ?>' type='hidden' />
<br />
<input value='AGREGAR MATERIAL' type='submit'  id='submit' />
</form>
<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- FIN FORMULARIO AGREGAR MATERIAL -------------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>










<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- INICIO FORMULARIO ADMINISTRAR MATERIALES ------------------------------------------------------------------------------>
<!-- ------------------------------------------------------------------------------------------------------------------>

<?php

$works = $YABALA->getWorks();
if ($works!=null){//HAY MATERIALES QUE ADMINISTRAR	
	echo "<form name='ocDel' method='post' action='del.php' class='admin'>\n";
	echo "<div class='admin'>Listado de materiales integrantes del conjunto, si quiere borrar un material seleccionelo y haga clic en el botón \"BORRAR MATERIAL\".</div><br />";
	echo "<input name='nombre' value='".$nombre."' type='hidden' />\n";

	echo "<table class='admin'>";
	echo "<tr class='admin'><td class='admin'>&nbsp;</td><td class='admin'>T&iacute;tulo</td><td class='admin'>Formato</td><td class='admin'>Keyword</td><td class='admin'>Autor</td><td class='admin'>URL</td><td class='admin'>Licencia</td><td class='admin'>Modificado?</td></tr>";
	
	foreach ($works as $key => $work){
		echo "<tr class='admin'><td class='admin'><input type='radio' name='works' value='$key'>";
		foreach ($work as $field){
			echo "<td class='admin'>".$field."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
	echo "<br /><input value='BORRAR MATERIAL' type='submit'  id='submit' />\n";
	echo "</form>\n";
}else{//NO HAY MATERIALES QUE ADMINISTRAR
	echo "<form class='admin'>NO HAY MATERIALES PARA LISTAR</form>";
}
?>
<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- FIN FORMULARIO ADMINISTRAR MATERIALES --------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>










<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- INICIO FORMULARIO GENERAR CREDITOS ------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>
<?php

$licencias = $YABALA->calculator();
$obras = $YABALA->getWorks();

if (($licencias!=null)&&($obras!=null)){//HAY LICENCIAS POR LAS CUALES OPTAR y MATERIALES EN EL CONJUNTO DE MATERIALES
	echo "<form name='ocCredits' method='post' action='credits.php' class='admin'>\n";
	echo "<div class='admin'>Elegir una de las licencias disponibles, indicar el título (si lo desea), indicar el o los autores (si corresponde) y haga clic en el botón \"CREAR CRÉDITOS\" para crear o actualizar los créditos en diferentes formatos con la licencia elejida para el conjunto de materiales.</div><br />";
	echo "<input name='nombre' value='".$nombre."' type='hidden' />\n";
	echo "\n"; 
	
	echo "<table>";
	
	echo "<tr>";
	echo "<td>LICENCIA: </td>";
	echo "<td>";
	echo "<select name='licencia'>\n";
	foreach ($licencias as $item){
		echo "<option value='$item'>$item</option>\n";
	}
	echo "</select>\n";
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>T&Iacute;TULO: </td>";
	echo "<td>";	
	echo "<input name='title' value='' type='text' />\n";
	echo "</td>";
	echo "</tr>";


	echo "<tr>";
	echo "<td>AUTOR: </td>";
	echo "<td>";	
	echo "<input name='author' value='' type='text' />\n";
	echo "</td>";
	echo "</tr>";
	
	echo "</table>";

	echo "<br />\n";
	echo "<input value='CREAR CRÉDITOS' type='submit'  id='submit' />\n";
	echo "</form>\n";
}else{//NO HAY LICENCIAS POR LAS CUALES OPTAR O NO HAY MATERIALES EN EL CONJuNTO DE MATERIALES
	if ($licencias==null){//NO HAY LICENCIAS
		echo "<form class='admin'>LA ACTUAL COMBINACIÓN DE MATERIALES NO ADMITE GENERAR OBRAS DERIVADAS</form>";
	}else{//NO HAY MATERIALES
		echo "<form class='admin'>DEBE AGREGAR MATERIALES PARA PODER OPTAR POR UNA LICENCIA</form>";
	}
}
?>
<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- FIN FORMULARIO GENERAR CREDITOS ---------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>










</body>
</html>