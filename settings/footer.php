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
 * Admin settings configuration for footer section.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Footer section.
$temp = new admin_settingpage('theme_prime_footer', get_string('footerheading', 'theme_prime'));

// Footer general block heading.
$name = 'theme_prime_footergeneralheading';
$heading = get_string('footerblockgeneral', 'theme_prime');
$information = '';
$setting = new admin_setting_heading($name, $heading, $information);
$temp->add($setting);

// Footer background image file setting.
$name = 'theme_prime/footerbgimg';
$title = get_string('footerbgimg', 'theme_prime');
$description = get_string('footerbgimgdesc', 'theme_prime');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'footerbgimg');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Footer background Overlay Opacity.
$name = 'theme_prime/footerbgOverlay';
$title = get_string('footerbgOverlay', 'theme_prime');
$description = get_string('footerbgOverlay_desc', 'theme_prime');
$opacity = [];
$opacity = array_combine(range(0, 1, 0.1), range(0, 1, 0.1));
$setting = new admin_setting_configselect($name, $title, $description, '0.4', $opacity);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Footer background color.
$name = 'theme_prime/footerbg';
$title = get_string('footerbg', 'theme_prime');
$description = get_string('footerbg_desc', 'theme_prime');
$default = '#0d4b60';
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
$temp->add($setting);

// Footer title color.
$name = 'theme_prime/footertitlecolor';
$title = get_string('footertitlecolor', 'theme_prime');
$description = get_string('footertitlecolor_desc', 'theme_prime');
$default = get_string('footertitlecolor_default', 'theme_prime');
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
$temp->add($setting);

// Footer text color.
$name = 'theme_prime/footertextcolor';
$title = get_string('footertextcolor', 'theme_prime');
$description = get_string('footertextcolor_desc', 'theme_prime');
$default = get_string('footertextcolor_default', 'theme_prime');
$setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
$temp->add($setting);

// Copyright.
$name = 'theme_prime/copyright_footer';
$title = get_string('copyright_footer', 'theme_prime');
$description = '';
$default = get_string('copyright_default', 'theme_prime');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

// Footer Block 1 heading.
$name = 'theme_prime_footerblock1heading';
$heading = get_string('footerblock', 'theme_prime') . ' 1';
$information = '';
$setting = new admin_setting_heading($name, $heading, $information);
$temp->add($setting);

// Footer block 1 status (enable / disable) option.
$name = 'theme_prime/footerb1_status';
$title = get_string('status', 'theme_prime');
$description = get_string('fblock_statusdesc', 'theme_prime');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$temp->add($setting);

// Footer block 1 title.
$name = 'theme_prime/footerbtitle1';
$title = get_string('title', 'theme_prime');
$description = get_string('footerbtitledesc', 'theme_prime');
$default = '';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

// Enable and Disable footer logo.
$name = 'theme_prime/footlogostatus';
$title = get_string('footerenable', 'theme_prime');
$description = '';
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$temp->add($setting);

// Footer Logo file setting.
$name = 'theme_prime/footerlogo';
$title = get_string('footerlogo', 'theme_prime');
$description = get_string('footerlogodesc', 'theme_prime');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'footerlogo');
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Footer content.
$name = 'theme_prime/footnote';
$title = get_string('footnote', 'theme_prime');
$description = get_string('footnotedesc', 'theme_prime');
$default = get_string('footnotedefault', 'theme_prime');
$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
$setting->set_updatedcallback('theme_reset_all_caches');
$temp->add($setting);

// Footer Block 2 heading.
$name = 'theme_prime_footerblock2heading';
$heading = get_string('footerblock', 'theme_prime') . ' 2';
$information = '';
$setting = new admin_setting_heading($name, $heading, $information);
$temp->add($setting);

// Footer block 2 status (enable / disable) option.
$name = 'theme_prime/footerb2_status';
$title = get_string('status', 'theme_prime');
$description = get_string('fblock_statusdesc', 'theme_prime');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$temp->add($setting);

// Footer block 2 title.
$name = 'theme_prime/footerbtitle2';
$title = get_string('title', 'theme_prime');
$description = get_string('footerbtitledesc', 'theme_prime');
$default = 'lang:footerbtitle2default';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

