<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funciones.php');
include ('../includes/funcionesReferencias.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Dashboard",$_SESSION['refroll_predio'],'');


if ($_SESSION['idroll_predio'] != 1) {
	header('Location: cotizador/index.php');
}

/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Orden";

$plural = "Ordenes";

$eliminar = "eliminarOrdenes";

$insertar = "insertarOrdenes";

$tituloWeb = "Gestión: Sistema Cortinas Roller";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////

/////////////////////// Opciones para la creacion del view  patente,refmodelo,reftipovehiculo,anio/////////////////////
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
					<th>Tela Sec.</th>";


//////////////////////////////////////////////  FIN de los opciones //////////////////////////

$lstPedidos 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerOrdenesActivas(),96);

$lstClientes	= $serviciosFunciones->devolverSelectBox($serviciosReferencias->traerClientes(),array(1),'');
//$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerOrdenesActivos(),95);
//$lstCargadosMora 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerOrdenesMora(),94);


$resClientes	=	$serviciosReferencias->traerCantidadClientes();
$resOrdenes		=	$serviciosReferencias->traerCantidadOrdenes();
$resVentas		=	$serviciosReferencias->traerCantidadVentas(date('Y-m-d'));



if (mysql_num_rows($resClientes)>0) {
	$cantClientes			=	mysql_result($resClientes,0,0);
} else {
	$cantClientes			=	0;
}

if (mysql_num_rows($resOrdenes)>0) {
	$cantPedidos			=	mysql_result($resOrdenes,0,0);
} else {
	$cantPedidos			=	0;
}

if (mysql_num_rows($resVentas)>0) {
	$cantVentas			=	mysql_result($resVentas,0,0);
} else {
	$cantVentas			=	0;
}

$cabeceras2 		= "	<th>Numero</th>
                    <th>Fecha</th>
                    <th>Tipo Pago</th>
					<th>Total</th>
					<th>Cliente</th>
                    <th>Cancelada</th>
                    <th>Usuario</th>
                    <th>Fec. Entrega</th>";				
//////////////////////////////////////////////  FIN de los opciones //////////////////////////

$lstVentas	= $serviciosFunciones->camposTablaView($cabeceras2, $serviciosReferencias->traerVentasPorDia(date('Y-m-d')),95);

?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">



<title>Gesti&oacute;n: Sistema Cortinas Roller</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"/>
	<!--<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>-->
    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../css/chosen.css">


   
   <link href="../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../js/jquery.mousewheel.js"></script>
      <script src="../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
    
    <script src="../js/jquery.color.min.js"></script>
	<script src="../js/jquery.animateNumber.min.js"></script>
</head>

<body>

 
<?php echo str_replace('..','../dashboard',$resMenu); ?>

