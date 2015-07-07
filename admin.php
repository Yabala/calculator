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

<h1>CALCULATOR</h1>
<h2><?php echo "Administración de la colección &lt;&lt;".$nombre."&gt;&gt;" ?></h2>

<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- FIN ENCABEZADO --------------------------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>








<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- INICIO FORMULARIO AGREGAR OBRA ----------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>
<form name='ocADD' method='post' action='add.php' class='admin'>

<div class='admin'>
Si quiere agregar una obra al remix, indique: Formato, Keywords, Autor, Url y Licencia de la obra a agregar y luego haga clic en el botón "AGREGAR OBRA". 
</div>

<table>

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

</table>

<input name='nombre' value='<?php echo $nombre ?>' type='hidden' />
<input value='AGREGAR OBRA' type='submit' />
</form>
<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- FIN FORMULARIO AGREGAR OBRA -------------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>










<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- INICIO FORMULARIO ADMINISTRAR OBRAS ------------------------------------------------------------------------------>
<!-- ------------------------------------------------------------------------------------------------------------------>

<?php

$works = $YABALA->getWorks();
if ($works!=null){//HAY OBRAS QUE ADMINISTRAR	
	echo "<form name='ocDel' method='post' action='del.php' class='admin'>\n";
	echo "<div class='admin'>Listado de obras integrantes del remix, si quiere borrar una obra seleccionela y haga clic en el botón \"BORRAR OBRA\".</div>";
	echo "<input name='nombre' value='".$nombre."' type='hidden' />\n";

	echo "<table class='admin'>";
	echo "<tr class='admin'><td class='admin'>&nbsp;</td><td class='admin'>Formato</td><td class='admin'>Keyword</td><td class='admin'>Autor</td><td class='admin'>URL</td><td class='admin'>Licencia</td></tr>";
	
	foreach ($works as $key => $work){
		echo "<tr class='admin'><td class='admin'><input type='radio' name='works' value='$key'>";
		//$a=0;
		//print_r($work);
		foreach ($work as $field){
			//$field1 = (string) $field;
			echo "<td class='admin'>".$field."</td>";
			//echo "$a<p>";
			//$a = $a+1;
		}
		echo "</tr>";
	}
	echo "</table>";
	echo "<input value='BORRAR OBRA' type='submit' />\n";
	echo "</form>\n";
}else{//NO HAY OBRAS QUE ADMINISTRAR
	echo "<div class='admin'>NO HAY OBRAS PARA LISTAR</div>";
}
?>
<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- FIN FORMULARIO ADMINISTRAR OBRAS --------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>










<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- INICIO FORMULARIO GENERAR CREDITOS ------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>
<?php

$licencias = $YABALA->calculator();
$obras = $YABALA->getWorks();

if (($licencias!=null)&&($obras!=null)){//HAY LICENCIAS POR LAS CUALES OPTAR y OBRAS EN LA COLECCION
	echo "<form name='ocCredits' method='post' action='credits.php' class='admin'>\n";
	echo "<div class='admin'>Elegir una de las licencias disponibles y haga clic en el botón \"CREAR CRÉDITOS\" para crear o actualizar los créditos en diferentes formatos con la licencia elejida para el remix de obras.</div>";
	echo "<input name='nombre' value='".$nombre."' type='hidden' />\n";
	echo "\n"; 
	echo "<select name='licencia'>\n";
	foreach ($licencias as $item){
		echo "<option value='$item'>$item</option>\n";
	}
	echo "</select>\n";
	echo "<br>\n";
	echo "<input value='CREAR CRÉDITOS' type='submit' />\n";
	echo "</form>\n";
}else{//NO HAY LICENCIAS POR LAS CUALES OPTAR O NO HAY OBRAS EN LA COLECCION
	if ($licencias==null){//NO HAY LICENCIAS
		echo "<div class='admin'>LA ACTUAL COMBINACIÓN NO ADMITE GENERAR OBRAS DERIVADAS</div>";
	}else{//NO HAY OBRAS
		echo "<div class='admin'>DEBE AGREGAR OBRAS PARA PODER OPTAR POR UNA LICENCIA</div>";
	}
}
?>
<!-- ------------------------------------------------------------------------------------------------------------------>
<!-- FIN FORMULARIO GENERAR CREDITOS ---------------------------------------------------------------------------------->
<!-- ------------------------------------------------------------------------------------------------------------------>










</body>
</html>