// INFO Link.
$name = 'theme_prime/infolink';
$title = get_string('infolink', 'theme_prime');
$description = get_string('infolink_desc', 'theme_prime');
$default = 'lang:infolinkdefault';
$setting = new admin_setting_configtextarea($name, $title, $description, $default);
$temp->add($setting);

// Footer Block 3 heading.
$name = 'theme_prime_footerblock3heading';
$heading = get_string('footerblock', 'theme_prime') . ' 3';
$information = '';
$setting = new admin_setting_heading($name, $heading, $information);
$temp->add($setting);

// Footer block 3 status (enable / disable) option.
$name = 'theme_prime/footerb3_status';
$title = get_string('status', 'theme_prime');
$description = get_string('fblock_statusdesc', 'theme_prime');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$temp->add($setting);

// Footer block 3 title.
$name = 'theme_prime/footerbtitle3';
$title = get_string('title', 'theme_prime');
$description = get_string('footerbtitledesc', 'theme_prime');
$default = 'lang:footerbtitle3default';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

// Address.
$name = 'theme_prime/address';
$title = get_string('address', 'theme_prime');
$description = '';
$default = get_string('defaultaddress', 'theme_prime');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

// Email ID.
$name = 'theme_prime/emailid';
$title = get_string('emailid', 'theme_prime');
$description = '';
$default = get_string('defaultemailid', 'theme_prime');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

// Phone number.
$name = 'theme_prime/phoneno';
$title = get_string('phoneno', 'theme_prime');
$description = '';
$default = get_string('defaultphoneno', 'theme_prime');
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

// Footer Block 4 heading.
$name = 'theme_prime_footerblock4heading';
$heading = get_string('footerblock', 'theme_prime') . ' 4';
$information = get_string('socialmediadesc', 'theme_prime');
$setting = new admin_setting_heading($name, $heading, $information);
$temp->add($setting);

// Footer block 4 status.
$name = 'theme_prime/footerb4_status';
$title = get_string('status', 'theme_prime');
$description = get_string('fblock_statusdesc', 'theme_prime');
$default = 1;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
$temp->add($setting);

// Footer block 4 Title.
$name = 'theme_prime/footerbtitle4';
$title = get_string('title', 'theme_prime');
$description = get_string('footerbtitledesc', 'theme_prime');
$default = 'lang:footerbtitle4default';
$setting = new admin_setting_configtext($name, $title, $description, $default);
$temp->add($setting);

// Select the number of social media show on the footer.
$name = 'theme_prime/numofsocialmedia';
$title = get_string('numofsocialmedia', 'theme_prime');
$description = get_string('numofsocialmediadesc', 'theme_prime');
$default = 4;
$choices = array_combine(range(1, 8), range(1, 8));
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$temp->add($setting);

$numofsocialmedia = get_config('theme_prime', 'numofsocialmedia');
for ($f = 1; $f <= $numofsocialmedia; $f++) {

    // Social media heading.
    $name = 'theme_prime_socialmeida' . $f;
    $heading = get_string('socialmeida', 'theme_prime', ['socialmedia' => $f]);
    $information = '';
    $setting = new admin_setting_heading($name, $heading, $information);
    $temp->add($setting);

    // Social media status (Enable or disable) option.
    $name = 'theme_prime/socialmedia' . $f . '_status';
    $title = get_string('smediastatus', 'theme_prime');
    $description = get_string('smediastatus_desc', 'theme_prime');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $temp->add($setting);

    // Social media icon.
    $name = 'theme_prime/socialmedia' . $f . '_icon';
    $title = get_string('icon', 'theme_prime');
    $description = get_string('socialmediaicon_desc', 'theme_prime');
    $default = get_string('socialmediaicon' . $f . '_default', 'theme_prime');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    // Social link URL.
    $name = 'theme_prime/socialmedia' . $f . '_url';
    $title = get_string('url', 'theme_prime');
    $description = get_string('socialmediaurl_desc', 'theme_prime');
    $default = get_string('socialmediaurl' . $f . '_default', 'theme_prime');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);
}

$settings->add($temp);
