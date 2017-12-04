<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
} else {


include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funcionesHTML.php');
include ('../../includes/funciones.php');
include ('../../includes/funcionesReferencias.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();

//*** SEGURIDAD ****/
include ('../../includes/funcionesSeguridad.php');
$serviciosSeguridad = new ServiciosSeguridad();
$serviciosSeguridad->seguridadRuta($_SESSION['refroll_predio'], '../cotizador/');
//*** FIN  ****/

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Cotizador",$_SESSION['refroll_predio'],'');

/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Orden";

$plural = "Ordenes";

$eliminar = "eliminarOrdenes";

$insertar = "insertarOrdenes";

$tituloWeb = "Gestión: Sistema Cortinas Roller";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////

$resTelas	=	$serviciosReferencias->traerTelas();

$resResiduo =	$serviciosReferencias->traerResiduos();

$lstClientes = $serviciosFunciones->devolverSelectBox( $serviciosReferencias->traerClientes(),array(1,3),' - ');

$lstTipoPago = $serviciosFunciones->devolverSelectBox( $serviciosReferencias->traerTipopago(),array(1),'');

$cadTelas	=	$serviciosFunciones->devolverSelectBox($resTelas,array(1,8),' - ');



/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla          = "dbclientes";

$lblCambio      = array("nrodocumento","fechanacimiento","telefono","direccion","nombrecompleto");
$lblreemplazo   = array("Nro Documento","Fecha Nacimiento","Teléfono","dirección","Nombre Completo");


$cadRef     = '';

$refdescripcion = array();
$refCampo   =  array();
//////////////////////////////////////////////  FIN de los opciones //////////////////////////


$formularioClientes     = $serviciosFunciones->camposTabla('insertarClientes' ,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">



<title>Gesti&oacute;n: Sistema Cortinas Roller</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
	<!-- <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'> -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../css/chosen.css">

	<style>
		.cartel {
			background: #0090D3;
			color: #FFF;
			display: inline-block;
			padding: 6px 12px;
			position: relative;
			margin-bottom: 15px;
			-webkit-box-shadow: 0 0 12px 0 rgba(0,0,0,0.5);
			box-shadow: 0 0 12px 0 rgba(0,0,0,0.5);
		}
		h2 {
			font-size: 16px;
			color: #0090D3;
		}
		*, *::after, *::before {
			-webkit-box-sizing: border-box !important;
			-moz-box-sizing: border-box !important;
			box-sizing: border-box !important;
			padding: 0;
			margin: 0;
		}
		
		.cartel_chico::after {
			background-image: url('../../imagenes/tip4.png');
		}
		.cartel::after {
			content: '';
			clear: both;
			width: 15px;
			height: 16px;
			background-image: url('../../imagenes/tip.png');
			background-repeat: no-repeat;
			background-position: center top;
			display: inline-block;
			position: absolute;
			bottom: -15px;
			left: 10px;
		}
	

		#table-6 {
			border:2px solid #C0C0C0;
		}
		
		#table-6 thead {
		text-align: left;
		}
		#table-6 thead th {
		background: -moz-linear-gradient(top, #F0F0F0 0, #DBDBDB 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #F0F0F0), color-stop(100%, #DBDBDB));
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#F0F0F0', endColorstr='#DBDBDB', GradientType=0);
		border: 1px solid #C0C0C0;
		color: #444;
		font-size: 16px;
		font-weight: bold;
		padding: 3px 10px;
		}
		
		#table-6 tbody td .cent {
			text-align:center;	
		}

        .flecha select::-ms-expand {
            display: none;
        }
		
		 .inputChico {
			 width:50px;
		 }
		 
		 .inputMedio {
			 width:70px;
		 }
  
		
	</style>

    
   <script src="../../js/jquery.number.min.js"></script>
   <link href="../../css/perfect-scrollbar.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../../css/jquery.datetimepicker.css"/>
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../../js/jquery.mousewheel.js"></script>
      <script src="../../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
</head>

<body>

 
<?php echo $resMenu; ?>

