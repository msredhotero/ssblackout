<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReferencias {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function convertidorMilimetros($medida, $valor) {
	switch ($medida) {
		case 'm':
			$valor = $valor * 1000;
			break;
		case 'dm':
			$valor = $valor * 100;
			break;
		case 'cm':
			$valor = $valor * 10;
			break;	
	}
	return $valor;
}

function cotizar($sistema, $tela, $residuo, $ancho, $alto, $esRevendedor) {
	//primero traigo el valor de la tela
	
	if (($sistema == 1) || ($sistema == 3)) {
		$resTelas	=	$this->traerTelasPorId($tela[0]);
		if (mysql_num_rows($resTelas)>0) {
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
	if ($sistema == 3) {
		$telaAltoFinal	= ($alto * 10) - $altoResiduo;
	} else {
		$telaAltoFinal	= ($alto * 10); //el residuo esta en mm y el ancho en cm
	}
	$telaAnchoFinal	= ($ancho * 10);
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
	//return $telaAltoFinal;
	return round($total,2,PHP_ROUND_HALF_UP);
	
}


/* PARA Cabecerapresupuesto */


function insertarCabecerapresupuesto($refusuarios,$refclientes,$fecha,$monto,$adelanto,$solicitante,$nrodocumento,$observaciones,$refestados) {
$sql = "insert into dbcabecerapresupuesto(idcabecerapresupuesto,refusuarios,refclientes,fecha,monto,adelanto,solicitante,nrodocumento,observaciones,refestados)
values ('',".$refusuarios.",".$refclientes.",'".utf8_decode($fecha)."',".$monto.",".$adelanto.",'".utf8_decode($solicitante)."','".utf8_decode($nrodocumento)."','".utf8_decode($observaciones)."',".$refestados.")";
$res = $this->query($sql,1);
return $res;
}


function modificarCabecerapresupuesto($id,$refusuarios,$refclientes,$fecha,$monto,$adelanto,$solicitante,$nrodocumento,$observaciones,$refestados) {
$sql = "update dbcabecerapresupuesto
set
refusuarios = ".$refusuarios.",refclientes = ".$refclientes.",fecha = '".utf8_decode($fecha)."',monto = ".$monto.",adelanto = ".$adelanto.",solicitante = '".utf8_decode($solicitante)."',nrodocumento = '".utf8_decode($nrodocumento)."',observaciones = '".utf8_decode($observaciones)."',refestados = ".$refestados."
where idcabecerapresupuesto =".$id;
$res = $this->query($sql,0);
return $res;
}

function modificarCabecerapresupuestoEstado($id) {
	$sql = "update dbcabecerapresupuesto set refestados = 3 where idcabecerapresupuesto =".$id;	
	
	$res = $this->query($sql,0);
	return $res;
}


function eliminarCabecerapresupuesto($id) {
$sql = "delete from dbcabecerapresupuesto where idcabecerapresupuesto =".$id;
$res = $this->query($sql,0);
return $res;
} 


function traerCabecerapresupuesto() {
	$sql = "SELECT 
		    c.idcabecerapresupuesto,
		    u.nombrecompleto AS usuario,
		    cl.nombrecompleto AS cliente,
		    cl.dni,
		    c.fecha,
		    c.monto,
		    c.adelanto,
		    c.solicitante,
		    c.nrodocumento,
		    c.observaciones,
		    est.estado,
		    c.refusuarios,
		    c.refclientes,
		    c.refestados
		FROM
		    dbcabecerapresupuesto c
		        INNER JOIN
		    dbusuarios u ON u.idusuario = c.refusuarios
		        LEFT JOIN
		    dbclientes cl ON cl.idcliente = c.refclientes
		        INNER JOIN
		    tbestados est ON est.idestado = c.refestados
		ORDER BY c.fecha DESC";

	$res = $this->query($sql,0);
	return $res;
}


function traerCabecerapresupuestoPorUsuario($idUsuario) {
	$sql = "SELECT 
		    c.idcabecerapresupuesto,
		    u.nombrecompleto AS usuario,
		    cl.nombrecompleto AS cliente,
		    cl.dni,
		    c.fecha,
		    c.monto,
		    c.adelanto,
		    c.solicitante,
		    c.nrodocumento,
		    c.observaciones,
		    est.estado,
		    c.refusuarios,
		    c.refclientes,
		    c.refestados
		FROM
		    dbcabecerapresupuesto c
		        INNER JOIN
		    dbusuarios u ON u.idusuario = c.refusuarios
		        LEFT JOIN
		    dbclientes cl ON cl.idcliente = c.refclientes
		        INNER JOIN
		    tbestados est ON est.idestado = c.refestados
		where u.idusuario = ".$idUsuario."
		ORDER BY c.fecha DESC";

	$res = $this->query($sql,0);
	return $res;
}


function traerCabecerapresupuestoPorId($id) {
$sql = "select idcabecerapresupuesto,refusuarios,refclientes,fecha,monto,adelanto,solicitante,nrodocumento,observaciones,refestados from dbcabecerapresupuesto where idcabecerapresupuesto =".$id;
$res = $this->query($sql,0);
return $res;
} 


function insertarVentaPorPresupuesto($idCabecera) {
	$numero = $this->generarNroVenta();
	$sql = "INSERT INTO dbventas
			(idventa,
			numero,
			fecha,
			adelanto,
			total,
			refclientes,
			reftipopago,
			observacion,
			cancelada,
			refpresupuesto)
			SELECT '',
				'".$numero."',
				'".date('Y-m-d')."',
				adelanto,
				monto,
				refclientes,
				1,
				observaciones,
				0,
				idcabecerapresupuesto
			FROM dbcabecerapresupuesto
			where idcabecerapresupuesto =".$idCabecera;	
			
	$res = $this->query($sql,1);
	return $res;
	
}


function insertarDetallesOrdenPorPresupuesto($idCabecera, $idVenta) {
	
	if ($idVenta >0) {
		$resPresupuestos = $this->traerPresupuestosDetallePorCabecera($idCabecera);

		while ($row = mysql_fetch_array($resPresupuestos)) {
			$numero = $this->generarNroOrden();
			$res = $this->insertarOrdenes($numero,$idVenta,date('Y-m-d'),'',$row['usuacrea'],$row['usuamodi'],$row['refestados'],$row['refsistemas'],$row['reftelas'],$row['refresiduos'],$row['roller'],$row['tramado'],$row['ancho'],$row['alto'],$row['reftelaopcional'],$row['esdobleaux'],$row['monto']);
			$this->insertarTareasSistemasPorOrden($res, $row['refsistemas']);
		}		
		
		
		return $res;
	} else {
		return 0;
	}
}

function eliminarTareasSistemasPorOrden($idOrden) {
	$sql = "delete from dbordenessistematareas where refordenes =".$idOrden;
	$res = $this->query($sql,0);
	return $res;
}

function insertarTareasSistemasPorOrden($idOrden, $idSistema) {
	$sql = "INSERT INTO dbordenessistematareas
				(idordenesistematarea,
				refsistematareas,
				refordenes,
				cumplida)

				SELECT '',
					idsistematarea,
				    ".$idOrden.",
				    0
				FROM dbsistematareas 
				where refsistemas = ".$idSistema;
	$res = $this->query($sql,0);
	return $res;			
}


/* Fin */
/* /* Fin de la Tabla: dbcabecerapresupuesto*/

/* PARA Tipotarea */

function insertarTipotarea($tarea,$valor,$detalle) {
$sql = "insert into tbtipotarea(idtipotarea,tarea,valor,detalle)
values ('','".utf8_decode($tarea)."',".$valor.",'".utf8_decode($detalle)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarTipotarea($id,$tarea,$valor,$detalle) {
$sql = "update tbtipotarea
set
tarea = '".utf8_decode($tarea)."',valor = ".$valor.",detalle = '".utf8_decode($detalle)."'
where idtipotarea =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipotarea($id) {
$sql = "delete from tbtipotarea where idtipotarea =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerTipotarea() {
$sql = "select
t.idtipotarea,
t.tarea,
t.valor,
t.detalle
from tbtipotarea t
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerTipotareaPorId($id) {
$sql = "select idtipotarea,tarea,valor,detalle from tbtipotarea where idtipotarea =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbtipotarea*/


/* PARA Presupuestos */

function insertarPresupuestos($fechacrea,$fechamodi,$usuacrea,$usuamodi,$refestados,$refsistemas,$reftelas,$refresiduos,$roller,$tramado,$ancho,$alto,$reftelaopcional,$esdoble,$montofinal,$refcabecerapresupuesto) {
$sql = "insert into dbpresupuestos(idpresupuesto,fechacrea,fechamodi,usuacrea,usuamodi,refestados,refsistemas,reftelas,refresiduos,roller,tramado,ancho,alto,reftelaopcional,esdoble,montofinal,refcabecerapresupuesto)
values ('','".utf8_decode($fechacrea)."','".utf8_decode($fechamodi)."','".utf8_decode($usuacrea)."','".utf8_decode($usuamodi)."',".$refestados.",".$refsistemas.",".$reftelas.",".$refresiduos.",'".utf8_decode($roller)."','".utf8_decode($tramado)."',".$ancho.",".$alto.",".$reftelaopcional.",".$esdoble.",".$montofinal.",".$refcabecerapresupuesto.")";
$res = $this->query($sql,1);
return $res;
}


function modificarPresupuestos($id,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$refestados,$refsistemas,$reftelas,$refresiduos,$roller,$tramado,$ancho,$alto,$reftelaopcional,$esdoble,$montofinal,$refcabecerapresupuesto) {
$sql = "update dbpresupuestos
set
fechacrea = '".utf8_decode($fechacrea)."',fechamodi = '".utf8_decode($fechamodi)."',usuacrea = '".utf8_decode($usuacrea)."',usuamodi = '".utf8_decode($usuamodi)."',refestados = ".$refestados.",refsistemas = ".$refsistemas.",reftelas = ".$reftelas.",refresiduos = ".$refresiduos.",roller = '".utf8_decode($roller)."',tramado = '".utf8_decode($tramado)."',ancho = ".$ancho.",alto = ".$alto.",reftelaopcional = ".$reftelaopcional.",esdoble = ".$esdoble.",montofinal = ".$montofinal.",refcabecerapresupuesto = ".$refcabecerapresupuesto."
where idpresupuesto =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPresupuestos($id) {
$sql = "delete from dbpresupuestos where idpresupuesto =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPresupuestosDetallePorCabecera($idCabecera) {
$sql = "select 
			o.idcabecerapresupuesto,
			cl.nombrecompleto,
            cl.dni as dnicliente,
            o.solicitante,
            o.nrodocumento,
			o.fecha,
			ven.montofinal as monto,
            o.adelanto,
			sis.nombre as sistema,
			tel.tela,
			ven.roller,
			ven.tramado,
			ven.ancho,
			ven.alto,
			(case when ven.esdoble = 1 then 'Si' else 'No' end) as esdoble,
			(select tela from dbtelas where idtela = ven.reftelaopcional) as segundatela,
			res.roller as residuoroller,
			res.telaancho as residuotelaancho,
			res.telaalto as residuotelaalto,
			res.zocalo as residuozocalo,
			ven.idpresupuesto,
			ven.refestados,
			ven.refsistemas,
			ven.reftelas,
			ven.refresiduos,
			ven.reftelaopcional,
			ven.usuacrea,
			ven.usuamodi,
			ven.esdoble as esdobleaux
			
		from
			dbcabecerapresupuesto o
				inner join
			dbpresupuestos ven ON o.idcabecerapresupuesto = ven.refcabecerapresupuesto
				left join
			dbclientes cl ON cl.idcliente = o.refclientes
				inner join
			dbsistemas sis ON sis.idsistema = ven.refsistemas
				inner join
			tbroller ro ON ro.idroller = sis.refroller
				inner join
			dbtelas tel ON tel.idtela = ven.reftelas
				inner join
			tbtipotramados tit ON tit.idtipotramado = tel.reftipotramados
				inner join
			tbresiduos res ON res.idresiduo = ven.refresiduos		
		where o.idcabecerapresupuesto =".$idCabecera."	
		order by 1";

	$res = $this->query($sql,0);
	return $res;
}


function traerPresupuestosPorId($id) {
$sql = "select idpresupuesto,fechacrea,fechamodi,usuacrea,usuamodi,refestados,refsistemas,reftelas,refresiduos,roller,tramado,ancho,alto,reftelaopcional,esdoble,montofinal,refcabecerapresupuesto from dbpresupuestos where idpresupuesto =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbpresupuestos*/


/* PARA Sistematareas */
function existeTareaEnSistema($refsistemas,$reftipotarea) {
	$sql = "select * from dbsistematareas where refsistemas =".$refsistemas." and reftipotarea=".$reftipotarea;
	$res = $this->query($sql,0);

	if (mysql_num_rows($res)>0) {
		return 1;
	}
	return 0;
}


function insertarSistematareas($refsistemas,$reftipotarea) {
$sql = "insert into dbsistematareas(idsistematarea,refsistemas,reftipotarea)
values ('',".$refsistemas.",".$reftipotarea.")";
$res = $this->query($sql,1);
return $res;
}


function modificarSistematareas($id,$refsistemas,$reftipotarea) {
$sql = "update dbsistematareas
set
refsistemas = ".$refsistemas.",reftipotarea = ".$reftipotarea."
where idsistematarea =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarSistematareas($id) {
$sql = "delete from dbsistematareas where idsistematarea =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerSistematareas() {
$sql = "select
s.idsistematarea,
s.refsistemas,
s.reftipotarea
from dbsistematareas s
inner join dbsistemas sis ON sis.idsistema = s.refsistemas
inner join tbroller ro ON ro.idroller = sis.refroller
inner join tbtipotarea tip ON tip.idtipotarea = s.reftipotarea
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerSistematareasPorId($id) {
$sql = "select idsistematarea,refsistemas,reftipotarea from dbsistematareas where idsistematarea =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerSistemaTareasPorSistema($idSistema) {
	$sql = "select idsistematarea,refsistemas,reftipotarea from dbsistematareas where refsistemas =".$idSistema;
	$res = $this->query($sql,0);
	return $res;
}

function traerSistemaTareasPorSistemaTodos($idSistema) {
	$sql = "select 
					idsistematarea,
					sis.nombre as sistema,
					tip.tarea,
					tip.valor,
					refsistemas,
					reftipotarea 
				from dbsistematareas s
			inner join dbsistemas sis ON sis.idsistema = s.refsistemas
			inner join tbroller ro ON ro.idroller = sis.refroller
			inner join tbtipotarea tip ON tip.idtipotarea = s.reftipotarea where s.refsistemas =".$idSistema;
	$res = $this->query($sql,0);
	return $res;
}


function traerSistemaTareasPorSistemaSinUsar($idSistema) {
	$sql = "select 
					tip.idtipotarea,
					tip.tarea,
					tip.valor,
                    sis.nombre as sistema,
					refsistemas,
					reftipotarea 
				from tbtipotarea tip
			left join dbsistematareas s ON tip.idtipotarea = s.reftipotarea
            left join dbsistemas sis ON sis.idsistema = s.refsistemas and s.idsistematarea =".$idSistema."
            where sis.idsistema is null";
	$res = $this->query($sql,0);
	return $res;
}

function traerSistemaTareasPorSistemaSinUsarPorOrden($idOrden, $idSistema) {
	$sql = "select 
					s.idsistematarea,
					tip.tarea,
					tip.valor,
                    sis.nombre as sistema,
					refsistemas,
					reftipotarea 
				from tbtipotarea tip
			inner join dbsistematareas s ON tip.idtipotarea = s.reftipotarea
            inner join dbsistemas sis ON sis.idsistema = s.refsistemas
            left join dbordenessistematareas ost ON ost.refsistematareas = s.idsistematarea and ost.refordenes = ".$idOrden."
            where ost.refsistematareas is null and sis.idsistema =".$idSistema;
	$res = $this->query($sql,0);
	return $res;
}

function devolverPorcentajeCumplido($idOrden) {
	$sqlCumplidas = "select
			count(s.refordenes) as cantidad
			from dbordenessistematareas s
			where cumplida = 1 and s.refordenes = ".$idOrden;
	$resCumplidas = $this->query($sqlCumplidas,0);

	$sqlNoCumplidas = "select
			count(s.refordenes) as cantidad
			from dbordenessistematareas s
			where cumplida = 0 and s.refordenes = ".$idOrden;
    $resNoCumplidas = $this->query($sqlNoCumplidas,0);

	$sqlCantidad = "select
			count(s.refordenes) as cantidad
			from dbordenessistematareas s
			where s.refordenes = ".$idOrden;
	$resCantidad = $this->query($sqlCantidad,0);

	if (mysql_result($resCantidad,0,0)>0) {
		if (mysql_num_rows($resCumplidas)>0) {
			return mysql_result($resCumplidas,0,0) * 100 / mysql_result($resCantidad,0,0);
		} else {
			return 0;
		}
	} else {
		return 0;
	}
}

/* Fin */
/* /* Fin de la Tabla: dbsistematareas*/


/* PARA Ordenessistematareas */

function insertarOrdenessistematareas($refsistematareas,$refordenes,$cumplida) { 
$sql = "insert into dbordenessistematareas(idordenesistematarea,refsistematareas,refordenes,cumplida) 
values ('',".$refsistematareas.",".$refordenes.",".$cumplida.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarOrdenessistematareas($id,$refsistematareas,$refordenes,$cumplida) { 
$sql = "update dbordenessistematareas 
set 
refsistematareas = ".$refsistematareas.",refordenes = ".$refordenes.",cumplida = ".$cumplida." 
where idordenesistematarea =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarOrdenessistematareas($id) { 
$sql = "delete from dbordenessistematareas where idordenesistematarea =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerOrdenessistematareas() { 
$sql = "select 
o.idordenesistematarea,
o.refsistematareas,
o.refordenes,
o.cumplida
from dbordenessistematareas o 
inner join dbsistematareas sis ON sis.idsistematarea = o.refsistematareas 
inner join dbsistemas si ON si.idsistema = sis.refsistemas 
inner join tbtipotarea ti ON ti.idtipotarea = sis.reftipotarea 
inner join dbordenes ord ON ord.idorden = o.refordenes 
inner join dbventas ve ON ve.idventa = ord.refventas 
inner join tbestados es ON es.idestado = ord.refestados 
inner join dbsistemas s ON s.idsistema = ord.refsistemas 
inner join dbtelas te ON te.idtela = ord.reftelas 
inner join tbresiduos re ON re.idresiduo = ord.refresiduos 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerOrdenessistematareasPorOrden($idOrden) { 
$sql = "SELECT 
		    o.idordenesistematarea,
		    ti.tarea,
		    ti.detalle,
		    (case when o.cumplida = 1 then 'Si' else 'No' end) as cumplida,
		    ti.valor,
		    o.refsistematareas,
		    o.refordenes
		FROM
		    dbordenessistematareas o
		        INNER JOIN
		    dbsistematareas sis ON sis.idsistematarea = o.refsistematareas
		        INNER JOIN
		    dbsistemas si ON si.idsistema = sis.refsistemas
		        INNER JOIN
		    tbtipotarea ti ON ti.idtipotarea = sis.reftipotarea
		        INNER JOIN
		    dbordenes ord ON ord.idorden = o.refordenes
		        INNER JOIN
		    dbventas ve ON ve.idventa = ord.refventas
		        INNER JOIN
		    tbestados es ON es.idestado = ord.refestados
		        INNER JOIN
		    dbsistemas s ON s.idsistema = ord.refsistemas
		        INNER JOIN
		    dbtelas te ON te.idtela = ord.reftelas
		        INNER JOIN
		    tbresiduos re ON re.idresiduo = ord.refresiduos
		    where ord.idorden = ".$idOrden."
		ORDER BY o.cumplida"; 
	$res = $this->query($sql,0); 
	return $res; 
} 

function cumplirTarea($idordenesistematarea) {
	$sql = "update dbordenessistematareas set cumplida = (1 - cumplida) where idordenesistematarea =".$idordenesistematarea;
	$res = $this->query($sql,0); 

	$tarea = $this->traerOrdenessistematareasPorId($idordenesistematarea);
	return mysql_result($tarea, 0,'cumplida'); 
}


function traerOrdenessistematareasPorId($id) { 
$sql = "select idordenesistematarea,refsistematareas,refordenes,(case when cumplida = 1 then 'Si' else 'No' end) as cumplida from dbordenessistematareas where idordenesistematarea =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbordenessistematareas*/




/* PARA Clientes */

function insertarClientes($nombrecompleto,$cuil,$dni,$direccion,$telefono,$email,$observaciones) {
$sql = "insert into dbclientes(idcliente,nombrecompleto,cuil,dni,direccion,telefono,email,observaciones)
values ('','".utf8_decode($nombrecompleto)."','".utf8_decode($cuil)."','".utf8_decode($dni)."','".utf8_decode($direccion)."','".utf8_decode($telefono)."','".utf8_decode($email)."','".utf8_decode($observaciones)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarClientes($id,$nombrecompleto,$cuil,$dni,$direccion,$telefono,$email,$observaciones) {
$sql = "update dbclientes
set
nombrecompleto = '".utf8_decode($nombrecompleto)."',cuil = '".utf8_decode($cuil)."',dni = '".utf8_decode($dni)."',direccion = '".utf8_decode($direccion)."',telefono = '".utf8_decode($telefono)."',email = '".utf8_decode($email)."',observaciones = '".utf8_decode($observaciones)."'
where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarClientes($id) {
$sql = "delete from dbclientes where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerClientes() {
$sql = "select
c.idcliente,
c.nombrecompleto,
c.cuil,
c.dni,
c.direccion,
c.telefono,
c.email,
c.observaciones
from dbclientes c
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerClientesPorId($id) {
$sql = "select idcliente,nombrecompleto,cuil,dni,direccion,telefono,email,observaciones from dbclientes where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbclientes*/


/* PARA Proveedores */

function insertarProveedores($nombre,$cuit,$dni,$direccion,$telefono,$celular,$email,$observacionces) {
$sql = "insert into dbproveedores(idproveedor,nombre,cuit,dni,direccion,telefono,celular,email,observacionces)
values ('','".utf8_decode($nombre)."','".utf8_decode($cuit)."','".utf8_decode($dni)."','".utf8_decode($direccion)."','".utf8_decode($telefono)."','".utf8_decode($celular)."','".utf8_decode($email)."','".utf8_decode($observacionces)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarProveedores($id,$nombre,$cuit,$dni,$direccion,$telefono,$celular,$email,$observacionces) {
$sql = "update dbproveedores
set
nombre = '".utf8_decode($nombre)."',cuit = '".utf8_decode($cuit)."',dni = '".utf8_decode($dni)."',direccion = '".utf8_decode($direccion)."',telefono = '".utf8_decode($telefono)."',celular = '".utf8_decode($celular)."',email = '".utf8_decode($email)."',observacionces = '".utf8_decode($observacionces)."'
where idproveedor =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarProveedores($id) {
$sql = "delete from dbproveedores where idproveedor =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerProveedores() {
$sql = "select
p.idproveedor,
p.nombre,
p.cuit,
p.dni,
p.direccion,
p.telefono,
p.celular,
p.email,
p.observacionces
from dbproveedores p
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerProveedoresPorId($id) {
$sql = "select idproveedor,nombre,cuit,dni,direccion,telefono,celular,email,observacionces from dbproveedores where idproveedor =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbproveedores*/


/* PARA Sistemas */

function insertarSistemas($nombre,$refroller,$desde,$hasta,$preciocosto,$preciocliente) {
$sql = "insert into dbsistemas(idsistema,nombre,refroller,desde,hasta,preciocosto,preciocliente)
values ('','".utf8_decode($nombre)."',".$refroller.",".$desde.",".$hasta.",".$preciocosto.",".$preciocliente.")";
$res = $this->query($sql,1);
return $res;
}


function modificarSistemas($id,$nombre,$refroller,$desde,$hasta,$preciocosto,$preciocliente) {
$sql = "update dbsistemas
set
nombre = '".utf8_decode($nombre)."',refroller = ".$refroller.",desde = ".$desde.",hasta = ".$hasta.",preciocosto = ".$preciocosto.",preciocliente = ".$preciocliente."
where idsistema =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarSistemas($id) {
$sql = "delete from dbsistemas where idsistema =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerSistemas() {
$sql = "select
s.idsistema,
s.nombre,
rol.diametro as roller,
s.desde,
s.hasta,
s.preciocosto,
s.preciocliente,
s.refroller
from dbsistemas s
inner join tbroller rol ON rol.idroller = s.refroller
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerSistemasPorId($id) {
$sql = "select idsistema,nombre,refroller,desde,hasta,preciocosto,preciocliente from dbsistemas where idsistema =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerSistemasPorSistema($idSistema) {
$sql = "select
s.idsistema,
s.nombre,
rol.diametro as roller,
s.desde,
s.hasta,
s.preciocosto,
s.preciocliente,
s.refroller
from dbsistemas s
inner join tbroller rol ON rol.idroller = s.refroller
where s.idsistema =".$idSistema;
$res = $this->query($sql,0);
return $res;
}

function traerSistemasPorMedida($ancho) {
$sql = "select s.idsistema,s.nombre,s.refroller,s.desde,s.hasta,s.preciocosto,s.preciocliente , rol.diametro
			from dbsistemas s
			inner join tbroller rol ON rol.idroller = s.refroller 
			where ".$ancho." between desde and hasta";
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbsistemas*/


/* PARA Telas */

function insertarTelas($tela,$reftipotramados,$ancho,$alto,$preciolista,$preciocosto,$preciocliente) {
$sql = "insert into dbtelas(idtela,tela,reftipotramados,ancho,alto,preciolista,preciocosto,preciocliente)
values ('','".utf8_decode($tela)."',".$reftipotramados.",".$ancho.",".$alto.",".$preciolista.",".$preciocosto.",".$preciocliente.")";
$res = $this->query($sql,1);
return $res;
}


function modificarTelas($id,$tela,$reftipotramados,$ancho,$alto,$preciolista,$preciocosto,$preciocliente) {
$sql = "update dbtelas
set
tela = '".utf8_decode($tela)."',reftipotramados = ".$reftipotramados.",ancho = ".$ancho.",alto = ".$alto.",preciolista = ".$preciolista.",preciocosto = ".$preciocosto.",preciocliente = ".$preciocliente."
where idtela =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTelas($id) {
$sql = "delete from dbtelas where idtela =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerTelas() {
$sql = "select
t.idtela,
t.tela,
t.reftipotramados,
t.ancho,
t.alto,
t.preciolista,
t.preciocosto,
t.preciocliente,
tip.tipotramado
from dbtelas t
inner join tbtipotramados tip ON tip.idtipotramado = t.reftipotramados
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerTelasPorId($id) {
$sql = "select t.idtela,t.tela,t.reftipotramados,t.ancho,t.alto,t.preciolista,t.preciocosto,t.preciocliente , tip.tipotramado
			from dbtelas t
			inner join tbtipotramados tip ON tip.idtipotramado = t.reftipotramados 
			where idtela =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbtelas*/


/* PARA Usuarios */

function insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto) {
$sql = "insert into dbusuarios(idusuario,usuario,password,refroles,email,nombrecompleto)
values ('','".utf8_decode($usuario)."','".utf8_decode($password)."',".$refroles.",'".utf8_decode($email)."','".utf8_decode($nombrecompleto)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto) {
$sql = "update dbusuarios
set
usuario = '".utf8_decode($usuario)."',password = '".utf8_decode($password)."',refroles = ".$refroles.",email = '".utf8_decode($email)."',nombrecompleto = '".utf8_decode($nombrecompleto)."'
where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarUsuarios($id) {
$sql = "delete from dbusuarios where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerUsuarios() {
$sql = "select
u.idusuario,
u.usuario,
u.password,
u.refroles,
u.email,
u.nombrecompleto
from dbusuarios u
inner join tbroles rol ON rol.idrol = u.refroles
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerUsuariosPorId($id) {
$sql = "select idusuario,usuario,password,refroles,email,nombrecompleto from dbusuarios where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbusuarios*/


/* PARA Ventas */


function traerCantidadOrdenes() {
	$sql = "select count(*) from dbordenes where refestados in (1,2)";
	$res = $this->query($sql,0); 
	return $res; 	
}

function traerCantidadClientes() {
	$sql = "select count(*) from dbclientes";
	$res = $this->query($sql,0); 
	return $res; 	
}


function traerCantidadVentas($fecha) {
	$sql = "select count(*) from dbventas v where v.fecha = '".$fecha."'";
	$res = $this->query($sql,0); 
	return $res; 	
}

function generarNroVenta() {
	$sql = "select max(idventa) as id from dbventas";	
	$res = $this->query($sql,0);
	
	if (mysql_num_rows($res)>0) {
		$nro = 'CC'.str_pad(mysql_result($res,0,0)+1, 8, "0", STR_PAD_LEFT);
	} else {
		$nro = 'CC00000001';
	}
	
	return $nro;
}


function insertarVentas($numero,$fecha,$adelanto,$total,$refclientes,$reftipopago,$observacion,$cancelada,$refpresupuesto) {
$sql = "insert into dbventas(idventa,numero,fecha,adelanto,total,refclientes,reftipopago,observacion,cancelada,refpresupuesto)
values ('','".utf8_decode($numero)."','".utf8_decode($fecha)."',".$adelanto.",".$total.",".$refclientes.",".$reftipopago.",'".utf8_decode($observacion)."',0,".$refpresupuesto.")";
$res = $this->query($sql,1);
return $res;
} 


function modificarVentas($id,$numero,$adelanto,$total,$refclientes,$reftipopago,$cancelada) {
$sql = "update dbventas
set
numero = '".utf8_decode($numero)."',adelanto = ".($adelanto == '' ? 0 : $adelanto).",total = ".$total.",refclientes = ".$refclientes.",reftipopago = ".$reftipopago.",cancelada = ".$cancelada."
where idventa =".$id;
$res = $this->query($sql,0);
return $res;
}


function modificarVentasValor($id,$total) {
$sql = "update dbventas v
set
v.total = (select sum(o.monto) from dbordenes o where o.refventas = ".$id.")
where v.idventa =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarVentas($id) {
$sql = "update dbventas set cancelada = 1 where idventa =".$id;
$res = $this->query($sql,0);

$sql = "update dbordenes set refestados = 5 where refventas =".$id;
$res = $this->query($sql,0);

return $res;
}


function traerVentas() {
$sql = "select
v.idventa,
v.numero,
cli.nombrecompleto,
v.adelanto,
v.total,
v.fecha,
tip.descripcion,
(case when v.cancelada = 1 then 'Si' else 'No' end) as cancelada,
v.refclientes,
v.reftipopago
from dbventas v
inner join dbclientes cli ON cli.idcliente = v.refclientes
inner join tbtipopago tip ON tip.idtipopago = v.reftipopago
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerVentasPorId($id) {
$sql = "select idventa,numero,fecha,adelanto,total,refclientes,reftipopago,cancelada,fecha from dbventas where idventa =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerVentasPorDia($fecha) {
	$sql = "select
v.idventa,
v.numero,
v.fecha,
tip.descripcion,
v.total,
cli.nombrecompleto,
(case when v.cancelada = 1 then 'Si' else 'No' end) as cancelado,
coalesce(u.nombrecompleto, ord.usuacrea) as usuacrea,
v.reftipopago,
v.refclientes
from dbventas v
inner join tbtipopago tip ON tip.idtipopago = v.reftipopago
inner join dbclientes cli ON cli.idcliente = v.refclientes
inner join dbordenes ord ON v.idventa = ord.refventas
left join dbcabecerapresupuesto cab ON cab.idcabecerapresupuesto = v.refpresupuesto
left join dbusuarios u ON u.idusuario = cab.refusuarios
where	ord.refestados in (1,2)
group by v.idventa,v.numero,v.fecha,tip.descripcion,v.total,cli.nombrecompleto,v.cancelada ,v.reftipopago,u.nombrecompleto,v.refclientes,ord.usuacrea
order by v.fecha desc";
$res = $this->query($sql,0);
return $res;
}


function traerVentasPorAno($anio) {
		$sql = "select
			m.mes as mes,
			m.nombremes as nombremes,
			coalesce( v.total,0) as total
			from tbmeses m
			left join (select sum(ve.total) as total,month(ve.fecha) as mes
						from dbventas ve
						where year(ve.fecha)=".$anio." and ve.cancelada = 0 
						group by month(ve.fecha)
					  ) v on v.mes = m.mes
			order by m.mes";
	$res = $this->query($sql,0);
	return $res;
}



function graficosProductosConsumoMayores($anio) {
	
	$sqlT = "select
			
				coalesce(count(dv.refsistemas),0)

			from dbventas v
			inner join dbordenes dv ON v.idventa = dv.refventas
			where	year(v.fecha) = ".$anio." and v.cancelada = 0";
			
	$resT = $this->query($sqlT,0);
	
	if (mysql_num_rows($resT)>0) {
	
		$cantidad = mysql_result($resT,0,0);
		$sql = "select
			
				s.idsistema, s.nombre as descripcion, round((coalesce(count(s.idsistema),0) * 100 / ".$cantidad."),2) as porcentaje
		
					from dbventas v
					inner join dbordenes dv ON v.idventa = dv.refventas
					inner join dbsistemas s ON s.idsistema = dv.refsistemas
					where	year(v.fecha) = ".$anio." and v.cancelada = 0
			group by s.idsistema, s.nombre
			order by (coalesce(count(s.idsistema),0) / 100 * ".$cantidad.") desc
			";
			
		//return $this->query($sql,0);	
		$resR = $this->query($sql,0);
		return $resR;
			
	}
	
	$sql = "select
			
				s.idsistema, s.nombre as descripcion, 10 as porcentaje
		
					from dbventas v
					inner join dbordenes dv ON v.idventa = dv.refventas
					inner join dbsistemas s ON s.idsistema = dv.refsistemas
					where	year(v.fecha) = 9 and v.cancelada = 0
			group by s.idsistema, s.nombre
			limit 5
			";
			
		return $this->query($sql,0);
		//return $sql;

	
}



function graficosProductosConsumoAnual($anio) {


	$sql = "select
			
				s.idsistema, s.nombre as descripcion, coalesce(count(s.idsistema),0)
		
					from dbventas v
					inner join dbordenes dv ON v.idventa = dv.refventas
					inner join dbsistemas s ON s.idsistema = dv.refsistemas
					where	year(v.fecha) = ".$anio." and v.cancelada = 0
			group by s.idsistema, s.nombre
			";
			
	$sqlT = "select
			
				coalesce(count(s.idsistema),0)

			from dbventas v
					inner join dbordenes dv ON v.idventa = dv.refventas
					inner join dbsistemas s ON s.idsistema = dv.refsistemas
			where	year(v.fecha) = ".$anio." and v.cancelada = 0";
			
	$sqlT2 = "select
					count(*)
				from dbsistemas p
			";

	
	$resT = mysql_result($this->query($sqlT,0),0,0);
	$resR = $this->query($sql,0);
	
	$cad	= "Morris.Donut({
              element: 'graph2',
			  stacked: true,
              data: [";
	$cadValue = '';
	if ($resT > 0) {
		while ($row = mysql_fetch_array($resR)) {
			$cadValue .= "{value: ".((100 * $row[2])	/ $resT).", label: '".$row[1]."'},";
		}
	}
	

	$cad .= substr($cadValue,0,strlen($cadValue)-1);
    $cad .=          "],
              formatter: function (x) { return x + '%'}
            }).on('click', function(i, row){
              console.log(i, row);
            });";
			
	return $cad;
}


function graficosProductosConsumoMensual($anio, $mes) {


	$sql = "select
			
				s.idsistema, s.nombre as descripcion, coalesce(count(s.idsistema),0)
		
					from dbventas v
					inner join dbordenes dv ON v.idventa = dv.refventas
					inner join dbsistemas s ON s.idsistema = dv.refsistemas
					where	year(v.fecha) = ".$anio." and month(v.fecha) = ".$mes." and v.cancelada = 0
			group by s.idsistema, s.nombre
			";
			
	$sqlT = "select
			
				coalesce(count(s.idsistema),0)

			from dbventas v
					inner join dbordenes dv ON v.idventa = dv.refventas
					inner join dbsistemas s ON s.idsistema = dv.refsistemas
			where	year(v.fecha) = ".$anio." and month(v.fecha) = ".$mes." and v.cancelada = 0";
			
	$sqlT2 = "select
					count(*)
				from dbsistemas p
			";

	
	$resT = mysql_result($this->query($sqlT,0),0,0);
	$resR = $this->query($sql,0);
	
	$cad	= "Morris.Donut({
              element: 'graph3',
			  stacked: true,
			  resize: false,
              data: [";
	$cadValue = '';
	if ($resT > 0) {
		while ($row = mysql_fetch_array($resR)) {
			$cadValue .= "{value: ".((100 * $row[2])	/ $resT).", label: '".$row[1]."'},";
		}
	}
	

	$cad .= substr($cadValue,0,strlen($cadValue)-1);
    $cad .=          "],
              formatter: function (x) { return x + '%'}
            }).on('click', function(i, row){
              console.log(i, row);
            });";
			
	return $cad;
}



function traerVentasPorClientesACuenta($idCliente) {
	$sql = "select
v.idventa,

v.numero,
ord.fechacrea,
tip.descripcion,
v.total,
cli.nombrecompleto,
(case when v.cancelada = 1 then 'Si' else 'No' end) as cancelado,
v.reftipopago,
ord.usuacrea,
v.refclientes
from dbventas v
inner join tbtipopago tip ON tip.idtipopago = v.reftipopago
inner join dbclientes cli ON cli.idcliente = v.refclientes
inner join dbordenes ord ON v.idventa = ord.refventas
where	v.refclientes = ".$idCliente." and tip.idtipopago = 5
order by 1 desc";
$res = $this->query($sql,0);
return $res;
}


function traerVentasPorClientes($idCliente) {
	$sql = "select
v.idventa,

v.numero,
ord.fechacrea,
tip.descripcion,
v.total,
cli.nombrecompleto,
(case when v.cancelada = 1 then 'Si' else 'No' end) as cancelado,
v.reftipopago,
ord.usuacrea,
v.refclientes
from dbventas v
inner join tbtipopago tip ON tip.idtipopago = v.reftipopago
inner join dbclientes cli ON cli.idcliente = v.refclientes
inner join dbordenes ord ON v.idventa = ord.refventas
where	v.refclientes = ".$idCliente." and tip.idtipopago <> 5
order by 1 desc";
$res = $this->query($sql,0);
return $res;
}



/* Fin */
/* /* Fin de la Tabla: dbventas*/


/* PARA Images */

function insertarImages($refproyecto,$refuser,$imagen,$type,$principal) {
$sql = "insert into images(idfoto,refproyecto,refuser,imagen,type,principal)
values ('',".$refproyecto.",".$refuser.",'".utf8_decode($imagen)."','".utf8_decode($type)."',".$principal.")";
$res = $this->query($sql,1);
return $res;
}


function modificarImages($id,$refproyecto,$refuser,$imagen,$type,$principal) {
$sql = "update images
set
refproyecto = ".$refproyecto.",refuser = ".$refuser.",imagen = '".utf8_decode($imagen)."',type = '".utf8_decode($type)."',principal = ".$principal."
where idfoto =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarImages($id) {
$sql = "delete from images where idfoto =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerImages() {
$sql = "select
i.idfoto,
i.refproyecto,
i.refuser,
i.imagen,
i.type,
i.principal
from images i
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerImagesPorId($id) {
$sql = "select idfoto,refproyecto,refuser,imagen,type,principal from images where idfoto =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: images*/


/* PARA Predio_menu */

function insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "insert into predio_menu(idmenu,url,icono,nombre,Orden,hover,permiso)
values ('','".utf8_decode($url)."','".utf8_decode($icono)."','".utf8_decode($nombre)."',".$Orden.",'".utf8_decode($hover)."','".utf8_decode($permiso)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "update predio_menu
set
url = '".utf8_decode($url)."',icono = '".utf8_decode($icono)."',nombre = '".utf8_decode($nombre)."',Orden = ".$Orden.",hover = '".utf8_decode($hover)."',permiso = '".utf8_decode($permiso)."'
where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPredio_menu($id) {
$sql = "delete from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menu() {
$sql = "select
p.idmenu,
p.url,
p.icono,
p.nombre,
p.Orden,
p.hover,
p.permiso
from predio_menu p
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menuPorId($id) {
$sql = "select idmenu,url,icono,nombre,Orden,hover,permiso from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: predio_menu*/


/* PARA Estados */

function insertarEstados($estado,$icono) {
$sql = "insert into tbestados(idestado,estado,icono)
values ('','".utf8_decode($estado)."','".utf8_decode($icono)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarEstados($id,$estado,$icono) {
$sql = "update tbestados
set
estado = '".utf8_decode($estado)."',icono = '".utf8_decode($icono)."'
where idestado =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarEstados($id) {
$sql = "delete from tbestados where idestado =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerEstados() {
$sql = "select
e.idestado,
e.estado,
e.icono
from tbestados e
order by 1";
$res = $this->query($sql,0);
return $res;
}

function traerEstadosPorRevendedor() {
$sql = "select
e.idestado,
e.estado,
e.icono
from tbestados e
where e.idestado in (1,5)";
$res = $this->query($sql,0);
return $res;
}


function traerEstadosPorId($id) {
$sql = "select idestado,estado,icono from tbestados where idestado =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbestados*/


/* PARA Residuos */

function insertarResiduos($nombre,$roller,$telaancho,$telaalto,$zocalo) {
$sql = "insert into tbresiduos(idresiduo,nombre,roller,telaancho,telaalto,zocalo)
values ('','".utf8_decode($nombre)."',".$roller.",".$telaancho.",".$telaalto.",".$zocalo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarResiduos($id,$nombre,$roller,$telaancho,$telaalto,$zocalo) {
$sql = "update tbresiduos
set
nombre = '".utf8_decode($nombre)."',roller = ".$roller.",telaancho = ".$telaancho.",telaalto = ".$telaalto.",zocalo = ".$zocalo."
where idresiduo =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarResiduos($id) {
$sql = "delete from tbresiduos where idresiduo =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerResiduos() {
$sql = "select
r.idresiduo,
r.nombre,
r.roller,
r.telaancho,
r.telaalto,
r.zocalo
from tbresiduos r
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerResiduosPorId($id) {
$sql = "select idresiduo,nombre,roller,telaancho,telaalto,zocalo from tbresiduos where idresiduo =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbresiduos*/


/* PARA Roles */

function insertarRoles($descripcion,$activo) {
$sql = "insert into tbroles(idrol,descripcion,activo)
values ('','".utf8_decode($descripcion)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarRoles($id,$descripcion,$activo) {
$sql = "update tbroles
set
descripcion = '".utf8_decode($descripcion)."',activo = ".$activo."
where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarRoles($id) {
$sql = "delete from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerRoles() {
$sql = "select
r.idrol,
r.descripcion,
r.activo
from tbroles r
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerRolesPorId($id) {
$sql = "select idrol,descripcion,activo from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbroles*/


/* PARA Roller */

function insertarRoller($diametro,$activo) {
$sql = "insert into tbroller(idroller,diametro,activo)
values ('',".$diametro.",".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarRoller($id,$diametro,$activo) {
$sql = "update tbroller
set
diametro = ".$diametro.",activo = ".$activo."
where idroller =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarRoller($id) {
$sql = "delete from tbroller where idroller =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerRoller() {
$sql = "select
r.idroller,
r.diametro,
(case when r.activo = 1 then 'Si' else 'No' end) as activo
from tbroller r
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerRollerPorId($id) {
$sql = "select idroller,diametro,activo from tbroller where idroller =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbroller*/


/* PARA Tipopago */

function insertarTipopago($descripcion) {
$sql = "insert into tbtipopago(idtipopago,descripcion)
values ('','".utf8_decode($descripcion)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarTipopago($id,$descripcion) {
$sql = "update tbtipopago
set
descripcion = '".utf8_decode($descripcion)."'
where idtipopago =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipopago($id) {
$sql = "delete from tbtipopago where idtipopago =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerTipopago() {
$sql = "select
t.idtipopago,
t.descripcion
from tbtipopago t
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerTipopagoPorId($id) {
$sql = "select idtipopago,descripcion from tbtipopago where idtipopago =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbtipopago*/


/* PARA Tipotramados */

function insertarTipotramados($tipotramado,$activo) {
$sql = "insert into tbtipotramados(idtipotramado,tipotramado,activo)
values ('','".utf8_decode($tipotramado)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarTipotramados($id,$tipotramado,$activo) {
$sql = "update tbtipotramados
set
tipotramado = '".utf8_decode($tipotramado)."',activo = ".$activo."
where idtipotramado =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipotramados($id) {
$sql = "delete from tbtipotramados where idtipotramado =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerTipotramados() {
$sql = "select
t.idtipotramado,
t.tipotramado,
(case when t.activo = 1 then 'Si' else 'No' end) as activo
from tbtipotramados t
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerTipotramadosPorId($id) {
$sql = "select idtipotramado,tipotramado,activo from tbtipotramados where idtipotramado =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbtipotramados*/




/* PARA Ordenes */

function generarNroOrden() {
	$sql = "select max(idorden) as id from dbordenes";	
	$res = $this->query($sql,0);
	
	if (mysql_num_rows($res)>0) {
		$nro = 'ORD'.str_pad(mysql_result($res,0,0)+1, 7, "0", STR_PAD_LEFT);
	} else {
		$nro = 'ORD0000001';
	}
	
	return $nro;
}



function insertarOrdenes($numero,$refventas,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$refestados,$refsistemas,$reftelas,$refresiduos,$roller,$tramado,$ancho,$alto,$reftelaopcional,$esdoble, $monto) {
$sql = "insert into dbordenes(idorden,numero,refventas,fechacrea,fechamodi,usuacrea,usuamodi,refestados,refsistemas,reftelas,refresiduos,roller,tramado,ancho,alto,reftelaopcional,esdoble, monto)
values ('','".utf8_decode($numero)."',".$refventas.",'".utf8_decode($fechacrea)."','".utf8_decode($fechamodi)."','".utf8_decode($usuacrea)."','".utf8_decode($usuamodi)."',".$refestados.",".$refsistemas.",".$reftelas.",".$refresiduos.",'".utf8_decode($roller)."','".utf8_decode($tramado)."',".$ancho.",".$alto.",".($reftelaopcional == '' ? 0 : $reftelaopcional).",".$esdoble.",".$monto.")";
$res = $this->query($sql,1);
return $res;
}


function modificarOrdenes($id,$numero,$refventas,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$refestados,$refsistemas,$reftelas,$refresiduos,$roller,$tramado,$ancho,$alto,$reftelaopcional,$esdoble, $monto) {
$sql = "update dbordenes
set
numero = '".utf8_decode($numero)."',refventas = ".$refventas.",fechamodi = '".date('Y-m-d')."',usuamodi = '".utf8_decode($usuamodi)."',refestados = ".$refestados.",refsistemas = ".$refsistemas.",reftelas = ".$reftelas.",refresiduos = ".$refresiduos.",roller = '".utf8_decode($roller)."',tramado = '".utf8_decode($tramado)."',ancho = ".$ancho.",alto = ".$alto.",reftelaopcional = ".($reftelaopcional == '' ? 0 : $reftelaopcional).",esdoble = ".$esdoble.", monto = ".$monto."
where idorden =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarOrdenes($id) {

$resOrd = $this->traerOrdenesPorId($id);	
$idVenta= mysql_result($resOrd,0,'refventas');
	
$sql = "update dbventas set cancelada = 1 where idventa =".$idVenta;
$res = $this->query($sql,0);

$sql = "update dbordenes set refestados = 5 where refventas =".$idVenta;
$res = $this->query($sql,0);

return $res;
}


function traerOrdenes() {
$sql = "select 
			o.idorden,
			o.numero as nroorden,
			ven.numero as nroventa,
			cl.nombrecompleto,
			o.fechacrea,
			o.usuacrea,
			sis.nombre as sistema,
			tel.tela,
			o.roller,
			o.tramado,
			o.ancho,
			o.alto,
			(case when o.esdoble = 1 then 'Si' else 'No' end) as esdoble,
			(select tela from dbtelas where idtela = o.reftelaopcional) as segundatela,
			o.fechamodi,
			o.usuamodi,
			res.roller as residuoroller,
			res.telaancho as residuotelaancho,
			res.telaalto as residuotelaalto,
			res.zocalo as residuozocalo,
			o.refventas,
			o.refestados,
			o.refsistemas,
			o.reftelas,
			o.refresiduos,
			o.reftelaopcional,
			o.monto as ordenmontomonto
			
		from
			dbordenes o
				inner join
			dbventas ven ON ven.idventa = o.refventas
				inner join
			dbclientes cl ON cl.idcliente = ven.refclientes
				inner join
			tbtipopago ti ON ti.idtipopago = ven.reftipopago
				inner join
			tbestados est ON est.idestado = o.refestados
				inner join
			dbsistemas sis ON sis.idsistema = o.refsistemas
				inner join
			tbroller ro ON ro.idroller = sis.refroller
				inner join
			dbtelas tel ON tel.idtela = o.reftelas
				inner join
			tbtipotramados tit ON tit.idtipotramado = tel.reftipotramados
				inner join
			tbresiduos res ON res.idresiduo = o.refresiduos		
		order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerOrdenesPorId($id) {
$sql = "select idorden,numero,refventas,fechacrea,fechamodi,usuacrea,usuamodi,refestados,refsistemas,reftelas,refresiduos,roller,tramado,ancho,alto,reftelaopcional,esdoble, monto from dbordenes where idorden =".$id;
$res = $this->query($sql,0);
return $res;
} 


function traerOrdenesPorVenta($idVenta) {
$sql = "select 
			o.idorden,
			o.numero as nroorden,
			ven.numero as nroventa,
			cl.nombrecompleto,
			DATE_FORMAT(o.fechacrea,'%Y-%m-%d') AS fechacrea,
			o.usuacrea,
			sis.nombre as sistema,
			tel.tela,
			o.roller,
			o.tramado,
			o.ancho,
			o.alto,
			(case when o.esdoble = 1 then 'Si' else 'No' end) as esdoble,
			(select tela from dbtelas where idtela = o.reftelaopcional) as segundatela,
			est.estado,
			o.monto as ordenmontomonto,
			o.fechamodi,
			o.usuamodi,
			res.roller as residuoroller,
			res.telaancho as residuotelaancho,
			res.telaalto as residuotelaalto,
			res.zocalo as residuozocalo,
			o.refventas,
			o.refestados,
			o.refsistemas,
			o.reftelas,
			o.refresiduos,
			o.reftelaopcional,
			ven.total
			
		from
			dbordenes o
				inner join
			dbventas ven ON ven.idventa = o.refventas
				inner join
			dbclientes cl ON cl.idcliente = ven.refclientes
				inner join
			tbtipopago ti ON ti.idtipopago = ven.reftipopago
				inner join
			tbestados est ON est.idestado = o.refestados
				inner join
			dbsistemas sis ON sis.idsistema = o.refsistemas
				inner join
			tbroller ro ON ro.idroller = sis.refroller
				inner join
			dbtelas tel ON tel.idtela = o.reftelas
				inner join
			tbtipotramados tit ON tit.idtipotramado = tel.reftipotramados
				inner join
			tbresiduos res ON res.idresiduo = o.refresiduos		
			where ven.idventa = ".$idVenta."
		order by 1";
$res = $this->query($sql,0);
return $res;
}



function traerOrdenesPorOrden($idOrden) {
$sql = "select 
			o.idorden,
			o.numero as nroorden,
			ven.numero as nroventa,
			cl.nombrecompleto,
			DATE_FORMAT(o.fechacrea,'%Y-%m-%d') AS fechacrea,
			o.usuacrea,
			sis.nombre as sistema,
			concat(tel.tela, ' ', tit.tipotramado) as tela,
			concat(tels.tela, ' ', tits.tipotramado) as telaopcional,
			o.roller,
			o.ancho,
			o.alto,
			(case when o.esdoble = 1 then 'Si' else 'No' end) as esdoble,
			(select tela from dbtelas where idtela = o.reftelaopcional) as segundatela,
			est.estado,
			o.monto as ordenmontomonto,
			o.fechamodi,
			o.usuamodi,
			res.roller as residuoroller,
			res.telaancho as residuotelaancho,
			res.telaalto as residuotelaalto,
			res.zocalo as residuozocalo,
			o.refventas,
			o.refestados,
			o.refsistemas,
			o.reftelas,
			o.refresiduos,
			o.reftelaopcional,
			ven.total
			
		from
			dbordenes o
				inner join
			dbventas ven ON ven.idventa = o.refventas
				inner join
			dbclientes cl ON cl.idcliente = ven.refclientes
				inner join
			tbtipopago ti ON ti.idtipopago = ven.reftipopago
				inner join
			tbestados est ON est.idestado = o.refestados
				inner join
			dbsistemas sis ON sis.idsistema = o.refsistemas
				inner join
			tbroller ro ON ro.idroller = sis.refroller
				inner join
			dbtelas tel ON tel.idtela = o.reftelas
				inner join
			tbtipotramados tit ON tit.idtipotramado = tel.reftipotramados
				left join
			dbtelas tels ON tels.idtela = o.reftelaopcional
				left join
			tbtipotramados tits ON tits.idtipotramado = tels.reftipotramados
				inner join
			tbresiduos res ON res.idresiduo = o.refresiduos		
			where o.idorden = ".$idOrden."
		order by 1";
$res = $this->query($sql,0);
return $res;
}



function traerOrdenesActivas() {
$sql = "select 
			o.idorden,
			o.numero as nroorden,
			ven.numero as nroventa,
			cl.nombrecompleto,
			o.fechacrea,
			o.usuacrea,
			sis.nombre as sistema,
			tel.tela,
			o.roller,
			o.tramado,
			o.ancho,
			o.alto,
			(case when o.esdoble = 1 then 'Si' else 'No' end) as esdoble,
			(select tela from dbtelas where idtela = o.reftelaopcional) as segundatela,
			est.estado,
			o.fechamodi,
			o.usuamodi,
			res.roller as residuoroller,
			res.telaancho as residuotelaancho,
			res.telaalto as residuotelaalto,
			res.zocalo as residuozocalo,
			o.refventas,
			o.refestados,
			o.refsistemas,
			o.reftelas,
			o.refresiduos,
			o.reftelaopcional,
			o.monto as ordenmontomonto
			
		from
			dbordenes o
				inner join
			dbventas ven ON ven.idventa = o.refventas
				inner join
			dbclientes cl ON cl.idcliente = ven.refclientes
				inner join
			tbtipopago ti ON ti.idtipopago = ven.reftipopago
				inner join
			tbestados est ON est.idestado = o.refestados
				inner join
			dbsistemas sis ON sis.idsistema = o.refsistemas
				inner join
			tbroller ro ON ro.idroller = sis.refroller
				inner join
			dbtelas tel ON tel.idtela = o.reftelas
				inner join
			tbtipotramados tit ON tit.idtipotramado = tel.reftipotramados
				inner join
			tbresiduos res ON res.idresiduo = o.refresiduos		
			where est.idestado in (1,2)
		order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerOrdenesFinalizadas() {
$sql = "select 
			o.idorden,
			o.numero as nroorden,
			ven.numero as nroventa,
			cl.nombrecompleto,
			o.fechacrea,
			o.usuacrea,
			sis.nombre as sistema,
			tel.tela,
			o.roller,
			o.tramado,
			o.ancho,
			o.alto,
			(case when o.esdoble = 1 then 'Si' else 'No' end) as esdoble,
			(select tela from dbtelas where idtela = o.reftelaopcional) as segundatela,
			est.estado,
			o.fechamodi,
			o.usuamodi,
			res.roller as residuoroller,
			res.telaancho as residuotelaancho,
			res.telaalto as residuotelaalto,
			res.zocalo as residuozocalo,
			o.refventas,
			o.refestados,
			o.refsistemas,
			o.reftelas,
			o.refresiduos,
			o.reftelaopcional,
			o.monto as ordenmontomonto
			
		from
			dbordenes o
				inner join
			dbventas ven ON ven.idventa = o.refventas
				inner join
			dbclientes cl ON cl.idcliente = ven.refclientes
				inner join
			tbtipopago ti ON ti.idtipopago = ven.reftipopago
				inner join
			tbestados est ON est.idestado = o.refestados
				inner join
			dbsistemas sis ON sis.idsistema = o.refsistemas
				inner join
			tbroller ro ON ro.idroller = sis.refroller
				inner join
			dbtelas tel ON tel.idtela = o.reftelas
				inner join
			tbtipotramados tit ON tit.idtipotramado = tel.reftipotramados
				inner join
			tbresiduos res ON res.idresiduo = o.refresiduos		
			where est.idestado not in (1,2)
		order by 1";
$res = $this->query($sql,0);
return $res;
}



function traerOrdenesPorUsuarios($idUsuarios) {
$sql = "select 
			o.idorden,
			o.numero as nroorden,
			ven.numero as nroventa,
			cl.nombrecompleto,
			o.fechacrea,
			o.usuacrea,
			sis.nombre as sistema,
			tel.tela,
			o.roller,
			o.tramado,
			o.ancho,
			o.alto,
			(case when o.esdoble = 1 then 'Si' else 'No' end) as esdoble,
			(select tela from dbtelas where idtela = o.reftelaopcional) as segundatela,
			est.estado,
			o.fechamodi,
			o.usuamodi,
			res.roller as residuoroller,
			res.telaancho as residuotelaancho,
			res.telaalto as residuotelaalto,
			res.zocalo as residuozocalo,
			o.refventas,
			o.refestados,
			o.refsistemas,
			o.reftelas,
			o.refresiduos,
			o.reftelaopcional,
			o.monto as ordenmontomonto
			
		from
			dbordenes o
				inner join
			dbventas ven ON ven.idventa = o.refventas
				inner join
			dbclientes cl ON cl.idcliente = ven.refclientes
				inner join
			tbtipopago ti ON ti.idtipopago = ven.reftipopago
				inner join
			tbestados est ON est.idestado = o.refestados
				inner join
			dbsistemas sis ON sis.idsistema = o.refsistemas
				inner join
			tbroller ro ON ro.idroller = sis.refroller
				inner join
			dbtelas tel ON tel.idtela = o.reftelas
				inner join
			tbtipotramados tit ON tit.idtipotramado = tel.reftipotramados
				inner join
			tbresiduos res ON res.idresiduo = o.refresiduos
				inner join
			dbcabecerapresupuesto cc ON cc.idcabecerapresupuesto = ven.refpresupuesto

			where est.idestado in (1,2) and cc.refusuarios = ".$idUsuarios."
		order by 1";
$res = $this->query($sql,0);
return $res;
}



function traerOrdenesFinalizadasPorUsuarios($idUsuarios) {
$sql = "select 
			o.idorden,
			o.numero as nroorden,
			ven.numero as nroventa,
			cl.nombrecompleto,
			o.fechacrea,
			o.usuacrea,
			sis.nombre as sistema,
			tel.tela,
			o.roller,
			o.tramado,
			o.ancho,
			o.alto,
			(case when o.esdoble = 1 then 'Si' else 'No' end) as esdoble,
			(select tela from dbtelas where idtela = o.reftelaopcional) as segundatela,
			est.estado,
			o.fechamodi,
			o.usuamodi,
			res.roller as residuoroller,
			res.telaancho as residuotelaancho,
			res.telaalto as residuotelaalto,
			res.zocalo as residuozocalo,
			o.refventas,
			o.refestados,
			o.refsistemas,
			o.reftelas,
			o.refresiduos,
			o.reftelaopcional,
			o.monto as ordenmontomonto
			
		from
			dbordenes o
				inner join
			dbventas ven ON ven.idventa = o.refventas
				inner join
			dbclientes cl ON cl.idcliente = ven.refclientes
				inner join
			tbtipopago ti ON ti.idtipopago = ven.reftipopago
				inner join
			tbestados est ON est.idestado = o.refestados
				inner join
			dbsistemas sis ON sis.idsistema = o.refsistemas
				inner join
			tbroller ro ON ro.idroller = sis.refroller
				inner join
			dbtelas tel ON tel.idtela = o.reftelas
				inner join
			tbtipotramados tit ON tit.idtipotramado = tel.reftipotramados
				inner join
			tbresiduos res ON res.idresiduo = o.refresiduos
				inner join
			dbcabecerapresupuesto cc ON cc.idcabecerapresupuesto = ven.refpresupuesto

			where est.idestado not in (1,2) and cc.refusuarios = ".$idUsuarios."
		order by 1";
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbordenes*/

/* PARA Pagos */

function insertarPagos($refclientes,$pago,$fechapago,$observaciones) {
$sql = "insert into dbpagos(idpago,refclientes,pago,fechapago,observaciones)
values ('',".$refclientes.",".$pago.",'".utf8_decode($fechapago)."','".utf8_decode($observaciones)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPagos($id,$refclientes,$pago,$fechapago,$observaciones) {
$sql = "update dbpagos
set
refclientes = ".$refclientes.",pago = ".$pago.",fechapago = '".utf8_decode($fechapago)."',observaciones = '".utf8_decode($observaciones)."'
where idpago =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPagos($id) {
$sql = "delete from dbpagos where idpago =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPagos() {
$sql = "select
p.idpago,
cli.nombrecompleto,
p.pago,
p.fechapago,
p.observaciones,
p.refclientes
from dbpagos p
inner join dbclientes cli ON cli.idcliente = p.refclientes
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerDetallePagosPorCliente($idCliente) {
$sql = "select
p.idpago,
cli.nombrecompleto,
p.pago,
p.fechapago,
p.observaciones,
p.refclientes
from dbpagos p
inner join dbclientes cli ON cli.idcliente = p.refclientes
where cli.idcliente = ".$idCliente."
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPagosPorCliente($idCliente) {
$sql = "select
coalesce(coalesce(sum(p.pago),0) - coalesce(sum(v.total),0),0) as cuenta
from dbventas v
inner join dbclientes cli ON v.refclientes = cli.idcliente
left join dbpagos p ON cli.idcliente = p.refclientes
where v.reftipopago = 5 and cli.idcliente = ".$idCliente."
order by 1";
$res = $this->query($sql,0);

	if (mysql_num_rows($res)>0) {
		return mysql_result($res,0,0);
	}
	
	return 0;
}

function traerPagosPorId($id) {
$sql = "select idpago,refclientes,pago,fechapago,observaciones from dbpagos where idpago =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbpagos*/


/* PARA Configuracion */

function insertarConfiguracion($empresa,$cuit,$direccion,$telefono,$email,$localidad,$codigopostal) {
$sql = "insert into tbconfiguracion(idconfiguracion,empresa,cuit,direccion,telefono,email,localidad,codigopostal)
values ('','".utf8_decode($empresa)."','".utf8_decode($cuit)."','".utf8_decode($direccion)."','".utf8_decode($telefono)."','".utf8_decode($email)."','".utf8_decode($localidad)."','".utf8_decode($codigopostal)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarConfiguracion($id,$empresa,$cuit,$direccion,$telefono,$email,$localidad,$codigopostal) {
$sql = "update tbconfiguracion
set
empresa = '".utf8_decode($empresa)."',cuit = '".utf8_decode($cuit)."',direccion = '".utf8_decode($direccion)."',telefono = '".utf8_decode($telefono)."',email = '".utf8_decode($email)."',localidad = '".utf8_decode($localidad)."',codigopostal = '".utf8_decode($codigopostal)."'
where idconfiguracion =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarConfiguracion($id) {
$sql = "delete from tbconfiguracion where idconfiguracion =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerConfiguracion() {
$sql = "select
c.idconfiguracion,
c.empresa,
c.cuit,
c.direccion,
c.telefono,
c.email,
c.localidad,
c.codigopostal
from tbconfiguracion c
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerConfiguracionUltima() {
$sql = "select
c.idconfiguracion,
c.empresa,
c.cuit,
c.direccion,
c.telefono,
c.email,
c.localidad,
c.codigopostal
from tbconfiguracion c
order by 1 desc
limit 1";
$res = $this->query($sql,0);
return $res;
}


function traerConfiguracionPorId($id) {
$sql = "select idconfiguracion,empresa,cuit,direccion,telefono,email,localidad,codigopostal from tbconfiguracion where idconfiguracion =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbconfiguracion*/



function query($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>