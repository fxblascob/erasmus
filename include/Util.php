<?php

declare(strict_types=1);

/**
 * Clase de utilidades para la gestión de archivos, navegación y galerías.
 */
class Util
{
    /**
     * Crea un menú con una estructura de carpetas completa.
     *
     * @param string $dir   Directorio a explorar.
     * @param int    $nivel Nivel de profundidad.
     */
    public static function crea_enlaces_dir(string $dir, int $nivel = 1): void
    {
        if (!is_dir($dir)) {
            return;
        }

        $archivos = self::leerFicherosCarpeta($dir);
        if (empty($archivos)) {
            return;
        }

        echo '<div class="sidebarmenu"><br><ul id="sidebarmenu1">' . PHP_EOL;
        foreach ($archivos as $fil) {
            $url = $dir . '/' . $fil;
            if ($fil !== 'imagenes_fondo_web' && $fil !== 'novedades_fondo_web') {
                self::crea_enlace_lista($url, $fil);
                if (is_dir($url) && $nivel >= 2) {
                    self::crea_enlaces_subdir($url, $nivel + 1);
                }
            }
        }
        echo '</ul><br></div>' . PHP_EOL;
    }

    /**
     * Crea los subniveles recursivos de un menú de carpetas.
     *
     * @param string $url   Ruta del subdirectorio.
     * @param int    $nivel Nivel de profundidad actual.
     */
    public static function crea_enlaces_subdir(string $url, int $nivel): void
    {
        $archivos = self::leerFicherosCarpeta($url);
        if (empty($archivos)) {
            return;
        }

        echo "<ul class='sidebarmenu2'>" . PHP_EOL;
        foreach ($archivos as $fil) {
            $url2 = $url . '/' . $fil;
            self::crea_enlace_lista($url2, $fil);
            if (is_dir($url2) && $nivel >= 2) {
                self::crea_enlaces_subdir($url2, $nivel + 1);
            }
        }
        echo '</ul>' . PHP_EOL;
    }

    /**
     * Genera un elemento <li> de enlace individual para un archivo o carpeta.
     *
     * @param string $url Ruta completa del recurso.
     * @param string $fil Nombre del archivo o carpeta.
     */
    public static function crea_enlace_lista(string $url, string $fil): void
    {
        $extension = strtolower(pathinfo($fil, PATHINFO_EXTENSION));
        $texto = (strpos($fil, '_') === 2) ? substr($fil, 3) : $fil;
        $textoEscapado = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');

        if ($extension === 'txt' && is_file($url) && is_readable($url)) {
            $contenido = trim((string) file_get_contents($url));
            $href = $contenido !== '' ? $contenido : '#';
        } else {
            $href = is_dir($url) ? '#' : $url;
        }

        $hrefEscapado = htmlspecialchars($href, ENT_QUOTES, 'UTF-8');
        echo "<li><a href='{$hrefEscapado}'>{$textoEscapado}</a></li>" . PHP_EOL;
    }

    /**
     * Crea un menú horizontal automatizado a partir del contenido de un directorio.
     *
     * @param string $url Directorio base.
     */
    public static function crea_enlaces_menu(string $url): void
    {
        $archivos = self::leerFicherosCarpeta($url);
        if (empty($archivos)) {
            return;
        }

        echo '<div class="sidebarmenu"><br><ul id="sidebarmenu1">' . PHP_EOL;
        foreach ($archivos as $fil) {
            $extension = strtolower(pathinfo($fil, PATHINFO_EXTENSION));
            $url2 = $url . '/' . $fil;

            if ($fil !== 'novedades_fondo_web' && $fil !== 'imagenes_fondo_web') {
                $filVer = ($extension === 'php') ? substr($fil, 0, -4) : $fil;
                $filVer = (strpos($filVer, '_') === 2) ? substr($filVer, 3) : $filVer;

                $filVerEscapado = htmlspecialchars($filVer, ENT_QUOTES, 'UTF-8');
                $href = is_dir($url2) ? htmlspecialchars($fil, ENT_QUOTES, 'UTF-8') : htmlspecialchars($url2, ENT_QUOTES, 'UTF-8');

                echo "<li><a href='{$href}'>{$filVerEscapado}</a></li>" . PHP_EOL;
            }
        }
        echo '</ul><br></div>' . PHP_EOL;
    }

