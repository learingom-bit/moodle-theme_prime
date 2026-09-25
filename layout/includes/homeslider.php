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
 * Home page slider data management for the theme.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/theme/prime/classes/helper.php');

/**
 * General config setting for the home page slider.
 *
 * @return array $general general data settings.
 */
function theme_prime_general() {
    $general = [];

    $general['status'] = theme_prime_get_setting('toggleslideshow');

    $interval = intval(theme_prime_get_setting('slideinterval'));
    $height = intval(theme_prime_get_setting('slideheight'));
    $autoslideshow = theme_prime_get_setting('autoslideshow');

    $bgcolor = theme_prime_get_setting('slidebgcolor');
    $general['interval'] = (!empty($interval)) ? $interval : 3000;
    $general['overlay'] = theme_prime_get_setting('slideOverlay');
    $general['slideheight'] = (!empty($height)) ? $height : 500;
    $general['slidebgcolor'] = (!empty($bgcolor)) ? $bgcolor : '#323232';

    if ($autoslideshow == 1) {
        $general['autoplay'] = 'true';
    } else {
        $general['autoplay'] = 'false';
    }

    return $general;
}

/**
 * Home page slider data.
 *
 * @return array $data data for home page slider.
 */
function theme_prime_homeslider() {
    global $PAGE;
    $data = [];
    $data['numofslide'] = theme_prime_get_setting('numberofslides');
    $helperobj = new theme_prime\helper();
    $slider = 0;

    for ($s = 1; $s <= $data['numofslide']; $s++) {
        $slide = [];
        $slide['slidestatus'] = theme_prime_get_setting('slide' . $s . 'status');
        $slide['slideimg'] = $helperobj->render_slideimg($s, 'slide' . $s . 'image');
        $slide['slidecontentstatus'] = theme_prime_get_setting('slide' . $s . 'contentstatus');
        $slide['caption'] = theme_prime_lang(theme_prime_get_setting('slide' . $s . 'caption', 'format_html'));
        $slide['desc'] = theme_prime_lang(theme_prime_get_setting('slide' . $s . 'desc', 'format_html'));
        $slide['btntxt'] = theme_prime_lang(theme_prime_get_setting('slide' . $s . 'btntext'));
        $slide['btnlink'] = theme_prime_get_setting('slide' . $s . 'btnurl');
        $btntarget = theme_prime_lang(theme_prime_get_setting('slide' . $s . 'btntarget'));
        $slide['btntarget'] = ($btntarget == 1) ? '_blank' : '_self';
        $contwidth = theme_prime_get_setting('slide' . $s . 'contFullwidth');

        if ((!empty($slide['slidestatus'])) && (!empty($slide['slideimg']))) {
            $slider = $slider + 1;
        }

        if ((empty($slide['caption'])) && (empty($slide['desc'])) && (empty($slide['btntxt']))) {
            $slide['slidecontentstatus'] = false;
        }

        if ($contwidth == 'auto') {
            $contwidth = 'auto';
        } else {
            $contwidth = intval($contwidth);
            if ($contwidth > '100') {
                $contwidth = '100%';
            } else if ($contwidth <= 0) {
                $contwidth = 'auto';
            } else {
                $contwidth = $contwidth . '%';
            }
        }

        $slide['contentwidth'] = $contwidth;
        $slide['contentAnimation'] = 'ScrollRight';
        $slide['contentAclass'] = 'animated ' . $slide['contentAnimation'];
        $postition = theme_prime_get_setting('slide' . $s . 'contentPosition');
        $slide['contentpostion'] = $postition;
        $slide['contentClass'] = (!empty($postition)) ? 'content-' . $postition : 'content-centerRight';

        if ($slide['slideimg']) {
            $data['slides'][] = $slide;
        }
    }

    $status = theme_prime_get_setting('toggleslideshow');
    $data['sliderblockstatus'] = ($slider == 0) ? false : $status;

    if (!$data['sliderblockstatus']) {
        $data['isblockempty'] = is_siteadmin() || $PAGE->user_is_editing() ? true : false;
    }

    return $data;
}

$sliderconfig = [];
$slidergeneral = theme_prime_general();
$sliderconfig += $slidergeneral;
$sliderconfig += theme_prime_homeslider();

$PAGE->requires->css('/theme/prime/style/animate.css');