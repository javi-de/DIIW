<?php
	foreach ($_POST as $key => $value){
        if (empty($value)) {
               $value=" ";
        }
	}
	$fecha_nacimiento = $_POST["fecha_nacimiento"];
	$codigo_postal = $_POST["codigo_postal"];
	$telefono = $_POST["telefono"];
	function validarFECH($input){
        $mensaje="NO es válida";
		if (preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',$input)==1){
			$input_array= explode("/",$input);
        	if (checkdate($input_array[1],$input_array[0],$input_array[2]))
					$mensaje= "SI es válida";
		}
		return $mensaje;
    }
	function validarTLFN($telefono){
		if (preg_match('/^[0-9]{9}$/',$telefono)){
			return "SI es válido";
		}else{
			return "NO es válido";
		}
	}
	function validarCP($postalcode){
		if (preg_match('/^[0-9]{5}$/',$postalcode)){
			return "SI es válido";
		}else{
			return "NO es válido";
		}
	}		
?>
La fecha de nacimiento [<?php echo $fecha_nacimiento;?>] <?php echo validarFECH($fecha_nacimiento)?><br/>
El codigo postal [<?php echo $codigo_postal;?>] <?php echo validarCP($codigo_postal)?><br/>
El telefono [<?php echo $telefono;?>] <?php echo validarTLFN($telefono)?><br/>