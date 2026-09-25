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
 * Theme data preparation and helper functions.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(dirname(__FILE__) . '/footer.php');
require_once($CFG->dirroot . '/theme/prime/lib.php');

$logourl = theme_prime_get_logo_url('header');
$phoneno = theme_prime_get_setting('phoneno');
$emailid = theme_prime_get_setting('emailid');
$themestyleheader = theme_prime_get_setting('themestyleheader');
$navstyle = theme_prime_get_setting('navstyle');
$fonttitle = theme_prime_get_setting('fonttitle');
$fontbody = theme_prime_get_setting('fontbody');
global $DB, $CFG, $USER;
require_once($CFG->dirroot . '/lib/accesslib.php');

$context = context_system::instance();
// System context.
$userprofile = '<a href="' . $CFG->wwwroot . '/user/profile.php" 
        data-toggle="tooltip" data-placement="top" title="' . get_string('profile') . '"><i class="icon fa fa-user
         maincolor fa-fw"></i></a>';

$adminbutton = '';
if (has_capability('moodle/site:configview', $context)) {
    $adminbutton = '<a href="' . $CFG->wwwroot . '/admin/search.php" '
        . 'class="nav-link" data-toggle="tooltip" data-placement="top" '
        . 'title="' . get_string('administrationsite') . '">'
        . '<i class="icon fa fa-cog rotating-icon maincolor fa-fw"></i>'
        . '</a>';
}

switch ($navstyle) {
    case THEME_PRIME_LOGO:
        $showlogo = true;
        $showsitename = false;
        break;
    case THEME_PRIME_SITENAME:
        $showsitename = true;
        $showlogo = false;
        break;
    case THEME_PRIME_LOGOANDSITENAME:
        $showsitename = true;
        $showlogo = true;
        break;
}

$custommenu = $OUTPUT->custom_menu();
if ($custommenu == '') {
    $navbarclass = 'navbar-toggler d-lg-none nocontent-navbar';
} else {
    $navbarclass = 'navbar-toggler d-lg-none';
}

/**
 * Get the course image URL.
 *
 * @param int $courseid The course ID.
 * @return string The image URL.
 */
function theme_prime_imprimir_imagen_curso($courseid) {
    global $CFG;

    $courseimage = '';

    $context = context_course::instance($courseid);
    $fs = get_file_storage();

    // Get the files in the course 'overviewfiles' area.
    $files = $fs->get_area_files($context->id, 'course', 'overviewfiles', 0, 'sortorder DESC, id DESC', false);

    foreach ($files as $file) {
        $isimage = $file->is_valid_image();

        if ($isimage) {
            // Build the image URL.
            $courseimage = file_encode_url("$CFG->wwwroot/pluginfile.php",
                '/' . $file->get_contextid() . '/' . $file->get_component() . '/' .
                $file->get_filearea() . $file->get_filepath() . $file->get_filename(), !$isimage);
            break;
        }
    }

    // Return the image if found, otherwise return a default image.
    if (!empty($courseimage)) {
        return $courseimage;
    } else {
        return $CFG->wwwroot . '/theme/prime/pix/no-image.jpg';
    }
}

/**
 * Get the current user's courses with progress.
 *
 * @return array List of courses.
 */
