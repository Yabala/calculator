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

//Encabezado
echo "<h1><i class='fa fa-calculator'></i> CALCULATOR</h1>";
echo "<h2>Créditos del conjunto de materiales &lt;&lt;".$nombre."&gt;&gt;</h2>";

//creditos
$creditURL = $YABALA->credits($nombre, $_POST["licencia"], $_POST["title"], $_POST["author"], null);

if ($creditURL[0]==""){//Se crearón los créditos
	echo "<table class='credits'>";

	echo "<th class='credits' colspan='2'>LICENCIA</th>";

	echo "<tr  class='credits'>";
	echo "<td  class='credits' >Imagen tradicional de la licencia</td>";
	echo "<td  class='credits' ><img src='$creditURL[4]'</td>";
	echo "</tr>";
	echo "<tr  class='credits'>";
	echo "<td  class='credits' >Link permanente a la imagen tradicional de la licencia</td>";
	echo "<td  class='credits' ><a href='$creditURL[4]'  target='_blank'>$creditURL[4]</a></td>";
	echo "</tr>";

	echo "<tr  class='credits'>";
	echo "<td  class='credits' >Imagen QR de la licencia</td>";
	echo "<td  class='credits' ><img src='$creditURL[3]'></td>";
	echo "</tr>";

	echo "<tr  class='credits'>";
	echo "<td  class='credits' >Link permanente a la imagen QR de la licencia</td>";
	echo "<td  class='credits' ><a href='$creditURL[3]'  target='_blank'>$creditURL[3]</a></td>";
	echo "</tr>";

	echo "</table>";

	echo "<p>&nbsp;</p>";

	echo "<table class='credits'>";

	echo "<th class='credits' colspan='2'>CRÉDITOS</th>";

	echo "<tr  class='credits'>";
	echo "<td  class='credits' >Link permanente a los créditos</td>";
	echo "<td  class='credits' ><a href='$creditURL[1]' target='_blank'>$creditURL[1]</a></td>";

	echo "</tr>";

	echo "<tr  class='credits'>";
	echo "<td  class='credits' >Imagen QR de los créditos</td>";
	echo "<td  class='credits' ><img whidt='200' height='200' src='$creditURL[2]'</td>";
	echo "</tr>";

	echo "<tr  class='credits'>";
	echo "<td  class='credits'   class='credits' >Link permanente a la imagen QR de los créditos</td>";
	echo "<td  class='credits' ><a href='$creditURL[2]' target='_blank'>$creditURL[2]</a></td>";
	echo "</tr>";

	echo "</table>";
}else{//No se crearon los créditos
	echo "No se pudier&oacute;n crear los cr&eacute;ditos por qu&eacute;: ".$creditURL[0]."<br />";
}
echo "<br />";

//Enviar la variable a disco
$dump = serialize($YABALA);
file_put_contents('work/'.$nombre, $dump);


//volver
echo "<form name='back' method='post' action='admin.php'><input name='nombre' value='$nombre' type='hidden' /><input value='VOLVER' type='submit'  id='submit' /></form>";

?>



</body>
</html>
