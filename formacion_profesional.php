<?php include_once("./include/cabecera.php"); ?>

    <section id="col-center">
        <h2 class="title-center mb-3"> Estudiantes </h2>

        <div class="text-center mb-3">
            <img src="./img/carteles/2026_gm_alu_ka121_vet_000431407.png" 
                alt="Cartel movilidad alumnado FP KA121-VET"
                class="cartel-centro img-fluid">
        </div>
        <div class="enlaces-centro mb-4">
            <?php echo Util::carga_novedades("./documentos/03_formacion_profesional/alumnos"); ?>
        </div>

        <h2 class="title-center mb-3"> Profesorado </h2>
        <div class="text-center mb-3">
            <img src="./img/carteles/2026_gm_profe_ka121_vet_000431407.jpg" 
                alt="Cartel movilidad profesorado FP KA121-VET"
                class="cartel-centro img-fluid">
        </div>
        <div class="enlaces-centro mb-4">
            <?php echo Util::carga_novedades("./documentos/03_formacion_profesional/profesores"); ?>
        </div>
    </section>

<?php include_once("./include/pie.php"); ?>