<div id="content">
	
    <div class="row" style="margin-top:15px;">
    	<div class="col-md-1">
        </div>
        <div class="col-md-10">
        	<div class="col-md-12">
            	<div class="col-md-4 col-xs-2">
                    <div align="center">
                        <img src="../imagenes/lblClientes.png" width="50%" title="Clientes"/>
                        <p><span id="lblCliente" style="color: red;">0</span></p>
                    </div>
                </div>
                <div class="col-md-4 col-xs-2">
                    <div align="center">
                        <img src="../imagenes/lblVentas.png" width="50%" title="Ventas">
                        <p><span id="lblVentas" style="color: red;">0</span></p>
                    </div>
                </div>
                

                <div class="col-md-4 col-xs-2">
                    <div align="center">
                        <img src="../imagenes/lblPedidos.png" width="50%" title="Ordenes">
                        <p><span id="lblPedidos" style="color: red;">0</span></p>
                    </div>
                </div>            
            </div>
        </div>
        
        
        
        <div class="col-md-1">
        </div>
    </div>
    

    
    <div class="row" style="margin-right:15px;">
    <div class="col-md-12">
    <div class="panel" style="border-color:#006666;">
				<div class="panel-heading" style="background-color:#006666; color:#FFF; ">
					<h3 class="panel-title">Ventas Actuales</h3>
					<span class="pull-right clickable panel-collapsed" style="margin-top:-15px; cursor:pointer;"><i class="glyphicon glyphicon-chevron-down"></i></span>
				</div>
                <div class="panel-body collapse">
            		<?php echo str_replace("example","example2",$lstVentas); ?>
								
				</div>
            </div>
    
    </div>
    </div>
    
    
    <div class="row" style="margin-right:15px;">
    <div class="col-md-12">
    <div class="panel" style="border-color:#006666;">
				<div class="panel-heading" style="background-color:#006666; color:#FFF; ">
					<h3 class="panel-title">Clientes</h3>
					<span class="pull-right clickable panel-collapsed" style="margin-top:-15px; cursor:pointer;"><i class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
                    <div class="panel-body">
                    	<div class="row">
                        <div class="form-group col-md-6" style="display:block">
                        <label class="control-label" for="codigobarra" style="text-align:left">Seleccione el Cliente</label>
                        <div class="input-group col-md-12">
                        	<div class="row">
                            <select data-placeholder="selecione el Cliente..." id="refclientes" name="refclientes" class="chosen-select form-control" tabindex="2" style="width:100%;">
                                
                                <?php echo $lstClientes; ?>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    	<div class="form-group col-md-6" style="display:block">
                            <label class="control-label" for="codigobarra" style="text-align:left">Buscar Compras y Pagos | Pagar</label>
                            <div class="input-group col-md-12">
                                <ul class="list-inline">
                                	<li>
                                    	<button type="button" class="btn btn-primary" id="buscarCliente" style="margin-left:0px;"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                    </li>
                                    <li>
                                    	<button type="button" class="btn btn-warning" id="pagarCliente" style="margin-left:0px;"><span class="glyphicon glyphicon-credit-card"></span> Pagar</button>
                                    </li>    
                                </ul>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="detalleCliente" style="display:none;">
                    <div class='row' style="margin-left:25px; margin-right:25px;">
                    	<h4><span class="glyphicon glyphicon-chevron-right"></span> Compras</h4>
                        <div class="col-md-12" id="compras">
                        
                        </div>
                    </div>
                    
                    <div class='row' style="margin-left:25px; margin-right:25px;">
                    	<h4><span class="glyphicon glyphicon-chevron-right"></span> Compras a Cuenta</h4>
                        <div class="col-md-12" id="comprascuentas">
                        
                        </div>
                    </div>
                    
                    <div class='row' style="margin-left:25px; margin-right:25px;">
                    	<h4><span class="glyphicon glyphicon-chevron-right"></span> Pagos</h4>
                        <div class="col-md-12" id="pagos">
                        
                        </div>
                    </div>
                    
                    <div class='row' style="margin-left:25px; margin-right:25px;">
                    	<h4><span class="glyphicon glyphicon-chevron-right"></span> Cuenta</h4>
                        <div class="col-md-12" style="margin-left:-15px;">
                        	<h4><span class="glyphicon glyphicon-credit-card"></span> Saldo: <span class="glyphicon glyphicon-usd"></span> <span class="cuenta">0</span></h4>
                        </div>
                    </div>
					</div><!-- fin del contenedor detalle -->
                    		
				</div>
            </div>
    
    </div>
    </div>
    
    
    
    
    
    
    
   
</div>


