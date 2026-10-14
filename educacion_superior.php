<?php include_once("./include/cabecera.php"); ?>

    	<section id="col-center">                   
			<h2 class="title-center"> Estudiantes </h2>
			<div class="col-contenedor">
				<div class="col-izq" >
					<img  src="./img/carteles/2025_gs_alumnado_izq_KA131-HED.png" class="cartel-centro" >
					<div class="enlaces-centro">
						<?php echo Util::carga_novedades("./documentos/04_educacion_superior/alumnos/KA131-HED"); ?>
					</div>
				</div>
				<div class="col-der" >
					<img src="./img/carteles/2025_gs_alumnado_der_KA171-HED.jpg" class="cartel-centro">
					<div class="enlaces-centro">
						<?php echo Util::carga_novedades("./documentos/04_educacion_superior/alumnos/KA171-HED"); ?>
					</div>
				</div>
			</div>

			<h2 class="title-center"> Profesorado </h2>
			<div class="col-contenedor">
				<div class="col-izq" >
					<img src="./img/carteles/2025_gs_profesorado_izq_KA131-HED.png" class="cartel-centro" >
					<div class="enlaces-centro">
						<?php echo Util::carga_novedades("./documentos/04_educacion_superior/profesores/KA-131-HED"); ?>
					</div>
				</div>
				<div class="col-der" >
					<img src="./img/carteles/2025_gs_profesorado_der_KA171-HED.png" class="cartel-centro">
					<div class="enlaces-centro">
						<?php echo Util::carga_novedades("./documentos/04_educacion_superior/profesores/KA-171-HED"); ?>
					</div>
				</div>
			</div>                        
        </section>
		
<?php include_once("./include/pie.php"); ?>	


				