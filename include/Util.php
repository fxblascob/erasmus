<style>
	.sidebarmenu ul{
		margin: 0px;
		padding: 0px;
		list-style-type: none;
		width:100%;  /* per menú horizontal */
		z-index:8; /*POSAR EL MENU DAVANT DE TOT PER NO COLISIONAR AMB L'ESLIDE DE LES FOTOS*/
	}
	.sidebarmenu ul li{
		padding: 2px;
		position: relative;
		display: inline-block; /* per menú horitzontal*/
	}
	/* Top level menu links style */
	.sidebarmenu ul li a{
		display: inline-block; /*per menú horizontal */
		overflow: auto; /*force hasLayout in IE7 */

		text-decoration: none;
		padding: 6px;
		border: 1px solid #778;
		border-radius: 5px;
	}
	.sidebarmenu ul li a:link, .sidebarmenu ul li a:visited, .sidebarmenu ul li a:active{
		background-color: #662726; /*background of tabs (default state)*/
		color:white;
	}
	
	.sidebarmenu ul li a:visited{	color: white;}
	.sidebarmenu ul li a:hover{	background-color: #b4837b; color:white;}
	/*Sub level menu items */
	.sidebarmenu ul li ul{
		position: absolute;
		width: 170px; /*Sub Menu Items width */
		top: 0px;
		visibility: hidden;
	}

	.sidebarmenu ul li ul li a{
		display: inline-block; /*per menú horizontal */
		overflow: auto; /*force hasLayout in IE7 */
		color: white;
		text-decoration: none;
		padding: 6px;
		border: 1px solid #778;
		border-radius: 5px;
	}

	.sidebarmenu a.subfolderstyle {	
		background: url(./img/bottom.gif) no-repeat 100% 100%;	
	}
</style>

<script type="text/javascript">
	'use strict';
	let menuids = ["sidebarmenu1"] //Enter id(s) of each Side Bar Menu's main UL, separated by commas
	console.log(menuids);
	function initsidebarmenu(){
		for (let i = 0; i < menuids.length; i++){
			let ultags = document.getElementById(menuids[i]).getElementsByTagName("ul")
			for (let j = 0; j < ultags.length; j++){
				ultags[j].parentNode.getElementsByTagName("a")[0].className+=" subfolderstyle"
				if (ultags[j].parentNode.parentNode.id == menuids[i]) //if this is a first level submenu
					ultags[j].style.left = ultags[j].parentNode.offsetWidth + "px" //dynamically position first level submenus to be width of main menu item
				else //else if this is a sub level submenu (ul)
				    ultags[j].style.left = ultags[j-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
				ultags[j].parentNode.onmouseover=function(){
							this.getElementsByTagName("ul")[0].style.display="block"
					}
				ultags[j].parentNode.onmouseout=function(){
							this.getElementsByTagName("ul")[0].style.display="none"
					}
			}
			for (let j = ultags.length-1; j > -1; j--){ //loop through all sub menus again, and use "display:none" to hide menus (to prevent possible page scrollbars
				  ultags[j].style.visibility = "visible"
				  ultags[j].style.display = "none"
			}
		  }
	}
	window.addEventListener("load", initsidebarmenu)
</script>
<?php

class Util {
	//aquesta funció crea un menu amb una estrúctura de carpetes completa, el paràmetre $ninel indica si fem un menú de un sols nivel amb valor 1 i 
	//si el seu valor es major que 1 crea tota l'estructura
	public static function crea_enlaces_dir($dir,$nivel){
		if (is_dir($dir)) {
			echo '<div class="sidebarmenu"> <br> <ul id="sidebarmenu1">';
			if (is_dir($dir)) {
				$archivos = self::leerFicherosCarpeta($dir);
				ksort ($archivos);
				foreach ($archivos as $fil) {
					$url = $dir."/".$fil;
					if ($fil <> "imagenes_fondo_web" and $fil <> "novedades_fondo_web" )  {
						self::crea_enlace_lista($url,$fil);
						if (is_dir($url) && $nivel >= 2) 
							self::crea_enlaces_subdir($url,++$nivel);
					}
				}
			} 
			echo "</ul><br></div>";
		}
	}
	//aquesta funció recursiva crea els diferents subnivells del menú
	public static function crea_enlaces_subdir($url,$nivel) {
		$archivos = self::leerFicherosCarpeta($url);
		if ($archivos != null && count($archivos) > 0) {
			echo "<ul class='sidebarmenu2'>";
				foreach ($archivos as $fil) {
					$url2 = $url."/".$fil;
					self::crea_enlace_lista($url2,$fil);
					if (is_dir($url2) && $nivel >= 2 ) 
						self::crea_enlaces_subdir($url2,++$nivel); 
				}
			echo "</ul>";
		}
	}
	public static function crea_enlace_lista( $url, $fil){
		$extension = pathinfo($fil, PATHINFO_EXTENSION);
		if ( $extension == "txt") {  // els archius .txt tenen la URL dins d'ell
			$href = file_get_contents($url);  //coge la url del archivo .txt
			if (strpos($fil,"_") == 2) // quitamos el prefijo para ordenar archivos si lo lleva
				echo  ("<li> <a href = $href> ".(substr($fil,3))."</a>");
			else 
				echo  ("<li> <a href = $href> ".($fil)."</a>  ");
		}else 
			$href = is_dir($url) ? '#' : $url;  // si es una carpeta no tiene HREF
			if (strpos($fil,"_") == 2) // quitamos el prefijo para ordenar carpetas si lo lleva
				echo  ("<li> <a href='$href' > ".(substr($fil,3))."</a>");
			else 
				echo  ("<li> <a href='$href' > ".($fil)."</a>  ");
	}
	//aquesta funció crea un menu horizontal automatitzat a partir del contingut de $url
	//en el 1er nivell cada opció te un enllaç amb un href que crida a un fitxer .php amb el mateix nom
	//els demes nivells poden contindre carpetes i arxius que  queden enllaçats. els .txt tenen el enllaç dins
	public static function crea_enlaces_menu( $url){
		$archivos = self::leerFicherosCarpeta($url);
		if (count($archivos) > 0) {
			echo '<div class="sidebarmenu"> <br> <ul id="sidebarmenu1" >';
				foreach ($archivos as $fil) {
					$extension = pathinfo($fil, PATHINFO_EXTENSION);
					$url2 = $url."/".$fil;
					if ($fil != "novedades_fondo_web" && $fil != "imagenes_fondo_web") {
						//quitamos la extensión .php del enlace
						$fil_ver = $extension == "php" ? substr($fil,0,strlen($fil)-4) : $fil;
						//quitamos el número de orden
						$fil_ver = strpos($fil_ver,"_") == 2 ? substr($fil_ver,3) : $fil_ver;
						
						if (is_dir($url2)) 
							echo  "<li> <a href= '".$fil."'> $fil_ver </a></li>";
						else 
							echo  "<li> <a href= '$url2' > $fil_ver </a> </li>";
					}
				}
			echo "</ul><br></div>";
		}
	}
	//aquesta funció recursiva carrega les novetats (arxius  que estàn a $dir en forma de llista <ul>)
	public static function carga_novedades($dir,$orden="asc") {
		$cadena = "";
		if (is_dir($dir)) {
			$archivos = self::leerFicherosCarpeta($dir,$orden); 
			if (count($archivos) > 0) {
				ksort ($archivos);
				$cadena .=  "<ul class='novedades'>";
				foreach ($archivos as $fil) {
					$url = $dir."/".$fil;
					if (!is_dir($url)) { 
						$extension = pathinfo($fil, PATHINFO_EXTENSION);
						$fil = basename($fil, '.'.$extension); 
					}else $extension="";
					$href = is_dir($url) ? '#' : $url;
					$imagen = "";
					$href = $extension == "txt" ? $href = file_get_contents($url) : $href;
					$fil = strpos($fil,"_") == 2 ? (substr($fil,3)) : $fil; // quitamos el prefijo para ordenar novedades si lo lleva
					$imagen =  strpos($fil,"_") > 0 ? "./img/banderas/".substr($fil,0, strpos($fil,"_")) : "";  //ponemos la bandera
					$fil = strpos($fil,"_") > 0 ? (substr($fil,strpos($fil,"_")+1)) : $fil; //quitamos la bandera del nombre
					if (strlen($imagen) > 0) $imagen = "<img class='banderas img-fluid' src=$imagen>";
						$cadena .= "<li><a href='$href'>$imagen $fil</a></li>";
					if (is_dir($url))	
						$cadena .= self::carga_novedades($url,$orden);
				}
				$cadena .= "</ul>";
			}
		} 
		return($cadena);
	}

	//aquesta funció carga totes les imatges que estiguen en $dir i les mostra en un slide
	public static function carga_todas_imagenes($dir) {
		?> <script src="./js/slideShow.js"></script> <?php
		$archivos = self::leerFicherosCarpeta($dir,"aleatorio");
		foreach ($archivos as $fil)   {
				$url=$dir."/".$fil;
				$extension = pathinfo($fil, PATHINFO_EXTENSION);
				$fil = basename($fil, '.'.$extension); 
				echo "<img src='$url'  class='foto-erasmus' alt='imagen'>";
		}
	}
	//aquesta funció torna un array amb els fitxers que hi haja en $dir de forma
	
	public static function leerFicherosCarpeta($dir, $orden="asc") {

		if (!is_dir($dir)) {
			return []; // o lanzar excepción si lo prefieres
		}
		$archivos = array_filter(scandir($dir), function ($fil) {
			return $fil !== "." && $fil !== ".." &&	$fil[0] !== '_' &&	$fil[0] !== '.';
		});
		$archivos = array_values($archivos); // reindexa para evitar problemas
		switch ($orden) {
			case "aleatorio":
				shuffle($archivos);
				break;
			case "desc":
				rsort($archivos, SORT_NATURAL | SORT_FLAG_CASE);
				break;
			case "asc":
			default:
				sort($archivos, SORT_NATURAL | SORT_FLAG_CASE);
				break;
		}
		return $archivos;
	}

}