</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="1" style="z-index:500000;" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle de Venta</h4>
      </div>
      <div class="modal-body detalleVentas">
        
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
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<script src="../bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$(document).on('click', '.panel-heading span.clickable', function(e){
		var $this = $(this);
		if(!$this.hasClass('panel-collapsed')) {
			$this.parents('.panel').find('.panel-body').slideUp();
			$this.addClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		} else {
			$this.parents('.panel').find('.panel-body').slideDown();
			$this.removeClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		}
	});
	
	$('#example').dataTable({
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


	$('#example2').dataTable({
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
	
	$('#example2').on("click",'.varpagos', function(){
		  
		  $.ajax({
				data:  {id: $(this).attr("id"), 
						accion: 'traerDetallepedidoPorPedido'},
				url:   '../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {
						
				},
				success:  function (response) {
					$('.detallePedido').html(response);	
				}
		});
	});
	
	

	$('#example2').on("click",'.varborrar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar").val(usersid);
			$("#dialog2").dialog("open");

			
			url = "index.php";
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar
	
	$('#example2').on("click",'.varmodificar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "ventas/modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar
	
	$('#example2').on("click",'.vardetalles', function(){
		usersid =  $(this).attr("id");

		traerDetalleVentaPorVenta(usersid);

	});//fin del boton detalle de ventas	
	
	
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
									url:   '../ajax/ajax.php',
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
	
	
	function traerVentasPorCliente(idCliente) {
		$.ajax({
			data:  {id: idCliente, 
					accion: 'traerVentasPorCliente'},
			url:   '../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
				
			},
			success:  function (response) {
				
				$('#compras').html(response);
					
					
			}
		});
	}
	
	
	function traerVentasPorClienteACuenta(idCliente) {
		$.ajax({
			data:  {id: idCliente, 
					accion: 'traerVentasPorClienteACuenta'},
			url:   '../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {

			},
			success:  function (response) {

				$('#comprascuentas').html(response);
	
			}
		});
	}
	
	
	function traerDetallePagosPorCliente(idCliente) {
		$.ajax({
			data:  {id: idCliente, 
					accion: 'traerDetallePagosPorCliente'},
			url:   '../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {

			},
			success:  function (response) {
				
				$('#pagos').html(response);
					
			}
		});
	}
	
	function traerDetalleVentaPorVenta(idVenta) {
		$.ajax({
			data:  {id: idVenta, 
					accion: 'traerDetalleVentaPorVenta'},
			url:   '../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {

			},
			success:  function (response) {
				
				$('.detalleVentas').html(response);
					
			}
		});
	}
	
	function traerDetalleVentaPorCliente(idVenta) {
		$.ajax({
			data:  {id: idVenta, 
					accion: 'traerDetalleVentaPorCliente'},
			url:   '../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {

			},
			success:  function (response) {
				
				$('.detalleVentas').html(response);
					
			}
		});
	}
	
	function traerSaldo(idCliente) {
		$.ajax({
			data:  {id: idCliente, 
					accion: 'traerPagosPorCliente'},
			url:   '../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
				$('.detalleCliente').hide(200);	
			},
			success:  function (response) {
				
				
				
					$('.cuenta').html(response);
					if (response < 0) {
						$('.cuenta').css({'color' : '#F00'});
					} else {
						$('.cuenta').css({'color' : '#000'});
					}
					
			}
		});
	}
	
	$('#refclientes').change(function() {
		$('.detalleCliente').hide(200);	
	});
	/* para la parte de clientes */
	$('#buscarCliente').click(function() {
		traerVentasPorCliente($('#refclientes').val());
		traerVentasPorClienteACuenta($('#refclientes').val());
		traerDetallePagosPorCliente($('#refclientes').val());
		traerSaldo($('#refclientes').val());
		$('.detalleCliente').show(300);
	});
	
	$('#pagarCliente').click(function() {
		url = "pagos/pagar.php?id=" + $('#refclientes').val();
		$(location).attr('href',url);
	});
	
	
	/* fin */
	
	$(document).on('click', '.varpdf', function(e){
		  usersid =  $(this).attr("id");
		  
		  if (!isNaN(usersid)) {
			
			url = "../reportes/rptFactura.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar


	$(document).on('click', '.varver', function(e){
		  usersid =  $(this).attr("id");
		  
		  if (!isNaN(usersid)) {
			
			url = "ventas/ver.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar
	
	
	$(document).on('click', '.varVerDetalle', function(e){
		  traerDetalleVentaPorCliente($(this).attr("id"));
	});//fin del boton modificar

	$(document).on('click', '.rptOrdenTotal', function(e){
		  usersid =  $(this).attr("id");
		  
		  if (!isNaN(usersid)) {
			
			window.open("../reportes/rptOrdenTrabajo.php?id=" + usersid,'_blank');	

			window.open("../reportes/rptOrdenTrabajoRoller.php?id=" + usersid,'_blank');

			window.open("../reportes/rptOrdenTrabajoTelas.php?id=" + usersid,'_blank');
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton Ordenes de trabajo


	$(document).on('click', '.rptImprimirEtiquetas', function(e){
		  usersid =  $(this).attr("id");
		  
		  if (!isNaN(usersid)) {

			window.open("../reportes/rptOrdenTrabajoImpresoraRoller.php?id=" + usersid,'_blank');

			window.open("../reportes/rptOrdenTrabajoImpresoraTelas.php?id=" + usersid,'_blank');
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton Ordenes de trabajo


});
</script>

<script>
	  	var percent_number_step = $.animateNumber.numberStepFactories.append('');
		$('#lblCliente').animateNumber(
		  {
			number: <?php echo $cantClientes; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);
		
		
		$('#lblVentas').animateNumber(
		  {
			number: <?php echo $cantVentas; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);
		
		
		
		
		$('#lblPedidos').animateNumber(
		  {
			number: <?php echo $cantPedidos; ?>,
			color: 'green',
			'font-size': '30px',
		
			easing: 'easeInQuad',
		
			numberStep: percent_number_step
		  },
		  1000
		);

	</script>
    
    <script src="../js/chosen.jquery.js" type="text/javascript"></script>
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
