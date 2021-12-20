<?php
	$hostname = "localhost:8889";
	$database = "territorio";
	$username = "root";
	$password = "root";
	foreach ($_POST as $key => $value){
        if (empty($value)) {
               $value="";
        }
	}
	$tipo = $_POST["tipo"];
	header("Content-type: text/plain; charset=ISO-8859-1");
	$conexion=mysqli_connect($hostname,$username,$password);
	
	if (!$conexion){
		die("No se puede conectar a mysql");
	}
	if (!mysqli_select_db($conexion,$database)){
		die(mysqli_error($conexion));
	}
	if ($tipo=="provincia"){
		$sql="select id_provincia as codigo, provincia as nombre from provincias";
	}else{
		$codigo_provincia = $_POST["codigo_provincia"];
		$sql="select id_municipio as codigo, nombre from municipios where id_provincia=".$codigo_provincia;
	}
	if (!$rs=mysqli_query($conexion,$sql)){
	 	die(mysqli_error($con));
	}
	
	$i=0;
	while ($registro=mysqli_fetch_assoc($rs)){
		 $elementos_json[$i]="\"".$registro['codigo']."\":\"".$registro['nombre']."\"";
		 $i++;
	}
	echo "{".implode(",\n", $elementos_json)."}";
 ?>