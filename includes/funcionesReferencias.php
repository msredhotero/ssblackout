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
s.refroller,
s.desde,
s.hasta,
s.preciocosto,
s.preciocliente
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
$sql = "select idtela,tela,reftipotramados,ancho,alto,preciolista,preciocosto,preciocliente from dbtelas where idtela =".$id;
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

function insertarVentas($refsistemas,$reftelas,$ancho,$alto,$total,$refestados,$sistema,$tela,$trama,$refclientes) {
$sql = "insert into dbventas(idventa,refsistemas,reftelas,ancho,alto,total,refestados,sistema,tela,trama,refclientes)
values ('',".$refsistemas.",".$reftelas.",".$ancho.",".$alto.",".$total.",".$refestados.",'".utf8_decode($sistema)."','".utf8_decode($tela)."','".utf8_decode($trama)."',".$refclientes.")";
$res = $this->query($sql,1);
return $res;
}


function modificarVentas($id,$refsistemas,$reftelas,$ancho,$alto,$total,$refestados,$sistema,$tela,$trama,$refclientes) {
$sql = "update dbventas
set
refsistemas = ".$refsistemas.",reftelas = ".$reftelas.",ancho = ".$ancho.",alto = ".$alto.",total = ".$total.",refestados = ".$refestados.",sistema = '".utf8_decode($sistema)."',tela = '".utf8_decode($tela)."',trama = '".utf8_decode($trama)."',refclientes = ".$refclientes."
where idventa =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarVentas($id) {
$sql = "delete from dbventas where idventa =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerVentas() {
$sql = "select
v.idventa,
v.refsistemas,
v.reftelas,
v.ancho,
v.alto,
v.total,
v.refestados,
v.sistema,
v.tela,
v.trama,
v.refclientes
from dbventas v
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerVentasPorId($id) {
$sql = "select idventa,refsistemas,reftelas,ancho,alto,total,refestados,sistema,tela,trama,refclientes from dbventas where idventa =".$id;
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