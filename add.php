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
echo "<h2>Agregar material al conjunto de materiales &lt;&lt;".$nombre."&gt;&gt;</h2>";

//agregar el oc (obra) a la coleccion
$YABALA->add($_POST["format"], $_POST["keywords"], $_POST["autor"], $_POST["url"], $_POST["cc"]);

//agregar el oc (obra) a la bd para que pueda ser recuperado en busquedas
//(esto no es obligatorio, el desarrollador puede optar por hacerlo o no)
$YABALA->insert($_POST["format"], $_POST["keywords"], $_POST["autor"], $_POST["url"], $_POST["cc"]);

//Enviar la variable a disco 
$dump = serialize($YABALA);
file_put_contents('work/'.$nombre, $dump);

//formulario para volver al administrador
echo "<form name='back' method='post' action='admin.php' class='add'>";
echo "<div class='add'>Material agregado al conjunto:<br /><br />Formato: ".$_POST["format"]."<br /> Keywords: ".$_POST["keywords"]."<br /> Autor: ".$_POST["autor"]."<br /> Url: ".$_POST["url"]."<br /> Licencia: ".$_POST["cc"]."</div>";
echo "<input name='nombre' value='$nombre' type='hidden' />";
echo "<br /><br /><input value='VOLVER' type='submit'  id='submit' />";
echo "</form>";

?>


</body>
</html>