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
 * Admin settings configuration for home page slider section.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

// Home page slider.
$temp = new admin_settingpage( 'theme_prime_slideshow', get_string( 'slideshowheading', 'theme_prime' ) );
$temp->add( new admin_setting_heading( 'theme_prime_slideshow', get_string( 'slideshowheadingsub', 'theme_prime' ),
format_text( get_string( 'slideshowdesc', 'theme_prime' ), FORMAT_MARKDOWN ) ) );

// Enable or disable option for slider show / hide in the home page.
$name = 'theme_prime/toggleslideshow';
$title = get_string( 'toggleslideshow', 'theme_prime' );
$description = get_string( 'toggleslideshowdesc', 'theme_prime' );
$default = THEME_PRIME_YES;
$choices = [
    THEME_PRIME_YES => get_string( 'yes' ),
    THEME_PRIME_NO => get_string( 'no' ),
];
$setting = new admin_setting_configselect( $name, $title, $description, $default, $choices );
$temp->add( $setting );

// Enable or diable option for home page slider auto scroll.
$name = 'theme_prime/autoslideshow';
$title = get_string( 'autoslideshow', 'theme_prime' );
$description = get_string( 'autoslideshowdesc', 'theme_prime' );
$default = THEME_PRIME_YES;
$choices = [
    THEME_PRIME_YES => get_string( 'yes' ),
    THEME_PRIME_NO => get_string( 'no' ),
];
$setting = new admin_setting_configselect( $name, $title, $description, $default, $choices );
$temp->add( $setting );

// SlideTitle.
$name = 'theme_prime/slidetitle';
$title = get_string( 'slidetitle', 'theme_prime' );
$description = get_string( 'slidetitledesc', 'theme_prime' );
$default = 'lang:slidetitledesc';
$setting = new admin_setting_configtext( $name, $title, $description, $default );
$temp->add( $setting );

// Slide Description.
$name = 'theme_prime/slidedescription';
$title = get_string( 'slidedescription', 'theme_prime' );
$description = get_string( 'slidedescription_desc', 'theme_prime' );
$default = get_string( 'slidedescription', 'theme_prime' );
$setting = new admin_setting_confightmleditor( $name, $title, $description, $default );
$temp->add( $setting );

// Give interval time for home page slider.
$name = 'theme_prime/slideinterval';
$title = get_string( 'slideinterval', 'theme_prime' );
$description = get_string( 'slideintervaldesc', 'theme_prime' );
$default = 3500;
$setting = new admin_setting_configtext( $name, $title, $description, $default, PARAM_INT );
$temp->add( $setting );

// Heightfor home page slider.
$name = 'theme_prime/slideheight';
$title = get_string( 'slideheight', 'theme_prime' );
$description = get_string( 'slideheightdesc', 'theme_prime' );
$default = 80;
$setting = new admin_setting_configtext( $name, $title, $description, $default, PARAM_INT );
$temp->add( $setting );

// Background color.
$name = 'theme_prime/slidebgcolor';
$title = get_string( 'slidebgcolor', 'theme_prime' );
$description = get_string( 'slidebgcolordesc', 'theme_prime' );
$default = '#ffffff';
$previewconfig = null;
$setting = new admin_setting_configcolourpicker( $name, $title, $description, $default, $previewconfig );
$setting->set_updatedcallback( 'theme_reset_all_caches' );
$temp->add( $setting );

// Select the overlay opacity value for the home page slider.
$name = 'theme_prime/slideOverlay';
$title = get_string( 'slideOverlay', 'theme_prime' );
$description = get_string( 'slideOverlay_desc', 'theme_prime' );
$opacity = [];
$opacity = array_combine( range( 0, 1, 0.1 ), range( 0, 1, 0.1 ) );
$setting = new admin_setting_configselect( $name, $title, $description, '0.4', $opacity );
$setting->set_updatedcallback( 'theme_reset_all_caches' );
$temp->add( $setting );

// Select the number of slides show in the homepage.
$name = 'theme_prime/numberofslides';
$title = get_string( 'numberofslides', 'theme_prime' );
$description = get_string( 'numberofslides_desc', 'theme_prime' );
$default = 3;
$choices = [
    1 => '1',
    2 => '2',
    3 => '3',
    4 => '4',
    5 => '5',
    6 => '6',
    7 => '7',
    8 => '8',
    9 => '9',
    10 => '10',
    11 => '11',
    12 => '12',
];
$temp->add( new admin_setting_configselect( $name, $title, $description, $default, $choices ) );

