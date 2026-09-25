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
 * Admin settings configuration for general section.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// General section.
$temp = new admin_settingpage('theme_prime_header', get_string('headerheading', 'theme_prime'));

// Nav style select option.
$name = 'theme_prime/navstyle';
$title = get_string('navstyle', 'theme_prime');
$description = get_string('navstyle_desc', 'theme_prime');
$default = THEME_PRIME_LOGO;
$choices = [
    THEME_PRIME_LOGO => get_string('logo', 'theme_prime'),
    THEME_PRIME_SITENAME => get_string('sitename', 'theme_prime'),
    THEME_PRIME_LOGOANDSITENAME => get_string('logoandsitename', 'theme_prime'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$temp->add($setting);

// Logo file upload option.
$name = 'theme_prime/logo';
$title = get_string('logo', 'theme_prime');
$description = get_string('logodesc', 'theme_prime');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Favicon upload option.
$name = 'theme_prime/favicon';
$title = get_string('favicon', 'theme_prime', null, true);
$description = get_string('favicon_desc', 'theme_prime', null, true);
$setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon', 0);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Logo compact.
$name = 'theme_prime/logocompact';
$title = get_string('logocompact', 'theme_prime', null, true);
$description = get_string('logocompact_desc', 'theme_prime', null, true);
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logocompact', 0);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Logo white.
$name = 'theme_prime/logowhite';
$title = get_string('logowhite', 'theme_prime', null, true);
$description = get_string('logowhite_desc', 'theme_prime', null, true);
$setting = new admin_setting_configstoredfile($name, $title, $description, 'logowhite', 0);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Primary pattern color select option.
$name = 'theme_prime/primarycolor';
$title = get_string('primarycolor', 'theme_prime');
$description = get_string('primarycolor_desc', 'theme_prime');
$default = "#79b05e";
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Secondary pattern color select option.
$name = 'theme_prime/secondarycolor';
$title = get_string('secondarycolor', 'theme_prime');
$description = get_string('secondarycolor_desc', 'theme_prime');
$default = "#48717e";
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Secondary pattern color select option.
$name = 'theme_prime/bodytextcolor';
$title = get_string('bodytextcolor', 'theme_prime');
$description = get_string('bodytextcolor_desc', 'theme_prime');
$default = "#757f95";
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// INFO Link.
$name = 'theme_prime/menulink';
$title = get_string('menulink', 'theme_prime');
$description = get_string('menulink_desc', 'theme_prime');
$default = 'lang:menulinkdefault';
$setting = new admin_setting_configtextarea($name, $title, $description, $default);
$temp->add($setting);

// Header style select option.
$name = 'theme_prime/themestyleheader';
$title = get_string('themestyleheader', 'theme_prime');
$description = get_string('themestyleheader_desc', 'theme_prime');
$default = 1;
$choices = [
    0 => get_string('moodlebased', 'theme_prime'),
    1 => get_string('themebased', 'theme_prime'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$temp->add($setting);

// Select the size for site inner pages.
$name = 'theme_prime/pagesize';
$title = get_string('pagesize', 'theme_prime');
$description = get_string('pagesize_desc', 'theme_prime');
$default = '1';
$choices = [
    'container' => get_string('container', 'theme_prime'),
    'default' => get_string('moodledefault', 'theme_prime'),
    'custom' => get_string('custom', 'theme_prime'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$temp->add($setting);

// Select the size for site font title.
$name = 'theme_prime/fonttitle';
$title = get_string('fonttitle', 'theme_prime');
$description = get_string('fonttitle_desc', 'theme_prime');
$default = 'montserrat';
$choices = [
    'Montserrat' => get_string('montserrat', 'theme_prime'),
    'Roboto' => get_string('roboto', 'theme_prime'),
    'Ubuntu' => get_string('ubuntu', 'theme_prime'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$temp->add($setting);

// Select the size for site font body.
$name = 'theme_prime/fontbody';
$title = get_string('fontbody', 'theme_prime');
$description = get_string('fontbody_desc', 'theme_prime');
$default = 'montserrat';
$choices = [
    'Montserrat' => get_string('montserrat', 'theme_prime'),
    'Roboto' => get_string('roboto', 'theme_prime'),
    'Ubuntu' => get_string('ubuntu', 'theme_prime'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$temp->add($setting);

// Give a custom size for site inner pages.
$name = 'theme_prime/pagesizecustomval';
$title = get_string('pagesizecustomval', 'theme_prime');
$description = get_string('pagesizecustomval_desc', 'theme_prime');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_INT);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Content font size.
$name = 'theme_prime/fontsize';
$title = get_string('fontsize', 'theme_prime');
$description = get_string('fontsize_desc', 'theme_prime');
$default = THEME_PRIME_THEMEDEFAULT;
$sizes = [
    THEME_PRIME_THEMEDEFAULT => get_string('default'),
    THEME_PRIME_SMALL => get_string('small', 'theme_prime'),
    THEME_PRIME_MEDIUM => get_string('medium', 'theme_prime'),
    THEME_PRIME_LARGE => get_string('large', 'theme_prime'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $sizes);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Select the available course type option.
$name = 'theme_prime/availablecoursetype';
$title = get_string('availablecoursetype', 'theme_prime');
$description = get_string('availablecoursetype_desc', 'theme_prime');
$default = THEME_PRIME_CAROUSEL;
$choices = [
    THEME_PRIME_CAROUSEL => get_string('carousel', 'theme_prime'),
    THEME_PRIME_MOODLEBASED => get_string('moodlebased', 'theme_prime'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$temp->add($setting);

// Select the combo list box type option.
$name = 'theme_prime/comboListboxType';
$title = get_string('comboListboxType', 'theme_prime');
$description = get_string('comboListboxType_desc', 'theme_prime');
$default = THEME_PRIME_COLLAPSE;
$choices = [
    THEME_PRIME_EXPAND => get_string('expand', 'theme_prime'),
    THEME_PRIME_COLLAPSE => get_string('collapse', 'theme_prime'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$temp->add($setting);

// Background image setting.
$name = 'theme_boost/backgroundimage';
$title = get_string('backgroundimage', 'theme_boost');
$description = get_string('backgroundimage_desc', 'theme_prime');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'backgroundimage');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Uploaded option for login page background image.
$name = 'theme_prime/loginbg';
$title = get_string('loginbg', 'theme_prime');
$description = get_string('loginbg_desc', 'theme_prime');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbg', 0);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Enable or disable option for "Back to top" option.
$name = 'theme_prime/backToTop_status';
$title = get_string('backToTop_status', 'theme_prime');
$description = get_string('backToTop_statusdesc', 'theme_prime');
$default = 1;
$choices = [
    1 => get_string('yes'),
    0 => get_string('no'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$temp->add($setting);

// Custom CSS file.
$name = 'theme_prime/customcss';
$title = get_string('customcss', 'theme_prime');
$description = get_string('customcssdesc', 'theme_prime');
$default = '';
$setting = new admin_setting_configtextarea($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Create theme presets heading.
$name = 'theme_prime/presetheading';
$title = get_string('presetheading', 'theme_prime', null, true);
$setting = new admin_setting_heading($name, $title, null);
$temp->add($setting);

// Sections order.
$name = 'theme_prime/sectionsorder';
$title = get_string('sectionsorder', 'theme_prime');
$description = get_string('order-sections-desc', 'theme_prime');
$default = 1;
$choices = [
    1 => get_string('layout1', 'theme_prime'),
    2 => get_string('layout2', 'theme_prime'),
    3 => get_string('layout3', 'theme_prime'),
    4 => get_string('layout4', 'theme_prime'),
];
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Replicate the preset files setting from theme_boost.
$name = 'theme_prime/presetfiles';
$title = get_string('presetfiles', 'theme_boost', null, true);
$description = get_string('presetfiles_desc', 'theme_boost', null, true);
$setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
    ['maxfiles' => 20, 'accepted_types' => ['.scss']]);
$temp->add($setting);

$settings->add($temp);
