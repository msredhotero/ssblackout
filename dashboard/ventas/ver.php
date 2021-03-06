<?php


session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
} else {


include ('../../includes/funciones.php');
include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funcionesHTML.php');
include ('../../includes/funcionesReferencias.php');

$serviciosFunciones = new Servicios();
$serviciosUsuario 	= new ServiciosUsuarios();
$serviciosHTML 		= new ServiciosHTML();
$serviciosReferencias 	= new ServiciosReferencias();




//*** SEGURIDAD ****/
include ('../../includes/funcionesSeguridad.php');
$serviciosSeguridad = new ServiciosSeguridad();
$serviciosSeguridad->seguridadRuta($_SESSION['refroll_predio'], '../ventas/');
//*** FIN  ****/


$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Ventas",$_SESSION['refroll_predio'],'');


$id = $_GET['id'];

$resResultado = $serviciosReferencias->traerVentasPorId($id);

/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Venta";

$plural = "Ventas";

$eliminar = "eliminarVentas";

$modificar = "modificarVentas";

$idTabla = "idventa";

$tituloWeb = "Gestión: Sistema Cortinas Roller";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbventas";

$lblCambio	 	= array("reftipopago","refclientes");
$lblreemplazo	= array("Tipo Pago","Cliente");


$resTipoPago 	= $serviciosReferencias->traerTipopagoPorId(mysql_result($resResultado,0,'reftipopago'));
$cadRef 	= $serviciosFunciones->devolverSelectBoxActivo($resTipoPago,array(1),'',mysql_result($resResultado,0,'reftipopago'));
    
$resClientes 	= $serviciosReferencias->traerClientesPorId(mysql_result($resResultado,0,'refclientes'));
$cadRef2 	= $serviciosFunciones->devolverSelectBoxActivo($resClientes,array(1),'',mysql_result($resResultado,0,'refclientes'));
   
	
$refdescripcion = array(0 => $cadRef,1=>$cadRef2);
$refCampo 	=  array("reftipopago","refclientes");
//////////////////////////////////////////////  FIN de los opciones //////////////////////////
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
					<th>Tela Sec.</th>
					<th>% Completo</th>";

//////////////////////////////////////////////  FIN de los opciones //////////////////////////

//nroorden, nroventa, cliente, fecha, usuario, sistema, tela, roller, tramado, ancho, alto, esdoble, tela aux
$lstCargados 	= $serviciosFunciones->camposTablaViewSinAction($cabeceras,$serviciosReferencias->traerOrdenesPorVenta($id),14);

$resA = $serviciosReferencias->traerOrdenesPorVenta($id);

$lblid			= 'idventa';

$formulario 	= $serviciosFunciones->camposTablaVer($id,$lblid,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo)






?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title><?php echo $tituloWeb; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
	<!--<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>-->
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

	<style type="text/css">
		
  
		
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

<h3><?php echo $plural; ?></h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Modificar <?php echo $singular; ?></p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	
			<div class="row">
			<?php echo $formulario; ?>
            </div>
            
            <div class='row' style="margin-left:10px; margin-right:10px;">
            	
                <div class="col-md-12">
                	<div class="panel panel-info">
                    	<div class="panel-heading">Detalle de la Venta</div>
                        <div class="panel-body">
							<?php //echo $lstCargados; 

								$cad = "<table class='table table-responsive table-striped'>
										<thead>
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
											<th>Estado</th>
										</thead>
										<tbody>";
								while ($rowJ = mysql_fetch_array($resA))	{
									$resPorcentaje = $serviciosReferencias->devolverPorcentajeCumplido($rowJ[0]); 
									$cad .= '<tr>
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
												<td>'.$rowJ[14].'</td>
											</tr>';
									$cad .= '<tr><td colspan="14"> <h6 style="color:#676767;">Porcentaje de Completo <span class="porcentajeaux">'.$resPorcentaje.'</span>%</h6>
							        		<div class="progress">
								                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="'.$resPorcentaje.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$resPorcentaje.'%; font-family:Verdana, Geneva, sans-serif;">
								                <span id="porcentaje">'.$resPorcentaje.'</span>%
								                </div>
								            </div></td></tr>';
								}

								$cad .= "</tbody></table>";

								

								

								echo $cad;            
							?>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">
                    <li>
                        <button type="button" class="btn btn-warning" id="cargar" style="margin-left:0px;">Modificar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-danger varborrar" id="<?php echo $id; ?>" style="margin-left:0px;">Eliminar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-default volver" style="margin-left:0px;">Volver</button>
                    </li>
                </ul>
                </div>
            </div>
            </form>
    	</div>
    </div>
    
    
   
</div>


</div>

<div id="dialog2" title="Eliminar <?php echo $singular; ?>">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el <?php echo $singular; ?>?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina el equipo se perderan todos los datos de este</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>

<div id="dialog3" title="Borrar imagen">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro de desea eliminar esta imagen?.
        </p>
        <div id="auxImg">
        
        </div>
        <input type="hidden" value="" id="idAgente" name="idAgente">
</div>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	if (<?php echo mysql_result($resResultado,0,'cancelada'); ?> == 1) {
		$('#cancelado').prop('checked',true);	
		$('#cancelado').prop('disabled',true);
	} else {
		$('#cancelado').prop('checked',false);	
	}
	
	
	
	$('#total').prop('readonly', true);
	
	$('#sistema').prop('readonly', true);
	
	$('#tela').prop('readonly', true);
	
	$('#numero').prop('readonly', true);
	
	$('.volver').click(function(event){
		 
		url = "index.php";
		$(location).attr('href',url);
	});//fin del boton modificar
	
	$('.varborrar').click(function(event){
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
	
	
	<?php 
		echo $serviciosHTML->validacion($tabla);
	
	?>
	
	$('.eliminar').click(function(event){
                
			  usersid =  $(this).attr("id");
			  imagenId = 'img'+usersid;
			  
			  if (!isNaN(usersid)) {
				$("#idAgente").val(usersid);
                                //$('#vistaPrevia30').attr('src', e.target.result);
				$("#auxImg").html($('#'+imagenId).html());
				$("#dialog3").dialog("open");
				//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
				//$(location).attr('href',url);
			  } else {
				alert("Error, vuelva a realizar la acción.");	
			  }
			  
			  //post code
	});
	
	$( "#dialog3" ).dialog({
		 	
		autoOpen: false,
		resizable: false,
		width:600,
		height:340,
		modal: true,
		buttons: {
			"Eliminar": function() {

				$.ajax({
							data:  {id: $("#idAgente").val(), accion: 'eliminarFoto'},
							url:   '../../ajax/ajax.php',
							type:  'post',
							beforeSend: function () {
									
							},
							success:  function (response) {
									url = "modificar.php?id=<?php echo $id; ?>";
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
 
 
	});
	
	
	//al enviar el formulario
    $('#cargar').click(function(){
		
		if (validador() == "")
        {
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

					if (data == '') {
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-info");
                                            $(".alert").addClass("alert-success");
                                            $(".alert").html('<strong>Ok!</strong> Se modifico exitosamente el <strong><?php echo $singular; ?></strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											url = "modificar.php?id=<?php echo $id; ?>";
											$(location).attr('href',url);
                                            
											
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
		}
    });
	
	$('#imagen1').on('change', function(e) {
	  var Lector,
		  oFileInput = this;
	 
	  if (oFileInput.files.length === 0) {
		return;
	  };
	 
	  Lector = new FileReader();
	  Lector.onloadend = function(e) {
		$('#vistaPrevia1').attr('src', e.target.result);         
	  };
	  Lector.readAsDataURL(oFileInput.files[0]);
	 
	});

});
</script>
<?php } ?>
</body>
</html>
