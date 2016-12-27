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

$lstClientes = $serviciosFunciones->devolverSelectBox( $serviciosReferencias->traerClientes(),array(1),'');

$lstTipoPago = $serviciosFunciones->devolverSelectBox( $serviciosReferencias->traerTipopago(),array(1),'');


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
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
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
	
	</style>

    
   
   <link href="../../css/perfect-scrollbar.css" rel="stylesheet">
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

<h3>Cotizador</h3>

    <div class="boxInfoLargo tile-stats tile-white stat-tile">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;"><span class="glyphicon glyphicon-usd"></span> Cotizador</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
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
                        <input type="checkbox" aria-label="..." id="normal" name="normal">
                        </span>
                        <input type="text" class="form-control" aria-label="..." value="Normal">
                        
                    </div><!-- /input-group -->
                </div>
                    
            	<div class="col-md-4" style="margin-bottom:7px;">
                    <div class="input-group">
                        <span class="input-group-addon">
                        <input type="checkbox" aria-label="..." id="doble" name="doble">
                        </span>
                        <input type="text" class="form-control" aria-label="..." value="Doble (Blackout + Screen)">
                        
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
                <?php
					while ($row = mysql_fetch_array($resTelas)) {
				?>
                    <div class="col-md-4" style="margin-bottom:7px;">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <input type="checkbox" aria-label="..." id="tela<?php echo $row[0]; ?>" name="tela<?php echo $row[0]; ?>">
                            </span>
                            <input type="text" class="form-control" aria-label="..." value="<?php echo $row[1]; ?>">
                            
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                <?php
					}
				?>
                
            </div>
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <hr>
            </div>
            <div class='row' style="margin-left:25px; margin-right:25px;">   
                <h2 class="cartel cartel_chico" style="margin-top:5px;">Medidas<br></h2>
            </div>
            <div class='row' style="margin-left:25px; margin-right:25px;">
            	<div class="form-group col-md-6" style="display:block">
                    <label for="desde" class="control-label" style="text-align:left">Alto</label>
                    <div class="input-group col-md-12">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-resize-horizontal"></span></span>
                        <input class="form-control" id="alto" name="alto" value="0" required type="text">
                        <span class="input-group-addon valorAdd">cm</span>
                    </div>
                </div>
                
                <div class="form-group col-md-6" style="display:block">
                    <label for="desde" class="control-label" style="text-align:left">Ancho</label>
                    <div class="input-group col-md-12">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-resize-horizontal"></span></span>
                        <input class="form-control" id="ancho" name="ancho" value="0" required type="text">
                        <span class="input-group-addon valorAdd">cm</span>
                    </div>
                </div>
            </div>

            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <hr>
            </div>
            <div class='row' style="margin-left:25px; margin-right:25px;">   
                <h2 class="cartel cartel_chico" style="margin-top:5px;">Residuo<br></h2>
            </div>
            
            <div class='row' style="margin-left:25px; margin-right:25px;"> 
            	<?php
					while ($row = mysql_fetch_array($resResiduo)) {
				?>
                    <div class="col-md-4" style="margin-bottom:7px;">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <input type="checkbox" aria-label="..." id="resi<?php echo $row[0]; ?>" name="resi<?php echo $row[0]; ?>">
                            </span>
                            <input type="text" class="form-control" aria-label="..." value="<?php echo $row[1]; ?>">
                            
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                <?php
					}
				?>
            </div>
            
            <div class='row' style="margin-left:25px; margin-right:25px;" id="datosFacturacion"> 
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
            
            
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">
                    <li>
                        <button type="button" class="btn btn-primary" id="cotizar" style="margin-left:0px;">Cotizar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-success" id="orden" style="margin-left:0px; display:none;">Crear Orden</button>
                    </li>
                    <li style="font-weight:bold; color:#F00; font-size:1.6em; margin-right:10%;" class="pull-right">
                    	Precio: <span class="glyphicon glyphicon-usd"></span><span style="font-weight:bold; color:#F00; font-size:1.6em;" id="total"></span>
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
            <input type="hidden" name="accion" id="accion" value="cotizar"/>
            <input type="hidden" name="totalgral" id="totalgral" value="0"/>
            <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['nombre_predio']; ?>" />
            </form>
            <div style="height:70px;">
            </div>
    	</div>
        
        
    </div>
    

   
</div>


</div>