function theme_prime_get_mycursos() {
    global $DB, $USER, $CFG;

    $data = [];

    $sql = "SELECT
                c.id,
                c.fullname AS course_name,
                c.summary,
                c.category,
                cc.id AS idcat,
                cc.name AS category_name,
                ctx.id AS context_id,

                (
                    SELECT d.value
                    FROM {customfield_data} d
                    JOIN {customfield_field} f ON f.id = d.fieldid
                    WHERE d.instanceid = c.id
                      AND f.shortname = 'coursead'
                    LIMIT 1
                ) AS coursead,

                (SELECT COUNT(cm.id)
                 FROM {course_modules} cm
                 JOIN {modules} m ON cm.module = m.id
                 WHERE cm.course = c.id
                   AND cm.deletioninprogress != 1
                   AND cm.visible = 1
                   AND cm.completion > 0
                ) AS total_modules,

                (SELECT COUNT(DISTINCT cmc.coursemoduleid)
                 FROM {course_modules_completion} cmc
                 JOIN {course_modules} cm ON cm.id = cmc.coursemoduleid
                 WHERE cm.course = c.id
                   AND cm.deletioninprogress != 1
                   AND cmc.userid = u.id
                   AND cmc.completionstate BETWEEN 1 AND 10
                ) AS completed_modules,
                (
                    SELECT COUNT(gg.id)
                    FROM {grade_items} gi
                    JOIN {grade_grades} gg ON gg.itemid = gi.id
                    JOIN {quiz} q ON q.id = gi.iteminstance
                    JOIN {course_modules} cm ON cm.instance = q.id
                    JOIN {modules} m ON m.id = cm.module AND m.name = 'quiz'
                    WHERE gi.courseid = c.id
                      AND gi.itemmodule = 'quiz'
                      AND gg.userid = u.id
                      AND cm.visible = 1
                      AND cm.deletioninprogress = 0
                      AND gg.finalgrade < gi.gradepass
                ) AS pendientes

            FROM {course} c
            JOIN {course_categories} cc ON c.category = cc.id
            JOIN {enrol} e ON e.courseid = c.id
            JOIN {user_enrolments} ue ON ue.enrolid = e.id
            JOIN {user} u ON u.id = ue.userid
            JOIN {context} ctx ON ctx.instanceid = c.id AND ctx.contextlevel = 50
            WHERE u.id = :userid
              AND c.visible = 1
            ORDER BY c.sortorder ASC";

    $result = $DB->get_records_sql($sql, ['userid' => $USER->id]);

    foreach ($result as $r) {

        $completionpercentage = $r->total_modules > 0
            ? ($r->completed_modules * 100 / $r->total_modules)
            : 0;

        $porcentaje = round($completionpercentage, 0);

        if ($porcentaje > 0 && $r->pendientes > 0) {

            $estado = 'pending';
            $estadobtn = '<span class="labels estado2">' .
                get_string('cursopendiente', 'theme_prime') .
                '</span>';

        } else if ($porcentaje < 1) {

            $estado = 'notstarted';
            $estadobtn = '<span class="labels estado1">' .
                get_string('cursonoiniciado', 'theme_prime') .
                '</span>';

        } else if ($porcentaje > 99) {

            $estado = 'completed';
            $estadobtn = '<span class="labels estado3">' .
                get_string('cursofinalizado', 'theme_prime') .
                '</span>';

        } else {

            $estado = 'inprogress';
            $estadobtn = '<span class="labels estado4">' .
                get_string('cursoiniciado', 'theme_prime') .
                '</span>';
        }

        $data[] = [
            'courseurl'             => $CFG->wwwroot . '/course/view.php?id=' . $r->id,
            'course_name'           => $r->course_name,
            'id_cat'                => $r->idcat,
            'category_name'         => $r->category_name,
            'image'                 => theme_prime_imprimir_imagen_curso($r->id),
            'completion_percentage' => $porcentaje,
            'modulos'               => $r->total_modules,
            'estado'                => $estado,
            'estadobtn'             => $estadobtn,
            'coursead'              => $r->coursead,
        ];
    }

    return array_values($data);
}

/**
 * Get a summary of the user's course progress.
 *
 * @return array Summary counts.
 */
function theme_prime_get_resumen_mycursos() {
    global $USER;

    // Reuse the original function without modification.
    $cursos = theme_prime_get_mycursos();

    $noiniciado = 0;
    $iniciado   = 0;
    $pendiente  = 0;
    $finalizado = 0;

    foreach ($cursos as $c) {
        if ($c['estado'] === 'notstarted') {
            $noiniciado++;
        } else if ($c['estado'] === 'inprogress') {
            $iniciado++;
        } else if ($c['estado'] === 'pending') {
            $pendiente++;
        } else if ($c['estado'] === 'completed') {
            $finalizado++;
        }
    }

    return [
        'noiniciado' => $noiniciado,
        'iniciado'   => $iniciado,
        'pendiente'  => $pendiente,
        'finalizado' => $finalizado,
    ];
}

/**
 * Get all visible courses excluding configured ones.
 *
 * @return array List of courses.
 */
function theme_prime_get_allcursos() {
    global $DB, $USER, $CFG;
    $data = [];

    // Get excluded courses from settings.
    $excludedcourses = get_config('theme_prime', 'excludecourse');

    // Get the order from settings.
    $order = get_config('theme_prime', 'courseorder');

    // Convert to array if there are values.
    $excluded = [];
    if (!empty($excludedcourses)) {
        if (is_array($excludedcourses)) {
            $excluded = $excludedcourses;
        } else {
            $excluded = array_map('trim', explode(',', $excludedcourses));
        }
    }

    // Define ORDER BY based on settings.
    switch ($order) {
        case 'iddesc':
            $orderby = 'ORDER BY c.id DESC';
            break;
        case 'nameasc':
            $orderby = 'ORDER BY c.fullname ASC';
            break;
        case 'namedesc':
            $orderby = 'ORDER BY c.fullname DESC';
            break;
        case 'idasc':
        default:
            $orderby = 'ORDER BY c.id ASC';
            break;
    }

    $sql = "SELECT c.id, c.fullname AS course_name, c.summary, c.category, cc.id as id_cat, cc.name AS category_name
FROM {course} c
JOIN {course_categories} cc ON c.category = cc.id
WHERE c.visible = 1
{$orderby}";

    $result = $DB->get_records_sql($sql);
    $cont = 0;

    foreach ($result as $r) {
        // Check if the course is in the excluded list.
        if (in_array($r->id, $excluded)) {
            // Skip this course.
            continue;
        }

        $cont = $cont + 1;
        $data[] = [
            'courseurl'     => $CFG->wwwroot . '/course/view.php?id=' . $r->id,
            'course_name'   => $r->course_name,
            'id_cat'        => $r->id_cat,
            'category_name' => $r->category_name,
            'image'         => theme_prime_imprimir_imagen_curso($r->id),
            'cont'          => $cont,
            'summary'       => strip_tags($r->summary),
        ];
    }

    return array_values($data);
}

