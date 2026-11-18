<?php include_once("./include/cabecera.php"); ?>

    <section id="col-center">
        <h2 class="title-center mb-3"> Estudiantes </h2>
        <div class="col-contenedor mb-4">
            <div class="col-izq">
                <img src="./img/carteles/2026_gs_alumnado_izq_KA131-HED 2026.jpg" 
                    alt="Cartel movilidad alumnado Educación Superior KA131-HED 2026"
                    class="cartel-centro img-fluid">
                <div class="enlaces-centro">
                    <?php echo Util::carga_novedades("./documentos/04_educacion_superior/alumnos/KA131-HED"); ?>
                </div>
            </div> 
            <div class="col-der">
                <img src="./img/carteles/2026_gs_alumnado_der_KA171-HED.jpg" 
                    alt="Cartel movilidad alumnado Educación Superior KA171-HED 2026"
                    class="cartel-centro img-fluid">
                <div class="enlaces-centro">
                    <?php echo Util::carga_novedades("./documentos/04_educacion_superior/alumnos/KA171-HED"); ?>
                </div>
            </div>
        </div>

        <h2 class="title-center mb-3"> Profesorado </h2>
        <div class="col-contenedor mb-4">
            <div class="col-izq">
                <img src="./img/carteles/2026_gs_profesores_izq_staff KA131-HED.jpg" 
                    alt="Cartel movilidad profesorado Educación Superior KA131-HED 2026"
                    class="cartel-centro img-fluid">
                <div class="enlaces-centro">
                    <?php echo Util::carga_novedades("./documentos/04_educacion_superior/profesores/KA-131-HED"); ?>
                </div>
            </div>
            <div class="col-der">
                <img src="./img/carteles/2026_gs_profesores_der_KA171-HED.jpg" 
                    alt="Cartel movilidad profesorado Educación Superior KA171-HED 2026"
                    class="cartel-centro img-fluid">
                <div class="enlaces-centro">
                    <?php echo Util::carga_novedades("./documentos/04_educacion_superior/profesores/KA-171-HED"); ?>
                </div>
            </div>
        </div>
    </section>

<?php include_once("./include/pie.php"); ?>
