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


case 'insertarTipotarea':
insertarTipotarea($serviciosReferencias);
break;
case 'modificarTipotarea':
modificarTipotarea($serviciosReferencias);
break;
case 'eliminarTipotarea':
eliminarTipotarea($serviciosReferencias);
break; 
case 'insertarSistematareas':
insertarSistematareas($serviciosReferencias);
break;
case 'modificarSistematareas':
modificarSistematareas($serviciosReferencias);
break;
case 'eliminarSistematareas':
eliminarSistematareas($serviciosReferencias);
break; 
case 'insertarOrdenessistematareas':
insertarOrdenessistematareas($serviciosReferencias);
break;
case 'modificarOrdenessistematareas':
modificarOrdenessistematareas($serviciosReferencias);
break;
case 'eliminarOrdenessistematareas':
eliminarOrdenessistematareas($serviciosReferencias);
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


case 'orden':
insertarVentas($serviciosReferencias);
break;
case 'modificarVentas':
modificarVentas($serviciosReferencias);
break;
case 'eliminarVentas':
eliminarVentas($serviciosReferencias);
break; 

case 'traerDetalleVentaPorVenta':
	traerDetalleVentaPorVenta($serviciosReferencias, $serviciosFunciones);
	break;
case 'traerDetalleVentaPorCliente':
	traerDetalleVentaPorCliente($serviciosReferencias);
	break;

case 'traerPagosPorCliente':
	traerPagosPorCliente($serviciosReferencias);
	break;
case 'traerVentasPorCliente':
	traerVentasPorCliente($serviciosReferencias);
	break;
case 'traerVentasPorClienteACuenta':
	traerVentasPorClienteACuenta($serviciosReferencias);
	break;
case 'traerDetallePagosPorCliente':
	traerDetallePagosPorCliente($serviciosReferencias);
	break;
	
	
	
case 'insertarOrdenes':
insertarOrdenes($serviciosReferencias);
break;
case 'modificarOrdenes':
modificarOrdenes($serviciosReferencias);
break;
case 'eliminarOrdenes':
eliminarOrdenes($serviciosReferencias);
break; 

case 'cumplirTarea':
	cumplirTarea($serviciosReferencias);
	break;
case 'devolverPorcentajeCumplido':
	devolverPorcentajeCumplido($serviciosReferencias);
	break;

	
case 'cotizar':
	cotizar($serviciosReferencias);
	break;

case 'insertarPresupuesto':
	insertarPresupuesto($serviciosReferencias);
	break;
case 'generarOrdenPorPresupuesto':
	generarOrdenPorPresupuesto($serviciosReferencias);
	break;

////****  POPUP'S   *********////
case 'traerDetallePresupuestoPorCabecera':
	traerDetallePresupuestoPorCabecera($serviciosReferencias);
	break;

////****   FIN       ************///	
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
	
	$idResiduo = $_POST['refresiduo'];

	$refroles = $_POST['refroles'];
	if ($refroles == 3) {
		$esRevendedor = 1;
	} else {
		$esRevendedor = 0;
	}

	$sistema = $_POST['normal'];
	
	$idTela[] = $_POST['reftelas'];
	$idTela[] = $_POST['reftelaopcional'];
	
	$ancho	=	(float)$_POST['ancho'] * 100;
	$alto	=	(float)$_POST['alto'] * 100;
	
	
	/*
	if ((sizeof($idTela) < 2) and ($sistema == 2)) {
		$cadErrores .= "_ Debe seleccionar el segundo Material<br>"; 
	}
	
	if ((sizeof($idTela) > 2) and ($sistema == 2)) {
		$cadErrores .= "_ Selecciono más de un Material<br>"; 
	}
	
	if ((sizeof($idTela) > 1) and ($sistema == 1)) {
		$cadErrores .= "_ Selecciono más de un Material<br>"; 
	}
	if (sizeof($idTela) < 1) {
		$cadErrores .= "_ Debe seleccionar un Material<br>"; 
	}
	*/
	if ($idResiduo == 0) {
		$cadErrores .= "_ Debe seleccionar un Residuo<br>"; 
	}
	
	
	
	if (($ancho == '') || ($ancho < 20)) {
		$cadErrores .= "_ Debe cargar un acnho o el ancho a menor a las 20 centimetros<br>"; 
	}
	
	if (($alto == '') || ($alto < 20)) {
		$cadErrores .= "_ Debe cargar un alto o el alto a menor a las 20 centimetros<br>"; 
	}
	
	
	if ($cadErrores == '') {
		$total = $serviciosReferencias->cotizar($sistema, $idTela, $idResiduo, $ancho, $alto, $esRevendedor);
		echo $total;
	} else {
		echo $cadErrores;	
	}
}

