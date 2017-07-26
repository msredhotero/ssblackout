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

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Ordenes",$_SESSION['refroll_predio'],'');


$id = $_GET['id'];

$resResultado = $serviciosReferencias->traerOrdenesPorId($id);

$resTareas		= $serviciosReferencias->traerOrdenessistematareasPorOrden($id);
/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Tareas - Ordenes";

$plural = "Tareas - Ordenes";

$eliminar = "eliminarOrdenessistematareas";

$insertar = "insertarOrdenessistematareas";

$tituloWeb = "Gestión: Sistema Cortinas Roller";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbordenessistematareas";

$lblCambio	 	= array("refsistematareas","refordenes");
$lblreemplazo	= array("Tareas", "Orden");


$resSistemas 	= $serviciosReferencias->traerSistemaTareasPorSistemaSinUsarPorOrden($id);
$cadRef 		= $serviciosFunciones->devolverSelectBox($resSistemas,array(1),'');

$cadRef2 		= $serviciosFunciones->devolverSelectBoxActivo($serviciosReferencias->traerOrdenesPorId($id),array(1),'',$id);


$refdescripcion = array(0 => $cadRef,1 => $cadRef2);
$refCampo 	=  array("refsistematareas","refordenes");
//////////////////////////////////////////////  FIN de los opciones //////////////////////////

