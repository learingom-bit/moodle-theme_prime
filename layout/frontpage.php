<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Frontpage layout.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(dirname(__FILE__) . '/includes/layoutdata.php');
require_once(dirname(__FILE__) . '/includes/homeslider.php');

$bodyattributes = $OUTPUT->body_attributes($extraclasses);

$ordenbruto = theme_prime_get_setting('sectionsorder');

// Inicializar todas en false.
$templatecontext['orden1'] = false;
$templatecontext['orden2'] = false;
$templatecontext['orden3'] = false;
$templatecontext['orden4'] = false;

// Activar la que corresponde.
if ($ordenbruto == 1) {
    $templatecontext['orden1'] = true;
} else if ($ordenbruto == 2) {
    $templatecontext['orden2'] = true;
} else if ($ordenbruto == 3) {
    $templatecontext['orden3'] = true;
} else if ($ordenbruto == 4) {
    $templatecontext['orden4'] = true;
} else {
    $templatecontext['orden1'] = true;
}

$sectionsorder['sectionsorder'] = theme_prime_lang(theme_prime_get_setting('sectionsorder'));

// Destacado.
$destacadostatus = theme_prime_get_setting('destacadostatus');
$destacado = [];

if ($destacadostatus == 1) {
    $destacado['destacado'] = true;
    $destacado['destacadotitle'] = theme_prime_lang(theme_prime_get_setting('destacadotitle'));
    $destacado['destacadocolortitle'] = theme_prime_lang(theme_prime_get_setting('destacadocolortitle'));
    $destacado['destacadocolorbg'] = theme_prime_lang(theme_prime_get_setting('destacadocolorbg'));
    $destacado['destacadodesc'] = theme_prime_lang(theme_prime_get_setting('destacadodesc', 'format_html'));
    $destacado['btntext'] = theme_prime_lang(theme_prime_get_setting('destacadobtntext'));
    $destacado['buttonlink'] = theme_prime_get_setting('destacadobtnlink');
    $btntarget = theme_prime_get_setting('destacadobtntarget');
    $destacado['btntarget'] = ($btntarget == '1') ? '_blank' : '_self';
    $destacado['destacadocontent'] = !empty($destacado['destacadotitle']) || !empty($destacado['destacadodesc']);
    $destacado['blockisempty'] = !empty($destacado['destacadotitle']) ||
        !empty($destacado['destacadodesc']) ||
        !empty($destacado['btntext']);
    $destacado['btnclass'] = empty($destacado['btntext']) ? 'destacado-text-block' : '';
    $destacado['destacadomedia'] = theme_prime_get_setting('destacadomedia', 'file');
    $destacado['destacadomargin_top'] = (int) theme_prime_get_setting('destacadomargin_top');
    $destacado['destacadomargin_bottom'] = (int) theme_prime_get_setting('destacadomargin_bottom');

    // Limpiar URL duplicada.
    if (!empty($destacado['destacadomedia']) && strpos($destacado['destacadomedia'], '///') !== false) {
        $partes = explode('///', $destacado['destacadomedia']);
        $destacado['destacadomedia'] = $partes[0];
    }
}

// Site features.
$sfstatus = theme_prime_get_setting('lgbloquestatus');
$indicadorlg = [];

if ($sfstatus == 1) {
    $indicadorlg['indicadorlg'] = true;
    $indicadorlg['blocktitle'] = theme_prime_lang(theme_prime_get_setting('sitefeaturetitle', 'format_html'));
    $indicadorlg['blockdesc'] = theme_prime_lang(theme_prime_get_setting('sitefeaturedesc', 'format_html'));
    $indicadorlg['sitefeaturebgcolor'] = theme_prime_lang(theme_prime_get_setting('sitefeaturebgcolor'));

    // Site features media.
    $indicadorlg['sitedmedia'] = theme_prime_get_setting('sitedmedia', 'file');

    // Limpiar URL duplicada.
    if (!empty($indicadorlg['sitedmedia']) && strpos($indicadorlg['sitedmedia'], '///') !== false) {
        $partes = explode('///', $indicadorlg['sitedmedia']);
        $indicadorlg['sitedmedia'] = $partes[0];
    }

    $indicadorlg['blockstatus'] = true;
    $indicadorlg['blockisempty'] = !empty($indicadorlg['blocktitle']) || !empty($indicadorlg['blockdesc']);
    $indicadorlg['class'] = 'site-features-block';

    $features = theme_prime_get_setting('numberofsitefeature');
    $items = [];

    for ($i = 1; $i <= $features; $i++) {
        $status = theme_prime_get_setting('lgbloque' . $i . 'status');
        $title = theme_prime_lang(theme_prime_get_setting('lgbloque' . $i . 'title'));
        $content = theme_prime_lang(theme_prime_get_setting('lgbloque' . $i . 'content', 'format_html'));
        $icon = theme_prime_lang(theme_prime_get_setting('lgbloque' . $i . 'icon', 'format_html'));
        $url = theme_prime_get_setting('lgbloque' . $i . 'url');

        if (!empty($status)) {
            $items[] = [
                'status' => true,
                'sfbbody' => true,
                'title' => $title,
                'content' => $content,
                'icon' => $icon,
                'url' => $url,
                'colclass' => 'col-lg-4',
            ];
        }
    }

    $indicadorlg['feature'] = $items;
}

