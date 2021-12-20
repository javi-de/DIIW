<?php
	foreach ($_POST as $key => $value){
        if (empty($value)) {
               $value="";
        }
	}
	$fecha_nacimiento = $_POST["fecha_nacimiento"];
	$codigo_postal = $_POST["codigo_postal"];
	$telefono = $_POST["telefono"];
	function validar($telefono,$codigo_postal,$fecha_nacimiento){
        $mensaje="";
		if (preg_match('/^[0-9]{9}$/',$telefono)==0){
			$mensaje.="El telefono no es valido.";
		}
		if (preg_match('/^[0-9]{5}$/',$codigo_postal)==0){
			$mensaje.="El codigo postal no es valido.";
		}
		if (preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',$fecha_nacimiento)==1){
			$input_array= explode("/",$fecha_nacimiento);
			$resultado= checkdate($input_array[1],$input_array[0],$input_array[2]);
			if ($resultado==0){
				$mensaje.="La fecha de nacimiento no es valida.";
			}
		}else{
			$mensaje.="La fecha de nacimiento no es valida.";
		}
		if ($mensaje==""){
			$mensaje="Los datos son correctos.";
		}
		
		return $mensaje;
	}
?>
{mensaje:"<?php echo validar($telefono,$codigo_postal,$fecha_nacimiento)?>",
parametros:{telefono:"<?php echo $telefono?>",codigo_postal:"<?php echo $codigo_postal?>",
fecha_nacimiento:"<?php echo $fecha_nacimiento?>"}}
	