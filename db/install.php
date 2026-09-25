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
 * Define install function.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Theme_prime install function.
 *
 * @return void
 */
function xmldb_theme_prime_install() {
    global $CFG;

    if (method_exists('core_plugin_manager', 'reset_caches')) {
        core_plugin_manager::reset_caches();
    }

    $fs = get_file_storage();

        // Slider images.
        $fs = get_file_storage();
        $adminid = get_admin()->id;
        $contextid = context_system::instance()->id;

    for ($i = 1; $i <= 3; $i++) {
            $filerecord = new stdClass();
            $filerecord->component = 'theme_prime';
            $filerecord->contextid = $contextid;
            $filerecord->userid = $adminid;
            $filerecord->filearea = 'slide' . $i . 'image';
            $filerecord->filepath = '/';
            $filerecord->itemid = 0;
            $filerecord->filename = 'slide' . $i . 'image.jpg';
            $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/prime/pix/home/slide' . $i . '.jpg');
    }

        // Logo image.
        $fs = get_file_storage();
        $filerecord = new stdClass();
        $filerecord->component = 'theme_prime';
        $filerecord->contextid = context_system::instance()->id;
        $filerecord->userid = get_admin()->id;
        $filerecord->filearea = 'logo';
        $filerecord->filepath = '/';
        $filerecord->itemid = 0;
        $filerecord->filename = 'logo.svg';
        $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/prime/pix/home/logo.svg');

        // Footer logo image.
        $fs = get_file_storage();
        $filerecord = new stdClass();
        $filerecord->component = 'theme_prime';
        $filerecord->contextid = context_system::instance()->id;
        $filerecord->userid = get_admin()->id;
        $filerecord->filearea = 'footerlogo';
        $filerecord->filepath = '/';
        $filerecord->itemid = 0;
        $filerecord->filename = 'footerlogo.svg';
        $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/prime/pix/home/footerlogo.svg');

         // Logo compact.
        $fs = get_file_storage();
        $filerecord = new stdClass();
        $filerecord->component = 'theme_prime';
        $filerecord->contextid = context_system::instance()->id;
        $filerecord->userid = get_admin()->id;
        $filerecord->filearea = 'logocompact';
        $filerecord->filepath = '/';
        $filerecord->itemid = 0;
        $filerecord->filename = 'logocompact.svg';
        $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/prime/pix/home/logocompact.svg');

         // Logo Blanco.
        $fs = get_file_storage();
        $filerecord = new stdClass();
        $filerecord->component = 'theme_prime';
        $filerecord->contextid = context_system::instance()->id;
        $filerecord->userid = get_admin()->id;
        $filerecord->filearea = 'logowhite';
        $filerecord->filepath = '/';
        $filerecord->itemid = 0;
        $filerecord->filename = 'logowhite.svg';
        $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/prime/pix/home/logowhite.svg');

        // Banner image.
        $fs = get_file_storage();
        $filerecord = new stdClass();
        $filerecord->component = 'theme_prime';
        $filerecord->contextid = context_system::instance()->id;
        $filerecord->userid = get_admin()->id;
        $filerecord->filearea = 'lgbannermedia';
        $filerecord->filepath = '/';
        $filerecord->itemid = 0;
        $filerecord->filename = 'lgbannermedia.png';
        $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/prime/pix/home/lgbannermedia.png');

        // Fullheader image.
        $fs = get_file_storage();
        $filerecord = new stdClass();
        $filerecord->component = 'theme_prime';
        $filerecord->contextid = context_system::instance()->id;
        $filerecord->userid = get_admin()->id;
        $filerecord->filearea = 'promotedmedia';
        $filerecord->filepath = '/';
        $filerecord->itemid = 0;
        $filerecord->filename = 'promotedmedia.png';
        $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/prime/pix/home/promotedmedia.png');

        // Courses image.
        $fs = get_file_storage();
        $filerecord = new stdClass();
        $filerecord->component = 'theme_prime';
        $filerecord->contextid = context_system::instance()->id;
        $filerecord->userid = get_admin()->id;
        $filerecord->filearea = 'cabeceramedia';
        $filerecord->filepath = '/';
        $filerecord->itemid = 0;
        $filerecord->filename = 'cabeceramedia.png';
        $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/prime/pix/home/cabeceramedia.png');

        // Sitedmedia image.
        $fs = get_file_storage();
        $filerecord = new stdClass();
        $filerecord->component = 'theme_prime';
        $filerecord->contextid = context_system::instance()->id;
        $filerecord->userid = get_admin()->id;
        $filerecord->filearea = 'sitedmedia';
        $filerecord->filepath = '/';
        $filerecord->itemid = 0;
        $filerecord->filename = 'sitedmedia.png';
        $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/prime/pix/home/sitedmedia.png');

        // Destacado image.
        $fs = get_file_storage();
        $filerecord = new stdClass();
        $filerecord->component = 'theme_prime';
        $filerecord->contextid = context_system::instance()->id;
        $filerecord->userid = get_admin()->id;
        $filerecord->filearea = 'destacadomedia';
        $filerecord->filepath = '/';
        $filerecord->itemid = 0;
        $filerecord->filename = 'destacadomedia.png';
        $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/prime/pix/home/destacadomedia.png');

        // Login image.
        $fs = get_file_storage();
        $filerecord = new stdClass();
        $filerecord->component = 'theme_prime';
        $filerecord->contextid = context_system::instance()->id;
        $filerecord->userid = get_admin()->id;
        $filerecord->filearea = 'loginbg';
        $filerecord->filepath = '/';
        $filerecord->itemid = 0;
        $filerecord->filename = 'loginbg.jpg';
        $fs->create_file_from_pathname($filerecord, $CFG->dirroot . '/theme/prime/pix/home/loginbg.jpg');

}