<div id="content">
    <form class="form-inline formulario" role="form">
    <div class="boxInfoLargo tile-stats tile-white stat-tile">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;"><span class="glyphicon glyphicon-usd"></span> Cotizador</p>
        	
        </div>
    	<div class="cuerpoBox">
        	
        	<div class='row' style="margin-left:25px; margin-right:25px;">
                <h4>Elegí el material de tu producto, completá las medidas y obtené el precio al instante!</h4>
                <hr>
            </div>
            
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">   
                <h2 class="cartel cartel_chico" style="margin-top:5px;">Sistema<br></h2>
            </div>
            
            <div class='row' style="margin-left:25px; margin-right:25px;"> 
            	<div class="col-md-4" style="margin-bottom:7px;">
                    <div class="input-group">
                        <span class="input-group-addon">
                        <input type="radio" aria-label="..." id="normal" class="normal" name="normal" checked value="1">
                        </span>
                        <input type="text" class="form-control" aria-label="..." value="Normal">
                        
                    </div><!-- /input-group -->
                </div>
                    
            	<div class="col-md-4" style="margin-bottom:7px;">
                    <div class="input-group">
                        <span class="input-group-addon">
                        <input type="radio" aria-label="..." id="doble" class="normal" name="normal" value="2">
                        </span>
                        <input type="text" class="form-control" aria-label="..." value="Doble (Blackout + Screen)">
                        
                    </div><!-- /input-group -->
                </div>
                
                <div class="col-md-4" style="margin-bottom:7px;">
                    <div class="input-group">
                        <span class="input-group-addon">
                        <input type="radio" aria-label="..." id="confeccion" class="normal" name="normal" value="3">
                        </span>
                        <input type="text" class="form-control" aria-label="..." value="Confeccion">
                        
                    </div><!-- /input-group -->
                </div>
            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <hr>
            </div>
            
            <div class='row' style="margin-left:25px; margin-right:25px;">   
                <h2 class="cartel cartel_chico" style="margin-top:5px;">Material<br></h2>
            </div>
            <div class='row' style="margin-left:25px; margin-right:25px;">

                <div class="col-md-3" style="margin-bottom:7px;">
                    <div class="input-group">
                        <select class="form-control" id="reftelas" name="reftelas">
                        	<?php echo $cadTelas; ?>
                        </select>
                        
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
				
                <div class="adicional" style="display:none;">
                    <div class="col-md-2" style="margin-bottom:7px;">
                        <h4>Tela Adicional:</h4>
                    </div>
                    <div class="col-md-4" style="margin-bottom:7px;">
                        <div class="input-group">
                            <select class="form-control" id="reftelaopcional" name="reftelaopcional">
                                <option value="">-- Seleccione --</option>
                                <?php echo $cadTelas; ?>
                            </select>
                            
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div>
                
            </div>

            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <hr>
            </div>
            <div class='row' style="margin-left:25px; margin-right:25px;">   
                <h2 class="cartel cartel_chico" style="margin-top:5px;">Medidas<br></h2>
            </div>
            <div class='row' style="margin-left:25px; margin-right:25px;">
            	<div class="form-group col-md-6" style="display:block">
                    <label for="desde" class="control-label" style="text-align:left">Ancho <span style="color:#F00;">*</span></label>
                    <div class="input-group col-md-12">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-resize-horizontal"></span></span>
                        <input class="form-control" id="ancho" name="ancho" value="1" required type="text">
                        <span class="input-group-addon valorAdd">mtrs</span>
                    </div>
                </div>

                
                <div class="form-group col-md-6" style="display:block">
                    <label for="desde" class="control-label" style="text-align:left">Alto <span style="color:#F00;">*</span></label>
                    <div class="input-group col-md-12">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-resize-horizontal"></span></span>
                        <input class="form-control" id="alto" name="alto" value="1" required type="text">
                        <span class="input-group-addon valorAdd">mtrs</span>
                    </div>
                </div>
                
                
            </div>

            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <hr>
            </div>
            <div class='row' style="margin-left:25px; margin-right:25px;">   
                <h2 class="cartel cartel_chico" style="margin-top:5px;">Residuo - Cantidad - Caida - Mando<br></h2>
            </div>
            
            <div class='row' style="margin-left:25px; margin-right:25px;"> 
            	<?php
					$cadResiduo = $serviciosFunciones->devolverSelectBox($resResiduo,array(1),'');
                    //while ($row = mysql_fetch_array($resResiduo)) {
				?>

                <div class="col-md-3" style="margin-bottom:7px;">
                    <div class="input-group">
                        <select class="form-control" id="refresiduo" name="refresiduo">
                            <?php echo $cadResiduo; ?>
                        </select>
                        
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-md-3" style="margin-bottom:7px;">
                    <div class="input-group">
                        <input type="text" class="form-control" id="cantidad" name="cantidad" value="1"/>
                        
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-md-3" style="margin-bottom:7px;">
                    <div class="input-group">
                        <input type="text" class="form-control" id="caida" name="caida" value="invertida"/>
                        
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                <div class="col-md-3" style="margin-bottom:7px;">
                    <div class="input-group">
                        <input type="text" class="form-control" id="mando" name="mando" value="izquierda"/>
                        
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div>
            
            
            

            
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">
                    <li>
                        <button type="button" class="btn btn-primary" id="cotizar" style="margin-left:0px;"><span class="glyphicon glyphicon-usd"></span> Cotizar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-warning" id="agregarpresupuesto" style="margin-left:0px; display:none;"><span class="glyphicon glyphicon-plus"></span> Agregar Al Carrito</button>
                    </li>


                    <li style="font-weight:bold; color:#F00; font-size:1.6em; margin-right:10%;" class="pull-right">
                    	Precio: <span class="glyphicon glyphicon-usd"></span><span style="font-weight:bold; color:#F00; font-size:1.6em;" id="total"></span>
                    </li>
                </ul>
                </div>
            </div>
            
            <hr>
         <div class='row' style="margin-left:25px; margin-right:25px;" id="tabla">
         	<h4><span class="glyphicon glyphicon-list"></span> Presupuestos Cargados</h4>
            <div class="col-md-12">
            <table class="table table-striped" id="table-6">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Cant</th>
                        <th style="width:260px;" class="text-center">Sistema</th>
                        <th class="text-center">Tela</th>
                        <th class="text-center">Tela-Adicional</th>
                        <th class="text-center">Alto</th>
                        <th class="text-center">Ancho</th>
                        <th class="text-center">Residuo</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Caida</th>
                        <th class="text-center">Mando</th>
                        <th style="width:120px;" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="detalle">
                	
                </tbody>
                <tfoot>
                    <tr style="background-color:#CCC; font-weight:bold; font-size:18px;">
                        <td colspan="11" align="right">
                            Total $
                        </td>
                        <td>
                            <input type="text" readonly name="totales" id="totales" value="0" style="border:none; background-color:#CCC;"/>
                        </td>
                    </tr>
                </tfoot>
            </table>
            </div>
         </div>   


            
            <input type="hidden" name="accion" id="accion" value="cotizar"/>
            <input type="hidden" name="totalgral" id="totalgral" value="0" />
            <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['nombre_predio']; ?>" />
            <input type="hidden" id="refroles" name="refroles" value="<?php echo $_SESSION['idroll_predio']; ?>">
            
            <div style="height:70px;">
            </div>
    	</div>
        
        
    </div>
    


    <div class="boxInfoLargo tile-stats tile-white stat-tile">
        <div id="headBoxInfo">
            <p style="color: #fff; font-size:18px; height:16px;">Datos Facturacion</p>
        </div>
        <div class="cuerpoBox">
            <div class='row datosFacturacion' style="margin-left:25px; margin-right:25px;"> 
                <div class="form-group col-md-6" style="display:block">
                    <label class="control-label" for="codigobarra" style="text-align:left">Seleccione el Cliente</label>
                    <div class="input-group col-md-12">
                        <select data-placeholder="selecione el Cliente..." id="refclientes" name="refclientes" class="chosen-select" tabindex="2" style="width:100%;">
                            
                            <?php echo $lstClientes; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group col-md-6" style="display:block">
                    <label class="control-label" for="codigobarra" style="text-align:left">Seleccione el Tipo Pago</label>
                    <div class="input-group col-md-12">
                        <select data-placeholder="selecione el Tipo de Pago..." id="reftipopago" name="reftipopago" class="chosen-select" tabindex="2" style="width:100%;">
                            
                            <?php echo $lstTipoPago; ?>
                        </select>
                    </div>
                </div>
            </div>
            
            
            <div class='row datosFacturacion' style="margin-left:25px; margin-right:25px;"> 
                <div class="form-group col-md-6" style="display:block">
                    <label class="control-label" for="codigobarra" style="text-align:left">Solicitante <span style="color:#F00;">*</span></label>
                    <div class="input-group col-md-12">
                        <input type="text" class="form-control" id="solicitante" name="solicitante" />
                    </div>
                </div>
                
                <div class="form-group col-md-3" style="display:block">
                    <label class="control-label" for="codigobarra" style="text-align:left">Nro Documento <span style="color:#F00;">*</span></label>
                    <div class="input-group col-md-12">
                        <input type="text" class="form-control" id="nrodocumento" name="nrodocumento" />
                    </div>
                </div>

                <div class="form-group col-md-3" style="display:block">
                    <label class="control-label" for="codigobarra" style="text-align:left">Fecha Entrega <span style="color:#F00;">*</span></label>
                    <div class="input-group col-md-12">
                        <input type="text" class="form-control" id="fechaentrega" name="fechaentrega" />
                    </div>
                </div>
            </div>
            
            
            <div class='row datosFacturacion' style="margin-left:25px; margin-right:25px;"> 
                <div class="form-group col-md-12" style="display:block">
                    <label class="control-label" for="codigobarra" style="text-align:left">Observaciones</label>
                    <div class="input-group col-md-12">
                        <textarea rows="3" class="form-control" name="observaciones" id="observaciones">
                        
                        </textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="list-inline" style="margin-top:15px;">
                        <?php
                            if ($_SESSION['idroll_predio'] == 1) {
                        ?>
                        <li>
                            <button type="button" data-toggle="modal" data-target="#myModal3" class="btn btn-success" id="agregarCliente"><span class="glyphicon glyphicon-plus"></span> Agregar Cliente</button>
                        </li>
                        <?php
                            }
                        ?>
                        <li>
                            <button type="button" class="btn btn-primary" id="presupuesto" style="margin-left:0px; display:none;"><span class="glyphicon glyphicon-shopping-cart"></span> Crear Presupuesto</button>
                        </li>

                    </ul>
                </div>
            </div>


            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                    
                </div>
                <div id='load'>
                
                </div>
            </div>
        </div>
    </div>
    </form>
