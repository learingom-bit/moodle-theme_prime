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
 * Admin settings configuration for indicator block section.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

// Site features.
$temp = new admin_settingpage( 'theme_prime_indicadorlg', get_string( 'indicadorlg', 'theme_prime' ) );

// Enable or disable option for the site features block.
$name = 'theme_prime/lgbloquestatus';
$title = get_string( 'status', 'theme_prime' );
$description = get_string( 'statusdesc', 'theme_prime' );
$default = THEME_PRIME_YES;
$setting = new admin_setting_configcheckbox( $name, $title, $description, $default );
$temp->add( $setting );

// Site feature block Title.
$name = 'theme_prime/sitefeaturetitle';
$title = get_string( 'title', 'theme_prime' );
$description = get_string( 'titledesc', 'theme_prime' );
$default = 'lang:indicadorlgdefault';
$setting = new admin_setting_configtext( $name, $title, $description, $default );
$temp->add( $setting );

// Site feature block description.
$name = 'theme_prime/sitefeaturedesc';
$title = get_string( 'description', 'theme_prime' );
$description = get_string( 'description_desc', 'theme_prime' );
$default = get_string( 'description_defaults', 'theme_prime' );
$setting = new admin_setting_confightmleditor( $name, $title, $description, $default );
$temp->add( $setting );

// Select the number of site features show in the front page.
$name = 'theme_prime/numberofsitefeature';
$title = get_string( 'numberofsitef', 'theme_prime' );
$description = get_string( 'numberofsitef_desc', 'theme_prime' );
$default = 4;
$choices = array_combine( range( 1, 8 ), range( 1, 8 ) );
$temp->add( new admin_setting_configselect( $name, $title, $description, $default, $choices ) );

// Background color.
$name = 'theme_prime/sitefeaturebgcolor';
$title = get_string( 'sitefeaturebgcolor', 'theme_prime' );
$description = get_string( 'sitefeaturebgcolor_desc', 'theme_prime' );
$default = '#f4fdf1';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker( $name, $title, $description, $default, $previewconfig );
$setting->set_updatedcallback( 'theme_reset_all_caches' );
$temp->add( $setting );

// Indicator media.
$name = 'theme_prime/sitedmedia';
$title = get_string( 'media', 'theme_prime' );
$description = get_string( 'sitedmedia_desc', 'theme_prime' );
$default = '<img src="https://learingo.cl/prime.jpg">';
$setting = new admin_setting_configstoredfile( $name, $title, $description, 'sitedmedia', 0,
[ 'accepted_types' => 'web_image' ] );
$temp->add( $setting );

$indicadorlg = get_config( 'theme_prime', 'numberofsitefeature' );
for ($i = 1; $i <= $indicadorlg; $i++) {

    // Site feature heading.
    $name = 'theme_prime_lgbloque'.$i.'heading';
    $heading = get_string( 'lgbloque', 'theme_prime', [ 'block' => $i ] );
    $information = '';
    $setting = new admin_setting_heading( $name, $heading, $information );
    $temp->add( $setting );

    // Site feature enable/disable option.
    $name = 'theme_prime/lgbloque'.$i.'status';
    $title = get_string( 'status', 'theme_prime' );
    $description = get_string( 'statusdesc', 'theme_prime' );
    $default = THEME_PRIME_YES;
    $setting = new admin_setting_configcheckbox( $name, $title, $description, $default );
    $temp->add( $setting );

    // Site feature title.
    $name = 'theme_prime/lgbloque'.$i.'title';
    $title = get_string( 'title', 'theme_prime' );
    $description = get_string( 'titledesc', 'theme_prime' );
    $default = 'lang:sb'.$i.'_default_title';
    $setting = new admin_setting_configtext( $name, $title, $description, $default );
    $temp->add( $setting );

    // Site feature content.
    $name = 'theme_prime/lgbloque'.$i.'content';
    $title = get_string( 'content', 'theme_prime' );
    $description = get_string( 'content_desc', 'theme_prime' );
    $default = get_string( 'learnanytimedesc'.$i.'', 'theme_prime' );
    $setting = new admin_setting_confightmleditor( $name, $title, $description, $default );
    $temp->add( $setting );

    // Site feature icon.
    $name = 'theme_prime/lgbloque'.$i.'icon';
    $title = get_string( 'icon', 'theme_prime' );
    $description = get_string( 'icondesc', 'theme_prime' );
    $default = 'lang:lgbloqueicon'.$i.'_default';
    $setting = new admin_setting_configtext( $name, $title, $description, $default );
    $temp->add( $setting );

}
$settings->add( $temp );
