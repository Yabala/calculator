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

<h1>CALCULATOR</h1>


<form name="createOP" method="post" action="create.php" class="index">

<div class="index">
Escriba el nombre de un "conjunto de materiales" ya existente para administrar, si el nombre ingresado es de un conjunto que no existe se creará un nuevo conjunto.
</div>
<p>
NOMBRE DEL CONJUNTO DE MATERIALES: <input type="text" name="nombre" value="">
<p>
<input value="CREAR O ABRIR CONJUNTO DE MATERIALES" type="submit" />

</form>

</body>
</html>