    /**
     * Carga recursivamente las novedades o documentos de un directorio en forma de lista HTML.
     *
     * @param string $dir   Directorio a consultar.
     * @param string $orden Tipo de ordenación ('asc', 'desc', 'aleatorio').
     * @return string Marcado HTML generado.
     */
    public static function carga_novedades(string $dir, string $orden = 'asc'): string
    {
        if (!is_dir($dir)) {
            return '';
        }

        $archivos = self::leerFicherosCarpeta($dir, $orden);
        if (empty($archivos)) {
            return '';
        }

        $cadena = "<ul class='novedades'>";
        foreach ($archivos as $fil) {
            $url = $dir . '/' . $fil;
            $esDirectorio = is_dir($url);
            $extension = $esDirectorio ? '' : strtolower(pathinfo($fil, PATHINFO_EXTENSION));

            if (!$esDirectorio) {
                $fil = basename($fil, '.' . pathinfo($fil, PATHINFO_EXTENSION));
            }

            // Quitar prefijo numérico de orden si lo lleva (ej: 01_...)
            if (strpos($fil, '_') === 2) {
                $fil = substr($fil, 3);
            }

            // Bandera si el nombre incluye prefijo de bandera (ej: ue.png_...)
            $imagenHtml = '';
            $posGuion = strpos($fil, '_');
            if ($posGuion !== false && $posGuion > 0) {
                $nombreBandera = substr($fil, 0, $posGuion);
                $rutaBandera = './img/banderas/' . $nombreBandera;
                $altBandera = pathinfo($nombreBandera, PATHINFO_FILENAME);
                $imagenHtml = '<img class="banderas img-fluid" src="' . htmlspecialchars($rutaBandera, ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($altBandera, ENT_QUOTES, 'UTF-8') . '"> ';
                $fil = substr($fil, $posGuion + 1);
            }

            // Resolver URL de destino
            if ($esDirectorio) {
                $href = '#';
            } elseif ($extension === 'txt' && is_file($url) && is_readable($url)) {
                $contenido = trim((string) file_get_contents($url));
                $href = $contenido !== '' ? $contenido : '#';
            } else {
                $href = $url;
            }

            $textoEnlace = htmlspecialchars($fil, ENT_QUOTES, 'UTF-8');
            $hrefEscapado = htmlspecialchars($href, ENT_QUOTES, 'UTF-8');

            $cadena .= "<li><a href='{$hrefEscapado}'>{$imagenHtml}{$textoEnlace}</a>";

            if ($esDirectorio) {
                $cadena .= self::carga_novedades($url, $orden);
            }

            $cadena .= "</li>";
        }
        $cadena .= '</ul>';

        return $cadena;
    }

    /**
     * Carga todas las imágenes de un directorio y genera las etiquetas para el slideshow.
     *
     * @param string $dir Directorio de imágenes.
     */
    public static function carga_todas_imagenes(string $dir): void
    {
        $jsPath = __DIR__ . '/../js/slideShow.js';
        $jsVersion = file_exists($jsPath) ? (string) filemtime($jsPath) : (string) time();
        echo '<script src="./js/slideShow.js?v=' . htmlspecialchars($jsVersion, ENT_QUOTES, 'UTF-8') . '"></script>' . PHP_EOL;

        $archivos = self::leerFicherosCarpeta($dir, 'aleatorio');
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        foreach ($archivos as $fil) {
            $url = $dir . '/' . $fil;
            if (is_file($url)) {
                $extension = strtolower(pathinfo($fil, PATHINFO_EXTENSION));
                if (in_array($extension, $extensionesPermitidas, true)) {
                    $urlEscapada = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
                    $nombreLimpio = pathinfo($fil, PATHINFO_FILENAME);
                    $altTexto = htmlspecialchars('Actividad Erasmus+ - ' . $nombreLimpio, ENT_QUOTES, 'UTF-8');
                    echo "<img src='{$urlEscapada}' class='foto-erasmus' alt='{$altTexto}'>" . PHP_EOL;
                }
            }
        }
    }

    /**
     * Devuelve una lista filtrada y ordenada de los archivos de una carpeta.
     *
     * @param string $dir   Directorio a leer.
     * @param string $orden Tipo de ordenación ('asc', 'desc', 'aleatorio').
     * @return array<int, string> Lista de nombres de archivos.
     */
    public static function leerFicherosCarpeta(string $dir, string $orden = 'asc'): array
    {
        if (!is_dir($dir) || !is_readable($dir)) {
            return [];
        }

        $elementos = scandir($dir);
        if ($elementos === false) {
            return [];
        }

        $archivos = array_filter($elementos, static function (string $fil): bool {
            return $fil !== '.' && $fil !== '..' && $fil[0] !== '_' && $fil[0] !== '.';
        });

        $archivos = array_values($archivos);

        switch ($orden) {
            case 'aleatorio':
                shuffle($archivos);
                break;
            case 'desc':
                rsort($archivos, SORT_NATURAL | SORT_FLAG_CASE);
                break;
            case 'asc':
            default:
                sort($archivos, SORT_NATURAL | SORT_FLAG_CASE);
                break;
        }

        return $archivos;
    }
}
