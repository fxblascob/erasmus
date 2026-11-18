<?php
$iconosInstitucionales = [
    ['url' => 'https://erasmus-plus.ec.europa.eu/es', 'img' => './img/erasmus/european_comision_logo.svg', 'alt' => 'European Commission'],
    ['url' => 'https://www.erasmusplus.es/', 'img' => './img/erasmus/erasmusplus.jpg', 'alt' => 'Erasmus+'],
    ['url' => 'https://sepie.es/', 'img' => './img/erasmus/sepie.gif', 'alt' => 'SEPIE'],
    ['url' => 'https://etwinning.es/', 'img' => './img/erasmus/etwinnig.png', 'alt' => 'eTwinning'],
    ['url' => 'https://ceice.gva.es/es/web/formacion-profesional/euro-trainee', 'img' => './img/erasmus/BannerEuroTraineePresent.png', 'alt' => 'EuroTrainee'],
    ['url' => 'https://europa.eu/europass/es', 'img' => './img/erasmus/europass.png', 'alt' => 'Europass'],
    ['url' => 'https://www.sepe.es/HomeSepe/Personas/encontrar-trabajo/empleo-europa/Ofertas-empleo-destacadas-informacion-paises.html', 'img' => './img/erasmus/eures_plano_logo.jpg', 'alt' => 'EURES'],
    ['url' => 'https://www.icex.es/es/todos-nuestros-servicios/programas-y-servicios-de-apoyo/icex-vives/que-es', 'img' => './img/erasmus/icex.png', 'alt' => 'ICEX Vives'],
    ['url' => 'https://www.injuve.es/erasmusplus/noticia/guias-y-documentacion-del-programa-erasmus-plus-juventud', 'img' => './img/erasmus/injuve.png', 'alt' => 'Injuve'],
    ['url' => 'https://erasmusintern.org/', 'img' => './img/erasmus/erasmus_intern.png', 'alt' => 'Erasmus Intern'],
    ['url' => 'https://accounts.esn.org/country/es/', 'img' => './img/erasmus/erasmus_student_network.png', 'alt' => 'Erasmus Student Network'],
];
?>
<div id="iconos">
    <ul>
        <?php foreach ($iconosInstitucionales as $item): ?>
            <li>
                <a href="<?= htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8') ?>"
                   title="<?= htmlspecialchars($item['alt'], ENT_QUOTES, 'UTF-8') ?>"
                   target="_blank"
                   rel="noopener noreferrer">
                    <img class="img-fluid"
                         src="<?= htmlspecialchars($item['img'], ENT_QUOTES, 'UTF-8') ?>"
                         alt="<?= htmlspecialchars($item['alt'], ENT_QUOTES, 'UTF-8') ?>"
                         loading="lazy">
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>