// Slideshow settings.
$numberofslides = get_config( 'theme_prime', 'numberofslides' );
for ($i = 1; $i <= $numberofslides; $i++) {

    // This is the descriptor for Slide.
    $name = 'theme_prime/slide' . $i . 'info';
    $heading = get_string( 'slideno', 'theme_prime', [ 'slide' => $i ] );
    $information = get_string( 'slidenodesc', 'theme_prime', [ 'slide' => $i ] );
    $setting = new admin_setting_heading( $name, $heading, $information );
    $temp->add( $setting );

    // Enable or disable option for slide show.
    $name = 'theme_prime/slide' . $i .'status';
    $title = get_string( 'slideStatus', 'theme_prime', [ 'slide' => $i ] );
    $description = get_string( 'slideStatus_desc', 'theme_prime', [ 'slide' => $i ] );
    $default = THEME_PRIME_YES;
    $choices = [
        THEME_PRIME_YES => get_string( 'enable', 'theme_prime' ),
        THEME_PRIME_NO => get_string( 'disable', 'theme_prime' ),
    ];
    $setting = new admin_setting_configselect( $name, $title, $description, $default, $choices );
    $temp->add( $setting );

    // Slider image uploaded option.
    $name = 'theme_prime/slide' . $i . 'image';
    $title = get_string( 'slideimage', 'theme_prime' );
    $description = get_string( 'slideimagedesc', 'theme_prime' );
    $setting = new admin_setting_configstoredfile( $name, $title, $description, 'slide' . $i . 'image' );
    $setting->set_updatedcallback( 'theme_reset_all_caches' );
    $temp->add( $setting );

    // Enable or disable option for SlideShow content.
    $name = 'theme_prime/slide' . $i .'contentstatus';
    $title = get_string( 'slidecontentstatus', 'theme_prime', [ 'slide' => $i ] );
    $description = get_string( 'slidecontentstatus_desc', 'theme_prime', [ 'slide' => $i ] );
    $default = THEME_PRIME_YES;
    $setting = new admin_setting_configcheckbox( $name, $title, $description, $default );
    $temp->add( $setting );

    // Give a caption for the home page slider.
    $name = 'theme_prime/slide' . $i . 'caption';
    $title = get_string( 'slidecaption', 'theme_prime' );
    $description = get_string( 'slidecaptiondesc', 'theme_prime' );
    $default = 'lang:slidecaptiondefault';
    $setting = new admin_setting_configtext( $name, $title, $description, $default );
    $temp->add( $setting );

    // Give a description for the home page slider.
    $name = 'theme_prime/slide' . $i . 'desc';
    $title = get_string( 'slidedesc', 'theme_prime' );
    $description = get_string( 'slidedesctext', 'theme_prime' );
    $default = 'lang:slidedescdefault';
    $setting = new admin_setting_configtextarea( $name, $title, $description, $default );
    $temp->add( $setting );

    // Give a text for the home page slider button.
    $name = 'theme_prime/slide' . $i . 'btntext';
    $title = get_string( 'slidebtntext', 'theme_prime' );
    $description = get_string( 'slidebtntext_desc', 'theme_prime' );
    $default = 'lang:knowmore';
    $setting = new admin_setting_configtext( $name, $title, $description, $default, PARAM_TEXT );
    $temp->add( $setting );

    // Give a url for the home page slider button.
    $name = 'theme_prime/slide' . $i . 'btnurl';
    $title = get_string( 'slidebtnlink', 'theme_prime' );
    $description = get_string( 'slidebtnlink_desc', 'theme_prime' );
    $default = 'https://learingo.cl/';
    $setting = new admin_setting_configtext( $name, $title, $description, $default );
    $temp->add( $setting );

    // Select the target of the button for the home page slider.
    $name = 'theme_prime/slide' . $i . 'btntarget';
    $title = get_string( 'slidebtntarget', 'theme_prime' );
    $description = get_string( 'slidebtntarget_desc', 'theme_prime', [ 'slide' => $i ] );
    $default = THEME_PRIME_NEWWINDOW;
    $choices = [
        THEME_PRIME_SAMEWINDOW => get_string( 'sameWindow', 'theme_prime' ),
        THEME_PRIME_NEWWINDOW => get_string( 'newWindow', 'theme_prime' ),
    ];
    $setting = new admin_setting_configselect( $name, $title, $description, $default, $choices );
    $temp->add( $setting );

    // Give a content width for the home page slider.
    $name = 'theme_prime/slide' . $i . 'contFullwidth';
    $title = get_string( 'slideCont_full', 'theme_prime' );
    $description = get_string( 'slideCont_fulldesc', 'theme_prime' );
    $default = '50';
    $setting = new admin_setting_configtext( $name, $title, $description, $default );
    $setting->set_updatedcallback( 'theme_reset_all_caches' );
    $temp->add( $setting );

    // Select the content position option for the home page slider.
    $name = 'theme_prime/slide' . $i . 'contentPosition';
    $title = get_string( 'slidecontent', 'theme_prime', [ 'slide' => $i ] );
    $description = get_string( 'slidecontentdesc', 'theme_prime' );
    $default = 'centerRight';
    $choices = [
        'topLeft' => get_string( 'topLeft', 'theme_prime' ),
        'topRight' => get_string( 'topRight', 'theme_prime' ),
        'center' => get_string( 'center', 'theme_prime' ),
    ];
    $setting = new admin_setting_configselect( $name, $title, $description, $default, $choices );
    $temp->add( $setting );
}
/* Slideshow Settings End*/
$settings->add( $temp );
