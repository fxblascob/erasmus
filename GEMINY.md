# Manual de Arquitectura y Reglas del Proyecto (`erasmus`)

Este archivo define las reglas obligatorias que cualquier agente de IA debe respetar al analizar, crear o modificar código en este repositorio.

## 1. Stack Tecnológico y Entorno
- **Backend:**  PHP 5.6 (evitar declare(strict_types=1), tipos escalares en parámetros, tipos de retorno y operador ?? )

- **Frontend:** HTML5 semántico, CSS3 y JavaScript Vanilla (ES6+).
- **Entorno de ejecución:** Linux (WSL 2 Ubuntu). Para comprobaciones de sintaxis y scripts de validación, usar siempre el binario `php` del sistema (`php -l <archivo>`).
- **Control de versiones:** Git con finales de línea en formato Unix (`LF`).

## 2. Estructura de Carpetas del Proyecto
- `/` (Raíz): Páginas públicas principales (`index.php`, `inicio.php`, `educacion_escolar.php`, `educacion_superior.php`, `formacion_profesional.php`, `blog_erasmus+.php`).
- `/include/`: Fragmentos PHP reutilizables y lógica auxiliar (`cabecera.php`, `pie.php`, `menu.php`, `menuiconos.php`, `Util.php`). **Nunca** deben ser accesibles como páginas independientes completas.
- `/css/`: Hojas de estilo. No crear archivos de estilo duplicados o versiones antiguas (`_v1`, `_old`).
- `/js/`: Scripts del lado del cliente.
- `/img/`: Recursos gráficos y cartelería organizados por subcarpetas temáticas (`carteles/`, banderas, iconos).
- `/documentos/`: Documentación descargable organizada por secciones (`01_inicio/`, etc.).

## 3. Convenciones de Código y Estilo
- **PHP (PSR-12):**
  - Usar etiquetas de apertura `<?php` (nunca etiquetas cortas `<?`).
  - Indentación de 4 espacios (sin tabuladores).
  - Separar la lógica de procesamiento de datos (en la parte superior del archivo o en `include/Util.php`) de la presentación HTML.
  - Usar `require_once` para dependencias críticas y `include_once` para bloques visuales repetitivos.
-- **HTML y Frontend (Bootstrap 5):**
  - **Framework y CDN/Local:** El proyecto utiliza **Bootstrap 5.x** (cargar hojas de estilo y `bootstrap.bundle.min.js` exclusivamente a través de `include/cabecera.php` e `include/pie.php`; nunca duplicar etiquetas `<link>` o `<script>` de Bootstrap en páginas individuales).
  - **Sistema de rejilla (Grid):** Estructurar siempre los bloques principales mediante `.container` o `.container-fluid`, `.row` y columnas responsivas (`.col-12`, `.col-md-6`, `.col-lg-4`, etc.). Prohibido usar floats o tablas HTML para maquetar.
  - **Prioridad de clases utilitarias:** Utilizar siempre las clases de utilidad nativas de Bootstrap 5 para márgenes y rellenos (`m-*`, `p-*`, `g-*`), flexbox (`d-flex`, `justify-content-*`, `align-items-*`), tipografía (`fw-bold`, `text-muted`, `fs-*`) y colores antes de escribir reglas nuevas en `/css/`.
  - **Sintaxis exclusiva de Bootstrap 5:** Usar prefijos `ms-*` / `me-*` y `ps-*` / `pe-*` (nunca `ml-*`, `mr-*`, `pl-*`, `pr-*` de Bootstrap 4), y atributos `data-bs-toggle` / `data-bs-target` para modales, desplegables y colapsables.
  - **Componentes y accesibilidad:** Usar componentes estándar (`card`, `accordion`, `navbar`, `alert`, `badge`, `table-responsive`). Toda etiqueta `<img>` debe llevar atributo `alt` descriptivo y clase `img-fluid` cuando deba adaptarse al contenedor.
  - **Consistencia de plantilla:** Reutilizar siempre `include/cabecera.php`, `include/menu.php` y `include/pie.php` en cualquier página nueva, y verificar que las rutas a `img/`, `css/`, `js/` o `documentos/` existan antes de enlazarlas.

## 4. Seguridad (Obligatorio)
- **Prevención XSS:** Escapar siempre cualquier variable o salida dinámica en HTML utilizando `htmlspecialchars($var, ENT_QUOTES, 'UTF-8')`.
- **Rutas dinámicas:** Nunca incluir archivos dinámicamente basándose directamente en parámetros `$_GET` o `$_POST` sin validarlos previamente contra una lista blanca cerrada.

## 5. Flujo de Trabajo y Verificación para Agentes
1. **Antes de editar:** Leer el archivo completo y verificar sus dependencias en `include/`.
2. **Al crear o modificar archivos PHP:** Ejecutar obligatoriamente `php -l <ruta_archivo>` para garantizar que no existen errores de sintaxis.
3. **Al modificar enlaces o imágenes:** Comprobar que las rutas apuntan a archivos existentes dentro de `img/`, `css/`, `js/` o `documentos/`.
4. **Restricciones:** No borrar archivos multimedia (`.mp4`, `.pdf`, imágenes) ni hojas de estilo sin confirmar primero que no están referenciados en ningún `.php` del proyecto.