$formulario 	= $serviciosFunciones->camposTabla($insertar ,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

$porcentaje 	= $serviciosReferencias->devolverPorcentajeCumplido($id);

$lblPorcentaje = '';
if ($porcentaje > 0 && $porcentaje < 33) {
	$lblPorcentaje = 'danger';
} else {
	if ($porcentaje > 33 && $porcentaje < 66) {
		$lblPorcentaje = 'warning';
	} else {
		$lblPorcentaje = 'success';
	}
}

if ($_SESSION['idroll_predio'] != 1) {

} else {

	
}


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
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../css/chosen.css">
    <script src="../../js/jquery.number.min.js"></script>
	<style type="text/css">
			th {
			  color:#D5DDE5;;
			  background:#1b1e24;
			  border-bottom:4px solid #9ea7af;
			  border-right: 1px solid #343a45;
			  font-size:17px;
			  font-weight: 100;
			  padding:18px;
			  text-align:left;
			  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
			  vertical-align:middle;
			  font-family: "Roboto", helvetica, arial, sans-serif;
			}
			
			th:first-child {
			  border-top-left-radius:3px;
			}
			 
			th:last-child {
			  border-top-right-radius:3px;
			  border-right:none;
			}
			
			tr {
			  border-top: 1px solid #C1C3D1;
			  border-bottom-: 1px solid #C1C3D1;
			  color:#666B85;
			  font-size:16px;
			  font-weight:normal;
			  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
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

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;"><?php echo $singular; ?></p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">

        	<div class="row" style="margin: 10px 20px;">
        		<h4>Porcentaje de Completo</h4>
        		<div class="progress">
	                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $porcentaje; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentaje; ?>%; font-family:Verdana, Geneva, sans-serif;">
	                <span id="porcentaje"><?php echo $porcentaje; ?></span>%
	                </div>
	            </div>

        		<table class="table table-striped table-responsive">
	            	<thead>
	                	<tr>
	                    	<th style="text-align: center;">Tarea</th>
	                    	<th style="text-align: center;">Valor</th>
	                    	<th style="text-align: center;">Detalle</th>
	                    	<th style="text-align: center;">Cumplida</th>
	                        <th style="text-align: center;">Marcar Cumplida</th>
	                        <th style="text-align: center;">Accion</th>
	                    </tr>
	                </thead>
	                <tbody id="resultados">

	                	<?php
	                		while ($row = mysql_fetch_array($resTareas)) {
	                	?>
	                		<tr>
	                			<td><?php echo $row['tarea']; ?></td>
	                			<td style="text-align: center;"><?php echo $row['valor']; ?></td>
	                			<td><?php echo $row['detalle']; ?></td>
	                			<td style="text-align: center;" class="cp<?php echo $row['idordenesistematarea']; ?>"><?php echo $row['cumplida']; ?></td>
	                			<td style="text-align: center;">
	                					<button type="button" class="btncumplir btn btn-<?php if ($row['cumplida'] == 'Si') { echo 'danger'; } else { echo 'success'; } ?>" id="cl<?php echo $row['idordenesistematarea']; ?>" style="margin-left:0px;"><?php if ($row['cumplida'] == 'Si') { echo 'No'; } else { echo 'Si'; } ?></button>
	                			</td>
	                			<td style="text-align: center;">
	                					<button type="button" class="btneliminar btn btn-danger" id="<?php echo $row['idordenesistematarea']; ?>" style="margin-left:0px;">Eliminar</button>
	                			</td>
	                		</tr>
	                	<?php
	                		}
	                	?>
	                </tbody>
	            </table>
        	</div>	
			<div class="row">
			<?php echo $formulario; ?>
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
                        <button type="button" class="btn btn-success" id="cargar" style="margin-left:0px;">Agregar Tarea</button>
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
            ¿Esta seguro que desea eliminar la <?php echo $singular; ?>?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina la <?php echo $singular; ?> se perderan todos los datos de este</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	
	function porcentaje() {
		$.ajax({
			data:  {id: <?php echo $id; ?>, accion: 'devolverPorcentajeCumplido'},
			url:   '../../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {

			},
			success:  function (response) {
				/*
				aria-valuenow
				progress-bar
				*/

				$('.progress-bar').attr('aria-valuenow', response).css('width',response+'%');
				$('#porcentaje').html(response);

				if (response > 0 && response < 33) {
					$('.progress-bar').removeClass('progress-bar-success');
					$('.progress-bar').removeClass('progress-bar-warning');
					$('.progress-bar').addClass('progress-bar-danger');
					
				} else {
					if (response > 33 && response < 66) {
						$('.progress-bar').removeClass('progress-bar-danger');
						$('.progress-bar').removeClass('progress-bar-success');
						$('.progress-bar').addClass('progress-bar-warning');
					} else {
						$('.progress-bar').removeClass('progress-bar-warning');
						$('.progress-bar').removeClass('progress-bar-danger');
						$('.progress-bar').addClass('progress-bar-success');
					}
				}
			}
		});
	}

	porcentaje();

		
	$("#resultados").on("click",'.btncumplir', function(){
		  usersid =  $(this).attr("id");
		  usersid = usersid.replace('cl','')
		  if (!isNaN(usersid)) {
			$.ajax({
				data:  {id: usersid, accion: 'cumplirTarea'},
				url:   '../../ajax/ajax.php',
				type:  'post',
				beforeSend: function () {

				},
				success:  function (response) {
					
					if (response == 'Si') {
						$('#cl'+usersid).removeClass('btn-success');
						$('#cl'+usersid).addClass('btn-danger');
						
						$('#cl'+usersid).html('No');
					} else {
						$('#cl'+usersid).addClass('btn-success');
						$('#cl'+usersid).removeClass('btn-danger');
						$('#cl'+usersid).html('Si');
					}

					$('.cp'+usersid).html(response);
					porcentaje();

				}
			});

			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar
	
	
	$('.volver').click(function(event){
		 
		url = "index.php";
		$(location).attr('href',url);
	});//fin del boton modificar
	
	$("#resultados").on("click",'.btneliminar', function(){
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
									data:  {id: $('#idEliminar').val(), accion: 'eliminarOrdenessistematareas'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "tareas.php?id="+<?php echo $id; ?>;
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
	

	
	//al enviar el formulario
    $('#cargar').click(function(){
		

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
                                        $(".alert").html('<strong>Ok!</strong> Se agrego exitosamente la <strong><?php echo $singular; ?></strong>. ');
										$(".alert").delay(3000).queue(function(){
											/*aca lo que quiero hacer 
											  después de los 2 segundos de retraso*/
											$(this).dequeue(); //continúo con el siguiente ítem en la cola
											
										});
										$("#load").html('');
										url = "tareas.php?id="+<?php echo $id; ?>;
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

    });

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
