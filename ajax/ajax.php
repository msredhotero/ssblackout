<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();


$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;


case 'insertarConfiguracion':
insertarConfiguracion($serviciosReferencias);
break;
case 'modificarConfiguracion':
modificarConfiguracion($serviciosReferencias);
break;
case 'eliminarConfiguracion':
eliminarConfiguracion($serviciosReferencias);
break; 


/* PARA Tipovehiculo */

case 'insertarClientes':
insertarClientes($serviciosReferencias);
break;
case 'modificarClientes':
modificarClientes($serviciosReferencias);
break;
case 'eliminarClientes':
eliminarClientes($serviciosReferencias);
break;
case 'insertarProveedores':
insertarProveedores($serviciosReferencias);
break;
case 'modificarProveedores':
modificarProveedores($serviciosReferencias);
break;
case 'eliminarProveedores':
eliminarProveedores($serviciosReferencias);
break;
case 'insertarSistemas':
insertarSistemas($serviciosReferencias);
break;
case 'modificarSistemas':
modificarSistemas($serviciosReferencias);
break;
case 'eliminarSistemas':
eliminarSistemas($serviciosReferencias);
break;
case 'insertarTelas':
insertarTelas($serviciosReferencias);
break;
case 'modificarTelas':
modificarTelas($serviciosReferencias);
break;
case 'eliminarTelas':
eliminarTelas($serviciosReferencias);
break;
case 'insertarUsuarios':
insertarUsuarios($serviciosReferencias);
break;
case 'modificarUsuarios':
modificarUsuarios($serviciosReferencias);
break;
case 'eliminarUsuarios':
eliminarUsuarios($serviciosReferencias);
break;
case 'insertarVentas':
insertarVentas($serviciosReferencias);
break;
case 'modificarVentas':
modificarVentas($serviciosReferencias);
break;
case 'eliminarVentas':
eliminarVentas($serviciosReferencias);
break;
case 'insertarImages':
insertarImages($serviciosReferencias);
break;
case 'modificarImages':
modificarImages($serviciosReferencias);
break;
case 'eliminarImages':
eliminarImages($serviciosReferencias);
break;
case 'insertarPredio_menu':
insertarPredio_menu($serviciosReferencias);
break;
case 'modificarPredio_menu':
modificarPredio_menu($serviciosReferencias);
break;
case 'eliminarPredio_menu':
eliminarPredio_menu($serviciosReferencias);
break;
case 'insertarEstados':
insertarEstados($serviciosReferencias);
break;
case 'modificarEstados':
modificarEstados($serviciosReferencias);
break;
case 'eliminarEstados':
eliminarEstados($serviciosReferencias);
break;
case 'insertarResiduos':
insertarResiduos($serviciosReferencias);
break;
case 'modificarResiduos':
modificarResiduos($serviciosReferencias);
break;
case 'eliminarResiduos':
eliminarResiduos($serviciosReferencias);
break;
case 'insertarRoles':
insertarRoles($serviciosReferencias);
break;
case 'modificarRoles':
modificarRoles($serviciosReferencias);
break;
case 'eliminarRoles':
eliminarRoles($serviciosReferencias);
break;
case 'insertarRoller':
insertarRoller($serviciosReferencias);
break;
case 'modificarRoller':
modificarRoller($serviciosReferencias);
break;
case 'eliminarRoller':
eliminarRoller($serviciosReferencias);
break;
case 'insertarTipopago':
insertarTipopago($serviciosReferencias);
break;
case 'modificarTipopago':
modificarTipopago($serviciosReferencias);
break;
case 'eliminarTipopago':
eliminarTipopago($serviciosReferencias);
break;
case 'insertarTipotramados':
insertarTipotramados($serviciosReferencias);
break;
case 'modificarTipotramados':
modificarTipotramados($serviciosReferencias);
break;
case 'eliminarTipotramados':
eliminarTipotramados($serviciosReferencias);
break; 

