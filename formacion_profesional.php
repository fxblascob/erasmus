
<?php include_once("./include/cabecera.php"); ?>

	<section id="col-center">
		<h2 class="title-center"> Estudiantes </h2>
	
		<div style="text-align: center;">
			<img src="./img/carteles/2025_gm_alu_ka121-vet-000319117.png" width=50%>
		</div>
		<div class="enlaces-centro">
			<?php echo Util::carga_novedades("./documentos/03_formacion_profesional/alumnos"); ?>
		</div>
		<h2 class="title-center"> Profesorado </h2>
		<div style="text-align: center;">
				<img src="./img/carteles/2025_gm_profe-ka121-vet-000319117.jpg" width=50%>
		</div>
		<div class="enlaces-centro">
			<?php echo Util::carga_novedades("./documentos/03_formacion_profesional/profesores"); ?>
		</div>		
	</section>
					
<?php include "./include/pie.php"; ?>	