</div>


</div>


<!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="1" style="z-index:500000;" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form class="form-inline formulario" role="form">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear Cliente</h4>
      </div>
      <div class="modal-body">
        <?php echo $formularioClientes; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="cargarCliente">Agregar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>





<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../../js/jquery.datetimepicker.full.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$('#ancho').number( true, 2,'.','' );
	$('#alto').number( true, 2,'.','' );
	$('#cantidad').number( true, 0,'.','' );
	
	$('#colapsarMenu').click();
	
	$('#doble').click(function() {
		$('.adicional').show();
        $('#agregarpresupuesto').hide();

	});
	
	$('#normal').click(function() {
		$('.adicional').hide();
		$('.adicional option[value=""]').attr("selected",true);
        $('#agregarpresupuesto').hide();
	});


    //al enviar el formulario
    $('#cargarCliente').click(function(){
        
            //información del formulario
            var formData = new FormData($(".formulario")[1]);
            var message = "";
            //hacemos la petición ajax  
            $.ajax({
                url: '../../ajax/ajax.php',  
                type: 'POST',
                // Form data
                //datos del formulario
                data: formData,
                //necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false,
                //mientras enviamos el archivo
                beforeSend: function(){
                    $("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');       
                },
                //una vez finalizado correctamente
                success: function(data){
                    
                    if (!isNaN(data)) {
                        $(".alert").removeClass("alert-danger");
                        $(".alert").removeClass("alert-info");
                        $(".alert").addClass("alert-success");
                        $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Cliente</strong>. ');
                        $(".alert").delay(3000).queue(function(){
                            /*aca lo que quiero hacer 
                              después de los 2 segundos de retraso*/
                            $(this).dequeue(); //continúo con el siguiente ítem en la cola
                            
                        });
                        $("#load").html('');
                        //url = "index.php";
                        //$(location).attr('href',url);
                        //alert('<option value="' + data.toString() + '">' + $('#reftipocontactos option:selected').text() + ', ' + $('#nombre1').val() + '</option>');
                        $('#refclientes').prepend('<option value="' + data.toString() + '">' + $('#nombrecompleto').val() + ' - ' + $('#dni').val() + '</option>');
                        $('#refclientes').trigger("chosen:updated");
                        
                        
                    } else {
                        $(".alert").removeClass("alert-danger");
                        $(".alert").addClass("alert-danger");
                        $(".alert").html('<strong>Error!</strong> '+data);
                        $("#load").html('');
                    }
                },
                //si ha ocurrido un error
                error: function(){
                    $(".alert").html('<strong>Error!</strong> Actualice la pagina');
                    $("#load").html('');
                }
            });
        
    });
	
	
	
	function insertarDetalleAux(idProducto, cantidad, precio, total, json) {
		var id = 0;
		$.ajax({
				data:  {refproductos: idProducto, 
						cantidad: cantidad, 
						precio: precio, 
						total: total, 
						accion: 'insertarDetallepedidoaux'},
				url:   '../../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
					setTimeout(function() {
						$("#aviso").fadeOut(1500);
					},3000);	
					
					$('#prodNombre').val(json[0].nombre);
					$('#prodPrecio').val(json[0].precioventa);
					
					$('.detalle').prepend('<tr><td align="center"><input type="checkbox" name="prod'+idProducto+'" id="prod'+idProducto+'" checked /></td><td>'+json[0].nombre+'</td><td align="center">'+cantidad+'</td><td align="right">'+json[0].precioventa+'</td><td align="right">'+monto.toFixed(2)+'</td><td class="text-center"><button type="button" class="btn btn-danger eliminarfila" id="'+response+'" style="margin-left:0px;">Eliminar</button></td></tr>');
					
					$('#cantidadbuscar').val(1);
							
					$("#aviso").show();
							
					$('#total').val(SumarTabla());
				}
		});
		
		return id;
	}
	
	function eliminarDetalleAux(idProducto) {
		$.ajax({
				data:  {id: idProducto, 
						accion: 'eliminarDetallepedidoaux'},
				url:   '../../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
					$('#total').val(SumarTabla());	
				}
		});
	}
	
	function getProducto(idProd, cantidad, accion) {
		$.ajax({
					data:  {idproducto: idProd,
							accion: accion},
					url:   '../../ajax/ajax.php',
					type:  'post',
					beforeSend: function () {
						$('#agregar').hide();
						$('#agregarfila').hide();	
						$('#codigobarrabuscar').val('');
					},
					success:  function (response) {
						if(response){
							//idproducto,codigo,nombre,descripcion,stock,stockmin,preciocosto,precioventa,utilidad,estado,imagen,idcategoria,tipoimagen,nroserie,codigobarra
							json = $.parseJSON(response);
							
							monto = parseFloat(json[0].precioventa) * parseInt(cantidad);
							//var idRetornado = insertarDetalleAux(json[0].idproducto, cantidad, json[0].precioventa, monto, json);
							
							$('#prodNombre').val(json[0].nombre);
							$('#prodPrecio').val(json[0].precioventa);
							
							/*
							$('.detalle tr').each(function(){
								
							});
							*/
							
							$("#tabla tbody tr").each(function (index) {
								var cantidadNueva, subtotalNuevo;
								
								if ($(this).find('td').eq(0).children("input").attr('id') == 'prod'+json[0].idproducto) {
									
									cantidadNueva = parseInt(cantidad) + parseInt($(this).find('td').eq(2).children("input").val());
									subtotalNuevo = parseFloat(monto) + parseFloat($(this).find('td').eq(4).text());
									
									$(this).remove();
									
									$('.detalle').prepend('<tr><td align="center"><input type="checkbox" name="prod'+json[0].idproducto+'" id="prod'+json[0].idproducto+'" checked  onclick="this.checked=!this.checked"/></td><td><input type="text" name="nombre'+json[0].idproducto+'" id="nombre'+json[0].idproducto+'" value="'+json[0].nombre+'" readonly style="background-color:transparent; border:none;cursor:default;text-align: center;" /></td><td align="center"><input type="text" name="cant'+json[0].idproducto+'" id="cant'+json[0].idproducto+'" value="'+cantidadNueva+'" readonly style="background-color:transparent; border:none;cursor:default;text-align: center;" /></td><td align="right"><input type="text" name="precio'+json[0].idproducto+'" id="precio'+json[0].idproducto+'" value="'+json[0].precioventa+'" readonly style="background-color:transparent; border:none;cursor:default;text-align: right; width:70px;" /></td><td align="right">'+subtotalNuevo.toFixed(2)+'</td><td class="text-center"><button type="button" class="btn btn-danger eliminarfila" id="'+json[0].idproducto+'" style="margin-left:0px;">Eliminar</button></td></tr>');
									
									return false;
								} else {
									$('.detalle').prepend('<tr id="'+json[0].idproducto+'"><td align="center"><input type="checkbox" name="prod'+json[0].idproducto+'" id="prod'+json[0].idproducto+'" checked  onclick="this.checked=!this.checked"/></td><td><input type="text" name="nombre'+json[0].idproducto+'" id="nombre'+json[0].idproducto+'" value="'+json[0].nombre+'" readonly style="background-color:transparent; border:none;cursor:default;text-align: center;" /></td><td align="center"><input type="text" name="cant'+json[0].idproducto+'" id="cant'+json[0].idproducto+'" value="'+cantidad+'" readonly style="background-color:transparent; border:none;cursor:default;text-align: center;" /></td><td align="right"><input type="text" name="precio'+json[0].idproducto+'" id="precio'+json[0].idproducto+'" value="'+json[0].precioventa+'" readonly style="background-color:transparent; border:none;cursor:default;text-align: right; width:70px;" /></td><td align="right">'+monto.toFixed(2)+'</td><td class="text-center"><button type="button" class="btn btn-danger eliminarfila" id="'+json[0].idproducto+'" style="margin-left:0px;">Eliminar</button></td></tr>');
									return false;
								}
								/*
								$(this).children("td").each(function (index2) {
									if (index2 == 0) {
										if ($(this).children("input").attr('id') == 'prod'+json[0].idproducto) {
		
										}
									}
								});
								*/
							});
					
							
							
							
							
							$('#cantidadbuscar').val(1);
									
							$("#aviso").show();
									
							$('#total').val(SumarTabla());
						} else {
							//var producto = ['', 0];
							$('#prodNombre').val('');
							$('#prodPrecio').val(0);
						}
						
						$('#agregar').show();
						$('#agregarfila').show();
					}
			});	
	}
	
	
	$('.agregarfila').click(function(e) {
		id =  $(this).attr("id");
		//getProducto(id);
		var cantidad = 1;
		$('.detallefaltante tr').each(function(){
			
			if ($(this).find('td').eq(0).text() == id) {
				cantidad = $(this).find('td').eq(2).text();	
			}
			//suma += parseFloat($(this).find('td').eq(4).text()||0,10); //numero de la celda 3
		});
		
		getProducto(id, cantidad);
		
	});
	
	  
	//elimina una fila
	  $(document).on("click",".eliminarfila",function(){
		var padre = $(this).parents().get(1);

		$(padre).remove();
		
		$('#totales').val(SumarTabla());
        existeCarrito();
		
	  });
	
	$('#orden').click(function(){
		
		$('#accion').val('orden');
		//información del formulario
		var error = '';
		if ($('.normal').val() == 2) {
			if ($('#reftelaopcional').val() == '') {
				error = 'Debe seleccionar otra tela para el sistema doble';	
			}
		}
		
		if (error == '') {
			var formData = new FormData($(".formulario")[0]);
			var message = "";
			//hacemos la petición ajax  
			$.ajax({
				url: '../../ajax/ajax.php',  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				//necesario para subir archivos via ajax
				cache: false,
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');       
				},
				//una vez finalizado correctamente
				success: function(data){
					
                    if (data == '') {
    					$('#total').html('');
    					$('#accion').val('cotizar');
    					$("#load").html('');
    					$(".alert").removeClass("alert-danger");
    					$(".alert").removeClass("alert-info");
    					$(".alert").addClass("alert-success");
    					$(".alert").html('<strong>Ok!</strong> Se cargo exitosamente la <strong>Orden y la Venta</strong>. ');
                    } else {
                        $('#total').html('');
                        $('#accion').val('cotizar');
                        $("#load").html('');
                        $(".alert").removeClass("alert-success");
                        $(".alert").removeClass("alert-info");
                        $(".alert").addClass("alert-danger");
                        $(".alert").html('<strong>Error!</strong> '+data);
                    }
				},
				//si ha ocurrido un error
				error: function(){
					$(".alert").html('<strong>Error!</strong> Actualice la pagina');
					$("#load").html('');
				}
			});
		
		} else {
			alert('Error: '+error);
		}

    });
	

	
	$('#cotizar').click(function(){
		$('#total').html('');
		$('#accion').val('cotizar');
        
		//información del formulario
		var error = '';

		if ($('#doble').prop('checked')) {
			if ($('#reftelaopcional').val() == '') {
				error = 'Debe seleccionar otra tela para el sistema doble';	
			}
		}
		
		if (error == '') {
			var formData = new FormData($(".formulario")[0]);
			var message = "";
			//hacemos la petición ajax  
			$.ajax({
				url: '../../ajax/ajax.php',  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				//necesario para subir archivos via ajax
				cache: false,
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');       
				},
				//una vez finalizado correctamente
				success: function(data){
					
					if (parseFloat(data)>0) {
						
						$(".alert").removeClass("alert-danger");
						$(".alert").removeClass("alert-info");
						$(".alert").html('');
						$("#load").html('');
						$('#orden').show();
						$('#agregarpresupuesto').show();

						
                        $('#total').html(data * parseInt($('#cantidad').val()));
                        $('#totalgral').val(data * parseInt($('#cantidad').val()));
						
					} else {
						$(".alert").removeClass("alert-danger");
						$(".alert").addClass("alert-danger");
						$(".alert").html('<strong>Error!</strong> '+data);
						$("#load").html('');
						$('#total').html('');
						$('#orden').hide();
						$('#agregarpresupuesto').hide();

						
                        $('#totalgral').val(0);
						
	
					}
				},
				//si ha ocurrido un error
				error: function(){
					$(".alert").html('<strong>Error!</strong> Actualice la pagina');
					$("#load").html('');
				}
			});
		
		} else {
			alert('Error: '+error);
		}
		
    });


    var i= 0;

    var valSistema = '';
    var lblSistema = '';

    var valTela = '';
    var lblTela = '';

    var valResiduo = '';
    var lblResiduo = '';

    var valTelaAux = '';
    var lblTelaAux = '';

    var select1 = '';
    var select2 = '';

    var input1  = '';
    var input2  = '';
	
	var inputCant = '';
	var inputCaida = '';
	var inputMando = '';

    var cadAgrega = '';
    

    $(document).on("click","#agregarpresupuesto",function(){
        i = i + 1;
        valSistema = 1;
        lblSistema = '';

        $('#agregarpresupuesto').hide();

        valTela = $('#reftelas').val();
        lblTela = $('#reftelas option:selected').html();

        valResiduo = $('#refresiduo').val();
        lblResiduo = $('#refresiduo option:selected').html();

        valTelaAux = $('#reftelaopcional').val();
        lblTelaAux = $('#reftelaopcional option:selected').html();
        select3 = '';

        if ($('#normal').prop('checked') == 1) {
            lblSistema = 'Normal';
            valSistema = 1;
            select3 = '<select id="telaopcional" class="flecha" name="telaopcional" style="background-color:transparent; border:none;cursor:default;text-align: center;"><option value="0"></option></select>';
        } else {
            lblSistema = 'Doble';
            valSistema = 2;
            select3 = '<select id="telaopcional" class="flecha" name="telaopcional" style="background-color:transparent; border:none;cursor:default;text-align: center;"><option value="'+valTelaAux+'">'+lblTelaAux+'</option></select>';
        }

        select1 = '<select id="sistema" name="sistema" style="background-color:transparent; border:none;cursor:default;text-align: center;"><option value="'+valSistema+'">'+lblSistema+'</option></select>';
        select2 = '<select id="tela" name="tela" style="background-color:transparent; border:none;cursor:default;text-align: center;"><option value="'+valTela+'">'+lblTela+'</option></select>';
        select4 = '<select id="residuo" name="residuo" style="background-color:transparent; border:none;cursor:default;text-align: center;"><option value="'+valResiduo+'">'+lblResiduo+'</option></select>';
        

        input1  = '<input type="text" class="inputChico" readonly name="altopre" id="altopre" value="' + $('#alto').val() + '" style="background-color:transparent; border:none;cursor:default;text-align: center;" />';
        input2  = '<input type="text" class="inputChico" readonly name="anchopre" id="anchopre" value="' + $('#ancho').val() + '" style="background-color:transparent; border:none;cursor:default;text-align: center;" />';
		
		inputCant = '<input type="text" class="inputChico" readonly name="cantpre" id="cantpre" value="' + $('#cantidad').val() + '" style="background-color:transparent; border:none;cursor:default;text-align: center;" />';
		inputCaida = '<input type="text" class="inputMedio" readonly name="caidapre" id="caidapre" value="' + $('#caida').val() + '" style="background-color:transparent; border:none;cursor:default;text-align: center;" />';
	    inputMando = '<input type="text" class="inputMedio" readonly name="mandopre" id="mandopre" value="' + $('#mando').val() + '" style="background-color:transparent; border:none;cursor:default;text-align: center;" />';

        cadAgrega = '<tr id="tr_'+i+'"> <td id="td_id">'+i+'</td><td>'+inputCant+'</td><td>'+select1+'</td><td>'+select2+'</td><td>'+select3+'</td><td>'+input1+'</td><td>'+input2+'</td><td>'+select4+'</td><td id="totalparcial" style="text-align:right;">'+$('#total').text()+'</td><td>'+inputCaida+'</td><td>'+inputMando+'</td><td style="text-align:center;"><button type="button" class="btn btn-danger eliminarfila" id="1" style="margin-left:0px;">Eliminar</button></td></tr>';
        $('.detalle').append(cadAgrega);
        $('#totales').val(SumarTabla());
        $('#total').html('');

        existeCarrito();

    });
    

    function existeCarrito() {
        var valor = SumarTabla();

        if (valor > 0) {
            $('.datosFacturacion').show();
            $('#presupuesto').show();
        } else {
            $('.datosFacturacion').show();
            $('#presupuesto').show();
        }
    }
    
	function SumarTabla() {
        var suma = 0;
        var sumadesc = 0;
        $('.detalle tr').each(function(){
            
            suma += parseFloat($(this).find('td').eq(8).text()||0,10); //numero de la celda 3
        })
        
        return suma.toFixed(2);

    }
      


	$('.datosFacturacion').hide();


    // Actualiza de manera masiva todos los archivos cargados en la tercera pestaña.
    function grabaTodoTabla(TABLAID){
        //tenemos 2 variables, la primera será el Array principal donde estarán nuestros datos y la segunda es el objeto tabla
        var DATA    = [];
        var TABLA   = $("#"+TABLAID+" tbody > tr");
		var Total   = 0;

        //una vez que tenemos la tabla recorremos esta misma recorriendo cada TR y por cada uno de estos se ejecuta el siguiente codigo
        TABLA.each(function(){
            //por cada fila o TR que encuentra rescatamos 3 datos, el ID de cada fila, la Descripción que tiene asociada en el input text, y el valor seleccionado en un select
            var ID              = $(this).find("td[id='td_id']").text(),
                SISTEMAS        = $(this).find("select[id*='sistema']").val(),
                TELA            = $(this).find("select[id*='tela']").val(),
                RESIDUO         = $(this).find("select[id*='residuo']").val(),
                ALTO            = $(this).find("input[id*='altopre']").val(),
                ANCHO           = $(this).find("input[id*='anchopre']").val(),
                TOTALPARCIAL    = $(this).find("td[id='totalparcial']").text(),
                CANTIDAD		= $(this).find("input[id*='cantpre']").val(),
				CAIDA			= $(this).find("input[id*='caidapre']").val(),
				MANDO			= $(this).find("input[id*='mandopre']").val(),
				TELAOPCIONAL    = $(this).find("select[id*='telaopcional']").val();
				
				
				Total			= parseFloat($('#totales').val());

            //entonces declaramos un array para guardar estos datos, lo declaramos dentro del each para así reemplazarlo y cada vez
            item = {};
            //si miramos el HTML vamos a ver un par de TR vacios y otros con el titulo de la tabla, por lo que le decimos a la función que solo se ejecute y guarde estos datos cuando exista la variable ID, si no la tiene entonces que no anexe esos datos.
            if(ID !== ''){
                item ["id"]     = ID;
                item ["sistema"]   = SISTEMAS;
                item ['tela']   = TELA;
                item ['residuo']   = RESIDUO;
                item ['telaopcional']   = TELAOPCIONAL;
                item ['alto']   = ALTO;
                item ['ancho']   = ANCHO;
				item ['cantidad']   = CANTIDAD;
				item ['caida']   = CAIDA;
				item ['mando']   = MANDO;
                item ['refclientes']   = $('#refclientes').val();
                item ['totalparcial']   = TOTALPARCIAL;
                item ['usuacrea']   = '<?php echo $_SESSION['nombre_predio']; ?>';
                item ['refusuarios']   = <?php echo $_SESSION['idusua_predio']; ?>;
				item ['solicitante']   = $('#solicitante').val();
				item ['nrodocumento']   = $('#nrodocumento').val();
				item ['observaciones']   = $('#observaciones').val();
				item ['refclientes']   = $('#refclientes').val();
                item ['fechaentrega']   = $('#fechaentrega').val();
				item ['total']   = Total;
                //una vez agregados los datos al array "item" declarado anteriormente hacemos un .push() para agregarlos a nuestro array principal "DATA".
                DATA.push(item);
            }
        });
        console.log(DATA);

        //eventualmente se lo vamos a enviar por PHP por ajax de una forma bastante simple y además convertiremos el array en json para evitar cualquier incidente con compativilidades.
        INFO    = new FormData();
        aInfo   = JSON.stringify(DATA);

        INFO.append('data', aInfo);

        $.ajax({
            data: INFO,
            type: 'POST',
            url : '../../json/cargar_presupuesto.php',
            processData: false, 
            contentType: false,
            success: function(r){
                alert(r);
                url = "index.php";
                $(location).attr('href',url);
            }
        });
    }

  
    $('#presupuesto').click(function() {
        
        if (($('#solicitante').val() != '') && ($('#nrodocumento').val() != '') && ($('#fechaentrega').val() != '') && ($('.detalle').html().trim() != '')) {
            grabaTodoTabla('table-6');    
        } else {
            alert('Error: Faltan los datos del Solicitante o el Nro Documento o No cargo ningun Presupuesto');
        }
        
    });
    
    $('#fechaentrega').datetimepicker({
    dayOfWeekStart : 1,
    format: 'Y-m-d'
    });
    $.datetimepicker.setLocale('es');
    $('#fechaentrega').datetimepicker();

});
</script>



<script src="../../js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
<?php } ?>
</body>
</html>
