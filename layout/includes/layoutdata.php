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
 * Layout data preparation for theme templates.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/behat/lib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once(dirname(__FILE__) . '/themedata.php');

$preset = optional_param('preset', 0, PARAM_TEXT);
if (!empty($preset) && isset($preset)) {
    set_config('preset', $preset, 'theme_prime');
    // Purge the theme cache to show the old icons in the GUI.
    theme_reset_all_caches();
}

// Add block button in editing mode.
$addblockbutton = $OUTPUT->addblockbutton();

if (isloggedin()) {
    $courseindexopen = ( get_user_preferences('drawer-open-index', true) == true );
    $blockdraweropen = ( get_user_preferences('drawer-open-block') == true );
} else {
    $courseindexopen = false;
    $blockdraweropen = false;
}

if (defined('BEHAT_SITE_RUNNING')) {
    $blockdraweropen = true;
}

$extraclasses = ['uses-drawers'];
if ($courseindexopen) {
    $extraclasses[] = 'drawer-open-index';
}

/* ===  ===  ===  ===  ===  ===  ===  ===  =
SIDE PRE BLOCKS
===  ===  ===  ===  ===  ===  ===  ===  = */

$sidepreblocks = $OUTPUT->blocks('side-pre');
$hassidepre = ( strpos($sidepreblocks, 'data-block=') !== false || !empty($addblockbutton) );

if (!$hassidepre) {
    $blockdraweropen = false;
}

/* ===  ===  ===  ===  ===  ===  ===  ===  =
SIDE POST BLOCKS (NEW)
===  ===  ===  ===  ===  ===  ===  ===  = */

$sidepostblocks = $OUTPUT->blocks('side-post');
$hassidepost = ( strpos($sidepostblocks, 'data-block=') !== false );

/* ===  ===  ===  ===  ===  ===  ===  ===  =
COURSE INDEX
===  ===  ===  ===  ===  ===  ===  ===  = */

$courseindex = core_course_drawer();
if (!$courseindex) {
    $courseindexopen = false;
}

$themestyleheader = theme_prime_get_setting('themestyleheader');
$extraclasses[] = ( $themestyleheader ) ? 'moodle-based-header' : 'theme-based-header';

$forceblockdraweropen = $OUTPUT->firstview_fakeblocks();

/* ===  ===  ===  ===  ===  ===  ===  ===  =
SECONDARY NAVIGATION
===  ===  ===  ===  ===  ===  ===  ===  = */

$secondarynavigation = false;
$overflow = '';

if ($PAGE->has_secondary_navigation()) {

    $tablistnav = $PAGE->has_tablist_secondary_navigation();

    $moremenu = new \core\navigation\output\more_menu(
        $PAGE->secondarynav,
        'nav-tabs',
        true,
        $tablistnav
    );

    $secondarynavigation = $moremenu->export_for_template($OUTPUT);

    $overflowdata = $PAGE->secondarynav->get_overflow_menu_data();

    if (!is_null($overflowdata)) {
        $overflow = $overflowdata->export_for_template($OUTPUT);
    }
}

/* ===  ===  ===  ===  ===  ===  ===  ===  =
PRIMARY NAVIGATION
===  ===  ===  ===  ===  ===  ===  ===  = */

$primary = new core\navigation\output\primary($PAGE);
$renderer = $PAGE->get_renderer('core');
$primarymenu = $primary->export_for_template($renderer);

/* ===  ===  ===  ===  ===  ===  ===  ===  =
SETTINGS MENU
===  ===  ===  ===  ===  ===  ===  ===  = */

$buildregionmainsettings =
!$PAGE->include_region_main_settings_in_header_actions()
&& !$PAGE->has_secondary_navigation();

$regionmainsettingsmenu =
$buildregionmainsettings ? $OUTPUT->region_main_settings_menu() : false;

/* ===  ===  ===  ===  ===  ===  ===  ===  =
HEADER
===  ===  ===  ===  ===  ===  ===  ===  = */

$header = $PAGE->activityheader;
$headercontent = $header->export_for_template($renderer);

/* ===  ===  ===  ===  ===  ===  ===  ===  =
TEMPLATE CONTEXT
===  ===  ===  ===  ===  ===  ===  ===  = */

$templatecontext += [

    'sitename' => format_string(
        $SITE->fullname,
        true,
        [
            'context' => context_course::instance(SITEID),
            'escape' => false,
        ]
    ),

    'output' => $OUTPUT,

    /* SIDE PRE */
    'sidepreblocks' => $sidepreblocks,
    'hassidepre' => $hassidepre,

    /* SIDE POST */
    'sidepostblocks' => $sidepostblocks,
    'hassidepost' => $hassidepost,

    /* BLOCKS */
    'hasblocks' => ( $hassidepre || $hassidepost ),
    'courseindexopen' => $courseindexopen,
    'blockdraweropen' => $blockdraweropen,
    'courseindex' => $courseindex,
    'primarymoremenu' => $primarymenu['moremenu'],
    'secondarymoremenu' => $secondarynavigation ?: false,
    'mobileprimarynav' => $primarymenu['mobileprimarynav'],
    'usermenu' => $primarymenu['user'],
    'langmenu' => $primarymenu['lang'],
    'forceblockdraweropen' => $forceblockdraweropen,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'overflow' => $overflow,
    'headercontent' => $headercontent,
    'addblockbutton' => $addblockbutton,
];