/********* fin cotizador ***************/

/***********  			POPUP'S   				************/
function traerDetallePresupuestoPorCabecera($serviciosReferencias) {
	$idCabecera = $_POST['id'];

	$res = $serviciosReferencias->traerPresupuestosDetallePorCabecera($idCabecera);

	$cad = "<table class='table table-responsive table-striped'>
			<thead>
				<th>Sistema</th>
				<th>Tela</th>
				<th>Roller</th>
				<th>Tramado</th>
				<th>Monto</th>
				<th>Ancho</th>
				<th>Alto</th>
				<th>Es Doble</th>
				<th>2da Tela</th>
			</thead>
			<tbody>";
	while ($row = mysql_fetch_array($res))	{
		$cad .= "<tr>
					<td>".$row['sistema']."</td>
					<td>".$row['tela']."</td>
					<td>".$row['roller']."</td>
					<td>".$row['tramado']."</td>
					<td>".$row['monto']."</td>
					<td>".$row['ancho']."</td>
					<td>".$row['alto']."</td>
					<td>".$row['esdoble']."</td>
					<td>".$row['segundatela']."</td>
				</tr>";
	}

	$cad .= "</tbody></table>";

	echo $cad;	
}

function traerDetalleVentaPorVenta($serviciosReferencias, $serviciosFunciones) {
	$idVenta = $_POST['id'];

	$cabeceras 		= "	<th>Nro Orden</th>
					<th>Nro Venta</th>
					<th>Clientes</th>
					<th>Fecha</th>
					<th>Usua. Crea</th>
					<th>Sistema</th>
					<th>Tela</th>
					<th>Roller</th>
					<th>Tramado</th>
					<th>Ancho</th>
					<th>Alto</th>
					<th>Es Doble</th>
					<th>Tela Sec.</th>
					<th>Estado</th>
					<th>Monto</th>";
	$lstCargados 	= $serviciosFunciones->camposTablaViewSinAction($cabeceras,$serviciosReferencias->traerOrdenesPorVenta($idVenta),15);

	echo $lstCargados;
}
/************				fin 				************/


/*********  Presupuestos ***************/

function generarOrdenPorPresupuesto($serviciosReferencias) {
	$refCabecera	=	$_POST['id'];
	
	$resCabecera =  $serviciosReferencias->traerCabecerapresupuestoPorId($refCabecera);
	
	$refEstado = mysql_result($resCabecera,0,'refestados');
	
	if ($refEstado == 1) {
		$idVenta	=	$serviciosReferencias->insertarVentaPorPresupuesto($refCabecera);
		
		$res 		=   $serviciosReferencias->insertarDetallesOrdenPorPresupuesto($refCabecera, $idVenta);
		
		if ($idVenta > 0) {
			$serviciosReferencias->modificarCabecerapresupuestoEstado($refCabecera);
			
			echo 'Orden Generada';
		} else {
			echo 'No se puede generar la Orden, datos incorrectos';
		}
	} else {
		echo 'La orden ya fue cargada o cancelada';
	}
		
}

function insertarPresupuesto($serviciosReferencias) {





}

//***********  fin Presupuestos ***************************************************/

//******************  VENTAS  *****************************************************/

