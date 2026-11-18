<?php include_once("./include/Util.php"); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>IES San Vicente Erasmus+</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="La página web del proyecto Erasmus+ del IES San Vicente"/>
        <meta name="keywords" content="Erasmus, Erasmus+, Erasmus plus, Erasmus plus IES San Vicente, Erasmus+ IES San Vicente">

        <!-- Bootstrap 5.3.2 CSS (desde jsDelivr CDN) -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous">        
            
        <link rel="stylesheet" type="text/css" href="./css/estilos.css?v=<?= filemtime(__DIR__ . '/../css/estilos.css') ?>">

        <!-- Bootstrap Bundle (incluye Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous" defer></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const nav   = document.getElementById('navbarNavDropdown');
                const btn   = document.getElementById('btnToggle');
                const inst  = bootstrap.Collapse.getOrCreateInstance(nav, { toggle: false });

                // Toggle controlado por JS (evita conflictos en Chrome)
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    inst.toggle();
                    // sincroniza aria-expanded para accesibilidad
                    const expanded = btn.getAttribute('aria-expanded') === 'true';
                    btn.setAttribute('aria-expanded', String(!expanded));
                });

                // (Opcional) auto-cerrar al hacer clic en un enlace (móvil)
                nav.addEventListener('click', (e) => {
                    if (e.target.matches('.nav-link, .dropdown-item')) {
                    inst.hide();
                    btn.setAttribute('aria-expanded', 'false');
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="page">
            <header class="cabecera-erasmus">
                <div id="izq">
                    <img src="./img/erasmus/cabecera.png" alt="Logo Erasmus+">
                </div>
                <div id="cen">
                    <h1 id="titulo">IES San Vicente - Erasmus+</h1>
                </div>
                <div id="der">
                    <img src="./img/ies/logo_ies_transparente.png" alt="Logo IES San Vicente">
                </div>
            </header>
            <div class="menu-row">
                <?php include_once("./include/menu.php"); ?>
            </div>
            <main>
                <div id="erasmus-layout">
                    <aside id="col-left">
                        <?php include_once("./include/menuiconos.php"); ?>
                    </aside>