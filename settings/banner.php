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
 * Admin settings configuration for banner section.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Banner section.
$temp = new admin_settingpage('theme_prime_banner', get_string('lgbannerheading', 'theme_prime'));

// Banner heading.
$name = 'theme_prime_lgbannerheading';
$heading = get_string('lgbannerheading', 'theme_prime');
$information = '';
$setting = new admin_setting_heading($name, $heading, $information);
$temp->add($setting);

// Enable or disable option for banner.
$name = 'theme_prime/lgbannerstatus';
$title = get_string('status', 'theme_prime');
$description = get_string('statusdesc', 'theme_prime');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$temp->add($setting);

// Banner Title.
$name = 'theme_prime/lgbannertitle';
$title = get_string('title', 'theme_prime');
$description = get_string('titledesc', 'theme_prime');
$default = 'lang:about-us';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

// Banner description.
$name = 'theme_prime/lgbannerdesc';
$title = get_string('description', 'theme_prime');
$description = get_string('description_desc', 'theme_prime');
$default = 'lang:learnanytimedesc';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

// Banner content.
$name = 'theme_prime/lgbannercontent';
$title = get_string('lgbannercontent', 'theme_prime');
$description = get_string('content_desc', 'theme_prime');
$default = get_string('lgbannerdescdefault', 'theme_prime');
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$temp->add($setting);

$name = 'theme_prime/lgbannerbg';
$title = get_string('lgbannerbg', 'theme_prime');
$description = '';
$default = '#0d4b60';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

$name = 'theme_prime/lgbannerpadding';
$title = get_string('lgbannerpadding', 'theme_prime');
$description = get_string('lgbannerpaddingdesc', 'theme_prime');
$default = 20;
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_INT, 5);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

$name = 'theme_prime/lgbannermargin';
$title = get_string('lgbannermargin', 'theme_prime');
$description = get_string('lgbannermargin', 'theme_prime');
$default = 20;
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_INT, 5);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

$name = 'theme_prime/lgbannerstyle';
$title = get_string('lgbannerstyle', 'theme_prime');
$description = get_string('lgbannerstyledesc', 'theme_prime');
$default = 'lgbannerstyle1';
$choices = [
    'lgbannerstyle1' => get_string('lgbannerstyle1', 'theme_prime'),
    'lgbannerstyle2' => get_string('lgbannerstyle2', 'theme_prime'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Title color.
$name = 'theme_prime/lgbannercolortitle';
$title = get_string('lgbannercolortitle', 'theme_prime');
$description = get_string('lgbannercolortitledesc', 'theme_prime');
$default = '#79b05e';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Text color.
$name = 'theme_prime/lgbannercolortext';
$title = get_string('lgbannercolortext', 'theme_prime');
$description = get_string('lgbannercolortext_desc', 'theme_prime');
$default = '#ffffff';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Button text.
$name = 'theme_prime/lgbannerbtntext';
$title = get_string('lgbannerbtntext', 'theme_prime');
$description = get_string('lgbannerbtntextdesc', 'theme_prime');
$default = get_string('lgbannerdesc-button', 'theme_prime');
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT, 30);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Button URL.
$name = 'theme_prime/lgbannerbtnurl';
$title = get_string('lgbannerbtnurl', 'theme_prime');
$description = get_string('lgbannerbtnurldesc', 'theme_prime');
$default = '#';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL, 50);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Banner media.
$name = 'theme_prime/lgbannermedia';
$title = get_string('media', 'theme_prime');
$description = get_string('lgbannermedia_desc', 'theme_prime');
$default = '<img src="https://learingo.cl/prime.jpg">';
$setting = new admin_setting_configstoredfile($name, $title, $description, 'lgbannermedia', 0,
    ['accepted_types' => 'web_image']);
$temp->add($setting);

$settings->add($temp);