case 'insertarPagos':
insertarPagos($serviciosReferencias);
break;
case 'modificarPagos':
modificarPagos($serviciosReferencias);
break;
case 'eliminarPagos':
eliminarPagos($serviciosReferencias);
break; 


case 'insertarVentas':
insertarVentas($serviciosReferencias);
break;
case 'modificarVentas':
modificarVentas($serviciosReferencias);
break;
case 'eliminarVentas':
eliminarVentas($serviciosReferencias);
break; 


case 'cotizar':
	cotizar($serviciosReferencias);
	break;

}

/* Fin */
/*

/********* cotizador *******************/

function cotizar($serviciosReferencias) {
	
	
	$cadErrores = '';
	$cad = 'tela';
	$cad1 = 'resi';
	$sistemaNormal = 0;
	$sistemaDoble = 0;
	$sistema = 1;
	$idResiduo = 0;
	
	$idTela = array();
	
	$resTelas = $serviciosReferencias->traerTelas();
	$resResiduos = $serviciosReferencias->traerResiduos();
	
	while ($rowFS1 = mysql_fetch_array($resResiduos)) {
		if (isset($_POST[$cad1.$rowFS1[0]])) {
			$idResiduo = $rowFS1[0];
		}
	}
	
	if (isset($_POST['normal'])) {
		$sistemaNormal = 1;
		$sistema = 1;
	}
	
	if (isset($_POST['doble'])) {
		$sistemaDoble = 1;
		$sistema = 2;
	}
	
	if (($sistemaNormal == 1) && ($sistemaDoble == 1)) {
		$cadErrores .= "No se puede cotizar dos sistemas juntos<br>"; 	
	}
	
	if (($sistemaNormal == 0) && ($sistemaDoble == 0)) {
		$cadErrores .= "Debe seleccionar un sistema<br>"; 	
	}
	
	
	while ($rowFS = mysql_fetch_array($resTelas)) {
		if (isset($_POST[$cad.$rowFS[0]])) {
			$idTela[] = $rowFS[0];
		}
	}
	
	$ancho	=	$_POST['ancho'];
	$alto	=	$_POST['alto'];
	
	
	
	if ((sizeof($idTela) < 2) and ($sistema == 2)) {
		$cadErrores .= "_ Debe seleccionar el segundo Material<br>"; 
	}
	
	if ((sizeof($idTela) > 2) and ($sistema == 2)) {
		$cadErrores .= "_ Selecciono más de un Material<br>"; 
	}
	
	if ((sizeof($idTela) > 1) and ($sistema == 1)) {
		$cadErrores .= "_ Selecciono más de un Material<br>"; 
	}
	
	if ($idResiduo == 0) {
		$cadErrores .= "_ Debe seleccionar un Residuo<br>"; 
	}
	
	if (sizeof($idTela) < 1) {
		$cadErrores .= "_ Debe seleccionar un Material<br>"; 
	}
	
	if (($ancho == '') || ($ancho < 20)) {
		$cadErrores .= "_ Debe cargar un acnho o el ancho a menor a las 10 centimetros<br>"; 
	}
	
	if (($alto == '') || ($alto < 20)) {
		$cadErrores .= "_ Debe cargar un alto o el alto a menor a las 10 centimetros<br>"; 
	}
	
	
	if ($cadErrores == '') {
		$total = $serviciosReferencias->cotizar($sistema, $idTela, $idResiduo, $ancho, $alto, 0);
		echo $total;
	} else {
		echo $cadErrores;	
	}
}

/********* fin cotizador ***************/


//******************  VENTAS  *****************************************************/

