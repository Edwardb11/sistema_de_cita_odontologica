<?php
include_once('../php/conexionDB.php');
include_once('../php/consultas.php');
$vUsuario = $_SESSION['id_doctor'];
$resultadoDentistas = MostrarCitas($link, $vUsuario); //mostrar dentistas

if (isset($_SESSION['id_doctor'])) {
	$vUsuario = $_SESSION['id_doctor'];
	$row = consultarDoctor($link, $vUsuario);
} else {
	$_SESSION['MensajeTexto'] = "Error acceso al sistema  no registrado.";
	$_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<!-- ICONO -->
	<link rel="icon" href="../src/img/logo.png" type="image/png" />
	<!-- Bootstrap CSS -->
	<!-- <link rel="stylesheet" href="../src/css/lib/bootstrap/css/bootstrap.min.css"> -->

	<!-- Style -->
	<link rel="stylesheet" href="../src/css/admin.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="../src/css/lib/fontawesome/css/all.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="css/styles.css"> -->
	<link rel='stylesheet' type='text/css' href='../src/css/fullcalendar.css' />
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script type='text/javascript' src='../src/js/lib/FullCalendar/moment.min.js'></script>
	<script type='text/javascript' src='../src/js/lib/FullCalendar/fullcalendar.min.js'></script>
	<script type='text/javascript' src='../src/js/lib/FullCalendar/locale/es.js'></script>
	<script>
		function addZero(i) {
			if (i < 10) {
				i = '0' + i;
			}
			return i;
		}
		var hoy = new Date();
		var dd = hoy.getDate();
		if (dd < 10) {
			dd = '0' + dd;
		}

		if (mm < 10) {
			mm = '0' + mm;
		}
		var mm = hoy.getMonth() + 1;
		var yyyy = hoy.getFullYear();

		dd = addZero(dd);
		mm = addZero(mm);

		$(document).ready(function() {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				defaultDate: yyyy + '-' + mm + '-' + dd,
				buttonIcons: true, // show the prev/next text
				weekNumbers: false,
				editable: true,
				eventLimit: true, // allow "more" link when too many events 
				events: [
					<?php

					while ($row1 = mysqli_fetch_array($resultadoDentistas)) {
					?> {

							id: '<?php echo $row1['id_cita']  ?>',
							title: '<?php echo $row1['tipo']  ?>',
							description: '<?php echo  'El paciente ' . $row1['nombre'] . ' ha realizado una consulta de ' . $row1['tipo'] . '  con el doctor ' . $row1['nombreD'] . '.' . '<br>' . 'Fecha de la cita: ' . $row1['fecha_cita']  . '<br>' . 'Hora de la cita: ' . $row1['hora_cita']    ?>',
							start: '<?php echo $row1['fecha_cita'] ?>',
							textColor: 'White',
							display: 'backgr'

						},
					<?php
					}
					?>
				],
				eventClick: function(calEvent, jsEvent, view) {
					$('#event-title').text(calEvent.title);
					$('#event-description').html(calEvent.description);
					$('#modal-event').modal();
				},
			});
		});
	</script>
	<title>Perfect Teeth </title>
</head>

<body>

	<body>
		<aside class="sidebar">
			<div class="toggle">
				<a href="#" class="burger js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
					<span></span>
				</a>
			</div>
			<div class="side-inner">
				<div class="profile">
					<img src="../src/img/admin_user.png" alt="Image" class="img-fluid">
					<h3 class="name"><?php echo utf8_decode($row['nombreD'] . ' ' . $row['apellido']); ?></h3>
					<span class="country">Perfect Teeth </span>
				</div>
				<div class="nav-menu">
					<ul>
						<li class="accordion">

						<li><a href="inicioAdmin.php"><span class="icon-location-arrow mr-3"></span> <i class="far fa-calendar-check"></i>
								Citas
								pendientes
							</a></li>
						<li><a href="doctores.php"><span class="icon-location-arrow mr-3"></span><i class="fas fa-user-md"></i>
								Dentistas</a></li>
						<li><a href="calendar.php"><span class="icon-pie-chart mr-3"></span> <i class="far fa-calendar-alt"></i>
								Calendario</a>
						</li>
						<li><a href="../php/cerrar.php"><span class="icon-sign-out mr-3"></span><i class="fas fa-sign-out-alt"></i> Cerrar
								sesión </a>
						</li>
					</ul>
				</div>
			</div>
		</aside>
		<main class="bg bg-white">
			<div class="site-section ">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="content-box-large">
								<div>
									<ol class=" breadcrumb bg-white">
										<li class="breadcrumb-item">
											<a href="./inicioAdmin.php">Inicio</a>
										</li>
										<li class="breadcrumb-item active">
											Calendario
										</li>
									</ol>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12 text-info">
											<div class="p-3 mb-2 bg-primary text-white text-center"> Calendario de Citas
											</div>
											<div class="row">
												<div id="content" class="col-lg-12">
													<div class="row">
														<div id="content" class="col-lg-12">
															<div id="calendar"></div>
															<div class="modal fade" id="modal-event" tabindex="-1" role="dialog" aria-labelledby="modal-eventLabel" aria-hidden="false">
																<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title text-primary 	" id="event-title"></h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																			</button>
																		</div>
																		<div class="modal-body text-dark">
																			<div id="event-description"></div>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</main>
		<script src="../src/js/admin.js"></script>
	</body>

</html>