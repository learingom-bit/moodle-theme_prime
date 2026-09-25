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
 * Admin settings configuration for featured section.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Featured section.
$temp = new admin_settingpage('theme_prime_destacado', get_string('destacadoheading', 'theme_prime'));

// Featured heading.
$name = 'theme_prime_destacadoheading';
$heading = get_string('destacadoheading', 'theme_prime');
$information = '';
$setting = new admin_setting_heading($name, $heading, $information);
$temp->add($setting);

// Featured enable or disable option.
$name = 'theme_prime/destacadostatus';
$title = get_string('status', 'theme_prime');
$description = get_string('statusdesc', 'theme_prime');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$temp->add($setting);

// Featured title.
$name = 'theme_prime/destacadotitle';
$title = get_string('title', 'theme_prime');
$description = get_string('titledesc', 'theme_prime');
$default = 'lang:learnanytime';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

// Featured description.
$name = 'theme_prime/destacadodesc';
$title = get_string('description', 'theme_prime');
$description = get_string('description_desc', 'theme_prime');
$default = get_string('learnanytimedescj', 'theme_prime');
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$temp->add($setting);

// Featured button text.
$name = 'theme_prime/destacadobtntext';
$title = get_string('buttontxt', 'theme_prime');
$description = get_string('destacadobtntext_desc', 'theme_prime');
$default = 'lang:viewallcourses';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
$temp->add($setting);

// Featured button link.
$name = 'theme_prime/destacadobtnlink';
$title = get_string('buttonlink', 'theme_prime');
$description = get_string('destacadobtnlink_desc', 'theme_prime');
$default = 'https://learingo.cl/';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
$temp->add($setting);

// Title color.
$name = 'theme_prime/destacadocolortitle';
$title = get_string('destacadocolortitle', 'theme_prime');
$description = get_string('destacadocolortitle_desc', 'theme_prime');
$default = '#757f95';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Background color.
$name = 'theme_prime/destacadocolorbg';
$title = get_string('destacadocolorbg', 'theme_prime');
$description = get_string('destacadocolorbg_desc', 'theme_prime');
$default = '#ffffff';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Featured media.
$name = 'theme_prime/destacadomedia';
$title = get_string('media', 'theme_prime');
$description = get_string('destacadomedia_desc', 'theme_prime');
$default = '<img src="https://learingo.cl/prime.jpg">';
$setting = new admin_setting_configstoredfile($name, $title, $description, 'destacadomedia', 0,
    ['accepted_types' => 'web_image']);
$temp->add($setting);

// Featured margin top.
$name = 'theme_prime/destacadomargin_top';
$title = get_string('destacadomargin_top', 'theme_prime');
$description = get_string('destacadomargin_topdesc', 'theme_prime');
$default = 0;
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_INT);
$temp->add($setting);

// Featured margin bottom.
$name = 'theme_prime/destacadomargin_bottom';
$title = get_string('destacadomargin_bottom', 'theme_prime');
$description = get_string('destacadomargin_bottomdesc', 'theme_prime');
$default = 50;
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_INT);
$temp->add($setting);

// Featured button target.
$name = 'theme_prime/destacadobtntarget';
$title = get_string('buttontarget', 'theme_prime');
$description = get_string('destacadobtntarget_desc', 'theme_prime');
$default = THEME_PRIME_NEWWINDOW;
$choices = [
    THEME_PRIME_SAMEWINDOW => get_string('sameWindow', 'theme_prime'),
    THEME_PRIME_NEWWINDOW => get_string('newWindow', 'theme_prime'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$temp->add($setting);

$settings->add($temp);