function insertarVentas($serviciosReferencias) {
	
	$cadErrores = '';
	$cad = 'tela';
	$cad1 = 'resi';
	$sistemaNormal = 0;
	$sistemaDoble = 0;
	$sistema = 1;
	$idResiduo = 0;
	
	$refroles = $_POST['refroles'];
	//esta variable por ahora es asi
	if ($refroles == 3) {
		$esRevendedor = 1;
	} else {
		$esRevendedor = 0;
	}
	
	$idResiduo = $_POST['refresiduo'];
	
	$sistema = $_POST['normal'];
	
	$idTela[] = $_POST['reftelas'];
	$idTela[] = $_POST['reftelaopcional'];
	
	$ancho	=	(float)$_POST['ancho'] * 100;
	$alto	=	(float)$_POST['alto'] * 100;
	
	////********************* del cotizar  *****************/
	if (($sistema == 1) || ($sistema == 3)) {
		$resTelas	=	$serviciosReferencias->traerTelasPorId($idTela[0]);
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
		$resTelasA	=	$serviciosReferencias->traerTelasPorId($idTela[0]);
		$resTelasB	=	$serviciosReferencias->traerTelasPorId($idTela[1]);
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
	$resResiduo	=	$serviciosReferencias->traerResiduosPorId($idResiduo);
	
	$refResiduo		= mysql_result($resResiduo,0,0);
	$rollerResiduo	= mysql_result($resResiduo,0,'roller');
	$anchoResiduo	= mysql_result($resResiduo,0,'telaancho');
	$altoResiduo	= mysql_result($resResiduo,0,'telaalto');
	$zocaloResiduo	= mysql_result($resResiduo,0,'zocalo');
	

	/****************************************/
	
	
	//el sistema que voy a utilizar
	// busca medidas en "metros"
	
	if ($sistema == 3) {
		$resSistema		=	$this->traerSistemasPorMedida(901); //voy a buscar a confeccion
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
	} else {
		$resSistema		=	$this->traerSistemasPorMedida($ancho / 100);
		
		if (mysql_num_rows($resSistema)>0) {
			$refSistema		= mysql_result($resSistema,0,0);
			$nombreSistema	= mysql_result($resSistema,0,'nombre');
			$roller			= mysql_result($resSistema,0,'diametro');
			if ($esRevendedor == 1) {
				$valorSistema	=	mysql_result($resSistema,0,'preciocliente') * ($ancho / 100);
			} else {
				$valorSistema	=	mysql_result($resSistema,0,'preciocosto') * ($ancho / 100);
			}
		} else {
			$valorSistema = 0;		
		}
	}

	
	/****************************************/
	
	//Valores finales en "cm"
	/*
	$telaAltoFinal	= ($alto * 10) - $altoResiduo;
	$telaAnchoFinal	= ($ancho * 10) - $anchoResiduo;
	$cañoFinal	= ($ancho * 10) - $rollerResiduo;
	$zocaloFinal	= ($ancho * 10) - $zocaloResiduo;
	*/
	$telaAltoFinal	= ($alto * 10);
	$telaAnchoFinal	= ($ancho * 10);
	$cañoFinal	= ($ancho * 10) - $rollerResiduo;
	$zocaloFinal	= ($ancho * 10) - $zocaloResiduo;
	/****************************************/
	
	if ($sistema == 3) {
		$telaAltoFinal	= ($alto * 10) - $altoResiduo;
	} else {
		$telaAltoFinal	= ($alto * 10); //el residuo esta en mm y el ancho en cm
	}
	
	$calculoSistema	= $valorSistema;
	/*if ($sistema == 2) {
		$calculoTela	= (((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela) + ((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela2));
	} else {*/
	$calculoTela	= ((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela);
	//}
	$total = $calculoSistema + $calculoTela;
	
	////*********************   fin  ************************/
	
	/****** basico para la venta  ***************************/
	$ancho	=	$_POST['ancho'];
	$alto	=	$_POST['alto'];
	
	$numero = $serviciosReferencias->generarNroVenta();
	$total = $_POST['totalgral'];
	$refclientes = $_POST['refclientes'];
	$reftipopago = $_POST['reftipopago'];
	$cancelada = 1;
	/*************  fin de la venta ************************/
	
	/********  basico para la orden ************************/
	$numeroOrdenes  = $serviciosReferencias->generarNroOrden();
	$usuacrea		= $_POST['usuario'];
	
	/*******   fin    **************************************/
	
	$res = $serviciosReferencias->insertarVentas($numero,date('Y-m-d'),0,$total,$refclientes,$reftipopago,'',0,0);
	
	if ((integer)$res > 0) {
		if ($sistema == 2) {
			$resN = $serviciosReferencias->insertarOrdenes($numeroOrdenes,$res,date('Y-m-d'),'',$usuacrea,'',1,$refSistema,$refTelasA,$refResiduo,$roller,$tramado,$ancho,$alto,$refTelasB,1,$total);

		} else {
			$resN = $serviciosReferencias->insertarOrdenes($numeroOrdenes,$res,date('Y-m-d'),'',$usuacrea,'',1,$refSistema,$refTelasA,$refResiduo,$roller,$tramado,$ancho,$alto,'',0,$total);	
		}
		$serviciosReferencias->insertarTareasSistemasPorOrden($resN, $refSistema);
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}


/******************   FIN   *******************************************************/



/********************    ORDENES   ************************************************/

function modificarOrdenes($serviciosReferencias) {
	$id = $_POST['id'];
	$numero = $_POST['numero'];
	$refventas = $_POST['refventas'];
	$fechacrea = '';
	$fechamodi = $_POST['fechamodi'];
	$usuacrea = $_POST['usuacrea'];
	$usuamodi = $_POST['usuamodi'];
	$refestados = $_POST['refestados'];
	//$refsistemas = $_POST['refsistemas'];
	$reftelas = $_POST['reftelas'];
	$refresiduos = $_POST['refresiduos'];
	$roller = $_POST['roller'];
	$tramado = $_POST['tramado'];
	$ancho	=	(float)$_POST['ancho'] * 100;
	$alto	=	(float)$_POST['alto'] * 100;
	
	$refroles = $_POST['refroles'];
	
	// POR AHORA LO SETEO EN 0
	if ($refroles == 3) {
		$esRevendedor = 1;
	} else {
		$esRevendedor = 0;
	}

	$resOrdenAux = $serviciosReferencias->traerOrdenesPorId($id);
	
	
	if (isset($_POST['esdoble'])) {
		$esdoble = 1;
		$reftelaopcional = $_POST['reftelaopcional'];
		// SI ES DOBLE SISTEMA CALCULO EL VALOR DE AMBAS TELAS
		$resTelasA	=	$serviciosReferencias->traerTelasPorId($reftelas);
		$resTelasB	=	$serviciosReferencias->traerTelasPorId($reftelaopcional);
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
		
	} else {
		$esdoble = 0;
		$reftelaopcional = '';
		// SOLO CALCULO EL VALOR DE UNA TELA
		$resTelas	=	$serviciosReferencias->traerTelasPorId($reftelas);
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
	
	/****************************************/
	
	//el residuo que voy a utilizar
	$resResiduo	=	$serviciosReferencias->traerResiduosPorId($refresiduos);
	
	$refResiduo		= mysql_result($resResiduo,0,0);
	$rollerResiduo	= mysql_result($resResiduo,0,'roller');
	$anchoResiduo	= mysql_result($resResiduo,0,'telaancho');
	$altoResiduo	= mysql_result($resResiduo,0,'telaalto');
	$zocaloResiduo	= mysql_result($resResiduo,0,'zocalo');
	
	/****************************************/
	
	
	//el sistema que voy a utilizar
	// busca medidas en "metros"
	if ($sistema == 3) {
		$resSistema		=	$this->traerSistemasPorMedida(901); //voy a buscar a confeccion
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
	} else {
		$resSistema		=	$this->traerSistemasPorMedida($ancho / 100);
		
		if (mysql_num_rows($resSistema)>0) {
			$refSistema		= mysql_result($resSistema,0,0);
			$nombreSistema	= mysql_result($resSistema,0,'nombre');
			$roller			= mysql_result($resSistema,0,'diametro');
			if ($esRevendedor == 1) {
				$valorSistema	=	mysql_result($resSistema,0,'preciocliente') * ($ancho / 100);
			} else {
				$valorSistema	=	mysql_result($resSistema,0,'preciocosto') * ($ancho / 100);
			}
		} else {
			$valorSistema = 0;		
		}
	}
	
	/****************************************/
	
	/****************************************/
	
	//Valores finales en "cm"
	/*
	$telaAltoFinal	= ($alto * 10) - $altoResiduo;
	$telaAnchoFinal	= ($ancho * 10) - $anchoResiduo;
	$cañoFinal	= ($ancho * 10) - $rollerResiduo;
	$zocaloFinal	= ($ancho * 10) - $zocaloResiduo;
	*/
	$telaAltoFinal	= ($alto * 10);
	$telaAnchoFinal	= ($ancho * 10);
	$cañoFinal	= ($ancho * 10) - $rollerResiduo;
	$zocaloFinal	= ($ancho * 10) - $zocaloResiduo;
	
	if ($sistema == 3) {
		$telaAltoFinal	= ($alto * 10) - $altoResiduo;
	} else {
		$telaAltoFinal	= ($alto * 10); //el residuo esta en mm y el ancho en cm
	}
	/****************************************/
	
	/*****************     CALCULOS     ***********************************/
	$calculoSistema	= $valorSistema;
	/*if ($sistema == 2) {
		$calculoTela	= (((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela) + ((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela2));
	} else {*/
	$calculoTela	= ((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela);
	//}
	$total = $calculoSistema + $calculoTela;
	
	/********************   FIN     ******************************************/
	
	$res = $serviciosReferencias->modificarOrdenes($id,$numero,$refventas,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$refestados,$refSistema,$reftelas,$refresiduos,$roller,$tramado,$ancho/100,$alto/100,$reftelaopcional,$esdoble, $total);
	
	if ($res == true) {
		$serviciosReferencias->modificarVentasValor($refventas, $total);
		if ((mysql_result($resOrdenAux,0,'ancho') != $ancho) || (mysql_result($resOrdenAux,0,'alto') != $alto)) {
			$serviciosReferencias->eliminarTareasSistemasPorOrden($id);
			$serviciosReferencias->insertarTareasSistemasPorOrden($id, $refSistema);
		}


		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}

function eliminarOrdenes($serviciosReferencias) {
	$id = $_POST['id'];
	$res = $serviciosReferencias->eliminarOrdenes($id);
	echo $res;
} 

function cumplirTarea($serviciosReferencias) {
	$id = $_POST['id'];

	$res = $serviciosReferencias->cumplirTarea($id);
	echo $res;
}


/********************    FIN        ************************************************/


/*****************        Datos del dashBoard  *************************************/

function insertarOrdenessistematareas($serviciosReferencias) { 
	
	if (isset($_POST['refsistematareas'])) {

		$refsistematareas = $_POST['refsistematareas']; 
		$refordenes = $_POST['refordenes']; 
		
		if (isset($_POST['cumplida'])) { 
			$cumplida	= 1; 
		} else { 
			$cumplida = 0; 
		} 
		
		$res = $serviciosReferencias->insertarOrdenessistematareas($refsistematareas,$refordenes,$cumplida); 
		
		if ((integer)$res > 0) { 
			echo ''; 
		} else { 
			echo 'Huvo un error al insertar datos';	 
		} 
	} else {
		echo 'No extiste un tipo de Tarea Especifica para este sistema, debe crearlo.';	 
	}
} 


function modificarOrdenessistematareas($serviciosReferencias) { 
	$id = $_POST['id']; 
	$refsistematareas = $_POST['refsistematareas']; 
	$refordenes = $_POST['refordenes']; 
	
	if (isset($_POST['cumplida'])) { 
		$cumplida	= 1; 
	} else { 
		$cumplida = 0; 
	} 

	$res = $serviciosReferencias->modificarOrdenessistematareas($id,$refsistematareas,$refordenes,$cumplida); 
	
	if ($res == true) { 
		echo ''; 
	} else { 
		echo 'Huvo un error al modificar datos'; 
	} 
} 


function eliminarOrdenessistematareas($serviciosReferencias) { 
	$id = $_POST['id']; 
	$res = $serviciosReferencias->eliminarOrdenessistematareas($id); 
	echo $res; 
} 


function devolverPorcentajeCumplido($serviciosReferencias) {
	$id = $_POST['id']; 
	$res = $serviciosReferencias->devolverPorcentajeCumplido($id); 
	echo $res;

}



function insertarTipotarea($serviciosReferencias) {
	$tarea = $_POST['tarea'];
	$valor = $_POST['valor'];
	$detalle = $_POST['detalle'];
	
	$res = $serviciosReferencias->insertarTipotarea($tarea,$valor,$detalle);
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}


function modificarTipotarea($serviciosReferencias) {
	$id = $_POST['id'];
	$tarea = $_POST['tarea'];
	$valor = $_POST['valor'];
	$detalle = $_POST['detalle'];
	
	$res = $serviciosReferencias->modificarTipotarea($id,$tarea,$valor,$detalle);
	
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}


function eliminarTipotarea($serviciosReferencias) {
	$id = $_POST['id'];
	$res = $serviciosReferencias->eliminarTipotarea($id);
	echo $res;
} 


function insertarSistematareas($serviciosReferencias) {
	$refsistemas = $_POST['refsistemas'];
	$reftipotarea = $_POST['reftipotarea'];
	
	$existe = $serviciosReferencias->existeTareaEnSistema($refsistemas,$reftipotarea);

	if ($existe == 0) {
		$res = $serviciosReferencias->insertarSistematareas($refsistemas,$reftipotarea);
	
		if ((integer)$res > 0) {
			echo '';
		} else {
			echo 'Huvo un error al insertar datos';
		}
	} else {
		echo 'Ya existe esa tarea para este sistema';
	}
	
}


function modificarSistematareas($serviciosReferencias) {
	$id = $_POST['id'];
	$refsistemas = $_POST['refsistemas'];
	$reftipotarea = $_POST['reftipotarea'];
	
	$res = $serviciosReferencias->modificarSistematareas($id,$refsistemas,$reftipotarea);
	
	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}


function eliminarSistematareas($serviciosReferencias) {
	$id = $_POST['id'];
	$res = $serviciosReferencias->eliminarSistematareas($id);
	echo $res;
} 


function traerPagosPorCliente($serviciosReferencias) {
	$id = $_POST['id'];
	
	$res = $serviciosReferencias->traerPagosPorCliente($id);
	
	echo $res;
	
}

function traerVentasPorCliente($serviciosReferencias) {
	$id = $_POST['id'];
	
	$res = $serviciosReferencias->traerVentasPorClientes($id);
	
	$cad3 = '';
	//////////////////////////////////////////////////////busquedajugadores/////////////////////
	$cad3 = $cad3.'
				<div class="col-md-12">
				<div class="panel panel-info">
                                <div class="panel-heading">
                                	<h3 class="panel-title">Resultado de la Busqueda</h3>
                                	
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad3 = $cad3.'
	<div class="row">
                	<table id="example" class="table table-responsive table-striped" style=" padding:2px;">
						<thead>
                        <tr>
                        	<th align="left">NºFactura</th>
							<th align="left">Fecha</th>
                            <th align="left">Total</th>
							<th align="center">Detalle</th>
							<th align="center">Factura</th>
                        </tr>
						</thead>
						<tbody id="resultadosProd">';
	while ($rowJ = mysql_fetch_array($res)) {
		$cad3 .= '<tr>
					<td>'.utf8_encode($rowJ['numero']).'</td>
					<td>'.($rowJ['fechacrea']).'</td>
					<td>'.$rowJ['total'].'</td>
					<td><img src="../imagenes/verIco.png" style="cursor:pointer;" id="'.$rowJ[0].'" data-toggle="modal" data-target="#myModal" class="varVerDetalle"></td>
					<td><img src="../imagenes/pdf.png" style="cursor:pointer;" id="'.$rowJ[0].'" class="varGenerarFactura"></td>
				 </tr>';
	}
	
	$cad3 = $cad3.'</tbody>
                                </table></div>
                            </div>
						</div>';
						
	echo $cad3;
}


function traerVentasPorClienteACuenta($serviciosReferencias) {
	$id = $_POST['id'];
	
	$res = $serviciosReferencias->traerVentasPorClientesACuenta($id);
	
	$cad3 = '';
	//////////////////////////////////////////////////////busquedajugadores/////////////////////
	$cad3 = $cad3.'
				<div class="col-md-12">
				<div class="panel panel-info">
                                <div class="panel-heading">
                                	<h3 class="panel-title">Resultado de la Busqueda</h3>
                                	
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad3 = $cad3.'
	<div class="row">
                	<table id="example" class="table table-responsive table-striped" style=" padding:2px;">
						<thead>
                        <tr>
                        	<th align="left">NºFactura</th>
							<th align="left">Fecha</th>
                            <th align="left">Total</th>
							<th align="center">Detalle</th>
							<th align="center">Factura</th>
                        </tr>
						</thead>
						<tbody id="resultadosProd">';
	while ($rowJ = mysql_fetch_array($res)) {
		$cad3 .= '<tr>
					<td>'.utf8_encode($rowJ['numero']).'</td>
					<td>'.($rowJ['fechacrea']).'</td>
					<td>'.$rowJ['total'].'</td>
					<td><img src="../imagenes/verIco.png" style="cursor:pointer;" id="'.$rowJ[0].'" data-toggle="modal" data-target="#myModal" class="varVerDetalle"></td>
					<td><img src="../imagenes/pdf.png" style="cursor:pointer;" id="'.$rowJ[0].'" class="varGenerarFactura"></td>
				 </tr>';
	}
	
	$cad3 = $cad3.'</tbody>
                                </table></div>
                            </div>
						</div>';
						
	echo $cad3;
}



function traerDetallePagosPorCliente($serviciosReferencias) {
	$id = $_POST['id'];
	
	$res = $serviciosReferencias->traerDetallePagosPorCliente($id);
	
	$cad3 = '';
	//////////////////////////////////////////////////////busquedajugadores/////////////////////
	$cad3 = $cad3.'
				<div class="col-md-12">
				<div class="panel panel-info">
                                <div class="panel-heading">
                                	<h3 class="panel-title">Resultado de la Busqueda</h3>
                                	
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad3 = $cad3.'
	<div class="row">
                	<table id="example" class="table table-responsive table-striped" style=" padding:2px;">
						<thead>
                        <tr>
                        	<th align="left">Fecha Pago</th>
							<th align="left">Pago</th>
                            <th align="left">Observaciones</th>
                        </tr>
						</thead>
						<tbody id="resultadosProd">';
	while ($rowJ = mysql_fetch_array($res)) {
		$cad3 .= '<tr>
					<td>'.$rowJ['fechapago'].'</td>
					<td>'.$rowJ['pago'].'</td>
					<td>'.utf8_encode($rowJ['observaciones']).'</td>
				 </tr>';
	}
	
	$cad3 = $cad3.'</tbody>
                                </table></div>
                            </div>
						</div>';
						
	echo $cad3;
}



function traerDetalleVentaPorCliente($serviciosReferencias) {
	$id	=	$_POST['id'];
	$res	=	$serviciosReferencias->traerOrdenesPorVenta($id);
	
	$total = 0;
	$cad3 = '';
	//////////////////////////////////////////////////////busquedajugadores/////////////////////
	$cad3 = $cad3.'
				<div class="col-md-12">
				<div class="panel panel-info">
                                <div class="panel-heading">
                                	<h3 class="panel-title">Resultado de la Busqueda</h3>
                                	
                                </div>
                                <div class="panel-body-predio" style="padding:5px 20px;">
                                	';
	$cad3 = $cad3.'
	<div class="row">
                	<table id="example" class="table table-responsive table-striped" style="padding:2px;">
						<thead>
                        <tr>
                        	<th>Nro Orden</th>
							<th>Nro Venta</th>
							<th>Clientes</th>
							<th>Fecha</th>
							<th>Usua. Crea</th>
							<th>Sistema</th>
							<th>Tela</th>
							<th>Roller</th>
							<th>Tramado</th>
							<th>Ancho</th>
							<th>Alto</th>
							<th>Es Doble</th>
							<th>Tela Sec.</th>
                        </tr>
						</thead>
						<tbody id="resultadosProd">';
	while ($rowJ = mysql_fetch_array($res)) {
		$total += $rowJ['total'];
		$cad3 .= '<tr>
					<td>'.$rowJ[1].'</td>
					<td>'.$rowJ[2].'</td>
					<td>'.utf8_encode($rowJ[3]).'</td>
					<td>'.$rowJ[4].'</td>
					<td>'.$rowJ[5].'</td>
					<td>'.$rowJ[6].'</td>
					<td>'.$rowJ[7].'</td>
					<td>'.$rowJ[8].'</td>
					<td>'.$rowJ[9].'</td>
					<td>'.$rowJ[10].'</td>
					<td>'.$rowJ[11].'</td>
					<td>'.$rowJ[12].'</td>
					<td>'.$rowJ[13].'</td>
				 </tr>';
	}
	
	$cad3 = $cad3.'</tbody>
				   <tfoot>
				   	  <td style="font-size: 1.4em;" colspan="12">Total: </td>
					  <td style="color:#F00; font-size: 1.4em;">$ '.$total.'</td>
				   </tfoot>
                                </table></div>
                            </div>
						</div>';
						
	echo $cad3;
}


/*****************           fin de datos del dashBoard    *************************/


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
	$adelanto = $_POST['adelanto'];
	$total = $_POST['total'];
	$refclientes = $_POST['refclientes'];
	$reftipopago = $_POST['reftipopago'];
	if (isset($_POST['cancelada'])) {
		$cancelada = 1;
		$serviciosReferencias->eliminarVentas($id);
		//cancelo la venta y cancelo todas las ordenes
	} else {
		$cancelada = 0;
	}
	
	$res = $serviciosReferencias->modificarVentas($id,$numero,$adelanto,$total,$refclientes,$reftipopago,$cancelada);
	
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