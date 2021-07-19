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
	header("Location: ./index.php");
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



	<!-- jQuery UI -->
	<link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<link href='../src/js/lib/fullcalendar/main.css' rel='stylesheet' />
	<script src='../src/js/lib/fullcalendar/main.js'></script>
	<script src='../src/js/lib/fullcalendar/locale/moment.min.js'></script>
	<script type='text/javascript' src='../src/js/lib/fullcalendar/locale/es.js'></script>


	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var calendarEl = document.getElementById('calendar');

			var calendar = new FullCalendar.Calendar(calendarEl, {
				locale: 'es',
				initialView: 'dayGridMonth',
				initialDate: '2021-07-22',
				headerToolbar: {
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay'
				},


				eventRender: function(info) {
					var tooltip = new Tooltip(info.el, {
						title: info.event.extendedProps.description,
						placement: 'top',
						trigger: 'hover',
						container: 'body'
					});
				},

				events: [
					<?php
					while ($row1 = mysqli_fetch_array($resultadoDentistas)) {
					?> {
							id: '<?php echo $row1['id_cita']  ?>',
							title: '<?php echo $row1['tipo']  ?>',
							description: 'ahahdjj',
							start: '<?php echo $row1['fecha_cita']; ?>',
							textColor: 'White',
							display: 'block'

						},
					<?php
					}
					?>
				]
			});
			calendar.render();
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
											<a href="index.html">Inicio</a>
										</li>
										<li class="breadcrumb-item active">
											Calendario
										</li>
									</ol>

								</div>

								<div class="panel-body">

									<div class="row">
										<div class="col-md-12 text-info">
											<div class="p-3 mb-2 bg-info text-white text-center"> Calendario de Citas
											</div>
											<div class="row">
												<div id="content" class="col-lg-12">
													<div id="calendar"></div>
													<div id="demo"></div>

													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Cronograma de Actividade</h4>
														</div>

														<div class="modal-body">
															<div class="doctor-detail-wrap">
																<div id="doctor-calendar"></div>
															</div>
														</div>
														<div class="modal-footer">
															<!-- <input type="submit" class="btn btn-warning" id="doc-update" value="Update"> -->
															<button type="button" class="btn btn-default" id="plist-close" data-dismiss="modal">Close</button>
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




		<!-- <script src="../src/css/lib/bootstrap/js/bootstrap.min.js"></script> -->
		<script src="../src/js/admin.js"></script>

	</body>

</html>