<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pagos</h4>
      </div>
      <div class="modal-body userasignates">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div id="dialog2" title="Eliminar <?php echo $singular; ?>">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el <?php echo $singular; ?>?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina el <?php echo $singular; ?> se perderan todos los datos de este</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	
	
	$('table.table').dataTable({
		"order": [[ 0, "asc" ]],
		"language": {
			"emptyTable":     "No hay datos cargados",
			"info":           "Mostrar _START_ hasta _END_ del total de _TOTAL_ filas",
			"infoEmpty":      "Mostrar 0 hasta 0 del total de 0 filas",
			"infoFiltered":   "(filtrados del total de _MAX_ filas)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrar _MENU_ filas",
			"loadingRecords": "Cargando...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"zeroRecords":    "No se encontraron resultados",
			"paginate": {
				"first":      "Primero",
				"last":       "Ultimo",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			}
		  }
	} );
	

	$('table.table').on("click",'.varborrar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar").val(usersid);
			$("#dialog2").dialog("open");

			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar
	
	$('table.table').on("click",'.varmodificar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "../ordenes/modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar
	
	
	$('table.table').on("click",'.varpagar', function(){
		
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "../pagos/pagar.php?id="+usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton pagos
	
	
	$('table.table').on("click",'.varpagos', function(){
			
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {

			$.ajax({
					data:  {id: usersid, accion: 'traerPagosPorOrden'},
					url:   '../../ajax/ajax.php',
					type:  'post',
					beforeSend: function () {
							
					},
					success:  function (response) {
							$('.userasignates').html(response);
							
					}
			});
			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error redo action.");	
		  }
	});//fin del boton eliminar
	
	
	$('table.table').on("click",'.varfinalizar', function(){

		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {

			$.ajax({
					data:  {id: usersid, usuario: '<?php echo $_SESSION['nombre_predio']; ?>', accion: 'finalizarOrden'},
					url:   '../../ajax/ajax.php',
					type:  'post',
					beforeSend: function () {
							
					},
					success:  function (response) {
							if (response == '') {
								$(".alert").removeClass("alert-danger");
								$(".alert").removeClass("alert-info");
								$(".alert").addClass("alert-success");
								$(".alert").html('<strong>Ok!</strong> Se finalizo exitosamente la <strong>Orden</strong>. ');
								$(".alert").delay(3000).queue(function(){
									/*aca lo que quiero hacer 
									  después de los 2 segundos de retraso*/
									$(this).dequeue(); //continúo con el siguiente ítem en la cola
									
								});
								$("#load").html('');
								url = "index.php";
								$(location).attr('href',url);
								
								
							} else {
								$(".alert").removeClass("alert-danger");
								$(".alert").addClass("alert-danger");
								$(".alert").html('<strong>Error!</strong> '+response);
								$("#load").html('');
							}
							
					}
			});
			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error redo action.");	
		  }
	});//fin del boton eliminar
	
	 $( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), accion: '<?php echo $eliminar; ?>'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "index.php";
											$(location).attr('href',url);
											
									}
							});
						$( this ).dialog( "close" );
						$( this ).dialog( "close" );
							$('html, body').animate({
	           					scrollTop: '1000px'
	       					},
	       					1500);
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
	 		}); //fin del dialogo para eliminar

	
	$('#orden').click(function(){
		
		$('#accion').val('orden');
		//información del formulario
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
				
				$('#total').html('');
				$('#accion').val('cotizar');
				$("#load").html('');
				$(".alert").removeClass("alert-danger");
				$(".alert").removeClass("alert-info");
				$(".alert").addClass("alert-success");
				$(".alert").html('<strong>Ok!</strong> Se cargo exitosamente la <strong>Orden y la Venta</strong>. ');
			},
			//si ha ocurrido un error
			error: function(){
				$(".alert").html('<strong>Error!</strong> Actualice la pagina');
				$("#load").html('');
			}
		});

    });
	
	
	
	$('#cotizar').click(function(){
		
		$('#accion').val('cotizar');
		//información del formulario
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
				$("#load").html('<img src="../imagenes/load13.gif" width="50" height="50" />');       
			},
			//una vez finalizado correctamente
			success: function(data){
				
				if (parseFloat(data)>0) {
					$('#total').html(data);
					$(".alert").removeClass("alert-danger");
					$(".alert").removeClass("alert-info");
					$(".alert").html('');
					$("#load").html('');
					$('#orden').show();
					$('#datosFacturacion').show();
					$('#totalgral').val(data);
				} else {
					$(".alert").removeClass("alert-danger");
					$(".alert").addClass("alert-danger");
					$(".alert").html('<strong>Error!</strong> '+data);
					$("#load").html('');
					$('#total').html('');
					$('#orden').hide();
					$('#datosFacturacion').hide();
					$('#totalgral').val(0);

				}
			},
			//si ha ocurrido un error
			error: function(){
				$(".alert").html('<strong>Error!</strong> Actualice la pagina');
				$("#load").html('');
			}
		});
		
    });
	
	$('#datosFacturacion').hide();

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
