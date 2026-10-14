        <aside id="col-right">
                <div class="imagenes-contenedor" id="slideShowImages" >
                        <?php Util::carga_todas_imagenes("./documentos/imagenes_fondo_web");	?>
                </div> 
				<div id="historico-contenedor">
                    <p id='historico-message' >Histórico</p>
					<div id="historico">
						<?php echo Util::carga_novedades("./documentos/novedades_fondo_web/historico","desc"); ?>
					</div>
				</div>
		</aside>	
    </div>
</main>
<address>
	Para más información, escribe un correo a esta dirección <span style="color:blue;">erasmusplus@iessanvicente.com</span> / <span style="color:blue;">03008423@edu.gva.es</span>
</address>
            <footer>
                <div id="redes_sociales">
                    <a href="https://www.facebook.com/IesSanVicente"><img src="./img/redes_sociales/facebook.png"></a>
                    <a href="https://twitter.com/IESSanVicente"><img src="./img/redes_sociales/twiter.png"></a>
                    <a href="https://www.instagram.com/iessanvicente_/"><img src="./img/redes_sociales/instagram.png"></a>
                </div>
                <p> 2022  IES San Vicente - Erasmus+</p> 
            </footer>
        </div>
    </body>
</html>