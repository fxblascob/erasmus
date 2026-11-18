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
		}else {
			$href = is_dir($url) ? '#' : $url;  // si es una carpeta no tiene HREF
			if (strpos($fil,"_") == 2) // quitamos el prefijo para ordenar carpetas si lo lleva
				echo  ("<li> <a href='$href' > ".(substr($fil,3))."</a>");
			else 
				echo  ("<li> <a href='$href' > ".($fil)."</a>  ");
		}
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
		$jsPath = __DIR__ . '/../js/slideShow.js';
		$jsVersion = file_exists($jsPath) ? filemtime($jsPath) : time();
		?> <script src="./js/slideShow.js?v=<?= $jsVersion ?>"></script> <?php
		$archivos = self::leerFicherosCarpeta($dir,"aleatorio");
		$extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
		foreach ($archivos as $fil) {
			$url = $dir."/".$fil;
			if (is_file($url)) {
				$extension = strtolower(pathinfo($fil, PATHINFO_EXTENSION));
				if (in_array($extension, $extensiones_permitidas)) {
					echo "<img src='$url' class='foto-erasmus' alt='imagen'>";
				}
			}
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