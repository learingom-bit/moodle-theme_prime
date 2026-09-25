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
 * Admin settings configuration for header section.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Header section.
$temp = new admin_settingpage('theme_prime_cabecera', get_string('cabeceraheading', 'theme_prime'));

// Background color.
$name = 'theme_prime/cabecerabg';
$title = get_string('cabecerabg', 'theme_prime');
$description = get_string('cabecerabgdesc', 'theme_prime');
$default = '#48717e';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Title color.
$name = 'theme_prime/cabeceracolortitle';
$title = get_string('cabeceracolortitle', 'theme_prime');
$description = get_string('cabeceracolortitledesc', 'theme_prime');
$default = '#fff';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Header media (background image).
$name = 'theme_prime/cabeceramedia';
$title = get_string('cabeceramedia', 'theme_prime');
$description = get_string('cabeceramedia_desc', 'theme_prime');
$default = '<img src="https://learingo.cl/prime.jpg">';
$setting = new admin_setting_configstoredfile($name, $title, $description, 'cabeceramedia', 0,
    ['accepted_types' => 'web_image']);
$temp->add($setting);

$settings->add($temp);
