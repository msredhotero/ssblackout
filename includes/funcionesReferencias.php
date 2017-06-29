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
	
	if ($sistema == 1) {
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
	
	$calculoSistema	= $valorSistema;
	/*if ($sistema == 2) {
		$calculoTela	= (((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela) + ((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela2));
	} else {*/
	$calculoTela	= ((($telaAltoFinal)/1000 * ($ancho/100)) * $valorTela);
	//}
	$total = $calculoSistema + $calculoTela;
	
	return round($total,2,PHP_ROUND_HALF_UP);
	
}


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
t.preciocliente
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
	$sql = "select count(*) from dbventas v inner join dbordenes o ON v.idventa = o.refventas where o.fechacrea = '".$fecha."'";
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


function insertarVentas($numero,$sistema,$tela,$total,$refclientes,$reftipopago,$cancelada) {
$sql = "insert into dbventas(idventa,numero,sistema,tela,total,refclientes,reftipopago,cancelada)
values ('','".utf8_decode($numero)."','".utf8_decode($sistema)."','".utf8_decode($tela)."',".$total.",".$refclientes.",".$reftipopago.",0)";
$res = $this->query($sql,1);
return $res;
}


function modificarVentas($id,$numero,$sistema,$tela,$total,$refclientes,$reftipopago,$cancelada) {
$sql = "update dbventas
set
numero = '".utf8_decode($numero)."',sistema = '".utf8_decode($sistema)."',tela = '".utf8_decode($tela)."',total = ".$total.",refclientes = ".$refclientes.",reftipopago = ".$reftipopago.",cancelada = ".$cancelada."
where idventa =".$id;
$res = $this->query($sql,0);
return $res;
}


function modificarVentasValor($id,$sistema,$tela,$total) {
$sql = "update dbventas
set
sistema = '".utf8_decode($sistema)."',tela = '".utf8_decode($tela)."',total = ".$total."
where idventa =".$id;
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
v.sistema,
v.tela,
v.total,
ord.fechacrea,
tip.descripcion,
(case when v.cancelada = 1 then 'Si' else 'No' end) as cancelada,
v.refclientes,
v.reftipopago
from dbventas v
inner join dbclientes cli ON cli.idcliente = v.refclientes
inner join tbtipopago tip ON tip.idtipopago = v.reftipopago
inner join dbordenes ord ON v.idventa = ord.refventas
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerVentasPorId($id) {
$sql = "select idventa,numero,sistema,tela,total,refclientes,reftipopago,cancelada from dbventas where idventa =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerVentasPorDia($fecha) {
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
where	ord.fechacrea = '".$fecha."'
order by ord.fechacrea desc";
$res = $this->query($sql,0);
return $res;
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



function insertarOrdenes($numero,$refventas,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$refestados,$refsistemas,$reftelas,$refresiduos,$roller,$tramado,$ancho,$alto,$reftelaopcional,$esdoble) {
$sql = "insert into dbordenes(idorden,numero,refventas,fechacrea,fechamodi,usuacrea,usuamodi,refestados,refsistemas,reftelas,refresiduos,roller,tramado,ancho,alto,reftelaopcional,esdoble)
values ('','".utf8_decode($numero)."',".$refventas.",'".utf8_decode($fechacrea)."','".utf8_decode($fechamodi)."','".utf8_decode($usuacrea)."','".utf8_decode($usuamodi)."',".$refestados.",".$refsistemas.",".$reftelas.",".$refresiduos.",'".utf8_decode($roller)."','".utf8_decode($tramado)."',".$ancho.",".$alto.",".($reftelaopcional == '' ? 0 : $reftelaopcional).",".$esdoble.")";
$res = $this->query($sql,1);
return $res;
}


function modificarOrdenes($id,$numero,$refventas,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$refestados,$refsistemas,$reftelas,$refresiduos,$roller,$tramado,$ancho,$alto,$reftelaopcional,$esdoble) {
$sql = "update dbordenes
set
numero = '".utf8_decode($numero)."',refventas = ".$refventas.",fechamodi = '".date('Y-m-d')."',usuamodi = '".utf8_decode($usuamodi)."',refestados = ".$refestados.",refsistemas = ".$refsistemas.",reftelas = ".$reftelas.",refresiduos = ".$refresiduos.",roller = '".utf8_decode($roller)."',tramado = '".utf8_decode($tramado)."',ancho = ".$ancho.",alto = ".$alto.",reftelaopcional = ".($reftelaopcional == '' ? 0 : $reftelaopcional).",esdoble = ".$esdoble."
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
			o.reftelaopcional
			
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
$sql = "select idorden,numero,refventas,fechacrea,fechamodi,usuacrea,usuamodi,refestados,refsistemas,reftelas,refresiduos,roller,tramado,ancho,alto,reftelaopcional,esdoble from dbordenes where idorden =".$id;
$res = $this->query($sql,0);
return $res;
} 


function traerOrdenesPorVenta($idVenta) {
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
			o.reftelaopcional
			
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