        <aside id="col-right">
            <div class="imagenes-contenedor" id="slideShowImages">
                <?php Util::carga_todas_imagenes("./documentos/imagenes_fondo_web"); ?>
            </div> 
            <div id="historico-contenedor">
                <p id="historico-message">Histórico</p>
                <div id="historico">
                    <?php echo Util::carga_novedades("./documentos/novedades_fondo_web/historico", "desc"); ?>
                </div>
            </div>
        </aside>
    </div>
</main>
<address class="text-center my-3">
    Para más información, escribe un correo a esta dirección 
    <a href="mailto:erasmusplus@iessanvicente.com" class="text-primary text-decoration-none fw-bold">erasmusplus@iessanvicente.com</a> / 
    <a href="mailto:03008423@edu.gva.es" class="text-primary text-decoration-none fw-bold">03008423@edu.gva.es</a>
</address>
<footer>
    <div id="redes_sociales">
        <a href="https://www.facebook.com/IesSanVicente" target="_blank" rel="noopener noreferrer">
            <img src="./img/redes_sociales/facebook.png" alt="Facebook">
        </a>
        <a href="https://twitter.com/IESSanVicente" target="_blank" rel="noopener noreferrer">
            <img src="./img/redes_sociales/x.png" alt="X (Twitter)">
        </a>
        <a href="https://www.instagram.com/iessanvicente_/" target="_blank" rel="noopener noreferrer">
            <img src="./img/redes_sociales/instagram.png" alt="Instagram">
        </a>
    </div>
    <p>&copy; <?= date('Y') ?> IES San Vicente - Erasmus+</p>
</footer>
        </div>
    </body>
</html>