// Banner.
$lgbannerstatus = theme_prime_get_setting('lgbannerstatus');
$lgbanner = [];

if ($lgbannerstatus == 1) {
    $lgbanner['lgbanner'] = true;

    $lgbanner['lgbannertitle'] = theme_prime_lang(theme_prime_get_setting('lgbannertitle', 'format_html'));
    $lgbanner['lgbannerdesc'] = theme_prime_lang(theme_prime_get_setting('lgbannerdesc', 'format_html'));
    $lgbanner['lgbannercontent'] = theme_prime_get_setting('lgbannercontent', 'format_html');
    $lgbanner['media'] = theme_prime_get_setting('lgbannermedia', 'file');
    $lgbanner['promotedmedia'] = theme_prime_get_setting('promotedmedia', 'file');
    $lgbanner['colclass'] = 'col-lg-6';
    $lgbanner['blockisempty'] = !empty($lgbanner['lgbannertitle']) ||
        !empty($lgbanner['lgbannerdesc']) ||
        !empty($lgbanner['content']);

    $lgbanner['lgbannerbg'] = theme_prime_get_setting('lgbannerbg');
    $lgbanner['lgbannerpadding'] = theme_prime_get_setting('lgbannerpadding');
    $lgbanner['lgbannermargin'] = theme_prime_get_setting('lgbannermargin');
    $lgbanner['lgbannerstyle'] = theme_prime_get_setting('lgbannerstyle');

    $lgbanner['lgbannerbtntext'] = theme_prime_lang(theme_prime_get_setting('lgbannerbtntext'));
    $lgbanner['lgbannerbtnurl'] = theme_prime_get_setting('lgbannerbtnurl');
    $lgbanner['lgbannercolortitle'] = theme_prime_get_setting('lgbannercolortitle');
    $lgbanner['lgbannercolortext'] = theme_prime_get_setting('lgbannercolortext');

    $lgbanner['hasspotbutton'] = !empty($lgbanner['lgbannerbtntext']) && !empty($lgbanner['lgbannerbtnurl']);
    $lgbanner['hasbackground'] = !empty($lgbanner['lgbannerbg']);
    $lgbanner['hasmedia'] = !empty($lgbanner['media']);
}

$mromotedtitle = theme_prime_get_setting('mromotedtitle');
$templatecontext['mromotedtitle'] = $mromotedtitle;

$mcoursestatus = theme_prime_get_setting('mcoursestatus');
$templatecontext['mcoursestatus'] = $mcoursestatus;

$pcoursestatus = theme_prime_get_setting('pcoursestatus');
$templatecontext['pcoursestatus'] = $pcoursestatus;

if ($lgbannerstatus == 1) {
    $lgbanner['promotedtitle'] = theme_prime_lang(theme_prime_get_setting('promotedtitle', 'format_html'));
    $lgbanner['promotedcoursedesc'] = theme_prime_lang(theme_prime_get_setting('promotedcoursedesc', 'format_html'));
    $lgbanner['titlemycourses'] = theme_prime_lang(theme_prime_get_setting('titlemycourses'));
    $lgbanner['mycoursescoursedesc'] = theme_prime_lang(theme_prime_get_setting('mycoursescoursedesc', 'format_html'));
}

// Contexto final.
$destacadoclass = (!empty($destacadostatus)) ? 'destacado-element' : '';
$templatecontext += $sliderconfig;
$templatecontext += [
    'bodyattributes' => $bodyattributes,
    'destacadoclass' => $destacadoclass,
];
$templatecontext += $destacado;
$templatecontext += $indicadorlg;
$templatecontext += $lgbanner;

// Render.
echo $OUTPUT->render_from_template('theme_prime/frontpage', $templatecontext);