function insertarVentas($serviciosReferencias) {
	
	$cadErrores = '';
	$cad = 'tela';
	$cad1 = 'resi';
	$sistemaNormal = 0;
	$sistemaDoble = 0;
	$sistema = 1;
	$idResiduo = 0;
	
	$idTela = array();
	
	$resTelas = $serviciosReferencias->traerTelas();
	$resResiduos = $serviciosReferencias->traerResiduos();
	
	while ($rowFS1 = mysql_fetch_array($resResiduos)) {
		if (isset($_POST[$cad1.$rowFS1[0]])) {
			$idResiduo = $rowFS1[0];
		}
	}
	
	if (isset($_POST['normal'])) {
		$esDoble = 0;
		$sistema = 1;
	}
	
	if (isset($_POST['doble'])) {
		$esDoble = 1;
		$sistema = 2;
	}
	
	
	
	while ($rowFS = mysql_fetch_array($resTelas)) {
		if (isset($_POST[$cad.$rowFS[0]])) {
			$idTela[] = $rowFS[0];
		}
	}
	
	
	////********************* del cotizar  *****************/
	if ($sistema == 1) {
		$resTelas	=	$this->traerTelasPorId($tela[0]);
		if (mysql_num_rows($resTelas)>0) {
			$refTelasA = mysql_result($resTelas,0,0);
			$nombreTela = mysql_result($resTelas,0,'tela');
			$tramado = mysql_result($resTelas,0,'tipotramado');
			if ($esRevendedor == 1) {
				$valorTela = mysql_result($resTelas,0,'preciocliente');
			} else {
				$valorTela = mysql_result($resTelas,0,'preciocosto');
			}
		} else {
			$valorTela = 0;		
		}
	}
	
	if ($sistema == 2) {
		$resTelasA	=	$this->traerTelasPorId($tela[0]);
		$resTelasB	=	$this->traerTelasPorId($tela[1]);
		if (mysql_num_rows($resTelasA)>0) {
			$refTelasA = mysql_result($resTelasA,0,0);
			$refTelasB = mysql_result($resTelasB,0,0);
			$nombreTela = mysql_result($resTelasA,0,'tela').' - '.mysql_result($resTelasB,0,'tela');
			$tramado = mysql_result($resTelasA,0,'tipotramado').' - '.mysql_result($resTelasB,0,'tipotramado');
			if ($esRevendedor == 1) {
				$valorTela = mysql_result($resTelasA,0,'preciocliente') + mysql_result($resTelasB,0,'preciocliente');
			} else {
				$valorTela = mysql_result($resTelasA,0,'preciocosto') + mysql_result($resTelasB,0,'preciocosto');
			}
		} else {
			$valorTela = 0;		
		}
		
	}
	
	/****************************************/
	
	//el residuo que voy a utilizar
	$resResiduo	=	$this->traerResiduosPorId($residuo);
	
	$refResiduo		= mysql_result($resResiduo,0,0);
	$rollerResiduo	= mysql_result($resResiduo,0,'roller');
	$anchoResiduo	= mysql_result($resResiduo,0,'telaancho');
	$altoResiduo	= mysql_result($resResiduo,0,'telaalto');
	$zocaloResiduo	= mysql_result($resResiduo,0,'zocalo');
	
	/****************************************/
	
	
	//el sistema que voy a utilizar
	// busca medidas en "metros"
	$resSistema		=	$this->traerSistemasPorMedida($ancho / 100);
	
	if (mysql_num_rows($resSistema)>0) {
		$refSistema		= mysql_result($resSistema,0,0);
		$nombreSistema	= mysql_result($resSistema,0,'nombre');
		$roller			= mysql_result($resSistema,0,'diametro');
		if ($esRevendedor == 1) {
			$valorSistema	=	mysql_result($resSistema,0,'preciocliente');
		} else {
			$valorSistema	=	mysql_result($resSistema,0,'preciocosto');
		}
	} else {
		$valorSistema = 0;		
	}
	
	/****************************************/
	
	//Valores finales en "cm"
	$telaAltoFinal	= ($alto * 10) - $altoResiduo;
	$telaAnchoFinal	= ($ancho * 10) - $anchoResiduo;
	$cañoFinal	= ($ancho * 10) - $rollerResiduo;
	$zocaloFinal	= ($ancho * 10) - $zocaloResiduo;
	
	/****************************************/
	
	$calculoSistema	= $valorSistema;
	/*if ($sistema == 2) {
		$calculoTela	= (((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela) + ((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela2));
	} else {*/
	$calculoTela	= ((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela);
	//}
	$total = $calculoSistema + $calculoTela;
	
	////*********************   fin  ************************/
	
	$ancho	=	$_POST['ancho'];
	$alto	=	$_POST['alto'];
	
	$numero = $serviciosReferencias->generarNroVenta();
	$tela = $_POST['tela'];
	$total = $_POST['total'];
	$refclientes = $_POST['refclientes'];
	$reftipopago = $_POST['reftipopago'];
	
	if (isset($_POST['cancelada'])) {
		$cancelada = 1;
	} else {
		$cancelada = 0;
	}
	
	$res = $serviciosReferencias->insertarVentas($numero,$nombreSistema,$nombreTela,$total,$refclientes,$reftipopago,$cancelada);
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}


/******************   FIN   *******************************************************/

/* PARA Tipotramados */

function insertarClientes($serviciosReferencias) {
$nombrecompleto = $_POST['nombrecompleto'];
$cuil = $_POST['cuil'];
$dni = $_POST['dni'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$observaciones = $_POST['observaciones'];
$res = $serviciosReferencias->insertarClientes($nombrecompleto,$cuil,$dni,$direccion,$telefono,$email,$observaciones);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarClientes($serviciosReferencias) {
$id = $_POST['id'];
$nombrecompleto = $_POST['nombrecompleto'];
$cuil = $_POST['cuil'];
$dni = $_POST['dni'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$observaciones = $_POST['observaciones'];
$res = $serviciosReferencias->modificarClientes($id,$nombrecompleto,$cuil,$dni,$direccion,$telefono,$email,$observaciones);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarClientes($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarClientes($id);
echo $res;
}
function insertarProveedores($serviciosReferencias) {
$nombre = $_POST['nombre'];
$cuit = $_POST['cuit'];
$dni = $_POST['dni'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$observacionces = $_POST['observacionces'];
$res = $serviciosReferencias->insertarProveedores($nombre,$cuit,$dni,$direccion,$telefono,$celular,$email,$observacionces);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarProveedores($serviciosReferencias) {
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$cuit = $_POST['cuit'];
$dni = $_POST['dni'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$observacionces = $_POST['observacionces'];
$res = $serviciosReferencias->modificarProveedores($id,$nombre,$cuit,$dni,$direccion,$telefono,$celular,$email,$observacionces);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarProveedores($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarProveedores($id);
echo $res;
}
function insertarSistemas($serviciosReferencias) {
$nombre = $_POST['nombre'];
$refroller = $_POST['refroller'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$preciocosto = $_POST['preciocosto'];
$preciocliente = $_POST['preciocliente'];
$res = $serviciosReferencias->insertarSistemas($nombre,$refroller,$desde,$hasta,$preciocosto,$preciocliente);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarSistemas($serviciosReferencias) {
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$refroller = $_POST['refroller'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$preciocosto = $_POST['preciocosto'];
$preciocliente = $_POST['preciocliente'];
$res = $serviciosReferencias->modificarSistemas($id,$nombre,$refroller,$desde,$hasta,$preciocosto,$preciocliente);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarSistemas($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarSistemas($id);
echo $res;
}
function insertarTelas($serviciosReferencias) {
$tela = $_POST['tela'];
$reftipotramados = $_POST['reftipotramados'];
$ancho = $_POST['ancho'];
$alto = $_POST['alto'];
$preciolista = $_POST['preciolista'];
$preciocosto = $_POST['preciocosto'];
$preciocliente = $_POST['preciocliente'];
$res = $serviciosReferencias->insertarTelas($tela,$reftipotramados,$ancho,$alto,$preciolista,$preciocosto,$preciocliente);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarTelas($serviciosReferencias) {
$id = $_POST['id'];
$tela = $_POST['tela'];
$reftipotramados = $_POST['reftipotramados'];
$ancho = $_POST['ancho'];
$alto = $_POST['alto'];
$preciolista = $_POST['preciolista'];
$preciocosto = $_POST['preciocosto'];
$preciocliente = $_POST['preciocliente'];
$res = $serviciosReferencias->modificarTelas($id,$tela,$reftipotramados,$ancho,$alto,$preciolista,$preciocosto,$preciocliente);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarTelas($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarTelas($id);
echo $res;
}
function insertarUsuarios($serviciosReferencias) {
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$refroles = $_POST['refroles'];
$email = $_POST['email'];
$nombrecompleto = $_POST['nombrecompleto'];
$res = $serviciosReferencias->insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarUsuarios($serviciosReferencias) {
$id = $_POST['id'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$refroles = $_POST['refroles'];
$email = $_POST['email'];
$nombrecompleto = $_POST['nombrecompleto'];
$res = $serviciosReferencias->modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarUsuarios($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarUsuarios($id);
echo $res;
}





function modificarVentas($serviciosReferencias) {
	$id = $_POST['id'];
	$numero = $_POST['numero'];
	$sistema = $_POST['sistema'];
	$tela = $_POST['tela'];
	$total = $_POST['total'];
	$refclientes = $_POST['refclientes'];
	$reftipopago = $_POST['reftipopago'];
	if (isset($_POST['cancelada'])) {
		$cancelada = 1;
	} else {
		$cancelada = 0;
	}
	
	$res = $serviciosReferencias->modificarVentas($id,$numero,$sistema,$tela,$total,$refclientes,$reftipopago,$cancelada);
	
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}


function eliminarVentas($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarVentas($id);
echo $res;
} 



function insertarImages($serviciosReferencias) {
$refproyecto = $_POST['refproyecto'];
$refuser = $_POST['refuser'];
$imagen = $_POST['imagen'];
$type = $_POST['type'];
if (isset($_POST['principal'])) {
$principal = 1;
} else {
$principal = 0;
}
$res = $serviciosReferencias->insertarImages($refproyecto,$refuser,$imagen,$type,$principal);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarImages($serviciosReferencias) {
$id = $_POST['id'];
$refproyecto = $_POST['refproyecto'];
$refuser = $_POST['refuser'];
$imagen = $_POST['imagen'];
$type = $_POST['type'];
if (isset($_POST['principal'])) {
$principal = 1;
} else {
$principal = 0;
}
$res = $serviciosReferencias->modificarImages($id,$refproyecto,$refuser,$imagen,$type,$principal);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarImages($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarImages($id);
echo $res;
}
function insertarPredio_menu($serviciosReferencias) {
$url = $_POST['url'];
$icono = $_POST['icono'];
$nombre = $_POST['nombre'];
$Orden = $_POST['Orden'];
$hover = $_POST['hover'];
$permiso = $_POST['permiso'];
$res = $serviciosReferencias->insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarPredio_menu($serviciosReferencias) {
$id = $_POST['id'];
$url = $_POST['url'];
$icono = $_POST['icono'];
$nombre = $_POST['nombre'];
$Orden = $_POST['Orden'];
$hover = $_POST['hover'];
$permiso = $_POST['permiso'];
$res = $serviciosReferencias->modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarPredio_menu($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarPredio_menu($id);
echo $res;
}
function insertarEstados($serviciosReferencias) {
$estado = $_POST['estado'];
$icono = $_POST['icono'];
$res = $serviciosReferencias->insertarEstados($estado,$icono);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarEstados($serviciosReferencias) {
$id = $_POST['id'];
$estado = $_POST['estado'];
$icono = $_POST['icono'];
$res = $serviciosReferencias->modificarEstados($id,$estado,$icono);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarEstados($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarEstados($id);
echo $res;
}
function insertarResiduos($serviciosReferencias) {
$nombre = $_POST['nombre'];
$roller = $_POST['roller'];
$telaancho = $_POST['telaancho'];
$telaalto = $_POST['telaalto'];
$zocalo = $_POST['zocalo'];
$res = $serviciosReferencias->insertarResiduos($nombre,$roller,$telaancho,$telaalto,$zocalo);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarResiduos($serviciosReferencias) {
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$roller = $_POST['roller'];
$telaancho = $_POST['telaancho'];
$telaalto = $_POST['telaalto'];
$zocalo = $_POST['zocalo'];
$res = $serviciosReferencias->modificarResiduos($id,$nombre,$roller,$telaancho,$telaalto,$zocalo);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
} 
function eliminarResiduos($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarResiduos($id);
echo $res;
}
function insertarRoles($serviciosReferencias) {
$descripcion = $_POST['descripcion'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->insertarRoles($descripcion,$activo);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarRoles($serviciosReferencias) {
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->modificarRoles($id,$descripcion,$activo);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarRoles($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarRoles($id);
echo $res;
}
function insertarRoller($serviciosReferencias) {
$diametro = $_POST['diametro'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->insertarRoller($diametro,$activo);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarRoller($serviciosReferencias) {
$id = $_POST['id'];
$diametro = $_POST['diametro'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->modificarRoller($id,$diametro,$activo);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarRoller($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarRoller($id);
echo $res;
}
function insertarTipopago($serviciosReferencias) {
$descripcion = $_POST['descripcion'];
$res = $serviciosReferencias->insertarTipopago($descripcion);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarTipopago($serviciosReferencias) {
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$res = $serviciosReferencias->modificarTipopago($id,$descripcion);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarTipopago($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarTipopago($id);
echo $res;
}
function insertarTipotramados($serviciosReferencias) {
$tipotramado = $_POST['tipotramado'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->insertarTipotramados($tipotramado,$activo);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarTipotramados($serviciosReferencias) {
$id = $_POST['id'];
$tipotramado = $_POST['tipotramado'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->modificarTipotramados($id,$tipotramado,$activo);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarTipotramados($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarTipotramados($id);
echo $res;
}

/* Fin */



function insertarPagos($serviciosReferencias) {
$refclientes = $_POST['refclientes'];
$pago = $_POST['pago'];
$fechapago = $_POST['fechapago'];
$observaciones = $_POST['observaciones'];
$res = $serviciosReferencias->insertarPagos($refclientes,$pago,$fechapago,$observaciones);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarPagos($serviciosReferencias) {
$id = $_POST['id'];
$refclientes = $_POST['refclientes'];
$pago = $_POST['pago'];
$fechapago = $_POST['fechapago'];
$observaciones = $_POST['observaciones'];
$res = $serviciosReferencias->modificarPagos($id,$refclientes,$pago,$fechapago,$observaciones);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarPagos($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarPagos($id);
echo $res;
} 











function insertarConfiguracion($serviciosReferencias) {
$empresa = $_POST['empresa'];
$cuit = $_POST['cuit'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$localidad = $_POST['localidad'];
$codigopostal = $_POST['codigopostal'];
$res = $serviciosReferencias->insertarConfiguracion($empresa,$cuit,$direccion,$telefono,$email,$localidad,$codigopostal);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarConfiguracion($serviciosReferencias) {
$id = $_POST['id'];
$empresa = $_POST['empresa'];
$cuit = $_POST['cuit'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$localidad = $_POST['localidad'];
$codigopostal = $_POST['codigopostal'];
$res = $serviciosReferencias->modificarConfiguracion($id,$empresa,$cuit,$direccion,$telefono,$email,$localidad,$codigopostal);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarConfiguracion($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarConfiguracion($id);
echo $res;
} 

////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
    $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function registrar($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function insertarUsuario($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function modificarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	echo $serviciosUsuarios->modificarUsuario($id,$usuario,$password,$refroll,$email,$nombre);
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	//$idempresa  =	$_POST['idempresa'];
	
	echo $serviciosUsuarios->login($email,$pass);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>