$foto = theme_prime_get_setting('promotedmedia', 'file');

if (empty($foto) || $foto === '0' || $foto === 0) {
    $foto = '';
}

$indicadorlg['promotedmedia'] = $foto;

/* Header. */
$cabecerabg = theme_prime_get_setting('cabecerabg');
$cabeceracolortitle = theme_prime_get_setting('cabeceracolortitle');
$cabeceramedia = [];
$cabeceramedia['cabeceramedia'] = theme_prime_get_setting('cabeceramedia', 'file');

if (!empty($cabeceramedia['cabeceramedia']) && strpos($cabeceramedia['cabeceramedia'], '///') !== false) {
    $partes = explode('///', $cabeceramedia['cabeceramedia']);
    $cabeceramedia['cabeceramedia'] = $partes[0];
}

/* Compact logo. */
$logocompact = [];
$logocompact['logocompact'] = theme_prime_get_setting('logocompact', 'file');

if (!empty($logocompact['logocompact']) && strpos($logocompact['logocompact'], '///') !== false) {
    $partes = explode('///', $logocompact['logocompact']);
    $logocompact['logocompact'] = $partes[0];
}

/* White logo. */
$logowhite = [];
$logowhite['logowhite'] = theme_prime_get_setting('logowhite', 'file');

if (!empty($logowhite['logowhite']) && strpos($logowhite['logowhite'], '///') !== false) {
    $partes = explode('///', $logowhite['logowhite']);
    $logowhite['logowhite'] = $partes[0];
}

/* Footer. */
$footerbg = theme_prime_get_setting('footerbg');
$footertitlecolor = theme_prime_get_setting('footertitlecolor');
$footertextcolor = theme_prime_get_setting('footertextcolor');
$footerbgoverlay = theme_prime_get_setting('footerbgOverlay');
$bodytextcolor = theme_prime_get_setting('bodytextcolor');
$menulink = theme_prime_get_setting('menulink');

$usuarioidentificado = $USER->username;

/* Slideshow. */
$slidetitle = theme_prime_get_setting('slidetitle', 'format_html');
$slidedescription = theme_prime_get_setting('slidedescription', 'format_html');

/**
 * Convert the infolink settings string into <li><a> items.
 * Supported format:
 * Text|URL
 * Text|URL|Title
 *
 * @param string $string The settings string.
 * @return string The HTML output.
 */
function theme_prime_render_footer_links($string) {

    $html = '';

    if (empty($string)) {
        return $html;
    }

    // Find all Texto|URL or Texto|URL|Title blocks.
    preg_match_all('/([^|]+)\|(\S+)(?:\|([^|]+))?/', $string, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {

        $text  = trim($match[1]);
        $url   = trim($match[2]);
        $title = isset($match[3]) ? trim($match[3]) : '';

        $html .= '<li class="nav-item">';
        $html .= '<a class="nav-link" href="' . htmlspecialchars($url) . '"';

        if (!empty($title)) {
            $html .= ' title="' . htmlspecialchars($title) . '"';
        }

        $html .= '>';
        $html .= htmlspecialchars($text);
        $html .= '</a>';
        $html .= '</li>';
    }

    return $html;
}

$menulink = theme_prime_get_setting('menulink');
$items = theme_prime_render_footer_links($menulink);

$titulotop = get_config('theme_prime', 'lgbannertitle');

$titulotop = str_replace(
    '{primernombre}',
    explode(' ', trim($USER->firstname))[0],
    $titulotop
);

$templatecontext = [
    'logourl' => $logourl,
    'navbarclass' => $navbarclass,
    'themestyleheader' => $themestyleheader,
    'showsitename' => $showsitename,
    'showlogo' => $showlogo,
    'fonttitle' => $fonttitle,
    'fontbody' => $fontbody,
    'adminbutton'  => $adminbutton,
    'allcursos' => theme_prime_get_allcursos(),
    'mycursos' => theme_prime_get_mycursos(),
    'resumen' => theme_prime_get_resumen_mycursos(),
    'foto' => $foto,
    'globalroot' => $CFG->wwwroot,
    'cabecerabg' => $cabecerabg,
    'cabeceracolortitle' => $cabeceracolortitle,
    'cabeceramedia' => $cabeceramedia['cabeceramedia'],
    'logocompact' => $logocompact['logocompact'],
    'logowhite' => $logowhite['logowhite'],
    'footerbg' => $footerbg,
    'footertitlecolor' => $footertitlecolor,
    'footertextcolor' => $footertextcolor,
    'footerbgoverlay' => $footerbgoverlay,
    'bodytextcolor' => $bodytextcolor,
    'usuarioidentificado' => $usuarioidentificado,
    'menulink' => $items,
    'firstname' => $USER->firstname,
    'lastname' => $USER->lastname,
    'titulotop' => $titulotop,
    'slidetitle' => $slidetitle,
    'slidedescription' => $slidedescription,
    'userprofile' => $userprofile,
];

$templatecontext += theme_prime_footer();
